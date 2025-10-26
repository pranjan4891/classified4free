<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Ad;
use App\Models\Country;
use Illuminate\Support\Str;

class WebController extends Controller
{
    public function index()
    {
        $categories = Category::with('subcategories')->get();
        return view('web.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::with('subcategories')->get();
        $countries = Country::where('status', true)->get();
        $ad = null;

        // Check if editing an existing ad
        if (request()->has('edit') && request('edit')) {
            $ad = Ad::where('uuid', request('edit'))->firstOrFail();
        }

        return view('web.create', compact('categories', 'countries', 'ad'));
    }

    public function listing(Request $request, $categorySlug = null, $subcategorySlug = null)
    {
        $query = Ad::with('category', 'subcategory', 'country');

        $category = null;
        $subcategory = null;
        $country = null;
        $city = null;

        if ($categorySlug) {
            $category = Category::where('slug', $categorySlug)->firstOrFail();
            $query->where('category_id', $category->id);

            if ($subcategorySlug) {
                $subcategory = Subcategory::where('slug', $subcategorySlug)
                    ->where('category_id', $category->id)
                    ->firstOrFail();
                $query->where('subcategory_id', $subcategory->id);
            }
        }

        // Filter by country
        if ($request->has('country') && $request->country) {
            $country = Country::where('id', $request->country)->first();
            if ($country) {
                $query->where('country_id', $country->id);
            }
        }

        // Filter by search keywords
        if ($request->has('q') && $request->q) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('city_name', 'like', '%' . $search . '%')
                  ->orWhere('tags', 'like', '%' . $search . '%')
                  ->orWhereHas('category', function ($cq) use ($search) {
                      $cq->where('name', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('subcategory', function ($sq) use ($search) {
                      $sq->where('name', 'like', '%' . $search . '%');
                  });
            });
        }

        // Filter by date range
        if ($request->has('date_filter') && $request->date_filter) {
            $dateFilter = $request->date_filter;
            $now = now();
            
            // Debug logging
            \Log::info('Date filter applied: ' . $dateFilter);
            \Log::info('Current time: ' . $now->toDateTimeString());
            
            switch ($dateFilter) {
                case 'today':
                    $today = $now->toDateString();
                    \Log::info('Filtering for today: ' . $today);
                    $query->whereDate('created_at', $today);
                    break;
                case 'last_7_days':
                    $sevenDaysAgo = $now->copy()->subDays(7);
                    \Log::info('Filtering from: ' . $sevenDaysAgo->toDateTimeString());
                    $query->where('created_at', '>=', $sevenDaysAgo);
                    break;
                case 'last_30_days':
                    $thirtyDaysAgo = $now->copy()->subDays(30);
                    \Log::info('Filtering from: ' . $thirtyDaysAgo->toDateTimeString());
                    $query->where('created_at', '>=', $thirtyDaysAgo);
                    break;
                case 'last_3_months':
                    $threeMonthsAgo = $now->copy()->subMonths(3);
                    \Log::info('Filtering from: ' . $threeMonthsAgo->toDateTimeString());
                    $query->where('created_at', '>=', $threeMonthsAgo);
                    break;
                case 'recently_published':
                default:
                    // No additional filtering for "Recently Published" - just show all
                    \Log::info('No date filter applied - showing all ads');
                    break;
            }
        }

        $ads = $query->paginate(6);
        $categories = Category::with('subcategories')->get();

        return view('web.listing', compact('ads', 'categories', 'category', 'subcategory', 'country', 'city'));
    }

    public function detail($vid)
    {
        $ad = Ad::with('category', 'subcategory', 'country')->where('vid', $vid)->firstOrFail();
        
        // Increment views counter
        $ad->increment('views');
        
        // Fetch similar ads (same category, excluding current ad)
        $similarAds = Ad::with('category', 'subcategory', 'country')
            ->where('category_id', $ad->category_id)
            ->where('vid', '!=', $ad->vid)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        
        return view('web.detail', compact('ad', 'similarAds'));
    }

    public function preview($id = null)
    {
        $ad = null;
        if ($id) {
            $ad = Ad::with('category', 'subcategory', 'country')->where('uuid', $id)->firstOrFail();
            
            // Filter out null/empty fields for display
            $ad->filtered_data = [
                'title' => $ad->title,
                'description' => $ad->description,
                'price' => $ad->price && $ad->country ? ($ad->country->currency_symbol ?? '₹') . number_format($ad->price) : null,
                'negotiable_price' => $ad->negotiable_price && $ad->country ? ($ad->country->currency_symbol ?? '₹') . number_format($ad->negotiable_price) : null,
                'city_name' => $ad->city_name,
                'country' => $ad->country ? $ad->country->name : null,
                'category' => $ad->category ? $ad->category->name : null,
                'subcategory' => $ad->subcategory ? $ad->subcategory->name : null,
                'featured_image' => $ad->featured_image,
                'tags' => $ad->tags ? json_decode($ad->tags, true) : null,
                'company_name' => $ad->company_name,
                'email' => $ad->email,
                'phone' => $ad->phone,
                'created_at' => $ad->created_at,
                'uuid' => $ad->uuid,
            ];
            
            // Remove null/empty values
            $ad->filtered_data = array_filter($ad->filtered_data, function($value) {
                return $value !== null && $value !== '' && $value !== [];
            });
        }

        return view('web.preview', compact('ad'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric',
            'negotiable_price' => 'nullable|numeric',
            'country_id' => 'required|exists:countries,id',
            'city_name' => 'required|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'tags' => 'nullable|string',
            'company_name' => 'nullable|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
        ]);

        $validated['uuid'] = Str::uuid()->toString();
        $validated['vid'] = 'C4FID'.rand(10000000, 99999999);        
        // Handle file upload
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('ads', 'public');
        }

        // Handle tags as JSON
        if (isset($validated['tags'])) {
            $validated['tags'] = json_encode(array_map('trim', explode(',', $validated['tags'])));
        }

        $ad = Ad::create($validated);

        // Always redirect to preview page after creating ad
        return redirect()->route('web.preview', $ad->uuid)->with('success', 'Ad created successfully!');
    }

