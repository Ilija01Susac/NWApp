<?php

$conn = mysqli_connect('localhost',"root","","nwapp");

$firstname = $_REQUEST["firstname"];
$lastname = $_REQUEST["lastname"];
$result = "";
if($firstname != ""){
$result = mysqli_query($conn,'SELECT * FROM customer AS c INNER JOIN individual AS i ON c.CUST_ID = i.CUST_ID WHERE i.FIRST_NAME ='."$firstname".'');
}
if($result == false){json_encode("nema nista");}
$data  = array();
while($row = mysqli_fetch_assoc($result)){
    $data[] = $row;
}

echo json_encode($data);