<?php
$host = 'localhost';
$dbname = 'todo_app';
$username = 'root';
$password = '';

$conn = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_errno()) {

    die ("connection error");
}

?>