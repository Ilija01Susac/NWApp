<?php
include 'database/databaseConfig.php';
include 'database/databaseConnection.php';
include 'model/product.php';

$config = include 'database/dbConfig.php';

if(isset($_POST["name"])) {
    $databaseConnection = new DatabaseConnection(new DatabaseConfig($config));
    $connection = $databaseConnection->connection();
    $customer = new Customer($connection);
    $customer = $customer->where($_POST["name"],$_POST["selected"],$_POST["type"] );

    
    echo $customer;
}
?>