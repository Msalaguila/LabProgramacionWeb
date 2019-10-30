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
                
                // 4. Checking if the table is created
            
                $sqlUser = "SELECT * FROM canales"; 
                 
                $nombreCanal = "";
                $descripcionCanal = "";
                $fechaCanal = "";
                $urlCanal = "";
            
                if ($result = mysqli_query($connection, $sqlUser)) {
                    while ($row = mysqli_fetch_array($result)) {
                        $nombreCanal = $row["nombreCanal"];
                        $descripcionCanal = $row["descripcion"];
                        $fechaCanal = $row["fechaRegistro"];
                        $urlCanal = $row["url"];

                        echo "<button class='btn btn-danger float-right deleteButton' type='button'></button>";
                        echo "<article class='canales_article'>";
                        echo "<p id='paragraph_canales'>Información sobre el Canal: $nombreCanal</p>";
                        echo "<p id='paragraph_canales'>Autor: &nbsp;</p>";
                        echo "<p id='paragraph_canales'>Descripción: $descripcionCanal</p>";
                        echo "<p id='paragraph_canales'>Fecha: $fechaCanal</p>";
                        echo "<p id='paragraph_canales'>Enlace URL: $urlCanal</p>";
                        echo "</article>";
                    }
                }
            
                mysqli_close($connection);
            ?>