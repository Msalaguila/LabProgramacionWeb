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

// delete a channel form the 'canales' table
$id = $_GET["id"];
$sql2 = "DELETE FROM ordenes WHERE id='$id'"; // todo: saber referencia para eliminar (preguntar)
$sql3 = "DELETE FROM ordenes_detalle WHERE orden_id='$id'";

// checking if operation succeeded or not
if (mysqli_query($connection, $sql3)) {
    echo "Order detail deleted correctly";
    if (mysqli_query($connection, $sql2)) {
        echo "Order deleted correctly";
        header('Location: ../transacciones.php');
        exit;
    } else {
        echo "Error deleting order: " . mysqli_error($connection);
    }
} else {
    echo "Error deleting order detail: " . mysqli_error($connection);
}

mysqli_close($connection);
?>