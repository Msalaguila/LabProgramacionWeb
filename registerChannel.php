<?php
        session_start();
        $nameIDInput = "nombreCanal";
        $longitudIDInput = "longitud";
        $latitudIDInput = "latitud";
        $nombreSensorIDInput = "nombreSensor";
        $descripcionIDInput = "descripcion";

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST[$nameIDInput]) && isset($_POST[$longitudIDInput]) && isset($_POST[$latitudIDInput]) 
            && isset($_POST[$nombreSensorIDInput]) && isset($_POST[$descripcionIDInput])) 
            {
                
                $name = $_POST[$nameIDInput];
                $longitud = $_POST[$longitudIDInput];
                $latitud = $_POST[$latitudIDInput];
                $nombreSensor = $_POST[$nombreSensorIDInput];
                $descripcion = $_POST[$descripcionIDInput];
                $url = rand();

                function saveInformationToDatabase($url, $name, $descripcion, $longitud, $latitud, $nombreSensor) {

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
                
                $sql = "INSERT INTO canales (url, id_user, nombreCanal, descripcion, longitud, latitud, nombreSensor, fechaRegistro)
                VALUES ('$url', '$userID', '$name', '$descripcion', '$longitud', '$latitud', '$nombreSensor', '$fechaCanal')";

                if (mysqli_query($connection, $sql)) {
                    echo "New record created successfully";
                    header('Location: nuevoCanal.php');
                    exit;
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
                }

                mysqli_close($connection);
                }
                
                //saveInformationToDatabase($name, $email, $passwordToSaveDatabase, $fecha);
                saveInformationToDatabase($url, $name, $descripcion, $longitud, $latitud, $nombreSensor);
            }

        }
?>