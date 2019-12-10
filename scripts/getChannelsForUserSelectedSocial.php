<?php

$host = "localhost";
$database = "laboratorioweb";
$user = "root";
$databasePassword = "";

// 1 Stablishing connection to Database
$connection = mysqli_connect($host, $user, $databasePassword, $database);

// 2. Managing errors

if (mysqli_connect_errno()) {
    die(mysqli_connect_error());
}

echo "<h1 class='article1_shop_heading'>Lista de canales</h1>";

$idUsuarioLogeado = $_SESSION["userID"];

$sqlUsuario = "SELECT * FROM canales WHERE id_user = $idUsuarioLogeado";
$nombreUsuario = "";

echo "<h3> Mis canales </h3>";

if ($result1 = mysqli_query($connection, $sqlUsuario)) {
    while ($row1 = mysqli_fetch_array($result1)) {

        $nombreCanal = $row1["nombreCanal"];
        $descripcionCanal = $row1["descripcion"];
        $urlCanal = $row1["url"];
        $idChannel = $row1["id"];

        echo "<p class='parrafo-miembros-social'>
        <b>Nombre de canal:</b> $nombreCanal. 
        <b>Descripcion:</b> $descripcionCanal
        <b>Url canal:</b> <a href=\"./showChannelDescription.php?id=".$idChannel."\" id='paragraph_canales'>  $urlCanal </a>
        </p>";
    }
}

echo "<h3> Canales de mis amigos </h3>";

$sqlAmigos = "SELECT * FROM amigos WHERE id_usuario = $idUsuarioLogeado";

if ($result2 = mysqli_query($connection, $sqlAmigos)) {
    while ($row2 = mysqli_fetch_array($result2)) {

        $idPersona = $row2["id_amigo"];

        $sqlCanalAmigo = "SELECT * FROM canales WHERE id_user = $idPersona";

        if ($result3 = mysqli_query($connection, $sqlCanalAmigo)) {
            while ($row3 = mysqli_fetch_array($result3)) {
                $nombreCanal = $row3["nombreCanal"];
                $descripcionCanal = $row3["descripcion"];
                $idChannel = $row3["id"];
                $urlCanal = $row3["url"];

                $sqlNombreAmigo = "SELECT * FROM users WHERE id = $idPersona";

                if ($result4 = mysqli_query($connection, $sqlNombreAmigo)) {
                    while ($row4 = mysqli_fetch_array($result4)) {
                        $nombreAmigo = $row4["nombre"];
                        
                        echo "<p class='parrafo-miembros-social'>
                        <b>Autor:</b> $nombreAmigo 
                        <b>Nombre de canal:</b> $nombreCanal. 
                        <b>Descripcion:</b> $descripcionCanal
                        <b>Url canal:</b> <a href=\"./showChannelDescription.php?id=".$idChannel."\" id='paragraph_canales'>  $urlCanal </a>
                        </p>
                        ";
                    }
                }
            }
        }
    }
}

mysqli_close($connection);
