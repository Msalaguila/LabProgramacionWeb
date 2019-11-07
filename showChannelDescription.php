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
    <?php include("../laboratorioweb/scripts/showChannel.php") ?>
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
    <section>
            <article id="articleShowChannelDescription">
                <h1 class="text-left card_header">Descripción canal</h1>
                <figure class="figure figure" id="chartContainer0" style="width: 100%; height: 500px"></figure>
            </article>
    </section>

</body>

</html>