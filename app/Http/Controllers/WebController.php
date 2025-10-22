<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Ad;
use App\Models\Country;
use App\Models\City;
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
        $query = Ad::with('category', 'subcategory', 'country', 'city');

        $category = null;
        $subcategory = null;

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

        $ads = $query->paginate(10);
        $categories = Category::with('subcategories')->get();

        return view('web.listing', compact('ads', 'categories', 'category', 'subcategory'));
    }

    public function detail($uuid)
    {
        $ad = Ad::with('category', 'subcategory', 'country', 'city')->where('uuid', $uuid)->firstOrFail();
        return view('web.detail', compact('ad'));
    }

    public function preview($id = null)
    {
        $ad = null;
        if ($id) {
            $ad = Ad::with('category', 'subcategory', 'country', 'city')->where('uuid', $id)->firstOrFail();
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
            'city_id' => 'required|exists:cities,id',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'tags' => 'nullable|string',
            'company_name' => 'nullable|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
        ]);

        $validated['uuid'] = Str::uuid()->toString();

        // Handle file upload
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('ads', 'public');
        }

        // Handle tags as JSON
        if (isset($validated['tags'])) {
            $validated['tags'] = json_encode(array_map('trim', explode(',', $validated['tags'])));
        }

        $ad = Ad::create($validated);

        // Check if preview was requested
        if ($request->input('action') === 'preview') {
            return redirect()->route('web.preview', $ad->uuid);
        }

        return redirect()->route('web.listing')->with('success', 'Ad created successfully!');
    }

    public function edit($uuid)
    {
        $ad = Ad::where('uuid', $uuid)->firstOrFail();
        $categories = Category::with('subcategories')->get();
        $countries = Country::where('status', true)->get();

        return view('web.preview', compact('ad', 'categories', 'countries'));
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
            'city_id' => 'required|exists:cities,id',
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

    public function getCities(Request $request)
    {
        $countryName = $request->country;
        $country = Country::where('name', $countryName)->first();

        if (!$country) {
            return response()->json([]);
        }

        $cities = $country->cities()->where('status', true)->get(['id', 'name']);
        return response()->json($cities);
    }

    // Admin panel methods for managing countries and cities
    public function countries()
    {
        $countries = Country::with('cities')->paginate(10);
        return view('admin.countries.index', compact('countries'));
    }

    public function cities()
    {
        $cities = City::with('country')->paginate(10);
        $countries = Country::where('status', true)->get();
        return view('admin.cities.index', compact('cities', 'countries'));
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

    public function storeCity(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'status' => 'boolean'
        ]);

        City::create($validated);
        return redirect()->back()->with('success', 'City created successfully');
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
}
