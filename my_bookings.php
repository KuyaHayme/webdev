<?php
    include ('connect.php');
    function myHead() {
        echo "
        <link rel='stylesheet' href='assets/css/bootstrap.min'>
        <link rel='stylesheet' href='assets/css/font-awesome.min.css'>
        <script src='assets/js/jquery-3.3.1.slim.min.js'></script>
        <script src='assets/js/bootstrap.bundle.min.js'></script>    
        ";
    }

    function getOne($table, $id, $column) {
        include ('connect.php');
            $qry = "SELECT * FROM $table WHERE id = $id";
            $results = $conn->query($qry);
    
            if (!$results) {
                die("Invalid query: " .$conn->error);
            }
    
            while ($row = $results->fetch_assoc()) {
                return $row['name'];
            }
    }

    function myDays($pick, $drop) {
        
        // Include your database connection file
        include('connect.php');

        // Start and end dates for counting entries
        $start_date = $pick;
        $end_date = $drop;

        // SQL query to count the entries between the specified dates
        $query = "SELECT COUNT('booking_id') AS total_entries FROM booking 
                WHERE pickup BETWEEN '$start_date' AND '$end_date'";

        // Execute the query
        $result = $conn->query($query);

        // Check if the query was successful
        if ($result) {
            // Fetch the result as an associative array
            $row = $result->fetch_assoc();

            // Access the count from the associative array
            $total_entries = $row['total_entries'];

            // Output the count
            return $total_entries;
        } else {
            // Handle the case where the query fails
            echo "Error: " . $conn->error;
        }

        // Close the database connection
        $conn->close();
    }

    $user_id = $_GET['id'];

    function myCountD($pick, $drop, $bookingId, $conn) {
        // Prepare and bind the parameters to prevent SQL injection
        $query = "SELECT DATEDIFF(?, ?) AS days_difference FROM booking WHERE booking_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $drop, $pick, $bookingId);
    
        // Execute the query
        if ($stmt->execute()) {
            // Bind the result variable
            $stmt->bind_result($total_entries);
    
            // Fetch the result
            $stmt->fetch();
    
            // Close statement
            $stmt->close();
    
            return $total_entries;
        } else {
            // Handle the case where the query fails
            // You might want to log the error or throw an exception
            return false;
        }
    }
    
?>

<?php
/*
    include ('connect.php');
    $car_id = "";
    $type = "";
    $name = "";
    $capacity = "";
    $transmission = "";
    $fuel = "";
    $cost = "";
    $image = "";
    $description = "";

    $error = "";
    $success = "";

    if($_SERVER['REQUEST_METHOD']=='GET') {
        if(!isset($_GET['car_id'])) {
            header('location: view_vehicle.php');
            exit;
        }

        $car_id = $_GET['car_id'];
        $qry = "SELECT * FROM vehicle WHERE car_id = $car_id";
        $result = $conn->query($qry);
        $row = $result->fetch_assoc();

        while(!$row) {
            header('location: view_vehicle.php');
            exit;
        }

        $type = $row['type'];
        $name = $row['name'];
        $capacity = $row['capacity'];
        $transmission = $row['transmission'];
        $fuel = $row['fuel'];
        $cost = $row['cost'];
        $image = $row['image'];
        $description = $row['description'];        
    }
    else {
        $car_id = $_POST['car_id'];
        $type = $_POST['type'];
        $name = $_POST['name'];
        $capacity = $_POST['capacity'];
        $transmission = $_POST['transmission'];
        $fuel = $_POST['fuel'];
        $cost = $_POST['cost'];
        $image = $_POST['image'];
        $description = $_POST['description']; 

        $qry = "UPDATE vehicle SET type='$type', name='$name', capacity='$capacity', transmission='$transmission', fuel='$fuel', cost='$cost', image='$image', description='$description' WHERE car_id='$car_id'";
        $result = $conn->query($qry);
    }
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="assets/css/bootstrap.min">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <style>
        .vertical-nav {
        min-width: 17rem;
        width: 17rem;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.4s;
        }

        .page-content {
        width: calc(100% - 17rem);
        margin-left: 17rem;
        transition: all 0.4s;
        }

        /* for toggle behavior */

        #sidebar.active {
        margin-left: -17rem;
        }

        #content.active {
        width: 100%;
        margin: 0;
        }

        @media (max-width: 768px) {
        #sidebar {
            margin-left: -17rem;
        }
        #sidebar.active {
            margin-left: 0;
        }
        #content {
            width: 100%;
            margin: 0;
        }
        #content.active {
            margin-left: 17rem;
            width: calc(100% - 17rem);
        }
        }

        /*
        *
        * ==========================================
        * FOR DEMO PURPOSE
        * ==========================================
        *
        */

        body {
        /*background: #599fd9;
        background: -webkit-linear-gradient(to right, #599fd9, #c2e59c);
        background: linear-gradient(to right, #599fd9, #c2e59c);*/
        min-height: 100vh;
        overflow-x: hidden;
        background: #EFEFEF;
        }

        .separator {
        margin: 3rem 0;
        border-bottom: 1px dashed #fff;
        }

        .text-uppercase {
        letter-spacing: 0.1em;
        }

        .text-gray {
        color: #aaa;
        }

        .nav-item:hover {
            background: #328CC1;
            font-size: 2em;
        }

        .nav-item {
            font-size: 1.25em;
        }
    </style>

    <script>
        $(function() {
        // Sidebar toggle behavior
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar, #content').toggleClass('active');
        });
        });
    </script>
