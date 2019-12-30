<?php

/**
 * Verify transaction is authentic
 *
 * @param array $data Post data from Paypal
 * @return bool True if the transaction is verified by PayPal
 * @throws Exception
 */
function verifyTransaction($data)
{
    global $paypalUrl;

    $req = 'cmd=_notify-validate';
    foreach ($data as $key => $value) {
        $value = urlencode(stripslashes($value));
        $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value); // IPN fix
        $req .= "&$key=$value";
    }

    $ch = curl_init($paypalUrl);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    curl_setopt($ch, CURLOPT_SSLVERSION, 6);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
    $res = curl_exec($ch);

    if (!$res) {
        $errno = curl_errno($ch);
        $errstr = curl_error($ch);
        curl_close($ch);
        throw new Exception("cURL error: [$errno] $errstr");
    }

    $info = curl_getinfo($ch);

    // Check the http response
    $httpCode = $info['http_code'];
    if ($httpCode != 200) {
        throw new Exception("PayPal responded with http code $httpCode");
    }

    curl_close($ch);

    return $res === 'VERIFIED';
}

/**
 * Check we've not already processed a transaction
 *
 * @param string $txnid Transaction ID
 * @return bool True if the transaction ID has not been seen before, false if already processed
 */
function checkTxnid($txnid)
{
    global $db;

    $txnid = $db->real_escape_string($txnid);
    $results = $db->query('SELECT * FROM `payments` WHERE txnid = \'' . $txnid . '\'');

    return !$results->num_rows;
}

/**
 * Add payment to database
 *
 * @param array $data Payment data
 * @return int|bool ID of new payment or false if failed
 */
function addPayment($data)
{
    global $db;

    if (is_array($data)) {
        $stmt = $db->prepare('INSERT INTO `payments` (txnid, payment_amount, payment_status, itemid, createdtime) VALUES(?, ?, ?, ?, ?)');
        $stmt->bind_param(
            'sdsss',
            $data['txn_id'],
            $data['payment_amount'],
            $data['payment_status'],
            $data['item_number'],
            date('Y-m-d H:i:s')
        );
        $stmt->execute();
        $stmt->close();

        return $db->insert_id;
    }

    return false;
}

function addPaymentToDatabse($data)
{
    decreaseProductStock($data);
    insertPaymentToOrdersTable($data);
}

function decreaseProductStock($data)
{
    $host = "localhost";
    $database = "laboratorioweb";
    $user = "root";
    $databasePassword = "";

    $connection = mysqli_connect($host, $user, $databasePassword, $database);

    foreach ($_SESSION['carrito'] as $key => $valor) {
        $idProducto = $key;
        $cantidadProducto = $valor;

        $sql = "SELECT * FROM productos WHERE id = $idProducto";
        if ($result = mysqli_query($connection, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $stockProducto = $row["stock"];
                $stockFinal = 0;
                if ($stockProducto == 0) {
                    $stockFinal = 0;
                } else {
                    $stockFinal = $stockProducto - 1;
                }

                $sql2 = "UPDATE productos SET stock = $stockFinal WHERE id = $idProducto";
                mysqli_query($connection, $sql2);
            }
        }
    }

    mysqli_close($connection);
}

function insertPaymentToOrdersTable($data)
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

    $idCliente = $data["userID"];
    $transaccion = $data["tx"];
    $total = $data["amt"];
    $fecha = $data["fecha"];
    $estado = $data["st"];

    $sql = "INSERT INTO ordenes (cliente_id, transaccion, total, fecha, estado)
                VALUES ('$idCliente', '$transaccion', '$total', '$fecha', '$estado')";

    if (mysqli_query($connection, $sql)) {
        echo "New record created successfully";

        $sql = "SELECT * FROM ordenes WHERE transaccion='$transaccion'";

        $idOrden = "";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            while ($row = mysqli_fetch_array($result)) {
                $idOrden = $row["id"];
            }
        }

        insertPaymentToOrdersDetailsTable($data, $idOrden);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
    mysqli_close($connection);
}

function insertPaymentToOrdersDetailsTable($data, $idOrden)
{
    $host = "localhost";
    $database = "laboratorioweb";
    $user = "root";
    $databasePassword = "";

    $connection = mysqli_connect($host, $user, $databasePassword, $database);

    foreach ($_SESSION['carrito'] as $key => $valor) {
        $idProducto = $key;
        $cantidadProducto = $valor;

        $sql = "INSERT INTO ordenes_detalle (orden_id, producto_id, cantidad)
                VALUES ('$idOrden', '$idProducto', '$cantidadProducto')";

        if (mysqli_query($connection, $sql)) {

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
        }
    }

    mysqli_close($connection);

    unset($_SESSION["carrito"]);

    $_SESSION["compraExitosa"] = 1;

    header('Location: ../tienda.php');
    exit;
}