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
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <?php
    echo myHead();
    ?>

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
    <div class="vertical-nav" id="sidebar" style="background: #0B3C5D; color: white;">
    <div class="py-4 px-3 mb-4" style='background: rgba(0, 0, 0, 0.2); color: white;'>
        <div class="media d-flex align-items-center">
        <div class="media-body">
            <h4 class="m-0" style="">
            <?php
                $table = "system";
                $id = 1; 
                $column = "name";
                echo getOne($table, $id,  $column);
                ?>
            </h4>
            <p class="font-weight-light mb-0">Management</p>
        </div>
        </div>
    </div>


    <ul class="nav flex-column mb-0" style="background: #0B3C5D; color: white;">
        <li class="nav-item">
        <a href="dashboard.php" class="nav-link text-light font-italic">
                    <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                    Dashboard
                </a>
        </li>
        <li class="nav-item">
        <a href="bookings.php" class="nav-link text-light font-italic">
                    <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                    Bookings
                </a>
        </li>
        <li class="nav-item">
        <a href="vehicle.php" class="nav-link text-light font-italic">
                    <i class="fa fa-cubes mr-3 text-primary fa-fw"></i>
                    Vehicle
                </a>
        </li>
        <li class="nav-item">
        <a href="users.php" class="nav-link text-light font-italic">
                    <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                    Users
                </a>
        </li>
        <li class="nav-item">
        <a href="system.php?id='1'" class="nav-link text-light font-italic">
                    <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                    System
                </a>
        </li>

        <li class="nav-item">
        <a href="../index.php" class="nav-link text-light font-italic">
                    <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                    Logout
                </a>
        </li>
    </ul>

    
    </div>
    <!-- End vertical navbar -->

        <!-- Page content holder -->
        <div class="page-content p-4 px-5" id="content">
        
        <!-- Demo content -->

        <h1 class="mb-4"><?php echo "$row[name]";?> <a href="vehicle.php" class="fs-4 btn btn-primary float-end">Back</a></h1>

        <img src="../assets/vehicle/<?php echo "$row[image]"; ?>" class="img-fluid" alt="..." style="height: 60vh;">

        <div class="">
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

        <!-- End demo content -->
        </div>


</body>
</html> 