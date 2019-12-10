<?php

$host = "localhost";
$database = "laboratorioweb";
$user = "root";
$databasePassword = "";

$fechaToStore = date("Y-m-d H:i:s");

$connection = mysqli_connect($host, $user, $databasePassword, $database);

// 2. Managing errors

if (mysqli_connect_errno()) {
    die(mysqli_connect_error());
}

// 3. Cogemos ID usuario logeado

$idUsuarioLogeado = $_SESSION["userID"];

$nombreUsuario = "";
$idUsuario = "";

// 4. Mostramos usuarios que sigue el usuario

echo "<h4> Usuarios que sigo </h4>";

$sqlUsuariosSeguidos = "SELECT * FROM amigos WHERE id_usuario = '$idUsuarioLogeado'";

if ($result = mysqli_query($connection, $sqlUsuariosSeguidos)) {
    while ($row = mysqli_fetch_array($result)) {
        $idUsuarioSeguido = $row["id_amigo"];

        $sqlUsuarioAmigo = "SELECT * FROM users WHERE id = '$idUsuarioSeguido'";

        if ($result2 = mysqli_query($connection, $sqlUsuarioAmigo)) {
            while ($row2 = mysqli_fetch_array($result2)) {
                $nombreUsuario = $row2["nombre"];
                $correoUsuario = $row2["email"];
                $idAmigo = $row2["id"];

                echo "<p class='parrafo-miembros-social'>
                <b> Nombre: </b> $nombreUsuario --- 
                <b> Correo Electrónico: <a href=\"./social.php?idUsuario=".$idAmigo."\" id='paragraph_canales'>  $correoUsuario </a></b> 
                </p>";        
            }
        }
    }
}

// 5. Usuarios que me siguen

echo "<h4> Usuarios que me siguen </h4>";

$sqlUsuariosQueMeSiguen = "SELECT * FROM amigos WHERE id_amigo = '$idUsuarioLogeado'";

if ($result = mysqli_query($connection, $sqlUsuariosQueMeSiguen)) {
    while ($row = mysqli_fetch_array($result)) {
        $idUsuarioSeguido = $row["id_usuario"];

        $sqlUsuarioAmigo = "SELECT * FROM users WHERE id = '$idUsuarioSeguido'";

        if ($result2 = mysqli_query($connection, $sqlUsuarioAmigo)) {
            while ($row2 = mysqli_fetch_array($result2)) {
                $nombreUsuario = $row2["nombre"];
                $correoUsuario = $row2["email"];

                echo "<p class='parrafo-miembros-social'><b> Nombre: </b> $nombreUsuario <b> --- Correo Electrónico: </b> $correoUsuario</p>";        
            }
        }
    }
}

mysqli_close($connection);
