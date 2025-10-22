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
            @isset($ad)
               <div class="row" style="position: relative;">
                  <div style="position: absolute; right: 20px; top: 10px;">
                     <form method="POST" action="{{ route('web.destroy', $ad->uuid) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this ad?');">
                         @csrf
                         @method('DELETE')
                         <button type="submit" class="btn btn-red btn-md" style="background-color:red; color:white;">
                             Delete Ad
                         </button>
                     </form>&emsp;&emsp;
                  </div>
               </div>
            @endisset
            @php
                $formAction = isset($ad) ? route('web.update', $ad->uuid) : route('web.store');
                $formMethod = isset($ad) ? 'POST' : 'POST';
            @endphp
            <form action="{{ $formAction }}" method="{{ $formMethod }}" enctype="multipart/form-data">
                @isset($ad)
                    @method('PUT')
                @endisset
               @csrf
               <div class="elements-block">
                  <div class="inner">
                     <div class="row field-block">
                        <div class="col-xs-12 col-md-3">
                           <label class="required" >Ad Title</label>
                        </div>
                        <div class="col-xs-12 col-md-9">
                           <input type="text" name="title" value="{{ $ad->title ?? '' }}" placeholder="e.g. Apple iPhone SE 2016" required>
                        </div>
                     </div>
                     <div class="row field-block">
                        <div class="col-xs-12 col-md-3">
                           <label class="required">Category</label>
                        </div>
                        <div class="col-xs-12 col-md-9">
                           <select name="category_id" id="categorySelect" class="form-control" style="height: 40px;" required>
                              <option value="">Select Category</option>
                              @foreach($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="row field-block">
                        <div class="col-xs-12 col-md-3">
                           <label class="required">Subcategory</label>
                        </div>
                        <div class="col-xs-12 col-md-9">
                           <select name="subcategory_id" id="subcategorySelect" class="form-control" style="height: 40px;" required>
                              <option value="">Select Subcategory</option>
                              {{-- @if(isset($ad) && $ad->category)
                                 @foreach($ad->category->subcategories as $subcat)
                                 <option value="{{ $subcat->id }}" {{ isset($ad) && $ad->subcategory_id == $subcat->id ? 'selected' : '' }}>{{ $subcat->name }}</option>
                                 @endforeach
                              @endif --}}
                           </select>
                        </div>
                     </div>
                     <div class="row field-block">
                            <div class="col-xs-12 col-md-3">
                                <label  for="price">Price</label>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <input type="number" name="price" value="{{ $ad->price ?? '' }}" class="form-control" placeholder="Enter Price" step="0.01">
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <input type="number" name="negotiable_price" value="{{ $ad->negotiable_price ?? '' }}" class="form-control" placeholder="Negotiable Price" step="0.01">
                            </div>
                        </div>
                        <div class="row field-block">
                            <div class="col-xs-12 col-md-3">
                                <label class="required">Country</label>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <select name="country_id" id="countrySelect" class="form-control" required>
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row field-block">
                            <div class="col-xs-12 col-md-3">
                                <label class="required">City</label>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <select name="city_id" id="citySelect" class="form-control" required>
                                    <option value="">Select City</option>
                                </select>
                            </div>
                        </div>
                        <div class="row field-block mb-3 align-items-center">
                            <div class="col-12 col-md-3">
                                <label for="featuredImage" class="form-label">Featured Image</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="file" id="featuredImage" name="featured_image" class="form-control" accept="image/*">
                            </div>
                        </div>
                        <div class="row field-block">
                            <div class="col-xs-12 col-md-3">
                                <label class="required">Ad Description</label>
                            </div>
                            {{-- <div class="col-xs-12 col-md-9">

                                <textarea name="description" id="create201" class="form-control" placeholder="Include the brand, model, age and any included accessories." rows="10" required></textarea>
                            </div> --}}
                            <div class="col-xs-12 col-md-9">
                                <div style="margin-bottom:10px;">
                                    <button onclick="document.execCommand('bold')"><b>B</b></button>

                                    <select id="headingSelect" onchange="setHeading(this.value)" class="textheading">

                                        <option value="H1">H1</option>
                                        <option value="H2">H2</option>
                                        <option value="H3">H3</option>
                                        <option value="H4">H4</option>
                                        <option value="H5">H5</option>
                                        <option value="H6">H6</option>
                                        <option value="P">Paragraph</option>
                                    </select>
                                    <button onclick="createLink()">🔗</button>
                                </div>

                                <textarea name="description" id="create201"
                                    contenteditable="true"
                                    placeholder="Include the brand, model, age and any included accessories."
                                    style="border:1px solid #ccc; padding:10px; min-height:150px; border-radius:4px;
                                            white-space:pre-wrap; font-family:sans-serif; line-height:25px;">
                                </textarea>


                            </div>
                        </div>
                        <div class="row field-block">
                            <div class="col-xs-12 col-md-3">
                                <label >Tags</label>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" name="tags" value="{{ $ad->tags ?? '' }}" class="form-control" placeholder="Enter tags separated by commas">
                            </div>
                        </div>
                        <div class="row field-block">
                            <div class="col-xs-12 col-md-3">
                                <label class="required" for="create401">Company Name</label>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" name="company_name" value="{{ $ad->company_name ?? '' }}" class="form-control" placeholder="e.g. Jhone Doe" required>
                            </div>
                        </div>
                        <div class="row field-block">
                            <div class="col-xs-12 col-md-3">
                                <label  for="create501">Your email</label>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <input type="email" name="email" value="{{ $ad->email ?? '' }}" class="form-control" placeholder="e.g. jon@got.com" required>
                            </div>
                        </div>
                        <div class="row field-block">
                            <div class="col-xs-12 col-md-3">
                                <label  for="create451">Phone number</label>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <input type="tel" name="phone" value="{{ $ad->phone ?? '' }}" class="form-control" placeholder="With Country Code">
                            </div>
                        </div>
                         <button type="submit" name="action" value="preview" class="btn btn-blue btn-md"><i class="fa fa-eye"></i> Preview Ad</button>
                         <button type="submit" class="btn btn-green btn-md"><i class="fa fa-plus-circle"></i> {{ isset($ad) ? 'Update' : 'Add' }}</button>

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
