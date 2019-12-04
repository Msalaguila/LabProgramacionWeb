<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PaginaWeb</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightpick@1.3.4/css/lightpick.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean-1.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean-2.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean-3.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean-1.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean-2.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <?php session_start(); ?>


    <!-- MOSTRAMOS MENSAJE CUANDO EL USUARIO NO ESTÁ LOGEADO E INTENTA PAGAR -->
    <?php
    if (isset($_SESSION["errorLogeadoTienda"])) {
        echo '<script language="javascript">';
        echo 'alert("Necesitas estar logeado para realizar el pago")';  //not showing an alert box.
        echo '</script>';
        unset($_SESSION["errorLogeadoTienda"]);
    }
    ?>

    <!-- MOSTRAMOS MENSAJE CUANDO CARRITO ESTÁ VACÍO -->
    <?php
    if (isset($_SESSION["errorCarritoVacio"])) {
        echo '<script language="javascript">';
        echo 'alert("El carrito se encuentra vacío")';  //not showing an alert box.
        echo '</script>';
        unset($_SESSION["errorCarritoVacio"]);
    }
    ?>

</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md" id="navbar" href="#">
        <div class="container-fluid"><a class="navbar-brand" id="page_icon" href="inicial.html"></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto" id="main_nav">
                    <li class="nav-item" role="presentation"><a class="nav-link nav_item" href="inicial.php">MyWebIoT</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link nav_item" href="canales.php">Canales</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">Ayuda</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="contacto.php">Contacto</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active normal" href="tienda.php">MyIoT Shop</a></li>
                    <?php
                    if (isset($_SESSION["user"])) {
                        $nombre = $_SESSION["user"];
                        // ADMIN LOGEADO
                        if ($nombre == "admin@gmail.com") {
                            echo "<li class='nav-item' role='presentation'><a class='nav-link' href='paginaPrincipalProductos.php'>Productos</a></li>";
                        }
                    }
                    ?>
                </ul>
                <ul class="nav navbar-nav ml-auto" id="right_nav">
                    <li class="nav-item" role="presentation"><a class="nav-link nav_item"></a></li>
                    <?php
                    if (isset($_SESSION["user"])) {
                        $nombre = $_SESSION["user"];
                        echo "<li class='nav-item' role='presentation'><a class='nav-link' href='#'>$nombre</a></li>";
                        echo "<li class='nav-item' role='presentation'><a class='nav-link' href='../laboratorioweb/scripts/logout.php'>Logout Usuario</a></li>";
                    } else {
                        echo "<li class='nav-item' role='presentation' style='margin-right: 5px;'><a class='nav-link' href='loginhtml.php'>Login</a></li>";
                        echo "<li class='nav-item' role='presentation'><a class='nav-link' href='registro.php'>Register</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <section class="section_shop">
        <div class="container shop">
            <div class="row d-flex flex-row">
                <div class="col-9 d-flex article1_shop">
                    <article class="text-break article1_shop">
                        <h1 class="article1_shop_heading">Bienvenidos a la tienda virtual de MyWebIoT</h1>
                        <p style="padding: 2px;">ParagraphParagraphParagraphParagraphParagraphParagraphParagraphParagraphParagraphParagraphParagraphParagraphParagraphParagraph</p>
                    </article>
                </div>
                <div class="col d-flex">
                    <article class="text-break d-flex flex-column justify-content-center align-items-center article1_shop"><a href="#canales_heading">Mostrar carrito</a>
                        <p style="padding: 2px;">Checkout</p>

                        <form class="paypal" action="scripts/payments.php" method="post" id="paypal_form">
                            <input type="hidden" name="cmd" value="_xclick" />
                            <input type="hidden" name="no_note" value="1" />
                            <input type="hidden" name="lc" value="UK" />
                            <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />


                            <input class="btn btn-primary checkout" type="submit" name="submit" value="Realizar Checkout" />
                        </form>
                    </article></a>
                </div>
            </div>
            <div class="row shop2" style="margin-top: 20px;">
                <div class="col d-flex justify-content-center flex-wrap">
                    <?php include("./scripts/getAllShopProducts.php"); ?>
                </div>
            </div>
            <br>
            <?php
            include("../laboratorioweb/scripts/showCarrito.php");
            ?>
        </div>
    </section>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightpick@1.3.4/lightpick.min.js"></script>
    <script src="assets/js/datepicker.js"></script>
</body>

</html>