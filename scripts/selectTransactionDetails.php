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

$transactionID = "";

if (isset($_GET["id"])) {
    $transactionID = $_GET["id"];
}

$currentUserID = $_SESSION["userID"];
$currentUserName = $_SESSION["user"];

if ($currentUserName == "admin@gmail.com") {
    $sqlUser = "SELECT * FROM ordenes_detalle WHERE orden_id=$transactionID";
} 

$ordenID = "";
$productoID = "";
$cantidad = "";

if ($result = mysqli_query($connection, $sqlUser)) {
    while ($row = mysqli_fetch_array($result)) {
        $ordenID = $row["orden_id"];
        $productoID = $row["producto_id"];
        $cantidad = $row["cantidad"];

        $sqlProducto = "SELECT * FROM productos WHERE id=$productoID";
        if ($result2 = mysqli_query($connection, $sqlProducto)) {
            while ($row2 = mysqli_fetch_array($result2)) {
                $nombreProducto = $row2["nombre"];
                $precioProducto = $row2["precio"];
        
                echo "<article class='canales_article'>";
                echo "<p id='paragraph_canales'>ID orden: $ordenID</p>";
                echo "<p id='paragraph_canales'>ID producto: $productoID</p>";
                echo "<p id='paragraph_canales'>Nombre producto: $nombreProducto</p>";
                echo "<p id='paragraph_canales'>Precio unitario: $precioProducto €</p>";
                echo "<p id='paragraph_canales'>Cantidad comprada: $cantidad</p>";
                echo "</article>";
            }
        }
    }
}

mysqli_close($connection);
