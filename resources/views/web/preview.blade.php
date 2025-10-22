@extends('web.includes.main')
@section('content')
<!-- Make sure Font Awesome is included -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
<div class="app-canvas">
   <div class="container">
      <div class="breadcrumb">
         <ul>
            <li><a href="#">Home</a></li>
            <li>
               Post your ad
            </li>
         </ul>
      </div>
      <div class="page row">
         <header class="heading style-bg big text-center">
            <h1>World’s <strong>Biggest</strong> Classified Marketplace</h1>
            <p class="text-uppercase">sell &amp; purchase anything</p>
         </header>
         <div class="form-wrapper">
            <form class="preview-form">
               <div class="elements-block">
                  <div class="inner">
                     <div class="row field-block">
                        <div class="col-xs-12 col-md-12" style="margin-left: 90%;
                           margin-top: -7%;">

                        </div>
                     </div>
                     <div class="row field-block">
                        <div class="col-xs-12 col-md-3">
                           <label class="required">Ad Title</label>
                        </div>
                        <div class="col-xs-12 col-md-9">
                           <div class="preview-value">{{ isset($ad) ? $ad->title : 'Ad Title' }}</div>
                        </div>
                     </div>
                     <div class="row field-block">
                        <div class="col-xs-12 col-md-3">
                           <label class="required">Category</label>
                        </div>
                        <div class="col-xs-12 col-md-9">
                           <div class="preview-value">{{ isset($ad) ? $ad->category->name ?? 'Unknown' : 'Select Category' }}</div>
                        </div>
                     </div>
                     <div class="row field-block">
                        <div class="col-xs-12 col-md-3">
                           <label class="required">Subcategory</label>
                        </div>
                        <div class="col-xs-12 col-md-9">
                           <div class="preview-value">{{ isset($ad) ? $ad->subcategory->name ?? 'Unknown' : 'Select Subcategory' }}</div>
                        </div>
                     </div>
                     <div class="row field-block">
                        <div class="col-xs-12 col-md-3">
                           <label for="price">Price</label>
                        </div>
                        <div class="col-xs-12 col-md-4">
                           <div class="preview-value">${{ isset($ad) && $ad->price ? number_format($ad->price, 2) : '0.00' }}</div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                           <div class="preview-value">${{ isset($ad) && $ad->negotiable_price ? number_format($ad->negotiable_price, 2) : '0.00' }}</div>
                        </div>
                     </div>
                     <div class="row field-block">
                        <div class="col-xs-12 col-md-3">
                           <label class="required">Country</label>
                        </div>
                        <div class="col-xs-12 col-md-9">
                           <div class="preview-value">{{ isset($ad) ? $ad->country->name ?? 'Unknown' : 'Select Country' }}</div>
                        </div>
                     </div>
                     <div class="row field-block">
                        <div class="col-xs-12 col-md-3">
                           <label class="required">City</label>
                        </div>
                        <div class="col-xs-12 col-md-9">
                           <div class="preview-value">{{ isset($ad) ? $ad->city->name ?? 'Unknown' : 'Select City' }}</div>
                        </div>
                     </div>
                     <div class="row field-block mb-3 align-items-center">
                        <div class="col-12 col-md-3">
                           <label for="featuredImage" class="form-label">Featured Image</label>
                        </div>
                        <div class="col-12 col-md-9">
                           @if(isset($ad) && $ad->featured_image)
                              <img src="{{ asset('storage/app/public/' . $ad->featured_image) }}" alt="Ad Image" class="preview-image">
                           @else
                              <img src="{{ asset('public/assets/img/lg2.png') }}" alt="Default Ad Image" class="preview-image">
                           @endif
                        </div>
                     </div>
                     <div class="row field-block">
                        <div class="col-xs-12 col-md-3">
                           <label class="required">Ad Description</label>
                        </div>
                        <div class="col-xs-12 col-md-9">
                           <div class="preview-value" style="white-space: pre-wrap; min-height: 100px;">
                              {{ isset($ad) && $ad->description ? $ad->description : 'Include the brand, model, age and any included accessories.' }}
                           </div>
                        </div>
                     </div>
                     <div class="row field-block">
                        <div class="col-xs-12 col-md-3">
                           <label>Tags</label>
                        </div>
                        <div class="col-xs-12 col-md-9">
                           <div class="preview-value">{{ isset($ad) && $ad->tags ? $ad->tags : 'No tags' }}</div>
                        </div>
                     </div>
                     <div class="row field-block">
                        <div class="col-xs-12 col-md-3">
                           <label class="required">Company Name</label>
                        </div>
                        <div class="col-xs-12 col-md-9">
                           <div class="preview-value">{{ isset($ad) ? $ad->company_name ?? 'Individual' : 'e.g. Jhone Doe' }}</div>
                        </div>
                     </div>
                     <div class="row field-block">
                        <div class="col-xs-12 col-md-3">
                           <label>Your email</label>
                        </div>
                        <div class="col-xs-12 col-md-9">
                           <div class="preview-value">{{ isset($ad) ? $ad->email ?? 'email@example.com' : 'e.g. jon@got.com' }}</div>
                        </div>
                     </div>
                     <div class="row field-block">
                        <div class="col-xs-12 col-md-3">
                           <label>Phone number</label>
                        </div>
                        <div class="col-xs-12 col-md-9">
                           <div class="preview-value">{{ isset($ad) ? $ad->phone ?? 'Not provided' : 'With Country Code' }}</div>
                        </div>
                     </div>

                     @if(isset($ad) && $ad->uuid)
                     <div class="row field-block">
                        <div class="col-xs-12 col-md-3">
                           <label>Ad UUID</label>
                        </div>
                        <div class="col-xs-12 col-md-9">
                           <div class="preview-value" style="font-family: monospace; background: #e9ecef; color: #495057;">
                              {{ $ad->uuid }}
                           </div>
                        </div>
                     </div>
                     @endif

                     <div class="row field-block text-center">
                        <div class="col-12">
                           <div class="action-buttons">
                              <a href="{{ route('web.create', ['edit' => $ad->uuid ?? null]) }}" class="btn btn-primary">
                                 <i class="fa fa-edit"></i> Edit Ad
                              </a>
                              <a href="{{ isset($ad) ? route('web.detail', $ad->uuid) : '#' }}" class="btn btn-success" target="_blank">
                                 <i class="fa fa-eye"></i> View Live Ad
                              </a>
                              <button type="button" onclick="window.history.back()" class="btn btn-secondary">
                                 <i class="fa fa-arrow-left"></i> Go Back
                              </button>
                           </div>
                        </div>
                     </div>

                  </div>

               </div>
         </div>
         <div class="elements-block style-gray">
         <div class="inner">

         <div>
         <span class="termStatement">
         By clicking 'Create Ad' you agree to <a class="link" href="#">our  Terms & Condition</a> and
         <a class="link" href="#">Posting Rules</a>.
         </span>
         </div>
         </div>
         </div>
         </form>
      </div>
   </div>
