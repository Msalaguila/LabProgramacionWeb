<?php

function getInformationFromDatabase()
{

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

    $sqlCanales = "SELECT * FROM canales";

    $nombre = "";
    $estado = "";

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

getInformationFromDatabase();
