<?php

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

$sql = 'SHOW TABLE STATUS';

if ($result = mysqli_query($connection, $sql)) {
    $dbSize = 0;

    while ($row = mysqli_fetch_array($result)) {
        $dbSize += $row["Data_length"] + $row["Index_length"];
    }

    // from bytes to kilobytes
    $dbSizeK = $dbSize / 1024;
}
echo "<p>Bytes/MB almacenados: $dbSizeK KB</p>";

mysqli_close($connection);
