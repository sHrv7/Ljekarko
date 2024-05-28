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


        <form action="scripts/orderProductsScript.php" method="POST">
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
                        <input type="hidden" name="quantity" value="<?php echo $product['Quantity']; ?>">
                        <div class="col-md-6">
                            <img class="productImg" src="<?php echo $product['Image']; ?>">
                            <p>
                                <?php echo $product['Description']; ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                Cijena: <?php echo $product['Price']; ?>€
                            </p>
                            <p>
                                U skladistu: <?php echo $product['Quantity']; ?>
                            </p>
                            <p>
                                <input type="number" name="kolicina" placeholder="Koliko naručiti">
                            </p>
                            <button class="btn btn-outline-info">Naruči</button>

                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </form>

    </main>

    <?php include 'partials/footer.php'; ?>



</body>

</html>