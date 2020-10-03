<?php

$host         = "localhost";
$username     = "root";
$password     = "";
$dbname       = "nwapp";

try {
    $dbconn = new PDO('mysql:host=localhost;dbname=nwapp', $username, $password);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
