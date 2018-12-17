<?php

// Server Information
$server = 'localhost';
$user = 'root';
$pass = 'T3mp12';
$db = 'temp';

// Connection
$mysqli = new mysqli($server, $user, $pass, $db);

// Error
mysqli_report(MYSQLI_REPORT_ERROR);

?>