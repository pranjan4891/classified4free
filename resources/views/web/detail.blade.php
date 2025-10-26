@extends('web.includes.main')
@section('content')
<style>
   /* Tag badge styling */
   .tag-badge {
       display: inline-block;
       padding: 8px 15px;
       background-color: #007bff;
       color: #fff;
       border-radius: 20px;
       font-size: 13px;
       font-weight: 500;
       margin: 5px 5px 5px 0;
       transition: all 0.3s ease;
   }
   
   .tag-badge:hover {
       background-color: #0056b3;
       transform: translateY(-2px);
       box-shadow: 0 2px 5px rgba(0, 123, 255, 0.3);
   }
   
   .text-muted {
       color: #6c757d;
       font-style: italic;
   }
   
   .rich-text-content {
       line-height: 1.6;
   }
   .rich-text-content h1, .rich-text-content h2, .rich-text-content h3, 
   .rich-text-content h4, .rich-text-content h5, .rich-text-content h6 {
       margin-top: 20px;
       margin-bottom: 10px;
       font-weight: 600;
   }
   .rich-text-content p {
       margin-bottom: 15px;
   }
   .rich-text-content ul, .rich-text-content ol {
       margin-bottom: 15px;
       padding-left: 20px;
   }
   .rich-text-content table {
       width: 100%;
       border-collapse: collapse;
       margin-bottom: 15px;
   }
   .rich-text-content table th, .rich-text-content table td {
       border: 1px solid #ddd;
       padding: 8px;
       text-align: left;
   }
   .rich-text-content table th {
       background-color: #f8f9fa;
       font-weight: 600;
   }
   .rich-text-content blockquote {
       border-left: 4px solid #007bff;
       padding-left: 15px;
       margin: 15px 0;
       font-style: italic;
       color: #666;
   }
