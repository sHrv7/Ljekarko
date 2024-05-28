<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ljekarko</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="styles/Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles/NewsStyle.css">

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

                // SQL query to select all news data
                $sql = "SELECT * FROM news ORDER BY `Date` DESC";

                // Execute query
                $result = $conn->query($sql);

                // Check if there are any results
                if ($result->num_rows > 0) {
                    // Fetch data from each row and store it in an array
                    $news = array();
                    while ($row = $result->fetch_assoc()) {
                        $row['Date'] = date('d.m.Y', strtotime($row['Date'])); // Convert date format
                        $news[] = $row;
                    }
                } else {
                    echo "0 results";
                }

                // Close database connection
                $conn->close();

                foreach ($news as $item) {
                ?>
                    <h2><?php echo $item['Title']; ?></h2>
                    <div class="col-md-6 news">
                        <img src="<?php echo $item['Image']; ?>" class="img-fluid">
                    </div>
                    <div class="col-md-6 news">
                        <p><?php echo $item['Text']; ?></p>
                        <p>Datum objave: <?php echo $item['Date']; ?></p>
                        <a href="<?php echo $item['Link']; ?>">Vidi više</a>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </main>



    <?php include 'partials/footer.php'; ?>

</body>

</html>