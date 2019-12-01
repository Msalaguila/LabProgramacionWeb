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
<?php 
    session_start();
    if (isset($_SESSION["user"])) {
        header('Location: paginaPrincipalUsuario.php');
        exit;
    }
    ?>
    
    <nav class="navbar navbar-light navbar-expand-md" id="navbar" href="#">
        <div class="container-fluid"><a class="navbar-brand" id="page_icon" href="inicial.php"></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav mr-auto" id="main_nav">
                    <li class="nav-item" role="presentation"><a class="nav-link nav_item" href="inicial.php">MyWebIoT</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link nav_item" href="canales.php">Canales</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">Ayuda</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link normal" href="contacto.php">Contacto</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="tienda.php">MyIoT Shop</a></li>
                </ul>
                <ul class="nav navbar-nav ml-auto" id="right_nav">
                    <li class="nav-item" role="presentation"><a class="nav-link nav_item"></a></li>
                    <li class="nav-item" role="presentation" style="margin-right: 5px;"><a class="nav-link" href="loginhtml.php">Login</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="registro.php">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="login-clean">
        <form method="POST" action="../laboratorioweb/scripts/register.php">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><img id="form_image" src="assets/img/0ZEt7WEWx1CUeUKrd.png"></div>
            <div class="input-group" id="inputs_formulario">
                <div class="input-group-prepend"><span class="input-group-text">Nombre</span></div><input class="form-control" name="nombre" type="text" required>
                <div class="input-group-append"></div>
            </div>
            <div class="input-group" id="inputs_formulario">
                <div class="input-group-prepend"><span class="input-group-text">Fecha de Nacimiento</span></div><input class="form-control" type="date" id="datePicker" name="datePicker" required>
                <div class="input-group-append"></div>
            </div>
            <div class="input-group" id="inputs_formulario">
                <div class="input-group-prepend"><span class="input-group-text">Email</span></div><input class="form-control" type="text" name="email" inputmode="email" required>
                <div class="input-group-append"></div>
            </div>
            <div class="input-group" id="inputs_formulario">
                <div class="input-group-prepend"><span class="input-group-text">Contraseña</span></div><input class="form-control" type="password" name="password" required>
                <div class="input-group-append"></div>
            </div>
            <div class="input-group" id="inputs_formulario">
                <div class="input-group-prepend"><span class="input-group-text">Repetir Contraseña</span></div><input class="form-control" type="password" name="passwordRepeat" required>
                <div class="input-group-append"></div>
            </div>
            <div class="form-group"><button class="btn btn-primary btn-block" id="register_button_registro" type="submit">Registrar</button></div>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightpick@1.3.4/lightpick.min.js"></script>
    <script src="assets/js/datepicker.js"></script>
</body>

</html>