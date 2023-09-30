<!DOCTYPE html>
<html>
<head>
    <title>Snacks</title>
    <link rel="stylesheet" href="{{ asset('path-to-your-css/pagination.css') }}">
    <style>
        /* Define styles for the grid */
        .grid-container {
            display: grid;
           
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px; /* Adjust the gap between items */
            
        }

        /* Style each grid item (snack) */
        .grid-item {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Style the snack image */
        .grid-item img {
            max-width: 100%;
            height: auto;
        }

        /* Add styles for filtering and sorting */
        .filter-sort-container {
            margin-bottom: 20px;
        }

        .filter-sort-container label {
            margin-right: 10px;
        }
        h1 {
            text-align: center;
            font-size: 36px;
            color: #007bff; /* Blue color, you can change this to your preferred color */
            text-transform: uppercase;
            margin-bottom: 20px;
        }
        /* Responsive styles for the grid */
        @media (min-width: 768px) {
            /* For screens wider than 768px, display 3 columns */
            .grid-container {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 767px) {
            /* For screens up to 767px wide, display 2 columns */
            .grid-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            /* For screens up to 480px wide, display 1 column */
            .grid-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Snacks</h1>

        <!-- Filter Form -->
        <div class="filter-sort-container">
            <label for="gluten-free">Filter by Gluten-Free:</label>
            <input type="checkbox" id="gluten-free" name="gluten_free" value="1">
        </div>

        <!-- Sort Buttons/Links -->
        <!-- <div class="filter-sort-container">
            <p>Sort by:</p>
            <a href="#" class="sort" data-sort="name">Name</a> |
            <a href="#" class="sort" data-sort="calories">Calories</a> |
            <a href="#" class="sort" data-sort="brand">Brand</a>
        </div> -->

        <!-- Display snacks in a grid -->
        <div class="grid-container">
            @foreach($paginator['snacks'] as $snack)
            <div class="grid-item {{ $snack['gluten_free'] ? 'gluten-free' : '' }}">
                <img src="{{ $snack['image_url'] }}" alt="{{ $snack['name'] }}" width="200" height="150">
                <h2>{{ $snack['name'] }}</h2>
                <p>{{ $snack['description'] }}</p>
                <p>Brand: {{ $snack['brand'] }}</p>
                <p>Calories: {{ $snack['calories'] }}</p>
                <p>Quantity: {{ $snack['quantity'] }}</p>
                <p>Gluten-free: {{ $snack['gluten_free'] ? 'Yes' : 'No' }}</p>
                <p>Refrigerated: {{ $snack['refrigerated'] ? 'Yes' : 'No' }}</p>
            </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        <!-- {{ $paginator->links() }} -->
    </div>

    <!-- Include jQuery and Isotope scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>

    <!-- JavaScript for filtering and sorting -->
    <script>
        $(document).ready(function () {
            // Initialize Isotope
            var $grid; // Declare $grid in a broader scope

// Check if all images are loaded
var areImagesLoaded = function () {
    var images = $('.grid-container img');
    var loaded = true;
    images.each(function () {
        if (!this.complete) {
            loaded = false;
            return false;
        }
    });
    return loaded;
};

// Initialize Isotope once images are loaded
var initializeIsotope = function () {
    $grid = $('.grid-container').isotope({
        itemSelector: '.grid-item',
        layoutMode: 'fitRows'
    });
};

// Check if images are already loaded or not
if (areImagesLoaded()) {
    initializeIsotope();
} else {
    $('.grid-container img').on('load', function () {
        if (areImagesLoaded()) {
            initializeIsotope();
        }
    });
}

            // Filtering
            $('#gluten-free').on('change', function () {
                var filterValue = $(this).is(':checked') ? '.gluten-free' : '';
                $grid.isotope({ filter: filterValue });
            });

            // Sorting
            $('.sort').on('click', function () {
                var sortByValue = $(this).data('sort');
                $grid.isotope({ sortBy: sortByValue });
                return false;
            });
        });
    </script>
</body>
</html>
