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

$sqlUser = "SELECT * FROM sugerencias";
$numerosugerencias = 0;
if ($result = mysqli_query($connection, $sqlUser)) {
    $numerosugerencias = mysqli_num_rows($result);
}

echo "<p>Numero de sugerencias totales: $numerosugerencias&nbsp;</p>";

mysqli_close($connection);