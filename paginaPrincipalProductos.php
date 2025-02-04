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
</head>

<body>
    <?php session_start(); ?>
    <nav class="navbar navbar-light navbar-expand-md" id="navbar" href="#">
        <div class="container-fluid"><a class="navbar-brand" id="page_icon" href="inicial.php"></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto" id="main_nav">
                    <li class="nav-item" role="presentation"><a class="nav-link nav_item" href="inicial.php">MyWebIoT</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link nav_item normal" href="canales.php">Canales</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">Ayuda</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link normal" href="contacto.php">Contacto</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="tienda.php">MyIoT Shop</a></li>
                    <!--SI HAY USUARIO LOGEADO PONEMOS OPCIÓN DE MOSTRAR CANALES-->
                    <?php
                    if (isset($_SESSION["user"])) {
                        $nombre = $_SESSION["user"];
                        echo "<li class='nav-item' role='presentation'><a class='nav-link active' href='paginaPrincipalProductos.php'>Productos</a></li>";
                        echo "<li class='nav-item' role='presentation'><a class='nav-link' href='transacciones.php'>Transacciones</a></li>";
                    }
                    echo "<li class='nav-item' role='presentation'><a class='nav-link' href='social.php'>MyIoT Social</a></li>";
                    ?>
                </ul>
                <ul class="nav navbar-nav ml-auto" id="right_nav">
                    <!--SI HAY USUARIO LOGEADO PONEMOS OPCIÓN DE LOGOUT-->
                    <?php
                    if (isset($_SESSION["user"])) {
                        $nombre = $_SESSION["user"];
                        echo "<li class='nav-item' role='presentation'><a class='nav-link' href='#'>$nombre</a></li>";
                        echo "<li class='nav-item' role='presentation'><a class='nav-link' href='../laboratorioweb/scripts/logout.php'>Logout Usuario</a></li>";
                    } else {
                        echo "<li class='nav-item' role='presentation'><a class='nav-link' href='#'>Nombre Usuario</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <section id="section1">
        <div class="container">
            <?php
            // SI EL ADMIN ESTÁ LOGEADO LE PONEMOS EL BOTÓN DE AÑADIR PRODUCTOS
            if (isset($_SESSION["user"])) {
                $nombre = $_SESSION["user"];
                if ($nombre == "admin@gmail.com") {
                    echo "<a class='btn btn-primary' id='principal_button' href='nuevoproducto.php'>Nuevo Producto</a>";
                }
            }
            ?>
            <h1 id="canales_heading">Listado de todos los Productos dados de alta</h1>
            <?php
            if (isset($_SESSION["user"])) {
                $nombre = $_SESSION["user"];
                // SI EL ADMIN ESTÁ LOGEADO MOSTRAMOS LOS PRODUCTOS CON OPCIÓN DE BORRARLOS
                if ($nombre == "admin@gmail.com") {
                    include("../laboratorioweb/scripts/selectAllProductsAdminLogin.php");
                }
            }
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