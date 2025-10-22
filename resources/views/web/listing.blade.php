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
                        @else
                            All Ads
                        @endif
                    </h2>
                    <h4>{{ $ads->total() }} Ads found</h4>
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
                            <i class="fa"></i>
                            <span>Recently Published</span>
                            <ul>
                                <li><a href="#">Today</a></li>
                                <li><a href="#">Last 7 Days</a></li>
                                <li><a href="#">Last 30 Days</a></li>
                                <li><a href="#">Last 3 Months</a></li>
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
                        <a href="{{ route('web.detail',['uuid'=> $ad->uuid]) }}" class="imgAsBg">
                        <img src="{{ $ad->featured_image ? asset('storage/app/public/' . $ad->featured_image) : asset('public/assets/img/items/list-item-1.png') }}" alt="{{ $ad->title }}">
                        </a>
                        <div class="item-content">
                        <header>
                            <h4><a href="{{ route('web.detail',['uuid'=> $ad->uuid]) }}">{{ Str::limit($ad->title, 50) }}</a></h4>
                            <div class="breadcrumb">
                            <ul>
                                <li><a href="{{ route('web.listing', $ad->category->slug ?? '') }}">{{ $ad->category->name ?? 'Unknown' }}</a></li>
                                <li><a href="{{ route('web.listing', [$ad->category->slug ?? '', $ad->subcategory->slug ?? '']) }}">{{ $ad->subcategory->name ?? 'Unknown' }}</a></li>

                            </ul>
                            </div>
                            <ul class="item-info">
                            <li><i class="fa fa-map-marker"></i><a href="#">{{ $ad->city->name ?? 'Unknown' }}, {{ $ad->country->name ?? 'Unknown' }}</a></li>
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
                            <li>
                                <a href="{{ route('web.edit',['uuid'=> $ad->uuid]) }}" ><i class="fa fa-eye tooltip-parent"></i></a>
                                <span class="tooltip">Share</span>
                                </a>
                            </li>
                            </ul>
                            <div class="price-tag">
                            @if($ad->price)
                                ${{ number_format($ad->price, 2) }}
                            @else
                                Contact
                            @endif
                            </div>
                        </div>
                        <div class="inner">
                            <p>
                            {{ Str::limit($ad->description, 120) }}
                            </p>
                            <a class="view-item" href="{{ route('web.detail',['uuid'=> $ad->uuid]) }}">view ad</a>
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
                   var link = '{{ route("web.listing", ["category" => ":category", "subcategory" => ":subcategory"]) }}'.replace(':category', subcat.category_slug).replace(':subcategory', subcat.slug);
                   subCategoryList.append('<li><a href="' + link + '"><i></i><span>' + subcat.name + '</span></a></li>');
               });
           }
       }
   });
</script>

@endpush
