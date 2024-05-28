<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ljekarko</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="styles/Style.css">



    <script src="https://cdn.jsdelivr.net/npm/nouislider/distribute/nouislider.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/nouislider/distribute/nouislider.min.css" rel="stylesheet">


    <link rel="stylesheet" href="styles/ShopStyle.css">
</head>

<body class="d-flex flex-column">

    <?php include 'partials/header.php'; ?>


    <main>

        <form action="Shop.php" method="POST" id="searchArea">
            <div id="slider"></div>
            <input type="number" step="any" placeholder="Min" id="minPrice" name="minPrice" value="<?php echo isset($_POST['minPrice']) ? $_POST['minPrice'] : '0'; ?>">
            <input type="number" step="any" placeholder="Max" id="maxPrice" name="maxPrice" value="<?php echo isset($_POST['maxPrice']) ? $_POST['maxPrice'] : '250'; ?>">
            <br>
            <textarea id="textArea" placeholder="Pretraži..." name="searchText"><?php echo isset($_POST['searchText']) ? $_POST['searchText'] : ''; ?></textarea>
            <br>
            <button type="submit" class="btn btn-success btn-sm">Pretraži</button>
            <a href="Shop.php" class="btn btn-danger btn-sm" onclick="return confirm('Jeste li sigurni da želite ukloniti filtere?')">Ukloni filtere</a>
        </form>


        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">

                <?php

                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "Ljekarko";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Check if the form is submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Retrieve form data
                    $minPrice = $_POST["minPrice"];
                    $maxPrice = $_POST["maxPrice"];
                    $searchText = $_POST["searchText"];
                    $searchText = "%$searchText%"; // For LIKE search

                    // Prepare SQL statement
                    $sql = "SELECT * FROM products WHERE price BETWEEN ? AND ? AND (description LIKE ? OR Name LIKE ?) ORDER BY `Name` ASC";
                    $stmt = $conn->prepare($sql);

                    // Bind parameters
                    $stmt->bind_param("ddss", $minPrice, $maxPrice, $searchText, $searchText);

                    $stmt->execute();

                    // Get the result
                    $result = $stmt->get_result();

                    $stmt->close();
                } else {
                    // SQL query to select all news data
                    $sql = "SELECT * FROM products ORDER BY `Name` ASC";

                    // Execute query
                    $result = $conn->query($sql);
                }

                // Close database connection
                $conn->close();

                if (!$result || $result->num_rows == 0) {
                    $result = [];
                }

                ?>

                <?php if (empty($result)) : ?>
                    <div class="fullHeight">Nema stavki za prikaz</div>
                <?php else : ?>
                    <!-- PHP loop to display products -->
                    <?php foreach ($result as $product) : ?>
                        <div class="col">
                            <form action="Product.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                <button class="imageButton">
                                    <img src="<?php echo $product['Image']; ?>">
                                </button>
                            </form>
                            <h1 class="productTitle"><?php echo $product['Name']; ?></h1>
                            <p><?php echo $product['Price']; ?>€</p>
                            <form action="scripts/addToCart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <?php
                                // Check if product quantity is larger than 0
                                if ($product['Quantity'] > 0) {
                                    // Product is available, display submit button
                                ?>
                                    <button type="submit" class="btn btn-outline-info">Dodaj u košaricu</button>
                                <?php
                                } else {
                                    // Product is not available, display message
                                ?>Nažalost, ovaj predmet nije trenutno u skladištu.
                                <?php
                                }
                                ?>
                            </form>

                        </div>
                    <?php endforeach; ?>


                <?php endif; ?>

            </div>
        </div>

        <br>
        <br>
        <br>


    </main>

    <?php include 'partials/footer.php'; ?>

    <script>
        // creating double handle slider
        var slider = document.getElementById('slider');
        var minPrice = document.getElementById('minPrice');
        var maxPrice = document.getElementById('maxPrice');

        noUiSlider.create(slider, {
            start: [minPrice.value, maxPrice.value],
            connect: true,
            range: {
                'min': 0,
                'max': 250
            },
        });

        // setting slider values to inputs
        minPrice.addEventListener('change', function() {
            slider.noUiSlider.set([this.value, null]);
        });

        maxPrice.addEventListener('change', function() {
            slider.noUiSlider.set([null, this.value]);
        });

        // setting inputs to slider values
        slider.noUiSlider.on('update', function(values, handle) {
            minPrice.value = values[0];
            maxPrice.value = values[1];
        });

        // dynamic search area positioning
        var headerHeight = document.getElementById('header').offsetHeight;
        var fixedElement = document.getElementById('searchArea');
        var originalTop = fixedElement.offsetTop;

        window.addEventListener('scroll', function() {
            // if the header not visible anymore
            if (window.scrollY >= headerHeight) {
                fixedElement.style.position = 'fixed';
                fixedElement.style.top = '0';
            } else {
                fixedElement.style.position = 'absolute';
                fixedElement.style.top = originalTop + 'px';
            }
        });
    </script>



</body>

</html>