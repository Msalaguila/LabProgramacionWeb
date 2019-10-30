<?php

function saveInformationToDatabase($url, $dato) {

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
    
    // 4. Checking if the table is created

    $sqlUser = "SELECT * FROM canales WHERE url = '" . $url . "'"; 
     
    $idToStore = 0;
    if ($result = mysqli_query($connection, $sqlUser)) {
        if ($row = mysqli_fetch_assoc($result)) {
            $idToStore = $row["id"];
        }
    }
    
    $sql = "INSERT INTO datossensores (id_canal, dato, fecha)
    VALUES ('$idToStore', '$dato', '$fechaToStore')";

    if (mysqli_query($connection, $sql)) {
        echo "New record created successfully";
        header('Location: nuevoCanal.php');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }

    mysqli_close($connection);
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["url"]) && isset($_POST["dato"])) 
        {
            $urlToStore = $_POST["url"];
            $datoToStore = $_POST["dato"];
            saveInformationToDatabase($urlToStore, $datoToStore);
        }
    }
?>