    public function edit($uuid)
    {
        $ad = Ad::where('uuid', $uuid)->firstOrFail();
        $categories = Category::with('subcategories')->get();
        $countries = Country::where('status', true)->get();

        return view('web.create', compact('ad', 'categories', 'countries'));
    }

    public function update(Request $request, $uuid)
    {
        $ad = Ad::where('uuid', $uuid)->firstOrFail();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric',
            'negotiable_price' => 'nullable|numeric',
            'country_id' => 'required|exists:countries,id',
            'city_name' => 'required|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'tags' => 'nullable|string',
            'company_name' => 'nullable|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
        ]);

        // Handle file upload
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('ads', 'public');
        } else {
            // Keep existing image if no new one uploaded
            $validated['featured_image'] = $ad->featured_image;
        }

        // Handle tags as JSON
        if (isset($validated['tags'])) {
            $validated['tags'] = json_encode(array_map('trim', explode(',', $validated['tags'])));
        }

        $ad->update($validated);

        // Check if preview was requested
        if ($request->input('action') === 'preview') {
            return redirect()->route('web.preview', $ad->uuid);
        }

        return redirect()->route('web.listing')->with('success', 'Ad updated successfully!');
    }

    public function destroy($uuid)
    {
        $ad = Ad::where('uuid', $uuid)->firstOrFail();
        $ad->delete();

        return redirect()->route('web.listing')->with('success', 'Ad deleted successfully!');
    }

    public function getSubcategories(Request $request)
    {
        $categoryId = $request->category_id;
        $subcategories = Subcategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }


    // Admin panel methods for managing countries and cities
    public function countries()
    {
        $countries = Country::with('cities')->paginate(10);
        return view('admin.countries.index', compact('countries'));
    }


    public function storeCountry(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:countries,name',
            'code' => 'nullable|string|max:3',
            'status' => 'boolean'
        ]);

        Country::create($validated);
        return redirect()->back()->with('success', 'Country created successfully');
    }


    public function getSubcategoriesByCategory($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $subcategories = $category->subcategories->map(function($subcat) use ($category) {
            return [
                'id' => $subcat->id,
                'name' => $subcat->name,
                'slug' => $subcat->slug,
                'category_slug' => $category->slug
            ];
        });

        return response()->json($subcategories);
    }

    public function getCountries()
    {
        $countries = Country::where('status', true)->get(['id', 'name']);
        return response()->json($countries);
    }

    public function getCategories()
    {
        $categories = Category::with('subcategories')->get();
        return response()->json($categories);
    }

}
