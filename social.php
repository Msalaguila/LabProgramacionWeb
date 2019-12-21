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
    <link rel="stylesheet" href="assets/css/Profile-Card.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <?php session_start(); ?>
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md" id="navbar" href="#">
        <div class="container-fluid"><a class="navbar-brand" id="page_icon" href="inicial.php"></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto" id="main_nav">
                    <li class="nav-item" role="presentation"><a class="nav-link nav_item" href="inicial.php">MyWebIoT</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link nav_item" href="canales.php">Canales</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">Ayuda</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="contacto.php">Contacto</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="tienda.php">MyIoT Shop</a></li>
                    <?php
                    if (isset($_SESSION["user"])) {
                        $nombre = $_SESSION["user"];
                        // ADMIN LOGEADO
                        if ($nombre == "admin@gmail.com") {
                            echo "<li class='nav-item' role='presentation'><a class='nav-link' href='paginaPrincipalProductos.php'>Productos</a></li>";
                            echo "<li class='nav-item' role='presentation'><a class='nav-link' href='transacciones.php'>Transacciones</a></li>";
                        }
                        echo "<li class='nav-item' role='presentation'><a class='nav-link active normal' href='social.php'>MyIoT Social</a></li>";
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
            <div class="row">
                <div class="col article1_shop">
                    <article class="text-break article1_shop">
                        <h1 class="article1_shop_heading">Bienvenidos a la red social de MyWebIoT</h1>
                        <p style="padding: 2px;">ParagraphParagraphParagraphParagraphParagraphParagraphParagraphParagraphParagraphParagraphParagraphParagraphParagraphParagraph</p>
                    </article>
                </div>
            </div>
            <div class="row d-flex flex-row justify-content-around" style="margin-top: 20px;">
                <div class="col-9 d-flex flex-column justify-content-center align-items-center article1_shop" style="margin-right: 10px;">
                    <?php include('./scripts/updateUserProfile.php'); ?>
                </div>
                <div class="col d-flex flex-column article1_shop">
                    <h3 class="text-center" style="margin-top: 10px;">Opciones</h3>
                    <div class="row">
                        <div class="col d-flex flex-column justify-content-center align-items-center">
                            <a href="amigos.php"> <button class="btn btn-primary opciones-perfil" type="button">Amigos</button> </a>
                            <a href="miembros.php"> <button class="btn btn-primary opciones-perfil" type="button">Miembros</button> </a>
                            <a href="mensajes.php"> <button class="btn btn-primary opciones-perfil-naranja" type="button">Mensajes</button> </a>
                            <a href="canalessocial.php"><button class="btn btn-primary opciones-perfil-naranja" type="button">Canales</button> </a>
                            <a href="perfil.php"> <button class="btn btn-primary opciones-perfil-naranja" type="button">Perfil</button> </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col article1_shop">
                    <article class="text-break article1_shop">
                        <h3 style="margin-left: 10px;">Últimos mensajes públicos</h3>
                        <p id="lastMessages" class='parrafo-miembros-social'> </p>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <!-- CONSEGUIMOS POR AJAX LOS ÚLTIMOS 5 MENSAJES DE LA RED SOCIAL-->
    <script>
        function get_lastMessages() {
            $("#lastMessages").load("./scripts/getLastMessagesSocial.php");
            setTimeout(get_lastMessages, 1000);
        };
    </script>
    <script>
        setTimeout(get_lastMessages, 1000);
    </script>


    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightpick@1.3.4/lightpick.min.js"></script>
    <script src="assets/js/datepicker.js"></script>
</body>

</html>