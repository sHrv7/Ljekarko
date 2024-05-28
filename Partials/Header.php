<header class="bg-dark text-white" id="header">
    <div class="container text-center">
        <h1>Ljekarko</h1>
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="Home.php">
                    <img src="https://img.icons8.com/ios-filled/50/home.png" class="icon" />
                    Početna
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Shop.php">
                    <img src="https://img.icons8.com/ios-filled/50/shop.png" class="icon" />
                    Trgovina
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Cart.php">
                    <img src="https://img.icons8.com/glyph-neue/128/shopping-cart.png" class="icon" />
                    Košarica
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Gallery.php">
                    <img src="https://img.icons8.com/glyph-neue/64/gallery.png" class="icon" />
                    Galerija
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="News.php">
                    <img src="https://img.icons8.com/ios-filled/50/news.png" class="icon" />
                    Vijesti
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="About_us.php">
                    <img src="https://img.icons8.com/ios-filled/50/info.png" class="icon" />
                    O nama
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Contact.php">
                    <img src="https://img.icons8.com/ios-filled/50/contact-card.png" class="icon" />
                    Kontakt
                </a>
            </li>

            <?php
            session_start();
            if (isset($_SESSION['username'])) {
                echo '<li class="nav-item">
                        <a class="nav-link" href="UserPage.php">' . $_SESSION['username'] . '</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="scripts/logoutScript.php">Odjava</a>
                    </li>';
            } else {
                echo '<li class="nav-item">
                        <a class="nav-link" href="Register.php">Registracija</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Login.php">Prijava</a>
                    </li>';
            }
            ?>
        </ul>
    </div>
</header>