<?php
        
        $emailIDInput = "email";
        $passwordIDInput = "passwd";

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST[$emailIDInput]) && isset($_POST[$passwordIDInput])) 
            {
                $email = $_POST[$emailIDInput];
                $password = $_POST[$passwordIDInput];

                function getInformationFromDatabase($email, $password) {

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

                $sql = "SELECT email, passwd FROM users WHERE email='$email' AND passwd='$password'";

                $result = mysqli_query($connection, $sql);
                if ($result) {
                    while($row = mysqli_fetch_array($result)) {
                            if ($row["passwd"==$password] && $row["email"==$email]) {
                                // Credentials are ok
                                $usernameEmail = $row["email"];
                                $pass = $row["passwd"];
                                echo "Hello: $usernameEmail"." $pass";
                                header('Location: nuevoCanal.html');
                                exit;
                            }
                    }
                }
                    
                $connection->close();
                header('Location: login.html');
                exit;

                mysqli_free_result($result);

                mysqli_close($connection);
                }
                
                //saveInformationToDatabase($name, $email, $passwordToSaveDatabase, $fecha);
                getInformationFromDatabase($email, $password);
            }
        }
    ?>