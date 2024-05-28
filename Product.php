<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ljekarko</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="styles/Style.css">


    <link rel="stylesheet" href="styles/ProductStyle.css">
</head>

<body class="d-flex flex-column">

    <?php include 'partials/header.php'; ?>


    <main>


        <div class="container">
            <div class="row">

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

                // Retrieve form data
                $id = $_POST['id'];

                // You can now use these variables as needed, such as querying the database with these parameters
                // For example:
                $sql = "SELECT * FROM products WHERE id=$id";
                // Execute your SQL query and process the results accordingly


                // Execute query
                $result = $conn->query($sql);

                // Close database connection
                $conn->close();
                ?>

                <!-- PHP loop to display products -->
                <?php foreach ($result as $product) : ?>
                    <h1 class="productTitle"><?php echo $product['Name']; ?></h1>
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                    <div class="col-md-6">
                        <img class="productImg" src="<?php echo $product['Image']; ?>">
                        <p>
                            <br>
                            <?php echo $product['Description']; ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            Cijena: <?php echo $product['Price']; ?>€
                        </p>
                        <p>
                            U skladištu: <?php echo $product['Quantity']; ?>
                        </p>
                        <form action="scripts/addToCart.php" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <?php
                            // Check if product quantity is larger than 0
                            if ($product['Quantity'] > 0) {
                                // Product is available, display submit button
                            ?>
                                <button type="submit" class="btn btn-outline-info">Dodaj u kosaricu</button>
                            <?php
                            }
                            ?>
                        </form>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
<br><br><br>
    </main>

    <?php include 'partials/footer.php'; ?>



</body>

</html>