<!DOCTYPE html>
<html>

<head>
    <title>Products Form</title>
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
    /* CSS styles */
    </style>
    <script>
    $(document).ready(function() {
        // Check the URL for query parameters
        var urlParams = new URLSearchParams(window.location.search);

        if (urlParams.has('something')) {
            // If query parameter exists, hide "Add Products" and show "View Products"
            $('#add_products').hide();
            $('#product_list').show();
        } else {
            // If no query parameter, show "Add Products" and hide "View Products"
            $('#add_products').show();
            $('#product_list').hide();
        }

        // Button click event to show "View Products" and hide "Add Products"
        $('#view_products').click(function() {
            $('#add_products').hide();
            $('#product_list').show();
        });
    });
    </script>
</head>

<body>
    <div class="container" id="add_products">
        <h1>Add</h1>
    </div>

    <div id="product_list" style="display: none;">
        <!-- View Products table -->
        <h1>View</h1>

    </div>

    <button id="view_products">View Products</button>
</body>

</html>