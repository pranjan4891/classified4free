@extends('web.includes.main')
@section('content')
    <div class="app-canvas">
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li>About us</li>
                </ul>
            </div>

            <div class="page contextual-page">
                <div class="inner">
                    <div class="slick-margin-fix">
                        <div class="slick-carousel slick-images dots-toRight" data-slides-scroll="1" data-dots="true" data-nav="false" data-prev="fa fa-chevron-left" data-next="fa fa-chevron-right" data-slides="1" data-slides-lg="1" data-slides-md="1" data-slides-sm="1" data-loop="true" data-auto="true">
                            <div class="slick-slide">
                                <img src="{{asset('public/assets/img/about1.jpg')}}" alt="dummy data">
                                <div class="slide-caption">
                                    <span class="big-caption">
                                        We strive to be the best and<br>
                                        make awesome work.
                                    </span>
                                </div>
                            </div>
                            <div class="slick-slide">
                                <img src="{{asset('public/assets/img/about2.jpg')}}" alt="dummy data">
                                <div class="slide-caption">
                                    <span class="big-caption">
                                        We strive to be the best and<br>
                                        make awesome work.
                                    </span>
                                </div>
                            </div>
                            <div class="slick-slide">
                                <img src="{{asset('public/assets/img/about3.jpg')}}" alt="dummy data">
                                <div class="slide-caption">
                                    <span class="big-caption">
                                        We strive to be the best and<br>
                                        make awesome work.
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="text-widget">
                                <h4>Introduction</h4><br>
                                Lorem ipsum dolor sit am consectetuer adipisc elit sed diam nonumy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpt wurisi enim ad minim veniam.
                                <br><br>
                                <h4>How we can help</h4><br>
                                Lorem ipsum dolor sit am consectetuer adipisc elit sed diam nonumy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpt wurisi enim ad minim veniam.
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <h4>What we’re good at</h4><br>
                            <div class="progress-bar" data-progress="62%">
                                <strong>Creativity</strong>
                                <div class="progress-line">
                                    <div><span>40%</span></div>
                                </div>
                            </div>

                            <div class="progress-bar" data-progress="92%">
                                <strong>Photoshop</strong>
                                <div class="progress-line">
                                    <div><span>92%</span></div>
                                </div>
                            </div>

                            <div class="progress-bar" data-progress="75%">
                                <strong>Development</strong>
                                <div class="progress-line">
                                    <div><span>75%</span></div>
                                </div>
                            </div>

                            <div class="progress-bar" data-progress="60%">
                                <strong>Marketing</strong>
                                <div class="progress-line">
                                    <div><span>60%</span></div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row border-separated-column border-top mt-100">
                        <div class="col-xs-12 col-sm-4">
                            <div class="text-with-icons">
                                <div class="widget-icon">
                                    <span class="fa fa-star-o"></span>
                                </div>
                                <h3 class="tc1">764</h3>
                                <strong>cups of coffee</strong>
                                <p>Lorem ipsum dolor met consectetur adipiscing elit. Sed a nulla ipsum itur pulvinar enim non justo.</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="text-with-icons">
                                <div class="bg2 widget-icon">
                                    <span class="fa fa-heart-o"></span>
                                </div>
                                <h3 class="tc2">8345</h3>
                                <strong>Happy users</strong>
                                <p>Lorem ipsum dolor met consectetur adipiscing elit. Sed a nulla ipsum itur pulvinar enim non justo.</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="text-with-icons">
                                <div class="bg9 widget-icon">
                                    <span class="fa fa-thumbs-o-up"></span>
                                </div>
                                <h3 class="tc9">14609</h3>
                                <strong>Ads posted</strong>
                                <p>Lorem ipsum dolor met consectetur adipiscing elit. Sed a nulla ipsum itur pulvinar enim non justo.</p>
                            </div>
                        </div>
                    </div>

                    <div class="team-members page-margin-fix clearfix">
                        <div class="team-member">
                            <img src="{{asset('public/assets/img/users/1a.jpg')}}" alt="dummt-data">
                            <div class="about-member">
                                <span>Artist</span>
                                <strong>David Spence</strong>
                            </div>
                            <ul class="social-links">
                                <li><a href="#" class="fa fa-facebook"></a></li>
                                <li><a href="#" class="fa fa-twitter"></a></li>
                                <li><a href="#" class="fa fa-google-plus"></a></li>
                                <li><a href="#" class="fa fa-instagram"></a></li>
                            </ul>
                        </div>
                        <div class="team-member">
                            <img src="{{asset('public/assets/img/users/2a.jpg')}}" alt="dummt-data">
                            <div class="about-member">
                                <span>Artist</span>
                                <strong>David Spence</strong>
                            </div>
                            <ul class="social-links">
                                <li><a href="#" class="fa fa-facebook"></a></li>
                                <li><a href="#" class="fa fa-twitter"></a></li>
                                <li><a href="#" class="fa fa-google-plus"></a></li>
                                <li><a href="#" class="fa fa-instagram"></a></li>
                            </ul>
                        </div>
                        <div class="team-member">
                            <img src="{{asset('public/assets/img/users/3a.jpg')}}" alt="dummt-data">
                            <div class="about-member">
                                <span>Artist</span>
                                <strong>David Spence</strong>
                            </div>
                            <ul class="social-links">
                                <li><a href="#" class="fa fa-facebook"></a></li>
                                <li><a href="#" class="fa fa-twitter"></a></li>
                                <li><a href="#" class="fa fa-google-plus"></a></li>
                                <li><a href="#" class="fa fa-instagram"></a></li>
                            </ul>
                        </div>
                        <div class="team-member">
                            <img src="{{asset('public/assets/img/users/4a.jpg')}}" alt="dummt-data">
                            <div class="about-member">
                                <span>Artist</span>
                                <strong>David Spence</strong>
                            </div>
                            <ul class="social-links">
                                <li><a href="#" class="fa fa-facebook"></a></li>
                                <li><a href="#" class="fa fa-twitter"></a></li>
                                <li><a href="#" class="fa fa-google-plus"></a></li>
                                <li><a href="#" class="fa fa-instagram"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="testimonial-slider mt-100 mb-100">
                        <div class="slick-carousel slick-testimonials dots-toRight" data-slides-scroll="1" data-dots="true" data-nav="false" data-prev="fa fa-chevron-left" data-next="fa fa-chevron-right" data-slides="1" data-slides-lg="1" data-slides-md="1" data-slides-sm="1" data-loop="true" data-auto="true">
                            <blockquote>
                                <q>Aenean sollicitudin lorem quis bibendum auctor nisi elit consequat ipsum nec sagittis sem nibh id elit lorem Ipsum proin gravida nibh vel velit auctor aliquet enean sollicitudin lorem quis bibendum.</q>
                                <cite>Gfx Partner</cite>
                            </blockquote>
                            <blockquote>
                                <q>Aenean sollicitudin lorem quis bibendum auctor nisi elit consequat ipsum nec sagittis sem nibh id elit lorem Ipsum proin gravida nibh vel velit auctor aliquet enean sollicitudin lorem quis bibendum.</q>
                                <cite>Gfx Partner</cite>
                            </blockquote>
                            <blockquote>
                                <q>Aenean sollicitudin lorem quis bibendum auctor nisi elit consequat ipsum nec sagittis sem nibh id elit lorem Ipsum proin gravida nibh vel velit auctor aliquet enean sollicitudin lorem quis bibendum.</q>
                                <cite>Gfx Partner</cite>
                            </blockquote>
                        </div>
                    </div>

                    <div class="page-margin-fix">
                        <div class="call-to-action-3">
                            <div class="inner clearfix">
                                <div class="counter">
                                    <span>2</span>
                                    <span>6</span>
                                    <span>3</span>
                                    <span>9</span>
                                    <span>5</span>
                                    <span>1</span>
                                </div>
                                <strong>World’s Biggest Classified Marketplace</strong>
                                <a href="#" class="btn btn-green pull-right">Post and Ad</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="call-to-action mt-25">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-7 pull-right">
                        <header>
                            <span class="text-uppercase">Make Your Phone a classified machine</span>
                            <h2>Download Free Classified App</h2>
                        </header>
                        <div class="row inner">
                            <div class="col-xs-4">
                                <a href="#" class="app-store">
                                    <img src="{{asset('public/assets/img/android.png')}}" alt="Google play">
                                    <span>download on</span>
                                    <h4>Google Play</h4>
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a href="#" class="app-store">
                                    <img src="{{asset('public/assets/img/apple.png')}}" alt="Apple store">
                                    <span>download on</span>
                                    <h4>Apple Store</h4>
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a href="#" class="app-store">
                                    <img src="{{asset('public/assets/img/win.png')}}" alt="windows store">
                                    <span>download on</span>
                                    <h4>Windows Store</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="hidden-xs col-sm-4 col-md-5 pull-right">
                        <div class="action-mock">
                            <img src="{{asset('public/assets/img/app-mock.png')}}" alt="download apps">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
