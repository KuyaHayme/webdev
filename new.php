<?php
    include ('connect.php');
    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $password = $_POST['password'];
        $qry = "INSERT INTO `users` (`name`, `email`, `contact`, `password`) VALUES ('$name', '$email', '$contact', '$password')";

        $query = mysqli_query($conn,$qry);
        header('location: login.php');
        exit;
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
            echo getOne($table, $id, $column);
            ?>
        </a>
        <a href="index.php" style="color: white; margin-left: 50vw;" class="btn fs-3">Home</a>
        <a href="login.php" style="color: white; margin: 10px;" class="btn fs-3">Login</a>
    </nav>

    <!-- ####################### -->

    <!-- ####################### -->
    <div class="d-block justify-content-center mx-auto my-5" style="">
        <div style="width: 40vw; background: #0B3C5D; padding: 5vh 10vw 7vh; color: black;" class="mx-auto rounded-3">
            <form method="post">
                <div class="text-center" style="color: white;">
                    <h1 style="color: white;">Register</h1>
                </div>

                <div class="my-3">
                    <label for="name" class="form-label" style="color: white;">Name</label>
                    <input class="form-control" type="text" id="name" name="name" required>
                </div>

                <div class="my-3">
                    <label for="email" class="form-label" style="color: white;">Email</label>
                    <input class="form-control" type="email" id="email" name="email" required>
                </div>

                <div class="my-3">
                    <label for="contact" class="form-label" style="color: white;">Contact</label>
                    <input class="form-control" type="text" id="contact" name="contact" required>
                </div>

                <div class="my-3">
                    <label for="about" class="form-label" style="color: white;">Password</label>
                    <input class="form-control" type="text" id="password" name="password" required>
                </div>

                <div class="d-flex justify-content-center m-4">
                    <button name="submit" class="btn btn-success m-2">Submit</button>
                    <a class="btn btn-danger m-2" type="submit" name="cancel" href="index.php">Cancel</a>
                </div>
            </form>
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


