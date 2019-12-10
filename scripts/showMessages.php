<?php

$host = "localhost";
$database = "laboratorioweb";
$user = "root";
$databasePassword = "";

$fechaToStore = date("Y-m-d H:i:s");

// 1 Stablishing connection to Database
$connection = mysqli_connect($host, $user, $databasePassword, $database);

// 2. Managing errors

if (mysqli_connect_errno()) {
    die(mysqli_connect_error());
}

// 4. Checking if the table is created

$idUsuarioLogeado = $_SESSION["userID"];

$sqlUsuarioLogeado = "SELECT * FROM users WHERE id = $idUsuarioLogeado";

$nombreEmisor = "";

if ($result1 = mysqli_query($connection, $sqlUsuarioLogeado)) {
    if ($row1 = mysqli_fetch_assoc($result1)) {
        $nombreEmisor = $row1["nombre"];
        $emailReceptor = $row1["email"];
    }
}


// MOSTRAMOS MENSAJES ENVIADOS

$sqlMensajes = "SELECT * FROM mensajes WHERE sender = $idUsuarioLogeado";

echo "<h3 class='parrafo-miembros-social'> Mensajes enviados </h3>";

if ($result = mysqli_query($connection, $sqlMensajes)) {
    while ($row = mysqli_fetch_array($result)) {
        $senderID = $idUsuarioLogeado;
        $receiverID = $row["receiver"];
        $privado = $row["privado"];
        $fechaMensaje = $row["fecha"];
        $mensaje = $row["mensaje"];

        $sqlUser = "SELECT * FROM users WHERE id='$receiverID'";

        if ($result2 = mysqli_query($connection, $sqlUser)) {
            if ($row2 = mysqli_fetch_assoc($result2)) {
                $nombreReceptor = $row2["nombre"];
                $emailReceptor = $row2["email"];

                echo "<p class='parrafo-miembros-social'>
                <b>Mensaje:</b> $mensaje. 
                <b>Receptor:</b> $nombreReceptor.
                <b>Emisor:</b> $nombreEmisor.
                <b>Fecha:</b> $fechaMensaje.
                </p>";

            }
        }
    }
}

// MOSTRAMOS MENSAJES RECIBIDOS

echo "<h3 class='parrafo-miembros-social'> Mensajes recibidos </h3>";

mysqli_close($connection);
