<?php
include('connect.php');

$user_id = $_GET['id'];
if (isset($_POST['submit'])) {
    $user = $_GET['id'];
    $car = $_GET['car_id'];
    $pickup = $_POST['pickup'];
    $dropoff = $_POST['dropoff'];
    $status = $_POST['status'];

    // Check if there is a conflicting booking for the same car
    $qry = "SELECT * FROM booking WHERE car = '$car' AND (
                (pickup <= '$pickup' AND dropoff >= '$pickup') OR
                (pickup <= '$dropoff' AND dropoff >= '$dropoff') OR
                (pickup >= '$pickup' AND dropoff <= '$dropoff')
            )";
    $result = mysqli_query($conn, $qry);

    if (mysqli_num_rows($result) > 0) {
        // Conflict found, show an alert and do not proceed with booking
        echo "<script>alert('The selected car is already booked for the chosen dates. Please select a different date range.');</script>";
    } else {
        // No conflict, proceed with the booking
        $qry = "INSERT INTO booking (`user`, `car`, `pickup`, `dropoff`, `status`) VALUES ('$user', '$car', '$pickup', '$dropoff', '$status')";
        $query = mysqli_query($conn, $qry);

        header("location: my_bookings.php?id=$user_id");
        exit;
    }
}
?>
<?php
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
?>

<?php

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
            header('location: my_bookings.php');
            exit;
        }

        $car_id = $_GET['car_id'];
        $qry = "SELECT * FROM vehicle WHERE car_id = $car_id";
        $result = $conn->query($qry);
        $row = $result->fetch_assoc();

        while(!$row) {
            header('location: my_bookings.php');
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
        $car_id = $_GET['car_id'];
        $qry = "SELECT * FROM vehicle WHERE car_id = $car_id";
        $result = $conn->query($qry);
        $row = $result->fetch_assoc();

        $car_id = $row['car_id'];
        $type = $row['type'];
        $name = $row['name'];
        $capacity = $row['capacity'];
        $transmission = $row['transmission'];
        $fuel = $row['fuel'];
        $cost = $row['cost'];
        $image = $row['image'];
        $description = $row['description'];

        $qry = "UPDATE vehicle SET type='$type', name='$name', capacity='$capacity', transmission='$transmission', fuel='$fuel', cost='$cost', image='$image', description='$description' WHERE car_id='$car_id'";
        $result = $conn->query($qry);
    }
    
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
            background: gray;
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
        <div class='vertical-nav bg-white' id='sidebar'>
          <div class='py-4 px-3 mb-4 bg-light'>
            <div class='media d-flex align-items-center'>
              <div class='media-body'>
                <h4 class='m-0' style=''>
                <?php
                    $table = "system";
                    $id = 1;          
                    $column = "name";
                    echo getOne($table, $id , $column);
                ?>
                </h4>
                <p class='font-weight-light text-muted mb-0'>My Account</p>
              </div>
            </div>
          </div>
        
        
        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item">
            <a href="user_dashboard.php?type=&id=<?php echo $user_id; ?>" class="nav-link text-dark font-italic">
                        
                        RENT A CAR
                    </a>
            </li>

            <li class="nav-item">
            <a href="my_account.php?id=<?php echo $user_id; ?>" class="nav-link text-dark font-italic">
                        
                        My Account
                    </a>
            </li>

            <li class="nav-item">
            <a href="my_bookings.php?id=<?php echo $user_id; ?>" class="nav-link text-dark font-italic">
    
                        Bookings
                    </a>
            </li>

            <li class="nav-item">
            <a href="index.php" class="nav-link text-dark font-italic">
                        
                        Logout
                    </a>
            </li>
        </ul>
        
          
        </div>
        <!-- End vertical navbar -->

        <!-- Page content holder -->
        <div class="page-content p-5" id="content">
        
        <!-- Demo content -->

        <h1>CONFIRM BOOKING</h1>

        <div>
            <!-- ################ -->
                        <!-- ################ -->
                        <form method="post" style="">
                            
                                <div class="page-title" style="display: flex;">
                                <input type="hidden" value="Pending" name="status">
                                    <div class="m-2 col">
                                        <label for="exampleInputEmail1" class="form-label">Pickup Date</label>
                                        <input class="form-control" type="datetimelocal" placeholder="Select DateTime" id="pickup" name="pickup" required>
                                    </div>

                                    <div class="m-2 col">
                                        <label for="exampleInputEmail1" class="form-label">Drop Off Date</label>
                                        <input class="form-control" type="datetimelocal" placeholder="Select DateTime" id="dropoff" name="dropoff">
                                    </div>

                                    <script>
                                        config = {
                                            enableTime: true,
                                            dateFormat: "Y-m-d H:i",
                                            altInput: true,
                                            altFormat: "F j, Y (h:S K)",
                                        }

                                        flatpickr("input[type=datetimelocal]", config);
                                    </script>
                                </div>
                                <button class="btn btn-success mt-3" style="width: 100%" name="submit">Confirm Booking</button>
                            <!--    <a href="my_bookings.php?id=<?php echo $user_id; ?>" class="btn btn-success mt-3" style="width: 60vh" >Confirm Booking</a> -->
                            </form>
                            <!-- ################ -->
                            <!-- ################ -->
        </div>

        <div id="content" class="mb-5">

            <div class="container-fluid mt-2" style="width: 75vw;">
                <h1 class=""><?php echo "$row[name]";?></h1>
                <div class="mt-3" style="display: flex;">

                    <!-- For demo purpose -->
                    <img src="assets/vehicle/<?php echo "$row[image]"; ?>" class="img-fluid" alt="..." style="height: 60vh;">

                    <div class="ms-4 container-fluid">
                        <?php
                            echo "
                            <span class='text-decoration-underline fs-1 fw-bold'>Cost: </span> <span class='text-decoration-underline fs-1'>₱ $row[cost]</span> <br>
                            <span class='fs-4 fw-bold'>Name: </span> <span class='fs-4'>$row[name]</span> <br>
                            <span class='fs-4 fw-bold'>Type: </span> <span class='fs-4'>$row[type]</span> <br>
                            <span class='fs-4 fw-bold'>Capacity: </span> <span class='fs-4'>$row[capacity]</span> <br>
                            <span class='fs-4 fw-bold'>Transmission: </span> <span class='fs-4'>$row[transmission]</span> <br>
                            <span class='fs-4 fw-bold'>Fuel: </span> <span class='fs-4'>$row[fuel]</span> <br>
                            <span class='fs-4 fw-bold'>Description: </span>
                            <p class='fs-5'>$row[description]</p>";
                        ?>
                    </div>
                    
                </div>
                
            </div>
            <!-- <button class="btn btn-success mt-3 ms-4" style="width: 60vh" name="submit">Confirm Booking</button> -->
        </div>


        <!-- End demo content -->
        </div>


</body>
</html>