</head>

<body>

        <!-- Vertical navbar -->
        <div class='vertical-nav' id='sidebar'  style="background: #0B3C5D; color: white;">
          <div class='py-4 px-3 mb-4' style='background: rgba(0, 0, 0, 0.2); color: white;'>
            <div class='media d-flex align-items-center'  style="">
              <div class='media-body' style=''>
                <h1 class='' style='color: white;'>
                <?php
                    $table = "system";
                    $id = 1;          
                    $column = "name";
                    echo getOne($table, $id , $column);
                ?>
                </h1>
                <p class='font-weight-light mb-0' style='color: white;'>My Account</p>
              </div>
            </div>
          </div>
        
        
        <ul class="nav flex-column mb-0"  style="color: white">
            <li class="nav-item">
            <a href="user_dashboard.php?type=&id=<?php echo $user_id; ?>" class="nav-link font-italic" style='color: white;'>
                        
                        RENT A CAR
                    </a>
            </li>

            <li class="nav-item">
            <a href="my_account.php?id=<?php echo $user_id; ?>" class="nav-link font-italic" style='color: white;'>
                        
                        My Account
                    </a>
            </li>

            <li class="nav-item">
            <a href="my_bookings.php?id=<?php echo $user_id; ?>" class="nav-link font-italic" style='color: white;'>
    
                        My Bookings
                    </a>
            </li>

            <li class="nav-item">
            <a href="index.php" class="nav-link font-italic" style='color: white;'>
                        
                        Logout
                    </a>
            </li>
        </ul>
        
          
        </div>
        <!-- End vertical navbar -->

        <!-- Page content holder -->
        <div class="page-content p-5" id="content">
        
        <!-- Demo content -->

        <h1 class="mb-3">MY BOOKINGS</h1>

        <div>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Reference #</th>
                            <th>Name</th>
                            <th>Vehicle</th>
                            <th>Pickup Date</th>
                            <th>Drop Off Date</th>
                            <th>Status</th>
                            <th>Amount to be Paid</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        include ('connect.php');
                        $id = $_GET['id'];

                        $qry = "SELECT booking.*, users.name AS user_name, vehicle.name AS vehicle_name, vehicle.cost AS vehicle_cost 
                                FROM booking 
                                JOIN users ON booking.user = users.id
                                JOIN vehicle ON booking.car = vehicle.car_id
                                WHERE booking.user = '$id'";

                        $results = $conn->query($qry);

                        if (!$results) {
                            die("Invalid query: " .$conn->error);
                        }

                        while ($row = $results->fetch_assoc()) {
                            $cost = '₱' . myCountD($row['pickup'], $row['dropoff'], $row['booking_id'], $conn) * $row['vehicle_cost'];
                            echo "
                            <tr>
                                <td>{$row['booking_id']}</td>
                                <td>{$row['user_name']}</td>
                                <td>{$row['vehicle_name']}</td>
                                <td>{$row['pickup']}</td>
                                <td>{$row['dropoff']}</td>
                                <td>{$row['status']}</td>
                                <td>$cost</td>
                            </tr>";
                        }    
                    ?>


                        
                    </tbody>
                </table>
            </div>

        <!-- End demo content -->
        </div>


</body>
</html>