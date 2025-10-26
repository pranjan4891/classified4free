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
<style>
   .preview-value {
       background: #f8f9fa;
       padding: 10px;
       border-radius: 4px;
       min-height: 40px;
       border: 1px solid #e9ecef;
   }
   
   /* Badge styling for tags */
   .badge {
       display: inline-block;
       padding: 5px 10px;
       font-size: 12px;
       font-weight: 500;
       border-radius: 4px;
       margin: 3px;
   }
   
   .badge-secondary {
       background-color: #6c757d;
       color: #fff;
   }
   
   .badge:empty {
       display: none;
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
                           @if(isset($ad) && $ad->uuid)
                              <a href="{{ route('web.edit', $ad->uuid) }}" class="btn btn-primary btn-sm">
                                 <i class="fa fa-edit"></i> Edit this Ad
                              </a>
                           @endif
                        </div>
                     </div>
                     @if(isset($ad) && isset($ad->filtered_data))
                        @foreach($ad->filtered_data as $key => $value)
                           @if($key !== 'uuid' && $key !== 'vid' && $key !== 'created_at')
                              <div class="row field-block">
                                 <div class="col-xs-12 col-md-3">
                                    <label class="required">{{ ucwords(str_replace('_', ' ', $key)) }}</label>
                                 </div>
                                 <div class="col-xs-12 col-md-9">
                                    <div class="preview-value">
                                       @if($key === 'tags' && is_array($value))
                                          @foreach($value as $tag)
                                             <span class="badge badge-secondary">{{ $tag }}</span>
                                          @endforeach
                                       @elseif($key === 'featured_image' && $value)
                                          <img src="{{ asset('storage/app/public/' . $value) }}" alt="Featured Image" style="max-width: 200px; max-height: 150px;">
                                       @elseif($key === 'description')
                                          <div class="rich-text-content">{!! $value !!}</div>
                                       @else
                                          {{ $value }}
                                       @endif
                                    </div>
                                 </div>
                              </div>
                           @endif
                        @endforeach
                     @else
                        <div class="row field-block">
                           <div class="col-xs-12 col-md-12">
                              <div class="alert alert-info">No ad data available for preview.</div>
                           </div>
                        </div>
                     @endif

                     @if(isset($ad) && $ad->uuid)
                     <div class="row field-block">
                        <div class="col-xs-12 col-md-3">
                           <label>Edit URL</label>
                        </div>
                        <div class="col-xs-12 col-md-9">
                           <div class="input-group">
                              <input type="text" class="form-control" id="editUrl" value="{{ route('web.edit', $ad->uuid) }}" readonly>
                              <div class="input-group-append">
                                 <button class="btn btn-outline-secondary" type="button" onclick="copyEditUrl()">
                                    <i class="fa fa-copy"></i> Copy URL
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                     @endif

                     @if(isset($ad) && $ad->uuid)
                     <div class="row field-block text-center">
                        <div class="col-12">
                           <div class="action-buttons">
                              <a href="{{ route('web.edit', $ad->uuid) }}" class="btn btn-primary">
                                 <i class="fa fa-edit"></i> Edit this Ad
                              </a>
                              <a href="{{ route('web.detail', $ad->vid) }}" class="btn btn-success" target="_blank">
                                 <i class="fa fa-eye"></i> View Live Ad
                              </a>
                              <a href="{{ route('web.listing') }}" class="btn btn-secondary">
                                 <i class="fa fa-list"></i> View All Ads
                              </a>
                           </div>
                        </div>
                     </div>
                     @endif

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

  // Copy Edit URL function
  function copyEditUrl() {
    const editUrlInput = document.getElementById('editUrl');
    if (editUrlInput) {
      editUrlInput.select();
      editUrlInput.setSelectionRange(0, 99999); // For mobile devices
      
      try {
        document.execCommand('copy');
        
        // Show success message
        const button = event.target.closest('button');
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fa fa-check"></i> Copied!';
        button.classList.remove('btn-outline-secondary');
        button.classList.add('btn-success');
        
        // Reset button after 2 seconds
        setTimeout(() => {
          button.innerHTML = originalText;
          button.classList.remove('btn-success');
          button.classList.add('btn-outline-secondary');
        }, 2000);
        
      } catch (err) {
        // Fallback for modern browsers
        navigator.clipboard.writeText(editUrlInput.value).then(() => {
          const button = event.target.closest('button');
          const originalText = button.innerHTML;
          button.innerHTML = '<i class="fa fa-check"></i> Copied!';
          button.classList.remove('btn-outline-secondary');
          button.classList.add('btn-success');
          
          setTimeout(() => {
            button.innerHTML = originalText;
            button.classList.remove('btn-success');
            button.classList.add('btn-outline-secondary');
          }, 2000);
        }).catch(() => {
          alert('Failed to copy URL. Please copy manually.');
        });
      }
    }
  }
</script>


@endpush
