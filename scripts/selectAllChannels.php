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

    $nombreCanal = "";
    $descripcionCanal = "";
    $fechaCanal = "";
    $urlCanal = "";
    $idUser = 0;

    if ($result = mysqli_query($connection, $sqlCanales)) {
        while ($row = mysqli_fetch_array($result)) {
            $nombreCanal = $row["nombreCanal"];
            $descripcionCanal = $row["descripcion"];
            $fechaCanal = $row["fechaRegistro"];
            $urlCanal = $row["url"];
            $idUser = $row["id_user"];


            $sqlUser = "SELECT * FROM users WHERE id='$idUser'";
            $userName = 0;
            if ($result2 = mysqli_query($connection, $sqlUser)) {
                if ($row2 = mysqli_fetch_assoc($result2)) {
                    $userName = $row2["nombre"];
                }
            }

            echo "<article class='canales_article'>";
            echo "<p id='paragraph_canales'>Información sobre el Canal: $nombreCanal</p>";
            echo "<p id='paragraph_canales'>Autor: $userName&nbsp;</p>";
            echo "<p id='paragraph_canales'>Descripción: $descripcionCanal</p>";
            echo "<p id='paragraph_canales'>Fecha: $fechaCanal</p>";
            echo "<p id='paragraph_canales'>Enlace URL: $urlCanal</p>";
            echo "</article>";
        }
    }

    mysqli_close($connection);
}

getInformationFromDatabase();
