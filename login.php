<?php
// Include your database connection file
include('connect.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve login credentials from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform database query to check login credentials
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];

        // Redirect to different dashboards based on user ID
        if ($user_id == 1) {
            // Redirect admin user to admin dashboard
            header("location: admin/dashboard.php");
            exit;
        } else {
            // Redirect regular user to user dashboard
            header("location: user_dashboard.php?type=&id=$user_id");
            exit;
        }
    } else {
        // Login failed, display an error message or redirect back to login page with an error message
        echo "<div class='alert alert-danger' role='alert'>
        Your email or password is incorrect!
      </div>";
    }
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
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        #myLog {
            
            height: 30vh;
            width: 50vw;
            display: flex;
            align-content: center;

            margin: auto;
            margin-top: 10vh;
            margin-bottom: 40vh;
            padding-bottom: 40vh;
        }

        #innerLog {
            color: white;
            display: grid;
            margin: auto;
            background: #0B3C5D;
            padding: 40px 60px 20px;
        }

        body {
            background: #EFEFEF;
        }
    </style>
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
        <div id="myLog">
            
        <form id="innerLog" action="login.php" method="post" class="justify-content-center rounded-3 shadow">
        <h1 class="mb-4">Login to Rent a Car</h1>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text" style="color: white;">We'll never share your email with anyone else.</div>
            </div>
            
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
            </div>
            <div class="d-grid justify-items-center text-center my-3">
                <button type="submit" class="btn btn-primary d-block">Login</button>
                <a href="new.php" style="" class="d-block my-3">Don't have an account?</a>
            </div>
            
        </form>
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

    <!--

        -->

</body>
</html>