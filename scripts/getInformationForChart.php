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

$sqlUser = "SELECT * FROM datossensores";

$url = "";
$id = "";
$dato = "";
$fecha = "";

if ($result = mysqli_query($connection, $sqlUser)) {
    while ($row = mysqli_fetch_array($result)) {
        $dato = $row["dato"];
        $fecha = $row["fecha"];

        echo "['$dato',  $dato],";
    }
}

mysqli_close($connection);
