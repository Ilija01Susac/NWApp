<?php
	require_once('lib/nusoap.php');
	$error  = '';
	$result = array();
	$response = '';
	$wsdl = "http://localhost/nwa/zadatci/soap/server.php?wsdl";
	if(isset($_POST['sub'])){
		$product_name = trim($_POST['product_name']);
		if(!$product_name){
			$error = 'Product name cannot be left blank.';
		}

		if(!$error){
			$client = new nusoap_client($wsdl, true);
			$err = $client->getError();
			if ($err) {
				echo '<h2>Constructor error</h2>' . $err;
			    exit();
			}
			 try {
				$result = $client->call('fetchClientData', array($product_name));
				$result = json_decode($result);
			//	var_dump($result);
			  }catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			 }
		}
	}	

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Client info</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>SOAP zadatak</h2>
  <br />       
  <div class='row'>
  	<form class="form-inline" method = 'post' name='form1'>
  		<?php if($error) { ?> 
	    	<div class="alert alert-danger fade in">
    			<a href="#" class="close" data-dismiss="alert">&times;</a>
    			<strong>Error!</strong>&nbsp;<?php echo $error; ?> 
	        </div>
		<?php } ?>
	    <div class="form-group">
	      <label for="email">Product name:</label>
	      <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Enter product name" required>
	    </div>
	    <button type="submit" name='sub' class="btn btn-default">Submit</button>
    </form>
   </div>
   <br />
   <h2>Client info</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Address</th>
        <th>city</th>
        <th>FED id</th>
        <th>State</th>
        <th>Postal code</th>
      </tr>
    </thead>
    <tbody>
	<?php if($result){ ?>
		<?php foreach($result as $res => $value){ ?>
      	
		      <tr>
		        <td><?php echo $value->ADDRESS; ?></td>
		        <td><?php echo $value->CITY; ?></td>
		        <td><?php echo $value->FED_ID; ?></td>
		        <td><?php echo $value->STATE; ?></td>	
		        <td><?php echo $value->POSTAL_CODE; ?></td>
		      </tr>
      <?php 
		  }}else{ ?>
		 <h3>Empty</h3>
  		<?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>



