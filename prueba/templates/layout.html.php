<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='UTF-8' />
    <meta name='robots' content='index' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hipermercado a tu medida | Merkar</title>
    <link rel='stylesheet' href='/css/normalize.css'>
    <link rel='stylesheet' href='/css/main.css'>
    <link href='https://fonts.googleapis.com/css2?family=Pacifico&family=Rubik:ital,wght@0,400;0,500;1,400&display=swap'
        rel='stylesheet'>
        <script src="https://kit.fontawesome.com/c094c4f2ad.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <header class="wrapper header">
            <div class="header__container">
                <div class="logo">
                    <h1 class="logo__title">Merkar</h1>
                    <p class="logo__slogan">Hipermercado a tu medida</p>
                </div>
                <div class="search">
                    <input type="search">
                </div>
                <nav class="toolbar">
                    <a href="#" class="toolbar__link">
                        <img class="toolbar__icon" src="/images/wishlist.svg" alt="Lista de deseos">
                    </a>
                    <a href="#" class="toolbar__link">
                        <img class="toolbar__icon" src="/images/user.svg" alt="Acceso de usuarios">
                    </a>
                    <a href="#" class="toolbar__link">
                        <img class="toolbar__icon" src="/images/cart.svg" alt="Carrito de compras">
                    </a>
                </nav>
            </div>
        </header>
        <?=$output?> <!-- Content -->
        <footer class="footer">
            <?php include 'footer.html.php';?>
        </footer>
    </div>
</body>

</html>