</div>
</div>



@endsection
@push('scripts')

<script>
   $(document).ready(function() {
       // Load subcategories when category is selected
       $('#categorySelect').change(function() {
           var categoryId = $(this).val();
           if (categoryId) {
               $.ajax({
                   url: '{{ route("api.subcategories") }}',
                   type: 'GET',
                   data: { category_id: categoryId },
                   success: function(data) {
                       $('#subcategorySelect').html('<option value="">Select Subcategory</option>');
                       $.each(data, function(key, subcategory) {
                           $('#subcategorySelect').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
                       });
                   },
                   error: function(xhr, status, error) {
                       console.error('Error loading subcategories:', error);
                   }
               });
           } else {
               $('#subcategorySelect').html('<option value="">Select Subcategory</option>');
           }
       });

       // Load cities when country is selected
       $('#countrySelect').change(function() {
           var countryId = $(this).val();
           if (countryId) {
               // Find the country name from the selected option
               var countryName = $('#countrySelect option:selected').text();
               $.ajax({
                   url: '{{ route("api.cities") }}',
                   type: 'GET',
                   data: { country: countryName },
                   success: function(data) {
                       $('#citySelect').html('<option value="">Select City</option>');
                       $.each(data, function(key, city) {
                           $('#citySelect').append('<option value="' + city.id + '">' + city.name + '</option>');
                       });
                   },
                   error: function(xhr, status, error) {
                       console.error('Error loading cities:', error);
                   }
               });
           } else {
               $('#citySelect').html('<option value="">Select City</option>');
           }
       });
   });

   function setHeading(tag) {
     if (!tag) return;
     if (tag === 'P') {
       document.execCommand('formatBlock', false, 'p');
     } else {
       document.execCommand('formatBlock', false, tag.toLowerCase());
     }
   }

   function createLink() {
     const url = prompt('Enter the URL:', 'https://');
     if (url) document.execCommand('createLink', false, url);
   }

   // optional placeholder support
   const editor = document.getElementById('create201');
   if (editor) {
       editor.addEventListener('focus', () => {
         if (editor.textContent.trim() === editor.getAttribute('placeholder')) {
           editor.textContent = '';
           editor.style.color = '#000';
         }
       });
       editor.addEventListener('blur', () => {
         if (editor.textContent.trim() === '') {
           editor.textContent = editor.getAttribute('placeholder');
           editor.style.color = '#777';
         }
       });
       editor.textContent = editor.getAttribute('placeholder');
       editor.style.color = '#777';
   }
</script>
<script>
   // Tag functionality for description (if needed)
   const input = document.getElementById('create401');
   const container = document.getElementById('tagContainer');

   if (input && container) {
     input.addEventListener('keydown', function(e) {
       if (e.key === 'Enter' || e.key === ' ') {
         e.preventDefault();
         const value = input.value.trim();
         if (value !== '') {
           addTag(value);
           input.value = '';
         }
       }
     });
   }

   function addTag(text) {
     const tag = document.createElement('div');
     tag.className = 'tag';
     tag.innerHTML = `${text} <button type="button" onclick="removeTag(this)">×</button>`;
     if (container) {
       container.insertBefore(tag, input);
     }
   }

   function removeTag(btn) {
     btn.parentElement.remove();
   }
</script>


@endpush
