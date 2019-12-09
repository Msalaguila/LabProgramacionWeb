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

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightpick@1.3.4/lightpick.min.js"></script>
    <script src="assets/js/datepicker.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <?php session_start(); ?>
    <?php include("../laboratorioweb/scripts/getInformationForChart.php") ?>
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md" id="navbar" href="#">
        <div class="container-fluid"><a class="navbar-brand" id="page_icon" href="inicial.php"></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto" id="main_nav">
                    <li class="nav-item" role="presentation"><a class="nav-link active nav_item" href="inicial.php">MyWebIoT</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link nav_item" href="canales.php">Canales</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">Ayuda</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link normal" href="contacto.php">Contacto</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link normal" href="tienda.php">MyIoT Shop</a></li> 
                    <?php 
                        if (isset($_SESSION["user"])) {
                            $nombre = $_SESSION["user"];
                            // ADMIN LOGEADO
                            if ($nombre == "admin@gmail.com") {
                                echo "<li class='nav-item' role='presentation'><a class='nav-link' href='paginaPrincipalProductos.php'>Productos</a></li>";
                            } 
                            echo "<li class='nav-item' role='presentation'><a class='nav-link' href='social.php'>MyIoT Social</a></li>";
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

    <section class="main_section">
        <div class="container-fluid main_container">
            <div class="row first_row">
                <div class="col-10 col-sm-9 col-md-9 col-lg-10 col-xl-10 text-center" id="left_column">
                    <article id="first_colum">
                        <h1 class="text-left card_header">MyWebIoT</h1>
                        <h3>BIENVENIDO A MI WEB DE IOT</h3>
                        <a class="btn btn-primary" id="article1_button" role="button" href="registro.php">Empieza YA</a>
                    </article>
                    <article id="first_colum">
                        <h1 class="text-left card_header">Últimos canales</h1>
                        <figure class="figure figure" id="chartContainer1" style="width: 800px; height: 400px"></figure>
                        <figure class="figure figure" id="chartContainer2" style="width: 800px; height: 400px"></figure>
                    </article>
                </div>

                <div class="col" id="second_column">
                    <article id="right_article">
                        <p>Información actualizada de los datos almacenados en la BBDD (al menos los siguientes):</p>
                        <p id="numerousuarios">Número de usuarios: </p>
                        <p id="numerocanales">Canales: </p>
                        <p id="databasesize">Bytes/MB almacenados: </p>
                        <p id="numerosugerencias">Numero de sugerencias totales: </p>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <!-- UPDATE CHANNELS AND USERS INFO WITH AJAX-->

    <script>
        function get_channels() {
            $("#numerocanales").load("../laboratorioweb/scripts/getTotalNumberOfChannels.php");
            setTimeout(get_channels, 100);
        };

        function get_users() {
            $("#numerousuarios").load("../laboratorioweb/scripts/getTotalNumberOfUsersAjax.php");
            setTimeout(get_users, 100);
        };

        function get_databaseSize() {
            $("#databasesize").load("../laboratorioweb/scripts/getDatabaseSize.php");
            setTimeout(get_databaseSize, 100);
        };

        // CONSEGUIMOS EL NUMERO TOTAL DE SUGERENCIAS CADA 10S

        function get_sugerencias() {
            $("#numerosugerencias").load("../laboratorioweb/scripts/getTotalNumberOfSugerencias.php");
            setTimeout(get_sugerencias, 10000);
        };
    </script>

    <script>
        setTimeout(get_users, 100);
    </script>
    <script>
        setTimeout(get_channels, 100);
    </script>
    <script>
        setTimeout(get_databaseSize, 100);
    </script>
    <script>
        setTimeout(get_sugerencias, 100);
    </script>

</body>

</html>