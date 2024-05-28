<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ljekarko</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="styles/Style.css">

    <link rel="stylesheet" href="styles/UserPageStyle.css">

    <script>
        function displayErrorMessage() {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const error = urlParams.get('error');
            if (error) {
                alert(error);
            }
        }
        window.onload = displayErrorMessage;


        function confirmDelete() {
            var result = confirm("Jeste li sigurni da želite obrisati svoj račun?");
            if (result) {
                window.location.href = "scripts/deleteUserScript.php";
            }
        }
    </script>

</head>

<body class="d-flex flex-column">

    <?php include 'partials/header.php'; ?>

    <main>

        <?php
        if ($_SESSION['admin']) {
            include 'partials/ManageNews.php';

            include 'partials/ManageProducts.php';

            include 'partials/ManageUsers.php';
        } else {
            echo "<div class='halfHeight'></div>";
        }
        ?>

        <div class="container text-center">
            <button class="delete-button" onclick="confirmDelete()">Obriši račun</button>
        </div>

        <?php
        if (! $_SESSION['admin']) {        
            echo "<div class='halfHeight'></div>";
        }
        ?>

    </main>


    <?php include 'partials/footer.php'; ?>

</body>

</html>