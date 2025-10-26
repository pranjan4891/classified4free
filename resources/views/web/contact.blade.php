@extends('web.includes.main')
@section('content')


        <div class="app-canvas">
            <div class="container">
                <div class="breadcrumb">
                    <ul>
                        <li><a href="{{ route('web.index') }}">Home</a></li>
                        <li>Contact Us</li>
                    </ul>
                </div>

                <div class="page contextual-page mb-0">
                    <div class="inner">
                        <div data-pin="{{asset('public/assets/img/basic/pin.png')}}" data-zoomlvl="5" data-address="texus usa" class="widget-map page-margin-fix" id="widget-map-1">

                        </div>

                        <header class="page-header text-center">
                            <p>If you have questions or comments, please get a hold of us in whichever way is most convenient.
                                <br><strong>Ask away there is no reasonable question that our team can not answer</strong>.</p>
                        </header>

                        <div class="pt-100 pb-100">

                            <div class="heading text-center">
                                <h1>Get In Touch With Us</h1>
                                Send us a message
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-8 col-md-offset-2">
                                    <form class="clearfix" action="/">
                                        <div class="fields-grid clearfix">
                                            <div class="fields-grid-ele">
                                                <div class="labeled-input">
                                                    <label for="addComment001">Your Name</label>
                                                    <input type="text" id="addComment001">
                                                </div>
                                            </div>
                                            <div class="fields-grid-ele">
                                                <div class="labeled-input">
                                                    <label for="addComment002">Your Email</label>
                                                    <input type="email" id="addComment002">
                                                </div>
                                            </div>
                                            <div class="fields-grid-ele">
                                                <div class="labeled-input">
                                                    <label for="addComment003">Subject</label>
                                                    <input type="text" id="addComment003">
                                                </div>
                                            </div>
                                            <div class="fields-grid-ele">
                                                <div class="labeled-input">
                                                    <label for="addComment004">Website</label>
                                                    <input type="text" id="addComment004">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="labeled-input">
                                            <label for="addComment005">Your comment</label>
                                            <textarea id="addComment005"></textarea>
                                        </div>
                                        <br>
                                        <button class="btn btn-green btn-small block-element">Submit</button>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <div class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-md-4">
                            <div class="text-widget">
                                <div class="inner">
                                    <h4>About Us</h4>
                                    <p>Morbi ut tellus ac leo molestie luctus nec vehicula sed justo ut varius onec tempor rhoncus volutpat ras lorem.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="text-widget">
                                <div class="inner">
                                    <h4>Our Address</h4>
                                    <p>Morbi ut tellus ac leo molestie luctus nec vehicula sed justo ut varius onec tempor rhoncus volutpat ras lorem.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="text-widget">
                                <div class="inner">
                                    <h4>Contact info</h4>
                                    <p>Morbi ut tellus ac leo molestie luctus nec vehicula sed justo ut varius onec tempor rhoncus volutpat ras lorem.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="call-to-action">
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
