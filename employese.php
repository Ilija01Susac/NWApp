<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nwapp";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM employee";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo " " . $row["FIRST_NAME"]. " " . $row["LAST_NAME"]."<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>
