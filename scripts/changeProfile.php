<?php
session_start();
$nameIDInput = "nombreUsuario";
$estadoIDInput = "estadoUsuario";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST[$nameIDInput]) && isset($_POST[$estadoIDInput])
    ) {

        $name = $_POST[$nameIDInput];
        $estado = $_POST[$estadoIDInput];

        function saveInformationToDatabase($name, $estado)
        {

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

            $sqlUser = "SELECT * FROM users WHERE email='" . $_SESSION["user"] . "'";
            $userID = 0;
            if ($result = mysqli_query($connection, $sqlUser)) {
                if ($row = mysqli_fetch_assoc($result)) {
                    $userID = $row["id"];
                }
            }


            $sql = "UPDATE users SET nombre = '$name', estadoSocial = '$estado' WHERE id = '$userID'";

            if (mysqli_query($connection, $sql)) {
                echo "New record created successfully";
                header('Location: ../social.php');
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connection);
            }

            mysqli_close($connection);
        }

        //saveInformationToDatabase($name, $email, $passwordToSaveDatabase, $fecha);
        saveInformationToDatabase($name, $estado);
    }
}
?>