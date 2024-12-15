<?php 
$serverName = "localhost";
$username = "root";
$password = "";
$database = "rent_a_car";

//Create connection
$conn = new mysqli($serverName, $username, $password, $database);

//Check connection
if ($conn->connect_error) {
    die("Connection failed: " .$conn->connect_error);
}
    /*echo "Connection success";*/
?>