</style>

        <div class="app-canvas">
            <div class="container">
                <div class="breadcrumb">
                    <ul>
                        <li><a href="{{ route('web.index') }}">Home</a></li>
                        @if($ad->category)
                        <li><a href="{{ route('web.listing', $ad->category->name) }}">{{ $ad->category->name }}</a></li>
                        @endif
                        @if($ad->subcategory)
                        <li><a href="{{ route('web.listing', [$ad->category->name ?? '', $ad->subcategory->name]) }}">{{ $ad->subcategory->name }}</a></li>
                        @endif
                        <li>{{ $ad->title }}</li>
                    </ul>
                </div>

                <div class="item-single row">

                    <div class="item-content col-xs-12 col-sm-7 col-md-8">

                        <article class="inner">
                            <header>
                                <ul class="info-icons">
                                    <li><a href="mailto:{{ $ad->email }}" class="fa fa-envelope tooltip-parent">
              <span class="tooltip">Send Message</span></a></li>
                                    <li><a href="tel:{{ $ad->phone }}" class="fa fa-phone tooltip-parent">
              <span class="tooltip">Mobile Number</span>
                                    </a></li>
                                    <!-- <li><a href="#" class="fa fa-heart tooltip-parent">
                                        <span class="tooltip">save ad</span>
                                    </a></li> -->
                                </ul>
                                <h1>{{ $ad->title }}</h1>
                                <ul class="info-list">
                                    @if($ad->city_name || $ad->country)
                                    <li><i class="fa fa-map-marker"></i><a href="#">{{ $ad->city_name ?? '' }}{{ $ad->city_name && $ad->country ? ', ' : '' }}{{ $ad->country->name ?? '' }}</a></li>
                                    @endif
                                    <li><i class="fa fa-clock-o"></i>{{ $ad->created_at->diffForHumans() }}</li>
                                    <li><i class="fa fa-bookmark"></i>ID: {{ $ad->vid }}</li>
                                </ul>
                            </header>
                            @if($ad->featured_image)
                            <div class="item-gallery-slider">
                                <img src="{{ asset('storage/app/public/' . $ad->featured_image) }}" alt="{{ $ad->title }}">
                            </div>
                            @endif



                            <div class="quick-info">
                                <ul class="clearfix">
                                    @if($ad->category && $ad->category->name)
                                    <li>
                                        <div class="inner clearfix">
                                            <span class="label">Category</span>
                                            <span class="desc">{{ $ad->category->name }}</span>
                                        </div>
                                    </li>
                                    @endif
                                    
                                    @if($ad->subcategory && $ad->subcategory->name)
                                    <li>
                                        <div class="inner clearfix">
                                            <span class="label">SubCategory</span>
                                            <span class="desc">{{ $ad->subcategory->name }}</span>
                                        </div>
                                    </li>
                                    @endif
                                    
                                    
                                    @if($ad->country && $ad->country->name)
                                    <li>
                                        <div class="inner clearfix">
                                            <span class="label">Located In</span>
                                            <span class="desc">{{ $ad->country->name }}</span>
                                        </div>
                                    </li>
                                    @endif
                                    
                                    @if($ad->city_name)
                                    <li>
                                        <div class="inner clearfix">
                                            <span class="label">City</span>
                                            <span class="desc">{{ $ad->city_name }}</span>
                                        </div>
                                    </li>
                                    @endif
                                    
                                    <li>
                                        <div class="inner clearfix">
                                            <span class="label">Published On</span>
                                            <span class="desc">{{ $ad->created_at->format('d-m-Y') }}</span>
                                        </div>
                                    </li>
                                    
                                    @if($ad->company_name)
                                    <li>
                                        <div class="inner clearfix">
                                            <span class="label">Company Name</span>
                                            <span class="desc">{{ $ad->company_name }}</span>
                                        </div>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            @if($ad->description)
                            <div class="text-widget">
                                <header><h4>Product Description</h4></header>
                                <div class="inner rich-text-content">
                                    {!! $ad->description !!}
                                </div>
                            </div>
                            @endif
                            <footer>
                                <div class="inner row">
                                    <div class="col-xs-12 col-md-4">
                                        <span class="item-views"> <i class="fa fa-eye"></i> Ad Views: {{ number_format($ad->views ?? 0) }}</span>
                                    </div>
                                    <div class="col-xs-12 col-md-8 text-right-md"> </div>
                                </div>
                            </footer>
                        </article>

                        <div class="email-alerts">
                            <div class="inner clearfix">
                                <div class="col-xs-12 col-md-7">
                                    <h4>Post Your FREE Ad Today</h4>
                                    <p> Do you have something to sell?</p>
                                            <button class="btn btn-small btn-blue block-element danger-hover" onclick="window.location.href='{{ route('web.create') }}'">
                                        Create
                                    </button>
                                </div>
                            </div>
                        </div>

                       

                        <div class="items-list-md single-similar-items">
                            <h4>Similar ads</h4>
                            <div class="items-list">
                                @forelse($similarAds as $similarAd)
                                <article class="item-spot">
                                    <a href="{{ route('web.detail', $similarAd->vid) }}" class="imgAsBg">
                                        <img src="{{ $similarAd->featured_image ? asset('storage/app/public/' . $similarAd->featured_image) : asset('public/assets/img/items/list-item-1.png') }}" alt="{{ $similarAd->title }}">
                                    </a>
                                    <div class="item-content">
                                        <header>
                                            <h5><a href="{{ route('web.detail', $similarAd->vid) }}">{{ $similarAd->title }}</a></h5>
                                            <span class="item-info-short">{{ $similarAd->created_at->diffForHumans() }} in {{ $similarAd->city_name ?? 'Unknown' }}</span>
                                        </header>
                                        <div class="price-tag">
                                            @if($similarAd->price)
                                                {{ $similarAd->country && $similarAd->country->currency_symbol ? $similarAd->country->currency_symbol : '₹' }}{{ number_format($similarAd->price, 2) }}
                                            @else
                                                Contact for Price
                                            @endif
                                        </div>
                                        <div class="item-actions text-center">
                                            <ul class="contact-options">
                                                @if($similarAd->email)
                                                <li> <a href="mailto:{{ $similarAd->email }}" class="fa fa-envelope tooltip-parent">
              <span class="tooltip">Send Message</span>
                                                </a></li>
                                                @endif
                                                @if($similarAd->phone)
                                                <li><a href="tel:{{ $similarAd->phone }}" class="fa fa-phone tooltip-parent">
              <span class="tooltip">Mobile Number</span>
                                                </a></li>
                                                @endif
                                            </ul>
                                            <a class="view-item" href="{{ route('web.detail', $similarAd->vid) }}">view ad</a>
                                        </div>
                                    </div>
                                </article>
                                @empty
                                <div class="text-center py-4">
                                    <p>No similar ads found.</p>
                                </div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                    <aside class="sidebar col-xs-12 col-sm-5 col-md-4">
                        <div class="inner">
                            @if($ad->price || $ad->negotiable_price)
                            <div class="price-widget short-widget">
                                <i class="adicon-dollar"></i>
                                <strong>
                                    @if($ad->price)
                                        {{ $ad->country && $ad->country->currency_symbol ? $ad->country->currency_symbol : '₹' }}{{ number_format($ad->price, 2) }}
                                    @else
                                        Contact for Price
                                    @endif
                                </strong>
                                @if($ad->negotiable_price)
                                <span>
                                    Negotiable Price: {{ $ad->country && $ad->country->currency_symbol ? $ad->country->currency_symbol : '₹' }}{{ number_format($ad->negotiable_price, 2) }}
                                </span>
                                @elseif($ad->price)
                                <span>
                                    Fixed Price
                                </span>
                                @endif
                            </div>
                            @endif
                            @if($ad->phone || $ad->email)
                            <div class="number-widget short-widget">
                                <i class="adicon-phone"></i>
                                @if($ad->phone)
                                    <strong>{{ $ad->phone }}</strong>
                                @endif
                                @if($ad->email)
                                    <span>{{ $ad->email }}</span>
                                @endif
                            </div>
                            @endif
                            @if($ad->company_name || $ad->email)
                            <div class="user-widget text-center">
                                <img src="{{asset('public/assets/img/basic/user-thumb.png')}}" alt="Seller">
                                <h4><a href="#">{{ $ad->company_name ?? 'Individual Seller' }}</a></h4>
                                <!-- <div>Member Since 2013</div> -->
                                @if($ad->email)
                                    <a href="mailto:{{ $ad->email }}" class="link">Contact Seller</a>
                                @endif
                                <ul class="clearfix">
                                    @if($ad->email)
                                    <li><a class="btn btn-transparent" href="mailto:{{ $ad->email }}" class="fa fa-envelope tooltip-parent">
              Send Message</a></li>
                                    @endif
                                    <li><a class="btn btn-transparent" href="#" onclick="alert('Report functionality not implemented yet')">Report Ad</a></li>
                                </ul>
                            </div>
                            @endif
                            <div class="share-widget">
                                <span>Share This Ad</span>
                                <div class="social-links social-bg">
                                    <ul>

                                        <li><a href="#" target="_blank" class="fa fa-facebook"></a></li>

                                        <li><a href="#" target="_blank" class="fa fa-instagram"></a></li>
                                    </ul>
                                </div>
                            </div>

                            @if($ad->tags)
                            <div class="check-list-widget">
                               <h4>Tags</h4>
                                <ul>
                                    @php
                                        $tagsArray = is_array($ad->tags) ? $ad->tags : (is_string($ad->tags) ? json_decode($ad->tags, true) : []);
                                    @endphp
                                    @if(is_array($tagsArray) && count($tagsArray) > 0)
                                        @foreach($tagsArray as $tag)
                                            <li>{{ $tag }}</li>
                                        @endforeach
                                    @else
                                        <li><em>No tags available</em></li>
                                    @endif
                                </ul>
                            </div>
                            @endif

                        </div>
                    </aside>

                </div>

            </div>

        </div>
       @endsection
