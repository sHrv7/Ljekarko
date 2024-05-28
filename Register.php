<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ljekarko</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="styles/Style.css">
    <link rel="stylesheet" href="styles/UserFormStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
    </script>

</head>

<body class="d-flex flex-column">

    <?php include 'partials/header.php'; ?>

    <main>
        <form action="scripts/registerScript.php" method="post" class="bg-dark text-white registration-form">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <button type="submit">Registriraj se</button>
        </form>
    </main>


    <?php include 'partials/footer.php'; ?>

</body>

</html>