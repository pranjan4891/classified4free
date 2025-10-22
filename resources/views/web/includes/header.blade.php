<!doctype html>
<html lang="en">
   <head>
      <title>Classified4Free- Buy | Sell Anything</title>
      <!--========================================
         Meta
         ===========================================-->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Disable tap highlight on IE -->
      <meta name="msapplication-tap-highlight" content="no">
      <!-- Web Application Manifest -->
      <!-- Add to home screen for Chrome on Android -->
      <meta name="mobile-web-app-capable" content="yes">
      <meta name="application-name" content="xDocs">
      <link rel="icon" sizes="192x192" href="{{asset('public/assets/img/basic/chrome-touch-icon-192x192.png')}}">
      <!-- Add to home screen for Safari on iOS -->
      <meta name="apple-mobile-web-app-capable" content="yes">
      <meta name="apple-mobile-web-app-status-bar-style" content="black">
      <meta name="apple-mobile-web-app-title" content="Web Starter Kit">
      <link rel="apple-touch-icon" href="{{asset('public/assets/img/basic/apple-touch-icon.png')}}">
      <!-- Tile icon for Win8 (144x144 + tile color) -->
      <meta name="msapplication-TileImage" content="{{asset('public/assets/img/basic/ms-touch-icon-144x144-precomposed.png')}}">
      <meta name="msapplication-TileColor" content="#55acee">
      <!-- Color the status bar on mobile devices -->
      <meta name="theme-color" content="#55acee">
      <!--========================================
         CSS
         ===========================================-->
      <!--3rd party plugins-->
      <link href="{{asset('public/assets/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
      <link href="{{asset('public/assets/lib/slick-carousel/slick/slick.css')}}" rel="stylesheet" type="text/css">
      <!--custom icons for classified website-->
      <link href="{{asset('public/assets/css/adspoticons.css')}}" rel="stylesheet" type="text/css">
      <!--main styles for template-->
      <link href="{{asset('public/assets/css/style.css')}}" rel="stylesheet" type="text/css">
      <!--put your custom css on the file below-->
      <link href="{{asset('public/assets/css/custom.css')}}" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div class="web-app">
      <div class="doc-header">
         <div class="container">
            <div class="inner">
               <div class="app-logo">
                  <button class="mobile-control mob-menu-trigger"><i class="adicon-hamburger"></i></button>
                  <a href="{{route('web.index')}}"><img src="{{asset('public/assets/img/LOGO.png')}}" alt="adspot"></a>
               </div>
               <div class="clearfix">
                  <a href="{{route('web.create')}}" class="btn btn-green pull-right quick-post">Post your ad</a>
                  <div class="pull-right search-filters">
                     <div class="mega-dropdown pull-left">
                        <button>Select Country / Region</button>
                        <i class="fa fa-navicon"></i>
                        <div class="mega-content">
                           <div class="inner">
                              <!-- 🔍 Search box -->
                              <div class="search-widget">
                                 <input type="text" id="countrySearch" placeholder="Search country / region" onkeyup="filterCountries()">
                                 <button type="submit"><i class="fa fa-search"></i></button>
                              </div>
                              <!-- 🌍 Country / Region list -->
                              <div class="mega-list" id="countryListContainer">
                                 <header><i class="adicon-globe"></i> Select Country / Region</header>
                                 <ul id="countryList" class="clearfix"></ul>
                              </div>
                              <!-- 🏙️ City list -->
                              <div class="mega-list" id="cityListContainer" style="display:none;">
                                 <header>
                                    <i class="adicon-buildings"></i> Select City
                                    <a href="#" onclick="backToCountries()" style="float:right;font-size:13px;">← Back</a>
                                 </header>
                                 <ul id="cityList" class="clearfix"></ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="mega-filtered-search">
                        <div class="mega-dropdown">
                           <button>Select Category</button>
                           <i class="fa fa-navicon"></i>
                           <div class="mega-content">
                              <ul class="category-list">
                                 <li><a href="#"><i class="adicon-grid"></i>All Categories</a></li>
                                 <li>
                                    <a href="#"><i class="adicon-car"></i>Vehicles</a>
                                    <ul>
                                       <li><a href="#">Cars</a></li>
                                       <li><a href="#">Bikes</a></li>
                                       <li><a href="#">Scooters</a></li>
                                       <li><a href="#">Commercial Vehicles</a></li>
                                       <li><a href="#">Spare Parts & Accessories</a></li>
                                       <li><a href="#">Electric Vehicles</a></li>
                                       <li><a href="#">Boats</a></li>
                                       <li><a href="#">Others</a></li>
                                    </ul>
                                 </li>
                                 <li>
                                    <a href="#"><i class="adicon-tablet"></i>Industrial & Business</a>
                                    <ul>
                                       <li><a href="#">Machinery & Equipment</a></li>
                                       <li><a href="#">Industrial Tools</a></li>
                                       <li><a href="#">Business for Sale</a></li>
                                       <li><a href="#">Franchise Opportunities</a></li>
                                       <li><a href="#">Office Supplies</a></li>
                                       <li><a href="#">Construction Material</a></li>
                                    </ul>
                                 </li>
                                 <li>
                                    <a href="#"><i class="adicon-tv"></i>Electronics & Appliances</a>
                                    <ul>
                                       <li><a href="#">Mobile Phones</a></li>
                                       <li><a href="#">Tablets</a></li>
                                       <li><a href="#">Laptops & Computers</a></li>
                                       <li><a href="#">TVs, Audio & Video</a></li>
                                       <li><a href="#">Cameras & Lenses</a></li>
                                       <li><a href="#">Gaming Consoles</a></li>
                                       <li><a href="#">Home Appliances (Fridge, AC, Washing Machine)</a></li>
                                       <li><a href="#">Smart Gadgets</a></li>
                                    </ul>
                                 </li>
                                 <li>
                                    <a href="#"><i class="adicon-sofa"></i>Furniture & Home Decor</a>
                                    <ul>
                                       <li><a href="#">Sofas & Chairs</a></li>
                                       <li><a href="#">Beds & Wardrobes</a></li>
                                       <li><a href="#">Tables & Desks</a></li>
                                       <li><a href="#">Kitchen Furniture</a></li>
                                       <li><a href="#">Office Furniture</a></li>
                                       <li><a href="#">Home Decor Items</a></li>
                                    </ul>
                                 </li>
                                 <li>
                                    <a href="#"><i class="adicon-briefcase"></i>Jobs</a>
                                    <ul>
                                       <li><a href="#">Full-Time</a></li>
                                       <li><a href="#">Part-Time</a></li>
                                       <li><a href="#">Work From Home</a></li>
                                       <li><a href="#">Freelance</a></li>
                                       <li><a href="#">Internship</a></li>
                                       <li><a href="#">Government Jobs</a></li>
                                       <li><a href="#">Abroad Jobs</a></li>
                                       <li><a href="#">Others</a></li>
                                    </ul>
                                 </li>
                                 <li>
                                    <a href="#"><i class="adicon-buildings"></i>Real Estate</a>
                                    <ul>
                                       <li><a href="#">Houses for Sale</a></li>
                                       <li><a href="#">Houses for Rent</a></li>
                                       <li><a href="#">Apartments / Flats</a></li>
                                       <li><a href="#">Commercial Property</a></li>
                                       <li><a href="#">Lands & Plots</a></li>
                                       <li><a href="#">PG & Roommates</a></li>
                                       <li><a href="#">Office Space</a></li>
                                       <li><a href="#">Vacation Rentals</a></li>
                                    </ul>
                                 </li>
                                 <li>
                                    <a href="#"><i class="adicon-bell"></i>Services</a>
                                    <ul>
                                       <li><a href="#">Home Services (Plumber, Electrician, Carpenter)</a></li>
                                       <li><a href="#">Repair Services (Mobile, Laptop, AC, etc.)</a></li>
                                       <li><a href="#">Packers & Movers</a></li>
                                       <li><a href="#">Beauty & Spa</a></li>
                                       <li><a href="#">Coaching & Tuition</a></li>
                                       <li><a href="#">Event Management</a></li>
                                       <li><a href="#">Travel & Transport</a></li>
                                       <li><a href="#">Legal & Financial</a></li>
                                       <li><a href="#">Cleaning Services</a></li>
                                    </ul>
                                 </li>
                                 <li>
                                    <a href="#"><i class="adicon-hat"></i>Education & Learning</a>
                                    <ul>
                                       <li><a href="#">Coaching Classes</a></li>
                                       <li><a href="#">Online Courses</a></li>
                                       <li><a href="#">Study Material & Books</a></li>
                                       <li><a href="#">Skill Development</a></li>
                                       <li><a href="#">School / College Admissions</a></li>
                                       <li><a href="#">Competitive Exams</a></li>
                                    </ul>
                                 </li>
                                 <li>
                                    <a href="#"><i class="adicon-dog"></i>Animals & Pet Care</a>
                                    <ul>
                                       <li><a href="#">Dogs</a></li>
                                       <li><a href="#">Cats</a></li>
                                       <li><a href="#">Birds</a></li>
                                       <li><a href="#">Fish & Aquariums</a></li>
                                       <li><a href="#">Pet Food & Accessories</a></li>
                                       <li><a href="#">Pet Adoption</a></li>
                                       <li><a href="#">Pet Grooming</a></li>
                                    </ul>
                                 </li>
                                 <li>
                                    <a href="#"><i class="adicon-heal"></i>Fashion & Lifestyle</a>
                                    <ul>
                                       <li><a href="#">Men’s Clothing</a></li>
                                       <li><a href="#">Women’s Clothing</a></li>
                                       <li><a href="#">Footwear</a></li>
                                       <li><a href="#">Watches</a></li>
                                       <li><a href="#">Jewellery</a></li>
                                       <li><a href="#">Bags & Accessories</a></li>
                                       <li><a href="#">Perfumes & Cosmetics</a></li>
                                    </ul>
                                 </li>
                                 <li>
                                    <a href="#"><i class="adicon-smile"></i>Kids & Baby Products</a>
                                    <ul>
                                       <li><a href="#">Baby Clothes</a></li>
                                       <li><a href="#">Toys</a></li>
                                       <li><a href="#">Baby Gear</a></li>
                                       <li><a href="#">School Supplies</a></li>
                                    </ul>
                                 </li>
                                 <li>
                                    <a href="#"><i class="adicon-hearts"></i>Travel & Tourism</a>
                                    <ul>
                                       <li><a href="#">Holiday Packages</a></li>
                                       <li><a href="#">Hotels & Stays</a></li>
                                       <li><a href="#">Car Rentals</a></li>
                                       <li><a href="#">Ticket Booking</a></li>
                                       <li><a href="#">Adventure Tours</a></li>
                                    </ul>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <div class="search-widget">
                           <input type="text" placeholder="search">
                           <button type="submit"><i class="fa fa-search"></i></button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="mobile-menu-wrap">
         <a href="#" class="closeMobilMenu">close the mobile menu</a>
         <nav class="mobile-menu">
            <div class="search-widget">
               <input type="text" placeholder="search">
               <button type="submit"><i class="fa fa-search"></i></button>
            </div>
            <ul class="menu-list">
               <li><a href="{{route('web.create')}}">Create an Ad</a></li>
               <li><a href="{{route('web.listing')}}">Ads Listing Page</a></li>
               <li><a href="{{route('web.about')}}">About us</a></li>
               <li><a href="{{route('web.contact')}}">Contact us</a></li>
            </ul>
         </nav>
      </div>

