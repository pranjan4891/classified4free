  <footer class="doc-footer">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <ul>
                            <li><a href="{{route('web.listing')}}">Post Ad</a></li>
                            <li><a href="{{route('web.about')}}">About Us</a></li>


                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <ul>
                            <li><a href="{{route('web.contact')}}">Contact Us</a></li>
                             <li><a href="#">Cookie Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <ul>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms of Service</a></li>
                        </ul>
                    </div>
                </div>
                <br>
                <br>

                <div class="text-center">
                    &copy; Classified4Free - Post Ad Easily
                </div>
            </div>
        </footer>
    </div>

<script src="{{asset('public/assets/lib/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('public/assets/lib/slick-carousel/slick/slick.min.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRu9ezOw1CH3F0sCGUtPrB972hRgKmU7w" type="text/javascript"></script>
<script src="{{asset('public/assets/js/app.js')}}"></script>

<script type="text/javascript">
    // Global variables
    let selectedCountry = null;
    let selectedCategoryId = null;
    let selectedSubcategoryId = null;
    let countries = [];
    let categories = [];

    // Load countries and categories on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadCountries();
        loadCategories();
    });

    // Load countries dynamically
    function loadCountries() {
        fetch('{{ route("api.countries") }}')
            .then(response => response.json())
            .then(data => {
                countries = data;
                populateCountries(data);
            })
            .catch(error => console.error('Error loading countries:', error));
    }

    // Populate country list
    function populateCountries(data) {
        const countryList = document.getElementById('countryList');
        if (countryList) {
            countryList.innerHTML = '';
            data.forEach(country => {
                const li = document.createElement('li');
                li.innerHTML = `<a href="#" onclick="selectCountry('${country.id}', '${country.name}')">${country.name}</a>`;
                countryList.appendChild(li);
            });
        }
    }

    // Filter countries with improved search functionality
    function filterCountries() {
        const input = document.getElementById('countrySearch').value.toLowerCase();
        const countryList = document.getElementById('countryList');
        let visibleCount = 0;
        let hasResults = false;
        
        // Filter and show/hide countries
        document.querySelectorAll('#countryList li').forEach(li => {
            const countryText = li.textContent.toLowerCase();
            const searchMatch = countryText.includes(input);
            
            if (searchMatch) {
                li.style.display = '';
                li.style.visibility = 'visible';
                visibleCount++;
                hasResults = true;
            } else {
                li.style.display = 'none';
                li.style.visibility = 'hidden';
            }
        });
        
        // Show "No results found" message if no countries match
        let noResultsMsg = countryList.querySelector('.no-results');
        
        if (input.length > 0 && !hasResults && !noResultsMsg) {
            const noResults = document.createElement('li');
            noResults.className = 'no-results';
            noResults.innerHTML = '<span style="padding: 20px; text-align: center; color: #999;">No countries found matching "' + input + '"</span>';
            countryList.appendChild(noResults);
        } else if (noResultsMsg && hasResults) {
            noResultsMsg.remove();
        } else if (noResultsMsg && input.length > 0) {
            noResultsMsg.querySelector('span').textContent = 'No countries found matching "' + input + '"';
        }
        
        // Update results counter
        console.log('Found ' + visibleCount + ' countries matching "' + input + '"');
    }

    // Select country and close dropdown
    function selectCountry(countryId, countryName) {
        event.preventDefault();
        event.stopPropagation();

        selectedCountry = { id: countryId, name: countryName };
        const selectedCountryText = document.getElementById('selectedCountryText');
        if (selectedCountryText) {
            selectedCountryText.textContent = countryName;
        }
        closeCountryDropdown();
    }

    // Close country dropdown
    function closeCountryDropdown() {
        const dropdown = document.getElementById('countryDropdown');
        if (dropdown) {
            dropdown.classList.remove('open');
        }
    }

    // Toggle country dropdown
    function toggleCountryDropdown() {
        const dropdown = document.getElementById('countryDropdown');
        if (dropdown) {
            dropdown.classList.toggle('open');
            
            // Close category dropdown if open
            const categoryDropdown = document.getElementById('categoryDropdown');
            if (categoryDropdown) {
                categoryDropdown.classList.remove('open');
            }
        }
    }

    // Load categories dynamically
    function loadCategories() {
        fetch('{{ route("api.categories") }}')
            .then(response => response.json())
            .then(data => {
                categories = data;
                populateCategories(data);
            })
            .catch(error => console.error('Error loading categories:', error));
    }

    // Populate category list
    function populateCategories(data) {
        const categoryList = document.getElementById('categoryList');
        if (categoryList) {
            categoryList.innerHTML = '';

            // Add "All Categories" option with active class by default
            const allCategoriesLi = document.createElement('li');
            allCategoriesLi.innerHTML = `
                <a href="#" onclick="selectCategory('', 'All Categories')" class="active">
                    <i class="fa fa-th icon"></i>All Categories
                </a>
            `;
            categoryList.appendChild(allCategoriesLi);

            data.forEach(category => {
                const li = document.createElement('li');
                li.innerHTML = `
                    <a href="#" onclick="selectCategory('${category.id}', '${category.name}')">
                        <i class="${category.icon || 'adicon-grid'} icon"></i>${category.name}
                    </a>`;
                categoryList.appendChild(li);
            });
        }
    }

    // Select category
    function selectCategory(categoryId, categoryName) {
        selectedCategoryId = categoryId;
        selectedSubcategoryId = null; // Reset subcategory
        
        // Update selected category text
        const selectedCategoryText = document.getElementById('selectedCategoryText');
        if (selectedCategoryText) {
            selectedCategoryText.textContent = categoryName;
        }
        
        // Update active class in dropdown
        const categoryList = document.getElementById('categoryList');
        if (categoryList) {
            // Remove active class from all items
            const allLinks = categoryList.querySelectorAll('a');
            allLinks.forEach(link => link.classList.remove('active'));
            
            // Add active class to selected item
            const selectedLink = categoryList.querySelector(`a[onclick*="selectCategory('${categoryId}', '${categoryName}')"]`);
            if (selectedLink) {
                selectedLink.classList.add('active');
            }
        }
        
        closeCategoryDropdown();
    }

    // Close category dropdown
    function closeCategoryDropdown() {
        const dropdown = document.getElementById('categoryDropdown');
        if (dropdown) {
            dropdown.classList.remove('open');
        }
    }

    // Toggle category dropdown
    function toggleCategoryDropdown() {
        const dropdown = document.getElementById('categoryDropdown');
        if (dropdown) {
            dropdown.classList.toggle('open');
            
            // Close country dropdown if open
            const countryDropdown = document.getElementById('countryDropdown');
            if (countryDropdown) {
                countryDropdown.classList.remove('open');
            }
        }
    }

    // Handle Enter key press in search input
    function handleSearchKeypress(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            submitSearch(event);
        }
    }

    // Submit search
    function submitSearch(event) {
        event.preventDefault();
        const queryParams = new URLSearchParams();

        // Add country filter
        if (selectedCountry) {
            queryParams.set('country', selectedCountry.id);
        }

        // Add category filter
        if (selectedCategoryId) {
            // If main category selected, find category and set up URL like category slug
            const cat = categories.find(c => c.id == selectedCategoryId);
            if (cat) {
                window.location.href = `{{ route("web.listing", ":category") }}?${queryParams.toString()}`.replace(':category', cat.slug);
                return;
            }
        }

        // Add search query
        const searchValue = document.getElementById('searchInput');
        if (searchValue && searchValue.value) {
            queryParams.set('q', searchValue.value);
        }

        // Add date filter if present in URL
        const urlParams = new URLSearchParams(window.location.search);
        const dateFilter = urlParams.get('date_filter');
        if (dateFilter) {
            queryParams.set('date_filter', dateFilter);
        }

        // Build the final URL
        const baseUrl = '{{ route("web.listing") }}';
        const queryString = queryParams.toString();
        const finalUrl = queryString ? `${baseUrl}?${queryString}` : baseUrl;

        // Redirect to listing page with all parameters
        window.location.href = finalUrl;
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function (event) {
        if (!event.target.closest('.search-field')) {
            const countryDropdown = document.getElementById('countryDropdown');
            const categoryDropdown = document.getElementById('categoryDropdown');
            
            if (countryDropdown) {
                countryDropdown.classList.remove('open');
            }
            if (categoryDropdown) {
                categoryDropdown.classList.remove('open');
            }
        }
    });
</script>
    @stack('scripts')

</body>
</html>
