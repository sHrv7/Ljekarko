<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ljekarko</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="styles/Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


</head>

<body class="d-flex flex-column">

    <?php include 'partials/header.php'; ?>

    <main>
        <div class="container">
            <h2>Kontakt</h2>
            <form>
                <div class="mb-3">
                    <label for="firstname" class="form-label">Ime</label>
                    <input type="text" class="form-control" id="firstname" required>
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">Prezime</label>
                    <input type="text" class="form-control" id="lastname" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-pošta</label>
                    <input type="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="country" class="form-label">Država</label>
                    <input type="text" class="form-control" id="country" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="newsletter">
                    <label class="form-check-label" for="newsletter">Pretplatite se na newsletter</label>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Predmet</label>
                    <input type="text" class="form-control" id="subject" required>
                </div>
                <button type="submit" class="btn btn-primary">Pošalji</button>
            </form>
        </div>


        <div class="container">
            <h2>Pronadite nas ovdje</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d44602.4310798772!2d16.368215530886523!3d45.677887195802406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47665fbddc1d410b%3A0x400ad50862bb640!2sIvani%C4%87-Grad!5e0!3m2!1sen!2shr!4v1710776559693!5m2!1sen!2shr" width="100%" height="500px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </main>


    <?php include 'partials/footer.php'; ?>

</body>

</html>