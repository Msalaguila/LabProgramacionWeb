<?php

$nameIDInput = "nombre";
$fechaNacimientoIDInput = "datePicker";
$emailIDInput = "email";
$passwordIDInput = "password";
$passwordRepeatIDInput = "passwordRepeat";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST[$nameIDInput]) && isset($_POST[$fechaNacimientoIDInput]) && isset($_POST[$emailIDInput])
        && isset($_POST[$passwordIDInput]) && isset($_POST[$passwordRepeatIDInput]) && ($_POST[$passwordRepeatIDInput] == $_POST[$passwordIDInput])
    ) {

        $name = $_POST[$nameIDInput];
        $email = $_POST[$emailIDInput];
        $password = $_POST[$passwordIDInput];
        date_default_timezone_set("Europe/London");
        $fechaRegistro = date("Y-m-d H:i:s", $_SERVER["REQUEST_TIME"]);
        $fechaNacimiento = $_POST[$fechaNacimientoIDInput];

        function saveInformationToDatabase($name, $email, $passwordToSaveDatabase, $fechaNacimiento, $fechaRegistro)
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

            $sql = "INSERT INTO users (nombre, email, passwd, fechaNacimiento, fecha)
                VALUES ('$name', '$email', '$passwordToSaveDatabase', '$fechaNacimiento', '$fechaRegistro')";

            if (mysqli_query($connection, $sql)) {
                echo "New record created successfully";
                header('Location: ../loginhtml.php');
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connection);
            }

            mysqli_close($connection);
        }

        //saveInformationToDatabase($name, $email, $passwordToSaveDatabase, $fecha);
        saveInformationToDatabase($name, $email, $password, $fechaNacimiento, $fechaRegistro);
    } else {
        header('Location: registro.html');
        exit;
    }
}
