<?php

// initializing database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laboratorioweb";

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // getting channels from 'canales' table
    $sql = "SELECT * FROM canales ORDER BY fechaRegistro DESC LIMIT 2"; // ORDER BY fecha DESC LIMIT 1

    // checking if operation succeeded or not
    if ($result = mysqli_query($conn, $sql)) {
        $index = 0;
        echo '<script type="text/javascript"> window.onload = function () {';
        while ($row = mysqli_fetch_array($result)) {
            $index += 1;
            $id = $row['id'];
            $nombreCanal = $row['nombreCanal'];
            $url = $row['url'];

            // getting channels data
            $sql2 = 'SELECT * FROM datossensores WHERE id_canal="' . $id . '"'; // 

            if ($result2 = mysqli_query($conn, $sql2)) {
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $dato = $row2['dato'];
                    $fecha = new DateTime($row2['fecha'], new DateTimeZone('Europe/London'));

                    $dataPoints[] = array("x" => $fecha->getTimestamp() * 1000, "y" => intval($dato));
                }

                echo 'var chart' . strval($index) . ' = new CanvasJS.Chart("chartContainer' . strval($index) . '", {
                            animationEnabled: true,
                            title:{
                                text: "Canal: ' . $nombreCanal . '"
                            },
                            subtitles:[{
                                text: "URL:  '.$url.'",
                                fontColor: "blue"
                            }]
                            ,
                            axisY: {
                                title: "Dato",
                            },
                            data: [{
                                type: "spline",
                                markerSize: 5,
                                xValueFormatString: "H:mm:s",
                                yValueFormatString: "#,##0.##",
                                xValueType: "dateTime",
                                dataPoints: ';
                echo json_encode($dataPoints, JSON_NUMERIC_CHECK);

                if (!empty($dataPoints)) {
                    echo '}]
                        });

                        chart' . strval($index) . '.render();';
                        unset($dataPoints);
                } else {
                    echo '}]
                        })';
                }
            } else {
                echo "Error selecting channels's data: " . mysqli_error($conn);
            }
        }
        echo '}</script>';
    } else {
        echo "Error selecting user's channel: " . mysqli_error($conn);
    }
    // finally closing connection
    $conn->close();
}