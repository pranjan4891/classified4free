@extends('web.includes.main')
@section('content')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Select2 Custom CSS -->
<style>
   .select2-container {
      width: 100% !important;
   }
   .select2-container .select2-selection--single {
      height: 40px;
      border: 2px solid #e0e0e0;
      border-radius: 6px;
      line-height: 40px;
   }
   .select2-container .select2-selection--single .select2-selection__rendered {
      line-height: 40px;
      padding-left: 15px;
   }
   .select2-container .select2-selection--single .select2-selection__arrow {
      height: 38px;
      right: 10px;
   }
   .select2-container--default .select2-selection--single .select2-selection__arrow b {
      border-color: #333 transparent transparent transparent;
   }
   .select2-dropdown {
      border: 2px solid #e0e0e0;
      border-radius: 6px;
   }
   .select2-search--dropdown .select2-search__field {
      border: 2px solid #e0e0e0;
      border-radius: 4px;
      padding: 8px;
   }
</style>

<div class="app-canvas">
   <div class="container">
      <div class="breadcrumb">
         <ul>
            <li><a href="{{ route('web.index') }}">Home</a></li>
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
                              <option value="{{ $category->id }}" {{ isset($ad) && $ad->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                              @if(isset($ad) && $ad->category)
                                 @foreach($ad->category->subcategories as $subcat)
                                 <option value="{{ $subcat->id }}" {{ $ad->subcategory_id == $subcat->id ? 'selected' : '' }}>{{ $subcat->name }}</option>
                                 @endforeach
                              @endif
                           </select>
                        </div>
                     </div>
                     <div class="row field-block">
                            <div class="col-xs-12 col-md-3">
                                <label for="price">Price</label>
                            </div>
                            <div class="col-xs-12 col-md-9 price-fields">
                                <div>
                                <input type="number" name="price" value="{{ $ad->price ?? '' }}" class="form-control" placeholder="Enter Price" step="0.01">
                            </div>
                                <div>
                                <input type="number" name="negotiable_price" value="{{ $ad->negotiable_price ?? '' }}" class="form-control" placeholder="Negotiable Price" step="0.01">
                                </div>
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
                                    <option value="{{ $country->id }}" {{ isset($ad) && $ad->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row field-block">
                            <div class="col-xs-12 col-md-3">
                                <label class="required">City</label>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" name="city_name" value="{{ $ad->city_name ?? '' }}" class="form-control" placeholder="Enter city name" required>
                            </div>
                        </div>
                        <div class="row field-block mb-3 align-items-center">
                            <div class="col-12 col-md-3">
                                <label for="featuredImage" class="form-label">Featured Image</label>
                            </div>
                            <div class="col-12 col-md-9">
                                @if(isset($ad) && $ad->featured_image)
                                <div style="margin-bottom: 15px;">
                                    <p style="margin-bottom: 10px; color: #666;">Current Image:</p>
                                    <img src="{{ asset('storage/app/public/' . $ad->featured_image) }}" alt="Current Image" style="max-width: 200px; max-height: 150px; border: 2px solid #ddd; border-radius: 6px; padding: 5px; background: #fff;">
                                </div>
                                @endif
                                <input type="file" id="featuredImage" name="featured_image" class="form-control" accept="image/*">
                                @if(isset($ad) && $ad->featured_image)
                                <small style="display: block; margin-top: 5px; color: #999;">Leave empty to keep current image</small>
                                @endif
                            </div>
                        </div>
                        <div class="row field-block">
                            <div class="col-xs-12 col-md-3">
                                <label class="required">Ad Description</label>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <textarea name="description" id="description" class="form-control" placeholder="Include the brand, model, age and any included accessories." rows="10" required>{{ $ad->description ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="row field-block">
                            <div class="col-xs-12 col-md-3">
                                <label >Tags</label>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" name="tags" value="{{ isset($ad) && $ad->tags ? (is_array(json_decode($ad->tags, true)) ? implode(', ', json_decode($ad->tags, true)) : $ad->tags) : '' }}" class="form-control" placeholder="Enter tags separated by commas">
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
                         <div class="form-submit-buttons">
                             <button type="submit" name="action" value="preview" class="btn btn-blue btn-md">
                                 <i class="fa fa-eye"></i> Preview Ad
                             </button>
                             <button type="submit" class="btn btn-green btn-md">
                                 <i class="fa fa-plus-circle"></i> {{ isset($ad) ? 'Update' : 'Add' }}
                             </button>
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
<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
   // Initialize CKEditor
   ClassicEditor
       .create(document.querySelector('#description'), {
           toolbar: {
               items: [
                   'heading', '|',
                   'bold', 'italic', 'underline', 'strikethrough', '|',
                   'bulletedList', 'numberedList', '|',
                   'outdent', 'indent', '|',
                   'blockQuote', 'insertTable', '|',
                   'link', '|',
                   'undo', 'redo'
               ]
           },
           language: 'en',
           table: {
               contentToolbar: [
                   'tableColumn',
                   'tableRow',
                   'mergeTableCells'
               ]
           },
           // Remove the label/labeledView configuration to hide labels
           removePlugins: ['LabeledSupport']
       })
       .then(editor => {
           console.log('CKEditor initialized successfully');
           window.editor = editor;
           
           // Hide the "Rich Text Editor" label programmatically
           setTimeout(function() {
               // Find and hide all labels that might contain "Rich Text Editor"
               $('label, span, div').each(function() {
                   var text = $(this).text();
                   if (text && text.trim() === 'Rich Text Editor') {
                       $(this).hide().css('display', 'none !important');
                   }
               });
               
               // Also hide CKEditor accessibility labels
               $('.ck-labeled-field-view label, .ck-editor__label, label[for="description"]:not(.required)').hide();
           }, 100);
           
           // Ensure content is updated on form submission
           editor.model.document.on('change:data', () => {
               editor.updateSourceElement();
               
               // Clear validation error when user starts typing
               var descriptionField = $('[name="description"]');
               if (descriptionField.hasClass('is-invalid')) {
                   var editorContent = editor.getData();
                   // Strip HTML tags to check for actual content
                   var textContent = editorContent.replace(/<[^>]*>/g, '').trim();
                   
                   if (textContent && textContent.length > 0) {
                       descriptionField.removeClass('is-invalid');
                       descriptionField.next('.invalid-feedback').remove();
                   }
               }
           });
       })
       .catch(error => {
           console.error('Error initializing CKEditor:', error);
       });
</script>

<script>
   $(document).ready(function() {
       // Initialize Select2 for country dropdown with search
       $('#countrySelect').select2({
           placeholder: 'Select Country',
           allowClear: false,
           width: '100%',
           language: {
               noResults: function() {
                   return "No countries found";
               },
               searching: function() {
                   return "Searching...";
               }
           }
       });
       
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

       // Handle form submission to ensure CKEditor content is included
       $('form').on('submit', function(e) {
           console.log('Form submission started');
           
           // Update the textarea with CKEditor content before validation
           if (window.editor) {
               console.log('Updating CKEditor content');
               window.editor.updateSourceElement();
               
               // Get the CKEditor content directly
               var editorContent = window.editor.getData();
               console.log('CKEditor content:', editorContent);
               
               // Update the textarea value manually
               $('#description').val(editorContent);
           }
           
           // Validate required fields
           var isValid = true;
           var requiredFields = ['title', 'description', 'category_id', 'subcategory_id', 'country_id', 'city_name', 'email'];
           
           requiredFields.forEach(function(fieldName) {
               var field = $('[name="' + fieldName + '"]');
               var fieldValue = field.val();
               
               // Special handling for description field with CKEditor
               if (fieldName === 'description' && window.editor) {
                   fieldValue = window.editor.getData();
                   console.log('Description from CKEditor:', fieldValue);
                   
                   // Strip HTML tags to check for actual content
                   var textContent = fieldValue.replace(/<[^>]*>/g, '').trim();
                   console.log('Description text content:', textContent);
                   
                   // Use text content for validation
                   if (textContent) {
                       fieldValue = textContent;
                   }
               }
               
               console.log('Field ' + fieldName + ':', fieldValue);
               
               // Check if field is empty or contains only whitespace/HTML tags
               var isEmpty = !fieldValue || !fieldValue.trim() || fieldValue.trim() === '<p></p>' || fieldValue.trim() === '<p>&nbsp;</p>';
               
               if (field.length && isEmpty) {
                   isValid = false;
                   field.addClass('is-invalid');
                   if (!field.next('.invalid-feedback').length) {
                       field.after('<div class="invalid-feedback">This field is required.</div>');
                   }
               } else {
                   field.removeClass('is-invalid');
                   field.next('.invalid-feedback').remove();
               }
           });
           
           console.log('Form validation result:', isValid);
           
           if (!isValid) {
               e.preventDefault();
               alert('Please fill in all required fields.');
               return false;
           }
           
           console.log('Form submission proceeding');
           return true;
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
