<?php

$destinatarioIDInput = "destinatario";
$messageIDInput = "mensaje";
$privadoIDInput = "privado";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST[$destinatarioIDInput]) && 
        isset($_POST[$messageIDInput])
        ) {

        $destinatario = $_POST[$destinatarioIDInput];
        $message = $_POST[$messageIDInput];

        // Privado marcado
        if (isset($_POST[$privadoIDInput])) {

        } 
        
        // Privado NO marcado
        else {

        }
        $privado = $_POST[$privadoIDInput];

        echo "Destinatario: $destinatario <br>";
        echo "Mensaje: $message <br>";
        echo "Privado: $privado <br>";
         
    }
}
