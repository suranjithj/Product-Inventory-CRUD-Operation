<?php

$db_host = 'localhost'; //hostname
$db_user = 'root'; //username
$db_password = ''; //password
$db_name = 'pdctinventorydb'; //database name

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>