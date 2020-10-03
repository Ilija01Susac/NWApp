<?php
 require_once('dbconn.php');
 require_once('lib/nusoap.php'); 
 $server = new nusoap_server();

function fetchClientData($product_name){
	global $dbconn;
	$sql = "SELECT * FROM customer 
  INNER JOIN account ON account.CUST_ID = customer.CUST_ID
  INNER JOIN product ON product.PRODUCT_CD = account.PRODUCT_CD
  WHERE product.PRODUCT_CD = (SELECT PRODUCT_CD from product WHERE NAME = :product_name)";

    $stmt = $dbconn->prepare($sql);
    $stmt->bindParam(':product_name', $product_name);
    
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return json_encode($data);
    $dbconn = null;
}
$server->configureWSDL('clientsServer', 'urn:client');
$server->register('fetchClientData',
			array('product_name' => 'xsd:string'),
			array('data' => 'xsd:string'),
			'urn:client',
			'urn:client#fetchClientData'
      );
$server->service(file_get_contents("php://input"));

?>