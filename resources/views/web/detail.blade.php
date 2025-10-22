@extends('web.includes.main')
@section('content')

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
                                    <li><i class="fa fa-map-marker"></i><a href="#">{{ $ad->city->name ?? 'Unknown' }}, {{ $ad->country->name ?? 'Unknown' }}</a></li>
                                    <li><i class="fa fa-clock-o"></i>{{ $ad->created_at->diffForHumans() }}</li>
                                    <li><i class="fa fa-bookmark"></i>ID: {{ $ad->uuid }}</li>
                                </ul>
                            </header>
                            <div class="item-gallery-slider">
                             <img src="{{ $ad->featured_image ? asset('storage/app/public/' . $ad->featured_image) : asset('public/assets/img/lg2.png') }}" alt="{{ $ad->title }}">

                            </div>



                            <div class="quick-info">
                                <ul class="clearfix">
                                    <li>
                                        <div class="inner clearfix">
                                            <span class="label">Category</span>
                                            <span class="desc">{{ $ad->category->name ?? 'Unknown' }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="inner clearfix">
                                            <span class="label">SubCategory</span>
                                            <span class="desc">{{ $ad->subcategory->name ?? 'Unknown' }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="inner clearfix">
                                              <span class="label">Tags</span>
                                            <span class="desc">
                                                @if($ad->tags)
                                                    {{ is_array($ad->tags) ? implode(', ', $ad->tags) : $ad->tags }}
                                                @else
                                                    No Tags
                                                @endif
                                            </span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="inner clearfix">
                                            <span class="label">Located In</span>
                                            <span class="desc">{{ $ad->country->name ?? 'Unknown' }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="inner clearfix">
                                            <span class="label">Published On</span>
                                            <span class="desc">{{ $ad->created_at->format('d-m-Y') }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="inner clearfix">
                                              <span class="label">Company Name</span>
                                            <span class="desc">{{ $ad->company_name ?? 'Individual' }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="text-widget">
                                <header><h4>Product Description</h4></header>
                                <div class="inner">
                                    {!! nl2br(e($ad->description)) !!}
                                </div>
                            </div>
                            <footer>
                                <div class="inner row">
                                    <div class="col-xs-12 col-md-4">
                                        <span class="item-views"> <i class="fa fa-eye"></i> Ad Views: {{ rand(100, 9999) }}</span>
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
                                <article class="item-spot">
                                    <a href="#" class="imgAsBg">
                                        <img src="{{asset('public/assets/img/items/list-item-1.png')}}" alt="dummy data">
                                    </a>
                                    <div class="item-content">
                                        <header>
                                            <h5><a href="detail.php">Canon SX Powershot A Great D-SLR</a></h5>
                                            <span class="item-info-short">2:49 pm in Melbourne</span>
                                        </header>
                                        <div class="price-tag">$229.9</div>
                                        <div class="item-actions text-center">
                                            <ul class="contact-options">
                                                <li> <a href="mailto:info@example.com" class="fa fa-envelope tooltip-parent">
              <span class="tooltip">Send Message</span>

                                                </a></li>
                                                <li><a href="tel:+911234567890" class="fa fa-phone tooltip-parent">
              <span class="tooltip">Mobile Number</span>
                                                </a></li>
                                                <!--<li><a href="#" class="fa fa-heart tooltip-parent">-->
                                                <!--    <span class="tooltip">save ad</span>-->
                                                <!--</a></li>-->
                                            </ul>
                                            <a class="view-item" href="detail.php">view ad</a>

                                        </div>

                                    </div>
                                </article>
                                <article class="item-spot">
                                    <a href="#" class="imgAsBg">
                                        <img src="{{asset('public/assets/img/items/list-item-1.png')}}" alt="dummy data">
                                    </a>
                                    <div class="item-content">
                                        <header>
                                            <h5><a href="detail.php">Canon SX Powershot A Great D-SLR</a></h5>
                                            <span class="item-info-short">2:49 pm in Melbourne</span>
                                        </header>
                                        <div class="price-tag">$229.9</div>
                                        <div class="item-actions text-center">
                                            <ul class="contact-options">
                                                <li><a href="mailto:info@example.com" class="fa fa-envelope tooltip-parent">
              <span class="tooltip">Send Message</span>
                                                </a></li>
                                                <li><a href="tel:+911234567890" class="fa fa-phone tooltip-parent">
              <span class="tooltip">Mobile Number</span>
                                                </a></li>
                                                <!--<li><a href="#" class="fa fa-heart tooltip-parent">-->
                                                <!--    <span class="tooltip">save ad</span>-->
                                                <!--</a></li>-->
                                            </ul>
                                            <a class="view-item" href="detail.php">view ad</a>

                                        </div>

                                    </div>
                                </article>
                                <article class="item-spot">
                                    <a href="#" class="imgAsBg">
                                        <img src="{{asset('public/assets/img/items/list-item-1.png')}}" alt="dummy data">
                                    </a>
                                    <div class="item-content">
                                        <header>
                                            <h5><a href="detail.php">Canon SX Powershot A Great D-SLR</a></h5>
                                            <span class="item-info-short">2:49 pm in Melbourne</span>
                                        </header>
                                        <div class="price-tag">$229.9</div>
                                        <div class="item-actions text-center">
                                            <ul class="contact-options">
                                                <li><a href="mailto:info@example.com" class="fa fa-envelope tooltip-parent">
                                                    <span class="tooltip">Send Message</span>
                                                </a></li>
                                                <li><a href="tel:+911234567890" class="fa fa-phone tooltip-parent">
                                                    <span class="tooltip">Mobile Number</span>
                                                </a></li>

                                            </ul>
                                            <a class="view-item" href="detail.php">view ad</a>

                                        </div>

                                    </div>
                                </article>
                            </div>
                        </div>

                    </div>
                    <aside class="sidebar col-xs-12 col-sm-5 col-md-4">
                        <div class="inner">
                            <div class="price-widget short-widget">
                                <i class="adicon-dollar"></i>
                                <strong>
                                    @if($ad->price)
                                        ${{ number_format($ad->price, 2) }}
                                    @else
                                        Contact for Price
                                    @endif
                                </strong>
                                <span>
                                    @if($ad->negotiable_price)
                                        Negotiable Price: ${{ number_format($ad->negotiable_price, 2) }}
                                    @else
                                        Fixed Price
                                    @endif
                                </span>
                            </div>
                            <div class="number-widget short-widget">
                                <i class="adicon-phone"></i>
                                <strong>{{ $ad->phone ?? 'Contact via Email' }}</strong>
                                <span>{{ $ad->email }}</span>
                            </div>
                            <div class="user-widget text-center">
                                <img src="{{asset('public/assets/img/basic/user-thumb.png')}}" alt="Seller">
                                <h4><a href="#">{{ $ad->company_name ?? 'Individual Seller' }}</a></h4>
                                <!-- <div>Member Since 2013</div> -->
                                <a href="mailto:{{ $ad->email }}" class="link">Contact Seller</a>
                                <ul class="clearfix">
                                    <li><a class="btn btn-transparent" href="mailto:{{ $ad->email }}" class="fa fa-envelope tooltip-parent">
              Send Message</a></li>
                                    <li><a class="btn btn-transparent" href="#" onclick="alert('Report functionality not implemented yet')">Report Ad</a></li>
                                </ul>
                            </div>
                            <div class="share-widget">
                                <span>Share This Ad</span>
                                <div class="social-links social-bg">
                                    <ul>

                                        <li><a href="#" target="_blank" class="fa fa-facebook"></a></li>

                                        <li><a href="#" target="_blank" class="fa fa-instagram"></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="check-list-widget">
                               <h4>Safety Tips</h4>
                                <ul>
                                    <li>Ensure the seller is trustworthy</li>
                                    <li>Research before buying</li>
                                    <li>Check product terms and conditions</li>
                                    <li>Use secure payment methods</li>
                                </ul>
                            </div>

                        </div>
                    </aside>

                </div>

            </div>

        </div>
       @endsection
