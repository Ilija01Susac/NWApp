<?php
    class Customer {
        function __construct($connection) {
            $this->connection = $connection;
        }

        public function where($name, $selected, $type) {
                
            if($selected == 'and'){
                
                if($name == ''){

                    $query  = "SELECT * FROM individual ";
                }
                else{

                        $query = "SELECT *
                        FROM customer AS c JOIN individaul AS i ON c.CUST_ID = i.CUST_ID
                        WHERE i.FIRST_NAME='$name'";
                }
                return  $this->list(mysqli_query($this->connection, $query));
            }
            else{

                if($name == ''){
                    $query  = "SELECT * FROM products ";
                    
                }
                else {
                    $query = "SELECT p.ProductName, p.UnitPrice, c.CategoryName
                     FROM products AS p JOIN categories AS c ON p.CategoryID = c.CategoryID
                     WHERE ProductName LIKe '%$name%'";
                }
                
 
                return  $this->list(mysqli_query($this->connection, $query));
            }

            
        }

        private function list($companies) {
            $companyList = [];

            while($row = mysqli_fetch_array($companies)) {
                $companyList[] = $row;
            }

            return json_encode($companyList);
        }
    }