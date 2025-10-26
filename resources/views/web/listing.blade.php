@extends('web.includes.main')
@section('content')

<style>
       .pagination {
        margin-top: 20px;
        text-align: center;
        padding: 0;
    }
    .pagination a, .pagination span {
        color: #007bff;
        text-decoration: none;
        display: inline-block;
        margin: 0 5px;
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        cursor: pointer;
    }
    .pagination a:hover, .pagination .active span {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }
    
    .search-filters-applied {
        margin-top: 10px;
        padding: 10px;
        background: #f8f9fa;
        border-radius: 5px;
        border-left: 4px solid #007bff;
    }
    
    .filter-tag {
        display: inline-block;
        background: #007bff;
        color: white;
        padding: 4px 8px;
        border-radius: 3px;
        font-size: 12px;
        margin-right: 8px;
        margin-bottom: 5px;
    }
    
    .clear-filters {
        color: #dc3545;
        text-decoration: none;
        font-size: 12px;
        font-weight: bold;
    }
    
    .clear-filters:hover {
        text-decoration: underline;
    }
    
    .sort-action ul li a.active {
        background-color: #007bff;
        color: white;
    }
    
    .sort-action ul li a:hover {
        background-color: #f8f9fa;
        color: #007bff;
    }
    
    .sort-action {
        position: relative;
        display: inline-block;
    }
    
    .sort-button {
        background: #f8f9fa;
        border: 1px solid #ddd;
        padding: 8px 15px;
        border-radius: 4px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #666;
        min-width: 150px;
        justify-content: space-between;
    }
    
    .sort-button:hover {
        background: #e9ecef;
        border-color: #007bff;
    }
    
    .sort-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        z-index: 1000;
        min-width: 150px;
        display: none;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    
    .sort-action:hover .sort-dropdown {
        display: block;
    }
    
    .sort-dropdown li {
        margin: 0;
    }
    
    .sort-dropdown li a {
        display: block;
        padding: 10px 15px;
        color: #333;
        text-decoration: none;
        border-bottom: 1px solid #eee;
        transition: background-color 0.2s;
    }
    
    .sort-dropdown li:last-child a {
        border-bottom: none;
    }
    
    .sort-dropdown li a:hover {
        background: #f8f9fa;
        color: #007bff;
    }
    
    .sort-dropdown li a.active {
        background: #007bff;
        color: white;
    }
    
    .rich-text-preview {
        line-height: 1.5;
        margin-bottom: 10px;
    }
    
    .rich-text-preview p {
        margin-bottom: 8px;
    }
    
    .rich-text-preview h1, .rich-text-preview h2, .rich-text-preview h3, 
    .rich-text-preview h4, .rich-text-preview h5, .rich-text-preview h6 {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .rich-text-preview ul, .rich-text-preview ol {
        margin-bottom: 8px;
        padding-left: 15px;
    }
    
    .rich-text-preview table {
        font-size: 12px;
    }
    
    .rich-text-preview blockquote {
        border-left: 2px solid #007bff;
        padding-left: 8px;
        margin: 8px 0;
        font-style: italic;
        color: #666;
    }
</style>
        <div class="app-canvas">
            <div class="container">
                <div class="breadcrumb">
                    <ul>
                        <li><a href="{{ route('web.index') }}">Home</a></li>
                        @if(isset($category) && $category)
                        <li><a href="{{ route('web.listing', $category->slug) }}">{{ $category->name }}</a></li>
                        @endif
                        @if(isset($subcategory) && $subcategory)
                        <li>{{ $subcategory->name }}</li>
                        @endif
                    </ul>
                </div>
                <header class="heading text-bold">
                    <h2>
                        @if(isset($subcategory) && $subcategory)
                            {{ $subcategory->name }} Ads
                        @elseif(isset($category) && $category)
                            {{ $category->name }} Ads
                        @elseif(request('q'))
                            Search Results for "{{ request('q') }}"
                        @elseif(request('country'))
                            @php
                                $selectedCountry = \App\Models\Country::find(request('country'));
                            @endphp
                            @if($selectedCountry)
                                Ads in {{ $selectedCountry->name }}
                            @else
                                All Ads
                            @endif
                        @else
                            All Ads
                        @endif
                    </h2>
                    <h4>{{ $ads->total() }} Ads found</h4>
                    @if(request('q') || request('country') || request('date_filter'))
                        <div class="search-filters-applied">
                            @if(request('q'))
                                <span class="filter-tag">Search: "{{ request('q') }}"</span>
                            @endif
                            @if(request('country'))
                                @php
                                    $selectedCountry = \App\Models\Country::find(request('country'));
                                @endphp
                                @if($selectedCountry)
                                    <span class="filter-tag">Country: {{ $selectedCountry->name }}</span>
                                @endif
                            @endif
                            @if(request('date_filter'))
                                <span class="filter-tag">Date: {{ ucwords(str_replace('_', ' ', request('date_filter'))) }}</span>
                            @endif
                            <a href="{{ route('web.listing') }}" class="clear-filters">Clear all filters</a>
                        </div>
                    @endif
                </header>
                <div class="listing-actions text-right clearfix"  data-target="#items-listing-area">
                    <div class="inner">

                        <div class="layout-action">
                            <a href="#" class="active">
                                <i class="fa fa-bars"></i>
                                <span class="tooltip">List layout</span>
                            </a>
                            <a href="#">
                                <i class="fa fa-th"></i>
                                <span class="tooltip">Grid layout</span>
                            </a>
                        </div>

                        <div class="sort-action">
                            <button type="button" class="sort-button">
                                <i class="fa fa-chevron-down"></i>
                                <span id="dateFilterText">{{ request('date_filter') ? ucwords(str_replace('_', ' ', request('date_filter'))) : 'Recently Published' }}</span>
                            </button>
                            <ul class="sort-dropdown">
                                <li><a href="#" onclick="applyDateFilter('recently_published')" class="{{ request('date_filter') == 'recently_published' || !request('date_filter') ? 'active' : '' }}">Recently Published</a></li>
                                <li><a href="#" onclick="applyDateFilter('today')" class="{{ request('date_filter') == 'today' ? 'active' : '' }}">Today</a></li>
                                <li><a href="#" onclick="applyDateFilter('last_7_days')" class="{{ request('date_filter') == 'last_7_days' ? 'active' : '' }}">Last 7 Days</a></li>
                                <li><a href="#" onclick="applyDateFilter('last_30_days')" class="{{ request('date_filter') == 'last_30_days' ? 'active' : '' }}">Last 30 Days</a></li>
                                <li><a href="#" onclick="applyDateFilter('last_3_months')" class="{{ request('date_filter') == 'last_3_months' ? 'active' : '' }}">Last 3 Months</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="listing-area clearfix">
                    <div class="listing-filters">
                        <div class="listing-filter-block">
                            <header>
                                <h6>Categories</h6>
                                <a class="trigger-filter-block" href="#"><i class="fa fa-navicon"></i></a>
                            </header>
                            <div class="inner">
                                <div class="filter-options-widget">
                                    <ul>
                                        <li class="{{ !isset($category) ? 'active' : '' }}">
                                            <a href="{{ route('web.listing') }}" class="no-ajax">
                                                <i></i>
                                                <span>All Categories</span>
                                            </a>
                                        </li>
                                        @foreach($categories as $cat)
                                        <li class="{{ (isset($category) && $category->id == $cat->id) ? 'active' : '' }}">
                                            <a href="{{ route('web.listing', $cat->slug) }}">
                                                <i></i>
                                                <span>{{ $cat->name }}</span>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="listing-filter-block">
                            <header>
                                <h6>Sub Categories</h6>
                                <a class="trigger-filter-block" href="#"><i class="fa fa-navicon"></i></a>
                            </header>
                            <div class="inner">
                                <div class="filter-options-widget">
                                    <ul id="subCategoryList">
                                        <li class="{{ !isset($subcategory) ? 'active' : '' }}">
                                            <a href="{{ isset($category) ? route('web.listing', $category->slug) : route('web.listing') }}" class="no-ajax">
                                                <i></i>
                                                <span>All {{ isset($category) ? $category->name : 'Categories' }}</span>
                                            </a>
                                        </li>
                                        @if(isset($category) && $category)
                                            @foreach($category->subcategories as $subcat)
                                            <li class="{{ (isset($subcategory) && $subcategory->id == $subcat->id) ? 'active' : '' }}">
                                                <a href="{{ route('web.listing', [$category->slug, $subcat->slug]) }}">
                                                    <i></i>
                                                    <span>{{ $subcat->name }}</span>
                                                </a>
                                            </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                 <div id="items-listing-area" class="items-list">
                    @forelse($ads as $index => $ad)
                    <article class="item-spot {{ $index === 0 ? 'featured' : '' }}">
                        <a href="{{ route('web.detail', $ad->vid) }}" class="imgAsBg">
                        <img src="{{ $ad->featured_image ? asset('storage/app/public/' . $ad->featured_image) : asset('public/assets/img/items/list-item-1.png') }}" alt="{{ $ad->title }}">
                        </a>
                        <div class="item-content">
                        <header>
                            <h4><a href="{{ route('web.detail', $ad->vid) }}">{{ Str::limit($ad->title, 50) }}</a></h4>
                            <div class="breadcrumb">
                            <ul>
                                <li><a href="{{ route('web.listing', $ad->category->slug ?? '') }}">{{ $ad->category->name ?? 'Unknown' }}</a></li>
                                <li><a href="{{ route('web.listing', [$ad->category->slug ?? '', $ad->subcategory->slug ?? '']) }}">{{ $ad->subcategory->name ?? 'Unknown' }}</a></li>

                            </ul>
                            </div>
                            <ul class="item-info">
                            <li><i class="fa fa-map-marker"></i><a href="#">{{ $ad->city_name ?? 'Unknown' }}, {{ $ad->country->name ?? 'Unknown' }}</a></li>
                            <li><i class="fa fa-clock-o"></i>{{ $ad->created_at->diffForHumans() }}</li>
                            </ul>
                        </header>
                        <div class="item-actions text-center">
                            <ul class="contact-options">
                            <li>
                                <a href="mailto:{{ $ad->email }}" class="fa fa-envelope tooltip-parent">
                                <span class="tooltip">Send Message</span>
                                </a>
                            </li>
                            <li>
                                <a href="tel:{{ $ad->phone }}" class="fa fa-phone tooltip-parent">
                                <span class="tooltip">Mobile Number</span>
                                </a>
                            </li>
                            </ul>
                            <div class="price-tag">
                            @if($ad->price)
                                {{ $ad->country && $ad->country->currency_symbol ? $ad->country->currency_symbol : '$' }}{{ number_format($ad->price, 2) }}
                            @else
                                Contact
                            @endif
                            </div>
                        </div>
                        <div class="inner">
                            <div class="rich-text-preview">
                                {!! Str::limit(strip_tags($ad->description), 120) !!}
                            </div>
                            <a class="view-item" href="{{ route('web.detail', $ad->vid) }}">view ad</a>
                        </div>
                        </div>
                    </article>
                    @empty
                        <div class="text-center py-5">
                        <h4>No ads found</h4>
                        <p>Be the first to post an ad in this category!</p>
                        <a href="{{ route('web.create') }}" class="btn btn-green">Create Ad</a>
                        </div>
                    @endforelse
                    <div id="pagination" class="pagination">
                        {{ $ads->links() }}
                    </div>
                </div>
            </div>

        </div>

@endsection
@push('scripts')

<script>
   $(document).ready(function() {
       // Handle category clicks - update subcategories via AJAX
       $('ul li a[href*="add-listing/"]').click(function(e) {
           if ($(this).hasClass('no-ajax')) {
               return; // Skip AJAX for no-ajax links
           }
           e.preventDefault();

           var href = $(this).attr('href');
           var categoryName = href.split('/add-listing/')[1]; // Extract category name from URL

  if (categoryName) {
               // Load subcategories via AJAX
               $.ajax({
                   url: '{{ route("web.subcategories", ":category") }}'.replace(':category', categoryName),
                   type: 'GET',
                   beforeSend: function() {
                       $('#subCategoryList').append('<div class="loader">Loading...</div>');
                   },
                   success: function(data) {
                       $('#subCategoryList .loader').remove();
                       updateSubcategories(data);
                   },
                   error: function() {
                       $('#subCategoryList .loader').remove();
                       alert('Error loading subcategories');
                   }
               });
           }

           // Navigate to the category page
           window.location.href = href;
       });

       // Optional: Add loading state
       $(document).on('click', 'ul li a', function() {
           var $this = $(this);
           $this.find('span').append(' <i class="fa fa-spinner fa-spin"></i>');
           setTimeout(function() {
               $this.find('i.fa-spinner').remove();
           }, 500);
       });

       // Function to update subcategories list
       function updateSubcategories(data) {
           var subCategoryList = $('#subCategoryList');
           subCategoryList.find('li:not(:first)').remove(); // Remove all li except the first (All Categories)

           if (data && data.length > 0) {
               data.forEach(function(subcat) {
                   var link = '{{ route("web.listing", [":category", ":subcategory"]) }}'.replace(':category', subcat.category_slug).replace(':subcategory', subcat.slug);
                   subCategoryList.append('<li><a href="' + link + '"><i></i><span>' + subcat.name + '</span></a></li>');
               });
           }
       }

   });

   // Date filter functionality - Global scope
   function applyDateFilter(dateFilter) {
       console.log('Date filter clicked:', dateFilter);
       
       // Get current URL parameters
       const urlParams = new URLSearchParams(window.location.search);
       console.log('Current URL params:', urlParams.toString());
       
       // Update the date filter parameter
       urlParams.set('date_filter', dateFilter);
       console.log('Updated URL params:', urlParams.toString());
       
       // Build the new URL using Laravel route
       const baseUrl = '{{ route("web.listing") }}';
       const queryString = urlParams.toString();
       const finalUrl = queryString ? `${baseUrl}?${queryString}` : baseUrl;
       
       console.log('Redirecting to:', finalUrl);
       
       // Redirect to the new URL
       window.location.href = finalUrl;
   }
</script>

@endpush
