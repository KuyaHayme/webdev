<?php
include ('connect.php');
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $qry = "DELETE from users WHERE id = $id";
    $conn->query($qry);
}
header('location:/rent_a_car/users.php');
exit;
?>