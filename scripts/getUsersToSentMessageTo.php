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

// 4. Checking if the table is created

$idUsuarioLogeado = $_SESSION["userID"];

$sqlAmigos = "SELECT * FROM amigos WHERE id_usuario = $idUsuarioLogeado";

if ($result2 = mysqli_query($connection, $sqlAmigos)) {
    while ($row2 = mysqli_fetch_array($result2)) {

        $idPersona = $row2["id_amigo"];

        $sqlNombreAmigo = "SELECT * FROM users WHERE id = $idPersona";

        if ($result4 = mysqli_query($connection, $sqlNombreAmigo)) {
            while ($row4 = mysqli_fetch_array($result4)) {
                $nombreAmigo = $row4["nombre"];
                $idPersona = $row4["id"];

                echo "<option value='$idPersona'>Nombre: $nombreAmigo</option>";
            }
        }
    }
}

mysqli_close($connection);
