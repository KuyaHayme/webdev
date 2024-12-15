<?php
    include ('connect.php');
    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $about = $_POST['about'];
        $qry = "INSERT INTO `system` (`name`, `email`, `contact`, `about`) VALUES ('$name', '$email', '$contact', '$about')";

        $query = mysqli_query($conn,$qry);
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
        if(!isset($_GET['type'])) {
            header('location: available.php');
            exit;
        }

        $type = $_GET['type'];
        $qry = "SELECT * FROM vehicle WHERE type = '$type'";
        $result = $conn->query($qry);
        if (!$result) {
            die("Error executing query: " . $conn->error);
        }
        $row = $result->fetch_assoc();

        while(!$row) {
            header('location: index.php');
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
    <title>Rent a Car</title>
    
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="assets/css/bootstrap.min">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    
    <style>
        /*
        #front {
            font-family: Times;
            background: gray;
            padding: 50vh;
        }
        */
        body {
        background: #EFEFEF;
        }

        .banner {
        background: #a770ef;
        background: -webkit-linear-gradient(to right, #a770ef, #cf8bf3, #fdb99b);
        background: linear-gradient(to right, #a770ef, #cf8bf3, #fdb99b);
        }

        #myCarousel {
            height: 90vh;
        }

        a {
        color: #1D2731;
        text-decoration: none;
}
    </style>
    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

<body>
<nav style="background: #0B3C5D; align-items: center; height: 48dp; display: flex;">
        <a href="index.php" style="color: white; margin-left: 10vw;" class="btn fs-1 fw-bold">
            <?php
            $table = "system";
            $id = 1;          
            $column = "name";
            echo getOne($table, $id , $column);
            ?>
        </a>
        <a href="index.php" style="color: white; margin-left: 50vw;" class="btn fs-3">Home</a>
        <a href="login.php" style="color: white; margin: 10px;" class="btn fs-3">Login</a>
    </nav>

    <!-- ####################### -->

    <!-- ####################### -->

    <div id="content">
        <div class="container-fluid">
            <div class="px-lg-5">

                <!-- For demo purpose -->
                <div class="row pt-5">
                    <div class="col-lg-12 mx-auto">
                        <div class="text-white p-2 shadow-sm rounded banner" style="background-image: url('assets/media/cs1.jpg'); background-size: cover;">
                        <h1 class="display-4 text-center"><?php echo $row['type']; ?></h1>
                        <p class="lead text-center mt-3">Check our group categories </p>
                        </div>
                    </div>
                </div>

                <div class="mx-auto d-flex justify-content-end align-items-center p-2" style="">
                    <a href="index.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                    </svg>
                    </a>
                </div>

                <div class="row">
                <?php
                    // Step 1: Connect to the Database
                    include('connect.php'); // Include the file containing database connection code

                    // Step 2: Retrieve Data from the Database
                    $query = "SELECT * FROM vehicle  WHERE type = '$type'"; // SQL query to select all columns from the vehicles table
                    $result = mysqli_query($conn, $query); // Execute the query

                    // Step 3: Check for Errors and Fetch Data
                    if ($result) {
                        // Step 4: Loop through fetched rows
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Step 5: Display Data
                            ?>
                            <div class="mb-4">
                                <a href="view_vehicle.php?car_id=<?php echo $row['car_id']; ?>">
                                    <div class="bg-white rounded shadow-sm d-flex">                                   
                                        <img src="assets/vehicle/<?php echo $row['image']; ?>" alt="" class="my-auto" style="height: 50vh;">
                                            
                                        <div class="p-4">
                                            <!-- <h5><a href="view_vehicle.php?car_id=<?php echo $row['car_id']; ?>" class="text-dark"><?php echo $row['name']; ?></a></h5> -->
                                            <a href="view_vehicle.php?car_id=<?php echo $row['car_id']; ?>">

                                            <div class="container-fluid" style="">
                                                <?php
                                                    echo "
                                                    <span class='fs-2 fw-bold mb-5'>$row[name]</span><br>
                                                    <span class='text-decoration-underline fs-4 fw-bold'>Cost: </span> <span class='text-decoration-underline fs-4'>₱$row[cost] / day</span> <br>                        
                                                    <span class='fs-6 fw-bold text-decoration-none'>Type: </span> <span class='fs-6'>$row[type]</span><br>
                                                    <span class='fs-6 fw-bold'>Capacity: </span> <span class='fs-6'>$row[capacity]</span> <br>
                                                    <span class='fs-6 fw-bold'>Transmission: </span> <span class='fs-6'>$row[transmission]</span> <br>
                                                    <span class='fs-6 fw-bold'>Fuel: </span> <span class='fs-6'>$row[fuel]</span><br>
                                                    <span class='fs-6 fw-bold'>Description: </span>
                                                    <p class='fs-6'>$row[description]</p>";
                                                ?>
                                            </div>

                                            <a href="login.php" class="btn btn-primary mt-3" style="width: 100%">Book Now</a>
                                            <!-- Other vehicle information can be displayed here -->
                                        </div>
                                        
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        // Handle database query error
                        echo "Error: " . mysqli_error($conn);
                    }
                ?>

                </div>
            </div>
            
        </div>
        
    </div>


    

    <!-- ####################### -->

    <div id="footer">
        <!-- Remove the container if you want to extend the Footer to full width. -->

        <footer class="text-center text-white" style="background-color: #0B3C5D;">
        <!-- Grid container -->
        <div class="container pt-4">
            <h1 class="mb-4">Contact Us</h1>
            <div>
                <img src="assets/phone.png" alt="phone.png" style="height: 25px;">
                <span class="me-5"><?php echo getOne('system' ,'1' ,'contact' ); ?></span>
                <img src="assets/mail.png" alt="mail.png" style="height: 25px;">
                <span><?php echo getOne('system' ,'1' ,'email' ); ?></span>
            </div>

            
            <!-- Section: Social media -->
            <section class="mb-4 mt-4">
            <!-- Facebook -->
            <a
                class="btn btn-link btn-floating btn-lg text-dark m-1"
                style="color: white; background: white"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fa fa-facebook-f"></i
            ></a>

            <!-- Twitter -->
            <a
                class="btn btn-link btn-floating btn-lg text-dark m-1"
                style="color: white; background: white"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fa fa-twitter"></i
            ></a>

            <!-- Google -->
            <a
                class="btn btn-link btn-floating btn-lg text-dark m-1"
                style="color: white; background: white"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fa fa-google"></i
            ></a>

            <!-- Instagram -->
            <a
                class="btn btn-link btn-floating btn-lg text-dark m-1"
                style="color: white; background: white"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fa fa-instagram"></i
            ></a>

            <!-- Linkedin -->
            <a
                class="btn btn-link btn-floating btn-lg text-dark m-1"
                style="color: white; background: white"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fa fa-linkedin"></i
            ></a>
            <!-- Github -->
            <a
                class="btn btn-link btn-floating btn-lg text-dark m-1"
                style="color: white; background: white"
                href="#!"
                role="button"
                ><i class="fa fa-github"></i
            ></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2024 Copyright:
            <a class="" href="#">rentacar.com</a>
        </div>
        <!-- Copyright -->
        </footer>
        
        </div>
        <!-- End of .container -->

</body>
</html>


