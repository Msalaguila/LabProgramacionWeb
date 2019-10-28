<?php
session_start();
session_unset();
header('Location: loginhtml.php');
exit;
?>