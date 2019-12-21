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

if ($currentUserName == "admin@gmail.com") {
    $sqlTransaction = "SELECT * FROM ordenes";
} 

$transaccionID = "";
$clientID = "";
$transaccion = "";
$total = "";
$fecha = "";
$estado = "";

if ($result = mysqli_query($connection, $sqlTransaction)) {
    while ($row = mysqli_fetch_array($result)) {
        $transaccionID = $row["id"];
        $clientID = $row["cliente_id"];
        $transaccion = $row["transaccion"];
        $total = $row["total"];
        $fecha = $row["fecha"];
        $estado = $row["estado"];

        $sqlUser = "SELECT * FROM users WHERE id=$clientID";
        if ($result2 = mysqli_query($connection, $sqlUser)) {
            while ($row2 = mysqli_fetch_array($result2)) {
                $nombreUsuario = $row2["nombre"];
                $email = $row2["email"];
        
                echo"<a href=\"./scripts/deleteTransaction.php?id=".$transaccionID."\" class='btn btn-danger float-right deleteButton'></a>";
                echo "<article class='canales_article'>";
                echo "<p id='paragraph_canales'>ID del cliente que realizó la transacción: $clientID</p>";
                echo "<p id='paragraph_canales'>Nombre del cliente que realizó la transacción: $nombreUsuario</p>";
                echo "<p id='paragraph_canales'>Email del cliente que realizó la transacción: $email</p>";
                echo "<p id='paragraph_canales'>ID transacción: $transaccion</p>";
                echo "<p id='paragraph_canales'>Fecha de transacción: $fecha</p>";
                echo "<p id='paragraph_canales'>Total ingresado: $total €</p>";
                echo "<p id='paragraph_canales'>Estado transacción: $estado </p>";
                echo"<a href=\"./showTransactionDetails.php?id=".$transaccionID."&transactionID=$transaccion\"><p id='paragraph_canales'>Más información acerca de esta transacción</p></a>";
                echo "</article>";
            }
        }
    }
}

mysqli_close($connection);
