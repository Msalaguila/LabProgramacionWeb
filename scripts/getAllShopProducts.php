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

$sql = "SELECT * FROM productos"; 

$nombreProducto = "";
$descripcionProducto = "";
$precioProducto = "";
$fechaProducto = "";
$stockProducto = "";

if ($result = mysqli_query($connection, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
        $nombreProducto = $row["nombre"];
        $descripcionProducto = $row["descripcion"];
        $precioProducto = $row["precio"];
        $fechaProducto = $row["fecha"];
        $idProducto = $row["id"];
        $stockProducto = $row["stock"];

        echo "<div class='card item'>";
        echo "<div class='card-body d-flex flex-column justify-content-center align-items-center'>";
        echo "<h4 class='card-title'>Producto: $nombreProducto</h4>";
        echo "<p class='card-text'>Precio: $precioProducto €</p>";
        echo "<p class='card-text'>Stock: $stockProducto disponibles</p>";
        if ($stockProducto == 0) {
            echo "<a href=\"scripts/addItemToCart.php?id=$idProducto\"><button class='btn btn-primary' type='button' disabled>Añadir al carrito</button></a>";
        } else {
            echo "<a href=\"scripts/addItemToCart.php?id=$idProducto\"><button class='btn btn-primary' type='button'>Añadir al carrito</button></a>";
        }
        echo "</div>";
        echo "</div>";
    }
}

mysqli_close($connection);
