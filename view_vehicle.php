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
            header('location: user_dasboard.php');
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
        color: #428BCA;
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

    <div id="content" class="mb-5">

        <div class="container-fluid mt-5" style="margin-left: 7vw; width: 90vw;">
            <h1 class="px-lg-5"><?php echo "$row[name]";?></h1>
            <div class="px-lg-5 mt-3" style="display: flex;">

                <!-- For demo purpose -->
                <img src="assets/vehicle/<?php echo "$row[image]"; ?>" class="img-fluid" alt="..." style="height: 60vh;">

                <div class="ms-4 container-fluid">
                    <?php
                        echo "
                        <span class='text-decoration-underline fs-1 fw-bold'>Cost: </span> <span class='text-decoration-underline fs-1'>₱$row[cost] / day</span> <br>
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
            <a href="login.php" class="btn btn-primary mt-3 ms-5" style="width: 60vh">Book Now</a>
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


