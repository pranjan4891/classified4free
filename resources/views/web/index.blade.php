@extends('web.includes.main')
@section('content')
<div class="app-canvas">
   <div class="container">
      <header class="heading big text-center">
         <h1>World’s <strong>Biggest</strong> Classified Marketplace</h1>
         <p class="text-uppercase">sell &amp; purchase anything</p>
      </header>
      <div class="cat-boxes">
         @foreach($categories as $index => $category)
         <a href="{{ route('web.listing', $category->slug) }}" class="cat-box">
            <div class="inner" style="height: 200px;">
               <div class="adicon-car bg{{ $index + 1 }}"></div>
               <span>{{ $category->name }}</span>
            </div>
         </a>
         @endforeach
      </div>
   </div>
   <div class="section">
      <div class="container">
         <div class="row">
            <div class="col-xs-12 col-md-4">
               <div class="text-widget">
                  <div class="inner">
                     <h4>About Us</h4>
                     <p>Classified4Free is a free online platform where anyone can post ads easily.</p>
                  </div>
               </div>
            </div>
            <div class="col-xs-12 col-md-4">
               <div class="text-widget">
                  <div class="inner">
                     <h4>Location</h4>
                     <p>Choose your country and city to reach the right audience instantly.</p>
                  </div>
               </div>
            </div>
            <div class="col-xs-12 col-md-4">
               <div class="text-widget">
                  <div class="inner">
                     <h4>Safety</h4>
                     <p>Buy, sell, or promote anything — simple, fast, and 100% free!</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
