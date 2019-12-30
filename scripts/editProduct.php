<?php
session_start();
$nameProductID = "nombreProducto";
$priceProductID = "precioProducto";
$descriptionProductID = "descripcion";
$stockProductID = "stockProducto";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST[$nameProductID]) && isset($_POST[$priceProductID]) && isset($_POST[$descriptionProductID])
        && isset($_POST[$stockProductID])
    ) {

        $idProducto = $_SESSION["productID"];
        $name = $_POST[$nameProductID];
        $price = $_POST[$priceProductID];
        $description = $_POST[$descriptionProductID];
        $stock = $_POST[$stockProductID];

        function saveInformationToDatabase($idProducto, $name, $price, $description, $stock)
        {

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

            $sql = "UPDATE productos SET nombre = '$name', descripcion = '$description', precio = '$price', stock = '$stock' WHERE id = '$idProducto'";

            if (mysqli_query($connection, $sql)) {
                echo "New record created successfully";
                header('Location: ../paginaPrincipalProductos.php');
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connection);
            }

            mysqli_close($connection);
        }


        saveInformationToDatabase($idProducto, $name, $price, $description, $stock);
    } else {
        header('Location: nuevoproducto.html');
        exit;
    }
}
