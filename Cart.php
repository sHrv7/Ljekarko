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

        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            // Get the product IDs from the cart session
            $product_ids = array_keys($_SESSION['cart']);

            // Convert the product IDs to a comma-separated string for the SQL IN clause
            $product_ids_str = implode(',', array_map('intval', $product_ids));

            // Prepare SQL statement to get products by IDs
            $sql = "SELECT * FROM products WHERE id IN ($product_ids_str) ORDER BY `Name` ASC";
            $result = $conn->query($sql);
        } else {
            $result = [];
        }


        // Close database connection
        $conn->close();



        ?>

        <?php if (empty($result)) : ?>
            <div class="fullHeight">Nema stavki dodanih u košaricu</div>
        <?php else : ?>


            <br>
            <br>

            <form class="payButton" action="scripts/buy.php">
                <button type="submit" class="btn btn-outline-info payButton">Plati odmah</button>
            </form>


            <br>
            <br>

            <div class="container">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">



                    <!-- PHP loop to display products -->
                    <?php foreach ($result as $product) : ?>
                        <div class="col">
                            <form action="Product.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                <button class="imageButton">
                                    <img src="<?php echo $product['Image']; ?>" alt="<?php echo htmlspecialchars($product['Name']); ?>">
                                </button>
                            </form>
                            <h1 class="productTitle"><?php echo htmlspecialchars($product['Name']); ?></h1>
                            <p><?php echo htmlspecialchars($product['Price']); ?>€</p>
                            <form action="scripts/updateCart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <input type="number" name="quantity" value="<?php echo $_SESSION['cart'][$product['id']] ?? 0; ?>" min="0">
                                <br><br>
                                <button type="submit" class="btn btn-outline-info">Ažuriraj količinu</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

<br>

    </main>

    <?php include 'partials/footer.php'; ?>

</body>

</html>