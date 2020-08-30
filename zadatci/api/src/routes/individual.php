<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = new \Slim\App();

$app->get('/api/individuals', function(Request $request, Response $response){
    $sql = "SELECT * FROM individual";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $individuals = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return json_encode($individuals);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


$app->get('/api/individuals/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM individual WHERE CUST_ID = $id";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $individual = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        if($individual){
            return json_encode($individual);
        }else{
            return json_encode("Korisnik nije pronađen!");
        }
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app->post('/api/individuals/add', function(Request $request, Response $response){
    $first_name = $request->getParam('FIRST_NAME');
    $last_name = $request->getParam('LAST_NAME');
    $date = $request->getParam('BIRTH_DATE');
    
    $sql = "INSERT INTO individual (FIRST_NAME,LAST_NAME,BIRTH_DATE) VALUES
    (:FIRST_NAME,:LAST_NAME,:BIRTH_DATE)";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':FIRST_NAME', $first_name);
        $stmt->bindParam(':LAST_NAME', $last_name);
        $stmt->bindParam(':BIRTH_DATE', $date);

        $stmt->execute();

        echo '{"notice": {"text": "Individual Added"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});




$app->put('/api/individuals/update/{CUST_ID}', function(Request $request, Response $response){
    $id = $request->getAttribute('CUST_ID');

    $first_name = $request->getParam('FIRST_NAME');
    $last_name = $request->getParam('LAST_NAME');
    $birth_date = $request->getParam('BIRTH_DATE');

    $sql = "UPDATE individual SET 
                FIRST_NAME 	= :FIRST_NAME,
				LAST_NAME 	= :LAST_NAME,
                BIRTH_DATE	= :BIRTH_DATE
            WHERE CUST_ID = $id";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':FIRST_NAME', $first_name);
        $stmt->bindParam(':LAST_NAME', $last_name);
        $stmt->bindParam(':BIRTH_DATE', $birth_date);

        $stmt->execute();

        echo '{"notice": {"text": "Individual Updated"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


$app->delete('/api/individuals/delete/{CUST_ID}', function(Request $request, Response $response){
    $id = $request->getAttribute('CUST_ID');

    $sql = "DELETE FROM individual WHERE CUST_ID = $id";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "Individual Deleted"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});