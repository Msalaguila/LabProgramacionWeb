<?php
session_start();

// ANTES DE NADA COMPROBAMOS QUE EXISTA UN USUARIO LOGEADO

if (!isset($_SESSION["user"])) {
	header('Location: ../tienda.php');
	$_SESSION["errorLogeadoTienda"] = 1;
	exit;
}

// DESPUÉS COMPROBAMOS QUE EL USUARIO NO ESTÉ VACÍO

if (!isset($_SESSION["carrito"])) {
	header('Location: ../tienda.php');
	$_SESSION["errorCarritoVacio"] = 1;
	exit;
}


// For test payments we want to enable the sandbox mode. If you want to put live
// payments through then this setting needs changing to `false`.

$enableSandbox = true;

// Database settings. Change these for your database configuration.
$dbConfig = [
	'host' => 'localhost',
	'username' => 'root',
	'password' => '',
	'name' => 'payPal_example'
];

// PayPal settings. Change these to your account details and the relevant URLs
// for your site.
$paypalConfig = [
	'email' => 'sb-dsigs592244@business.example.com',
	'return_url' => 'http://localhost/proyectos-clase/laboratorioweb/tienda.php',
	'cancel_url' => 'http://193.145.145.251/payPal/payment-cancelled.html',
	'notify_url' => 'http://193.145.145.251/payPal/payments.php'
];

$paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

// CONTAMOS EL TOTAL AÑADIDO AL CARRITO

$host = "localhost";
$database = "laboratorioweb";
$user = "root";
$databasePassword = "";

$connection = mysqli_connect($host, $user, $databasePassword, $database);

$totalAPagar = 0;

foreach ($_SESSION['carrito'] as $key => $valor) {

	$idProducto = $key;
	$cantidadProducto = $valor;

	$sql = "SELECT * FROM productos WHERE id = '$idProducto'";

	if ($result = mysqli_query($connection, $sql)) {
		while ($row = mysqli_fetch_array($result)) {
			$precioProducto = $row["precio"];

			$totalAPagar = $totalAPagar + ($cantidadProducto * $precioProducto);
		}
	}
}

//mysqli_close($connection);

// Product being purchased.
$itemName = "Compra MyIoT";
$itemAmount = $totalAPagar;

// Include Functions
// require 'functions.php';

// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])) {

	// Grab the post data so that we can set up the query string for PayPal.
	// Ideally we'd use a whitelist here to check nothing is being injected into
	// our post data.
	$data = [];
	foreach ($_POST as $key => $value) {
		$data[$key] = stripslashes($value);
	}

	// Set the PayPal account.
	$data['business'] = $paypalConfig['email'];

	// Set the PayPal return addresses.
	$data['return'] = stripslashes($paypalConfig['return_url']);
	$data['cancel_return'] = stripslashes($paypalConfig['cancel_url']);
	$data['notify_url'] = stripslashes($paypalConfig['notify_url']);

	// Set the details about the product being purchased, including the amount
	// and currency so that these aren't overridden by the form data.
	$data['item_name'] = $itemName;
	$data['amount'] = $itemAmount;
	$data['currency_code'] = 'EUR';

	// Add any custom fields for the query string.
	//$data['custom'] = USERID;

	// Build the query string from the data.
	$queryString = http_build_query($data);

	// Redirect to paypal IPN
	header('location:' . $paypalUrl . '?' . $queryString);
	exit();
} else {
	// Handle the PayPal response.

	// Create a connection to the database.
	// $db = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['name']);

	// Assign posted variables to local data array.
	$data = [
		'item_name' => $_POST['item_name'],
		'item_number' => $_POST['item_number'],
		'payment_status' => $_POST['payment_status'],
		'payment_amount' => $_POST['mc_gross'],
		'payment_currency' => $_POST['mc_currency'],
		'txn_id' => $_POST['txn_id'],
		'receiver_email' => $_POST['receiver_email'],
		'payer_email' => $_POST['payer_email'],
		'custom' => $_POST['custom'],
	];

	$_SESSION["paypal"] = $data;

	// We need to verify the transaction comes from PayPal and check we've not
	// already processed the transaction before adding the payment to our
	// database.
	if (verifyTransaction($_POST, $data) && checkTxnid($data['txn_id'])) {
		if (addPayment($data) !== false) {
			// Payment successfully added.
			
		}
	}

	// EN UN CASO REAL DEBEMOS DE AÑADIR LOS PAGOS UNA VEZ HAN SIDO VERIFICADOS PERO LOS VAMOS A HACER AQUÍ ANTES YA QUE NO PODEMOS
	// VINCULAR LA RED PRIVADA CON LA PÚBLICA 
}
