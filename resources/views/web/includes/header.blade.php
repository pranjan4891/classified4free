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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

      <style>
         /* Form Design Improvements */
         .form-wrapper {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 30px;
         }
         
         .field-block {
            margin-bottom: 25px;
            display: flex;
            align-items: center;
         }
         
         .field-block label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0;
            padding-right: 15px;
         }
         
         .field-block .required::after {
            content: " *";
            color: #dc3545;
         }
         
         .field-block input[type="text"],
         .field-block input[type="email"],
         .field-block input[type="tel"],
         .field-block input[type="number"],
         .field-block textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #fff;
            font-family: inherit;
         }
         
         .field-block select {
            width: 100%;
            padding: 12px 35px 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #fff;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10L6 9z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            cursor: pointer;
            font-family: inherit;
         }
         
         .field-block select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23007bff' d='M6 9L1 4h10L6 9z'/%3E%3C/svg%3E");
         }
         
         .field-block input:focus,
         .field-block textarea:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
         }
         
         .field-block input::placeholder,
         .field-block select option:first-child {
            color: #999;
         }
         
         .field-block select option {
            color: #333;
            padding: 8px;
         }
         
         /* Ensure all inputs have same height and alignment */
         .field-block input,
         .field-block select,
         .field-block textarea {
            min-height: 48px;
            box-sizing: border-box;
            line-height: 1.5;
         }
         
         .field-block select {
            padding-right: 40px;
         }
         
         /* Price fields alignment */
         .price-fields {
            display: flex;
            gap: 15px;
            align-items: flex-start;
         }
         
         .price-fields > div {
            flex: 1;
         }
         
         /* CKEditor container */
         .ck-editor-container {
            min-height: 250px;
         }
         
         /* File input styling */
         input[type="file"] {
            padding: 8px;
            border: 2px dashed #ddd;
            border-radius: 6px;
            background: #f8f9fa;
            cursor: pointer;
            transition: all 0.3s ease;
         }
         
         input[type="file"]:hover {
            border-color: #007bff;
            background: #f0f7ff;
         }
         
         /* Submit buttons */
         .form-submit-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #f0f0f0;
         }
         
         .btn {
            padding: 12px 30px;
            border-radius: 6px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            border: none;
         }
         
         .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
         }
         
         .btn-blue {
            background: #007bff;
            color: #fff;
         }
         
         .btn-green {
            background: #28a745;
            color: #fff;
         }
         
         /* Mobile Responsive */
         @media (max-width: 768px) {
            .form-wrapper {
               padding: 20px;
            }
            
            .field-block {
               flex-direction: column;
               align-items: flex-start;
            }
            
            .field-block label {
               margin-bottom: 8px;
               padding-right: 0;
            }
            
            .price-fields {
               flex-direction: column;
               gap: 10px;
            }
            
            .form-submit-buttons {
               flex-direction: column;
            }
            
            .form-submit-buttons .btn {
               width: 100%;
            }
         }
         
         .is-invalid {
            border-color: #dc3545 !important;
         }
         .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #dc3545;
         }
         /* Hide the "Rich Text Editor" label and screen reader text */
         .ck-editor__label,
         label[for="description"]:not(.required),
         .ck-editor__main label,
         .ck-toolbar__label,
         .ck-label,
         label[aria-describedby],
         .ck.ck-labeled-field-view label {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
         }
         /* Target specific CKEditor accessibility labels */
         label[for="description"]:not(.required) {
            display: none !important;
         }
         /* Hide any text that says "Rich Text Editor" */
         label:contains("Rich Text Editor"),
         span:contains("Rich Text Editor") {
            display: none !important;
         }
      </style>
      <!-- Make sure Font Awesome is included -->
      <style>
         select#headingSelect {
         background: #efefef;
         padding: 0 0 3px;
         }
         h1, h2, h3, h4, h5, .shortcodes-page h6 {
         margin: 0;
         color: #151515;
         font-weight: 600;
         }
      </style>
      <style>
         .tag-container {
         display: flex;
         flex-wrap: wrap;
         gap: 6px;
         border: 1px solid #ccc;
         padding: 6px;
         border-radius: 4px;
         min-height: 40px;
         align-items: center;
         }
         .tag {
         background: #007bff;
         color: #fff;
         padding: 5px 10px;
         border-radius: 20px;
         display: flex;
         align-items: center;
         gap: 6px;
         font-size: 14px;
         }
         .tag button {
         background: none;
         border: none;
         color: #fff;
         font-weight: bold;
         cursor: pointer;
         padding: 0;
         line-height: 1;
         }
         .tag input {
         border: none;
         outline: none;
         flex-grow: 1;
         min-width: 120px;
         font-size: 14px;
         }
      </style>
      <style>
         /* Modern Header Search Design */
         .header-search-container {
            display: flex;
            align-items: center;
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            max-width: 800px;
            margin: 0 auto;
         }
         
         .search-field {
            position: relative;
            display: flex;
            align-items: center;
            background: #f8f9fa;
            border-right: 1px solid #e0e0e0;
            min-width: 150px;
         }
         
         .search-field:last-child {
            border-right: none;
            background: #fff;
         }
         
         .search-field input, .search-field button {
            background: transparent;
            border: none;
            outline: none;
            padding: 12px 15px;
            font-size: 14px;
            color: #666;
         }
         
         .search-field input::placeholder {
            color: #999;
         }
         
         .search-field button {
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 120px;
            text-align: left;
         }
         
         .search-field button:hover {
            background: #f0f0f0;
         }
         
         .search-field .dropdown-icon {
            margin-left: auto;
            color: #999;
            font-size: 12px;
         }
         
         .search-field .search-icon {
            color: #999;
            font-size: 16px;
         }
         
         .search-input {
            flex: 1;
            min-width: 300px;
            position: relative;
         }
         
         .search-input input {
            width: 100%;
            padding-right: 40px;
         }
         
         .search-input .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 16px;
            transition: color 0.2s;
         }
         
         .search-input .search-icon:hover {
            color: #007bff;
         }
         
         /* Dropdown Styles */
         .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 1000;
            display: none;
            min-width: 300px;
         }
         
         .dropdown-menu.open {
            display: block;
         }
         
         .dropdown-search {
            padding: 15px;
            border-bottom: 1px solid #e0e0e0;
            position: relative; /* ensure ::after icon positions relative to this container */
         }
         
        .dropdown-search input {
            width: 100%;
            padding: 10px 35px 10px 12px;
            border: 2px solid #007bff;
            border-radius: 4px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #fff;
            color: #333;
        }
        
        .dropdown-search input:focus {
            outline: none;
            border-color: #0056b3;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }
        
        .dropdown-search input::placeholder {
            color: #999;
            font-style: italic;
        }
        
        /* Search icon inside input */
        .dropdown-search::after {
            content: '\f002';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: 25px;
            top: 50%;
            transform: translateY(-50%);
            color: #007bff;
            pointer-events: none;
        }
         
         .dropdown-header {
            padding: 15px;
            background: #f8f9fa;
            border-bottom: 1px solid #e0e0e0;
            font-weight: 600;
            color: #333;
            display: flex;
            align-items: center;
            gap: 8px;
         }
         
         .dropdown-content {
            max-height: 300px;
            overflow-y: auto;
         }
         
         .dropdown-list {
            list-style: none;
            margin: 0;
            padding: 0;
         }
         
         .dropdown-list li {
            border-bottom: 1px solid #f0f0f0;
         }
         
         .dropdown-list li:last-child {
            border-bottom: none;
         }
         
         .dropdown-list a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #333;
            text-decoration: none;
            transition: background-color 0.2s;
         }
         
         .dropdown-list a:hover {
            background: #f8f9fa;
         }
         
         .dropdown-list a.active {
            background: #007bff;
            color: #fff;
         }
         
         .dropdown-list .icon {
            margin-right: 10px;
            width: 16px;
            text-align: center;
         }
         
         .dropdown-list .arrow {
            margin-left: auto;
            color: #999;
            font-size: 12px;
         }
         
         
         /* Country Dropdown - Grid Layout */
         .country-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 0;
         }
         
         .country-grid .dropdown-list {
            display: contents;
         }
         
         .country-grid .dropdown-list li {
            border: none;
         }
         
         .country-grid .dropdown-list a {
            padding: 10px 12px;
            font-size: 13px;
            border-right: 1px solid #f0f0f0;
            border-bottom: 1px solid #f0f0f0;
         }
         
         
         /* Mobile Responsive */
         @media (max-width: 768px) {
            .header-search-container {
               flex-direction: column;
               gap: 10px;
            }
            
            .search-field {
               width: 100%;
               border-right: none;
               border-bottom: 1px solid #e0e0e0;
            }
            
            .search-input {
               min-width: auto;
            }
         }
      </style>
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
                  <a href="{{route('web.create')}}" class="btn btn-green pull-right quick-post">POST YOUR AD</a>
                  <div class="pull-right">
                     <div class="header-search-container">
                        <!-- Country/Region Field -->
                        <div class="search-field">
                           <button onclick="toggleCountryDropdown()">
                              <span id="selectedCountryText">Select Country / R...</span>
                              <i class="fa fa-navicon dropdown-icon"></i>
                           </button>
                           <div class="dropdown-menu" id="countryDropdown">
                              <div class="dropdown-search">
                                 <input type="text" id="countrySearch" placeholder="Search country / region" onkeyup="filterCountries()">
                              </div>
                              <div class="dropdown-header">
                                 <i class="fa fa-globe"></i>
                                 Select Country / Region
                              </div>
                              <div class="dropdown-content">
                                 <div class="country-grid">
                                    <ul id="countryList" class="dropdown-list">
                                       <li><span>Loading countries...</span></li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                        <!-- Category Field -->
                        <div class="search-field">
                           <button onclick="toggleCategoryDropdown()">
                              <span id="selectedCategoryText">Select Category</span>
                              <i class="fa fa-navicon dropdown-icon"></i>
                           </button>
                           <div class="dropdown-menu" id="categoryDropdown">
                              <div class="dropdown-header">
                                 <i class="fa fa-th-large"></i>
                                 Categories
                              </div>
                              <div class="dropdown-content">
                                 <ul class="dropdown-list" id="categoryList">
                                    <li><a href="#" onclick="selectCategory('', 'All Categories')" class="active">
                                       <i class="fa fa-th icon"></i>All Categories
                                    </a></li>
                                    <li><span>Loading categories...</span></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        
                        <!-- Search Input Field -->
                        <div class="search-field search-input">
                           <input type="text" id="searchInput" placeholder="search" value="{{ request('q') }}" onkeypress="handleSearchKeypress(event)">
                           <i class="fa fa-search search-icon" onclick="submitSearch(event)" style="cursor: pointer;"></i>
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
