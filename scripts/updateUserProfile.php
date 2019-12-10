<?php

$host = "localhost";
$database = "laboratorioweb";
$user = "root";
$databasePassword = "";

$fechaToStore = date("Y-m-d H:i:s");

$connection = mysqli_connect($host, $user, $databasePassword, $database);

if (mysqli_connect_errno()) {
    die(mysqli_connect_error());
}

// Si el usuario es el logeado
if (!isset($_GET["idUsuario"])) {
    $nombre = "";
    $estado = "";

    echo "<h3 style='margin-top: 10px;'>Mi perfil</h3><img class='rounded-circle' src='assets/img/avatar-dhg.png'>";

    $sqlUser = "SELECT * FROM users WHERE email='" . $_SESSION["user"] . "'";
    $userID = 0;
    if ($result = mysqli_query($connection, $sqlUser)) {
        if ($row = mysqli_fetch_assoc($result)) {
            $userID = $row["id"];

            $estado = $row["estadoSocial"];
            $nombre = $row["nombre"];

            echo "<p class='text-center paragraph-profile'>Nombre: $nombre </p>";
            echo "<p class='text-center paragraph-profile'>Estado: $estado </p>";
        }
    }

    mysqli_close($connection);
}

// Si un usuario ha sido seleccionado
else {

    $idUsuarioSeleccionado = $_GET["idUsuario"];

    $nombre = "";
    $estado = "";

    $sqlUser = "SELECT * FROM users WHERE id = $idUsuarioSeleccionado";
    if ($result = mysqli_query($connection, $sqlUser)) {
        if ($row = mysqli_fetch_assoc($result)) {
            $estado = $row["estadoSocial"];
            $nombre = $row["nombre"];

            echo "<h3 style='margin-top: 10px;'>Perfil de: $nombre</h3><img class='rounded-circle' src='assets/img/avatar-dhg.png'>";

            echo "<p class='text-center paragraph-profile'>Nombre: $nombre </p>";
            echo "<p class='text-center paragraph-profile'>Estado: $estado </p>";
        }
    }

    mysqli_close($connection);

}
