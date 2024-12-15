<?php
include ('connect.php');
if(isset($_GET['car_id'])) {
    $id = $_GET['car_id'];
    $qry = "DELETE from vehicle WHERE car_id = $id";
    $conn->query($qry);
}
header('location:/rent_a_car/admin/vehicle.php');
exit;
?>