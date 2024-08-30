<?php

$servername = "db";
$db_username = "admin";
$db_password = "comfac123";
$dbname = "udnote";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed:". $conn->connect_error);
}