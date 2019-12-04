<?php

$nameProductID = "nombreProducto";
$priceProductID = "precioProducto";
$descriptionProductID = "descripcion";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST[$nameProductID]) && isset($_POST[$priceProductID]) && isset($_POST[$descriptionProductID])
    ) {

        $name = $_POST[$nameProductID];
        $price = $_POST[$priceProductID];
        $description = $_POST[$descriptionProductID];
        date_default_timezone_set("Europe/London");
        $fechaRegistro = date("Y-m-d H:i:s", $_SERVER["REQUEST_TIME"]);

        function saveInformationToDatabase($name, $price, $description, $fechaRegistro)
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

            $sql = "INSERT INTO productos (nombre, descripcion, precio, fecha)
                VALUES ('$name', '$description', '$price','$fechaRegistro')";

            if (mysqli_query($connection, $sql)) {
                echo "New record created successfully";
                header('Location: ../paginaPrincipalProductos.php');
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connection);
            }

            mysqli_close($connection);
        }

        //saveInformationToDatabase($name, $email, $passwordToSaveDatabase, $fecha);
        saveInformationToDatabase($name, $price, $description, $fechaRegistro);
    } else {
        header('Location: nuevoproducto.html');
        exit;
    }
}
