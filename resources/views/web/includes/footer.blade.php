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
    const citiesByCountry = {
        "USA": ["Basildon","Bedford","Benfleet","Billericay","Bishops Stortford","Braintree","Brentwood","Bury St Edmunds","Cambridge","Canvey Island","Chelmsford","Cheshunt","Clacton-on-Sea","Colchester","Dunstable","Ely","Felixstowe","Grays","Great Yarmouth","Harlow","Harpenden","Harwich","Hemel Hempstead","Hertford","Hitchin","Hoddesdon","Huntingdon","Ipswich","Kings Lynn","Leighton Buzzard","Lowestoft","Luton","Maldon","Norwich","Peterborough","Saffron Walden","Southend-on-Sea","St Albans","St Ives - Cambs","St Neots","Stevenage","Sudbury","Watford","Welwyn Garden City","Witham","Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","DC","Florida","Georgia","Guam","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Carolina","North Dakota","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","US Virgin Islands","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"],
        "North East": ["Blyth","Chester-le-Street","Darlington","Durham","Gateshead","Hartlepool","Middlesbrough","Morpeth","Newcastle-upon-Tyne","North Shields","Redcar","South Shields","Stockton-on-Tees","Sunderland","Wallsend","Washington","Whitley Bay"],
        "Yorkshire": ["Barnsley","Batley","Beverley","Bradford","Bridlington","Castleford","Dewsbury","Doncaster","Grimsby","Halifax","Harrogate","Huddersfield","Hull","Leeds","Rotherham","Scarborough","Sheffield","Wakefield","York"],
        "East Midlands": ["Arnold","Beeston","Boston","Chesterfield","Corby","Derby","Gainsborough","Grantham","Hinckley","Kettering","Leicester","Lincoln","Loughborough","Mansfield","Nottingham","Skegness","Spalding"],
        "London": ["Barking & Dagenham","Barnet","Bexley","Brent","Bromley","Camden","City of London","Croydon","Ealing","Enfield","Greenwich","Hackney","Hammersmith & Fulham","Haringey","Harrow","Havering","Hillingdon","Hounslow","Islington","Kensington & Chelsea","Kingston","Lambeth","Lewisham","Merton","Newham","Redbridge","Richmond","Southwark","Sutton","Tower Hamlets","Waltham Forest","Wandsworth","Westminster"],
        "South West": ["Barnstaple","Bath","Bideford","Bournemouth","Bristol","Cheltenham","Exeter","Gloucester","Plymouth","Swindon","Taunton","Torquay","Truro","Weston-super-Mare","Yeovil"],
        "Other Countries": ["Algeria","Argentina","Australia","Austria","Bangladesh","Belgium","Brazil","Canada","China","France","Germany","India","Japan","Nepal","New Zealand","Pakistan","Singapore","South Africa","Sri Lanka","United Arab Emirates","United Kingdom","USA","Zimbabwe"]
    };

    const countryList = document.getElementById('countryList');
    const cityList = document.getElementById('cityList');
    const megaContent = document.querySelector('.mega-content');
    const dropdownButton = document.querySelector('.mega-dropdown > button');

    let selectedCity = null;
    let selectedCountry = null;

    // Populate country list
    Object.keys(citiesByCountry).forEach(country => {
        const li = document.createElement('li');
        li.innerHTML = `<a href="#" onclick="showCities('${country}')">${country}</a>`;
        countryList.appendChild(li);
    });

    // Filter countries
    function filterCountries() {
        const input = document.getElementById('countrySearch').value.toLowerCase();
        document.querySelectorAll('#countryList li').forEach(li => {
            li.style.display = li.textContent.toLowerCase().includes(input) ? '' : 'none';
        });
    }

    // Show cities of selected country
    function showCities(country) {
        cityList.innerHTML = '';
        selectedCountry = country;

        citiesByCountry[country].forEach(city => {
            const isSelected = (selectedCity === city && selectedCountry === country);
            const li = document.createElement('li');
            li.innerHTML = `
            <a href="#" onclick="selectCity(event, '${city}', '${country}')"
                style="${isSelected ? 'font-weight:bold;color:#007bff;' : ''}">
                ${city}
            </a>`;
            cityList.appendChild(li);
        });

        document.getElementById('countryListContainer').style.display = 'none';
        document.getElementById('cityListContainer').style.display = 'block';
    }

    // Go back to countries
    function backToCountries() {
        document.getElementById('cityListContainer').style.display = 'none';
        document.getElementById('countryListContainer').style.display = 'block';
    }

    // Select city and close dropdown
    function selectCity(event, city, country) {
        event.preventDefault();
        event.stopPropagation();

        selectedCity = city;
        selectedCountry = country;
        dropdownButton.textContent = `${city}, ${country}`;

        // Close dropdown immediately
        megaContent.classList.remove('open');
        dropdownButton.blur();

        // Highlight selected
        document.querySelectorAll('#cityList a').forEach(a => {
            a.style.fontWeight = (a.textContent === city) ? 'bold' : 'normal';
            a.style.color = (a.textContent === city) ? '#007bff' : '';
        });
    }

    // Toggle dropdown open/close
    dropdownButton.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        // Toggle open class
        megaContent.classList.toggle('open');

        if (megaContent.classList.contains('open')) {
            // When opened, reset to countries
            document.getElementById('countryListContainer').style.display = 'block';
            document.getElementById('cityListContainer').style.display = 'none';
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (event) {
        if (!event.target.closest('.mega-dropdown')) {
            megaContent.classList.remove('open');
        }
    });
  </script>


    <script>
        const citiesByCountry = {
        "USA": ["Basildon","Bedford","Benfleet","Billericay","Bishops Stortford","Braintree","Brentwood","Bury St Edmunds","Cambridge","Canvey Island","Chelmsford","Cheshunt","Clacton-on-Sea","Colchester","Dunstable","Ely","Felixstowe","Grays","Great Yarmouth","Harlow","Harpenden","Harwich","Hemel Hempstead","Hertford","Hitchin","Hoddesdon","Huntingdon","Ipswich","Kings Lynn","Leighton Buzzard","Lowestoft","Luton","Maldon","Norwich","Peterborough","Saffron Walden","Southend-on-Sea","St Albans","St Ives - Cambs","St Neots","Stevenage","Sudbury","Watford","Welwyn Garden City","Witham","Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","DC","Florida","Georgia","Guam","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Carolina","North Dakota","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","US Virgin Islands","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"],
        "North East": ["Blyth","Chester-le-Street","Darlington","Durham","Gateshead","Hartlepool","Middlesbrough","Morpeth","Newcastle-upon-Tyne","North Shields","Redcar","South Shields","Stockton-on-Tees","Sunderland","Wallsend","Washington","Whitley Bay"],
        "Yorkshire": ["Barnsley","Batley","Beverley","Bradford","Bridlington","Castleford","Dewsbury","Doncaster","Grimsby","Halifax","Harrogate","Huddersfield","Hull","Leeds","Rotherham","Scarborough","Sheffield","Wakefield","York"],
        "East Midlands": ["Arnold","Beeston","Boston","Chesterfield","Corby","Derby","Gainsborough","Grantham","Hinckley","Kettering","Leicester","Lincoln","Loughborough","Mansfield","Nottingham","Skegness","Spalding"],
        "London": ["Barking & Dagenham","Barnet","Bexley","Brent","Bromley","Camden","City of London","Croydon","Ealing","Enfield","Greenwich","Hackney","Hammersmith & Fulham","Haringey","Harrow","Havering","Hillingdon","Hounslow","Islington","Kensington & Chelsea","Kingston","Lambeth","Lewisham","Merton","Newham","Redbridge","Richmond","Southwark","Sutton","Tower Hamlets","Waltham Forest","Wandsworth","Westminster"],
        "South West": ["Barnstaple","Bath","Bideford","Bournemouth","Bristol","Cheltenham","Exeter","Gloucester","Plymouth","Swindon","Taunton","Torquay","Truro","Weston-super-Mare","Yeovil"],
        "Other Countries": ["Algeria","Argentina","Australia","Austria","Bangladesh","Belgium","Brazil","Canada","China","France","Germany","India","Japan","Nepal","New Zealand","Pakistan","Singapore","South Africa","Sri Lanka","United Arab Emirates","United Kingdom","USA","Zimbabwe"]
        };

        const countryList = document.getElementById('countryList');
        const cityList = document.getElementById('cityList');
        const megaContent = document.querySelector('.mega-content');
        const dropdownButton = document.querySelector('.mega-dropdown > button');

        let selectedCity = null;
        let selectedCountry = null;

        // Populate country list
        Object.keys(citiesByCountry).forEach(country => {
        const li = document.createElement('li');
        li.innerHTML = `<a href="#" onclick="showCities('${country}')">${country}</a>`;
        countryList.appendChild(li);
        });

        // Filter countries
        function filterCountries() {
        const input = document.getElementById('countrySearch').value.toLowerCase();
        document.querySelectorAll('#countryList li').forEach(li => {
            li.style.display = li.textContent.toLowerCase().includes(input) ? '' : 'none';
        });
        }

        // Show cities of selected country
        function showCities(country) {
        cityList.innerHTML = '';
        selectedCountry = country;

        citiesByCountry[country].forEach(city => {
            const isSelected = (selectedCity === city && selectedCountry === country);
            const li = document.createElement('li');
            li.innerHTML = `
            <a href="#" onclick="selectCity(event, '${city}', '${country}')"
                style="${isSelected ? 'font-weight:bold;color:#007bff;' : ''}">
                ${city}
            </a>`;
            cityList.appendChild(li);
        });

        document.getElementById('countryListContainer').style.display = 'none';
        document.getElementById('cityListContainer').style.display = 'block';
        }

        // Go back to countries
        function backToCountries() {
        document.getElementById('cityListContainer').style.display = 'none';
        document.getElementById('countryListContainer').style.display = 'block';
        }

        // Select city and close dropdown
        function selectCity(event, city, country) {
        event.preventDefault();
        event.stopPropagation();

        selectedCity = city;
        selectedCountry = country;
        dropdownButton.textContent = `${city}, ${country}`;

        // Close dropdown immediately
        megaContent.classList.remove('open');
        dropdownButton.blur();

        // Highlight selected
        document.querySelectorAll('#cityList a').forEach(a => {
            a.style.fontWeight = (a.textContent === city) ? 'bold' : 'normal';
            a.style.color = (a.textContent === city) ? '#007bff' : '';
        });
        }

        // Toggle dropdown open/close
        dropdownButton.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        // Toggle open class
        megaContent.classList.toggle('open');

        if (megaContent.classList.contains('open')) {
            // When opened, reset to countries
            document.getElementById('countryListContainer').style.display = 'block';
            document.getElementById('cityListContainer').style.display = 'none';
        }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function (event) {
        if (!event.target.closest('.mega-dropdown')) {
            megaContent.classList.remove('open');
        }
        });
    </script>
    @stack('scripts')

</body>
</html>


