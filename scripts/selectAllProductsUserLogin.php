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

$currentUserID = $_SESSION["userID"];
$currentUserName = $_SESSION["user"];


$sqlUser = "SELECT * FROM productos";


$nombreProducto = "";
$descripcionProducto = "";
$precioProducto = "";
$fechaProducto = "";

if ($result = mysqli_query($connection, $sqlUser)) {
    while ($row = mysqli_fetch_array($result)) {
        $nombreProducto = $row["nombre"];
        $descripcionProducto = $row["descripcion"];
        $precioProducto = $row["precio"];
        $fechaProducto = $row["fecha"];
        $idProducto = $row["id"];

        echo "<article class='canales_article'>";
        echo "<p id='paragraph_canales'>Nombre del producto: $nombreProducto</p>";
        echo "<p id='paragraph_canales'>Descripción: $descripcionProducto</p>";
        echo "<p id='paragraph_canales'>Fecha de creación: $precioProducto</p>";
        echo "<p id='paragraph_canales'>Precio: $precioProducto €</p>";
        echo "</article>";
    }
}

mysqli_close($connection);
