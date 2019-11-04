<?php
$nameIDInput = "nombreCanal";
$longitudIDInput = "longitud";
$latitudIDInput = "latitud";
$nombreSensorIDInput = "nombreSensor";
$descripcionIDInput = "descripcion";


$host = "localhost";
$database = "laboratorioweb";
$user = "root";
$databasePassword = "";

// 1 Stablishing connection to Database
$connection = mysqli_connect($host, $user, $databasePassword, $database);

$fechaCanal = date("Y-m-d H:i:s");

// 2. Managing errors

if (mysqli_connect_errno()) {
    die(mysqli_connect_error());
}

// 4. Checking if the table is created

$sqlUser = "SELECT * FROM users";
$numero_usuarios = 0;
if ($result = mysqli_query($connection, $sqlUser)) {
    $numero_usuarios = mysqli_num_rows($result);
}

echo "Numero de registros de usuarios: $numero_usuarios";

mysqli_close($connection);