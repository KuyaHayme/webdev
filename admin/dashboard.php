<?php
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

    function myCount($table, $column) {
   
        // Include your database connection file
        include('connect.php');
        $myTable = "$table";

        // SQL query to count the entries in the table
        $query = "SELECT COUNT('$column') AS total FROM $myTable";

        // Execute the query
        $result = $conn->query($query);

        // Check if the query was successful
        if ($result) {
            // Fetch the result as an associative array
            $row = $result->fetch_assoc();

            // Access the count from the associative array
            $total_entries = $row['total'];

            // Output the count
            echo $total_entries;
        } else {
            // Handle the case where the query fails
            echo "Error: " . $conn->error;
        }

        // Close the database connection
        $conn->close();
    }

    function myToday($column) {
        // Include your database connection file
        include('connect.php');
    
        // SQL query to count the entries for today
        $query = "SELECT COUNT($column) AS total_entries FROM booking 
                  WHERE DATE(pickup) = CURDATE()";
    
        // Execute the query
        $result = $conn->query($query);
    
        // Check if the query was successful
        if ($result) {
            // Fetch the result as an associative array
            $row = $result->fetch_assoc();
            $total_entries = $row['total_entries'];
    
            // Close the database connection
            $conn->close();
    
            // Return the count
            return $total_entries;
        } else {
            // Handle the case where the query fails
            echo "Error: " . $conn->error;
        }
    
        // Close the database connection in case of error
        $conn->close();
        return 0; // Return 0 if there's an error
    }
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="assets/css/bootstrap.min">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

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
    <div class="vertical-nav" id="sidebar" style="background: #0B3C5D; color: white;">
    <div class="py-4 px-3 mb-4" style='background: rgba(0, 0, 0, 0.2); color: white;'>
        <div class="media d-flex align-items-center">
        <div class="media-body">
            <h4 class="m-0" style="">
            <?php
                $table = "system";
                $id = 1;           
                $column = "name";
                echo getOne($table, $id, $column);
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
        <h1 class="mb-4">DASHBOARD</h1>

        <div class="card text-center shadow" style="margin-bottom: 50px;">
            <div class="card-header" style="">
                Featured
            </div>
            <div class="card-body" style="">
                <h5 class="card-title">Bookings Today!</h5>
                <p class="card-text">You have a total of <?php echo myToday('booking_id'); ?> bookings today!</p>

                <a href="bookings.php" class="btn btn-success">Bookings</a>
            </div>
            <div class="card-footer" style="">
                Today
            </div>
        </div>

        <div class="row">
            
        <div class="col-sm-6 text-center">
            <div class="card"  style="border: solid; border-color: #0B3C5D;">
            <div class="card-body">
                <h5 class="card-title">Your Vehicles</h5>
                <p class="card-text">You have a total of <?php echo myCount('vehicle', 'car_id'); ?> vehicle.</p>
                <a href="vehicle.php" class="btn btn-primary">Vehicles</a>
            </div>
            </div>
        </div>
        <div class="col-sm-6 text-center">
            <div class="card" style="border: solid; border-color: #0B3C5D;">
            <div class="card-body">
                <h5 class="card-title=">Your Users</h5>
                <p class="card-text">You have a total of <?php echo myCount('users', 'id'); ?> users.</p>
                <a href="users.php" class="btn btn-primary">Users</a>
            </div>
            </div>
        </div>
        </div>
    <!-- End demo content -->
</div>
</body>
</html>