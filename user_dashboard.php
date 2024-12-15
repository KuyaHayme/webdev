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
?>

<?php
include ('connect.php');
$type = $_GET['type'];
$user_id = $_GET['id'];
if ($type === '') {
    $myqry = "SELECT * FROM vehicle";
} else {
    $myqry = "SELECT * FROM vehicle WHERE type ='$type'";
}


// Handle form submission
if(isset($_POST['submit'])) {
    // Retrieve the selected type from the form
    $type = $_POST['type'];
    // Redirect to available.php with the selected type as a parameter
    header("location: user_dashboard.php?type=$type&id=$user_id");
    exit;
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
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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

        a {
        color: #1D2731;
        text-decoration: none;
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
        <div class='vertical-nav' id='sidebar' style="background: #0B3C5D; color: white;">
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
        
        
        <ul class="nav flex-column mb-0" style="color: white">
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
        <div class="page-content" id="content">
        
        <!-- Demo content -->
        
        <div id="content">
        <div class="container-fluid">
            <div class="px-lg-5">

                <!-- For demo purpose -->
                <div class="row py-4">
                <div class="col-lg-12 mx-auto">
                    <div class="text-white p-5 shadow-sm rounded banner" style="background-image: url('assets/media/cs1.jpg'); background-size: cover;">

                        <!-- ################ -->
                        <!-- ################ -->
                        <form method="post" style="">
                                <div class="page-title" style="display: flex;">
                                    <div class="m-2 col">
                                        <label for="exampleInputEmail1" class="form-label">Pickup Date</label>
                                        <input class="form-control" type="datetimelocal" placeholder="Select DateTime" id="pickup">
                                    </div>

                                    <div class="m-2 col">
                                        <label for="exampleInputEmail1" class="form-label">Drop Off Date</label>
                                        <input class="form-control" type="datetimelocal" placeholder="Select DateTime" id="dropoff">
                                    </div>

                                    <script>
                                        config = {
                                            minDate: "today",
                                            enableTime: true,
                                            dateFormat: "Y-m-d H:i",
                                            altInput: true,
                                            altFormat: "F j, Y (h:S K)",
                                        }

                                        flatpickr("input[type=datetimelocal]", config);
                                    </script>

                                    <div class="m-2 col">
                                        <label for="exampleInputEmail1" class="form-label">Type</label>
                                        <select class="form-select" name="type" id="type-select">
                                            <option value="">Select Type</option>
                                            <?php
                                            include ('connect.php');
                                                // Retrieve options from the database
                                                $query = "SELECT DISTINCT type FROM vehicle";
                                                $result = $conn->query($query);
                                                if ($result) {
                                                    // Loop through the results and populate the select options
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<option value=$row[type]>$row[type]</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div style="">
                                    <center>
                                        <button type="submit" name="submit" class="btn btn-primary mt-3 fs-5 fw-bold">Find Availability</button>
                                    </center>
                                </div>
                            </form>
                            <!-- ################ -->
                            <!-- ################ -->
                    </div>
                </div>
                </div>


                <div class="row">
                <?php
                    // Step 1: Connect to the Database
                    include('connect.php'); // Include the file containing database connection code

                    // Step 2: Retrieve Data from the Database
                    $query = "$myqry"; // SQL query to select all columns from the vehicles table
                    $result = mysqli_query($conn, $query); // Execute the query

                    // Step 3: Check for Errors and Fetch Data
                    if ($result) {
                        // Step 4: Loop through fetched rows
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Step 5: Display Data
                            ?>
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-5">
                                <a href="user_view.php?car_id=<?php echo $row['car_id']; ?>&id=<?php echo $user_id; ?>">
                                <div class="bg-white rounded shadow-sm p-1" style="">
                                    <img src="assets/vehicle/<?php echo $row['image']; ?>" alt="" class="img-fluid card-img-top">
                                    
                                    <div class="">
                                            <!-- <h5><a href="view_vehicle.php?car_id=<?php echo $row['car_id']; ?>" class="text-dark"><?php echo $row['name']; ?></a></h5> -->
                                            <a href="user_view.php?car_id=<?php echo $row['car_id']; ?>&id=<?php echo $user_id; ?>">

                                            <div class="container-fluid" style="">
                                                <?php
                                                    echo "
                                                    <span class='fs-4 fw-bold mb-5'>$row[name]</span><br>
                                                    <span class='text-decoration-underline fs-4 fw-bold'>Cost: </span> <span class='text-decoration-underline fs-4'>₱$row[cost] / day</span> <br>                        
                                                    <span class='fs-6 fw-bold text-decoration-none'>Type: </span> <span class='fs-6'>$row[type]</span><br>
                                                    <span class='fs-6 fw-bold'>Capacity: </span> <span class='fs-6'>$row[capacity]</span> <br>
                                                    <span class='fs-6 fw-bold'>Transmission: </span> <span class='fs-6'>$row[transmission]</span> <br>
                                                    <span class='fs-6 fw-bold'>Fuel: </span> <span class='fs-6'>$row[fuel]</span><br>
                                                    ";
                                                ?>
                                                <a href="user_view.php?car_id=<?php echo $row['car_id']; ?>&id=<?php echo $user_id; ?>" class="btn btn-primary my-3" style="width: 100%">Book Now</a>
                                            </div>

                                            
                                            <!-- Other vehicle information can be displayed here -->
                                        </div>

                                </div></a>
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

    <!-- <footer class="text-white" style="background-color: #0B3C5D;">
        Grid container
        <div class="container pt-4 d-flex">
            <div class="text-center container-fluid" style="">
                <h1 class="mb-3">Contact Us</h1>
                <div>
                    <img src="assets/phone.png" alt="phone.png" style="height: 25px;">
                    <span class="me-5">+63 123 9876 45</span>
                    <img src="assets/mail.png" alt="mail.png" style="height: 25px;">
                    <span>rac@mail.com</span>
                </div>
            </div>


            
            Section: Social media
            <div class="container-fluid" style="">
            <section class="mb-4 mt-4 mx-auto">
            Facebook
            <a
                class="btn btn-link btn-floating btn-lg ccm-1"
                style="color: white; background: white"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fa fa-facebook-f"></i
            ></a>

            Twitter
            <a
                class="btn btn-link btn-floating btn-lg text-dark m-1"
                style="color: white; background: white"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fa fa-twitter"></i
            ></a>

            Google
            <a
                class="btn btn-link btn-floating btn-lg text-dark m-1"
                style="color: white; background: white"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fa fa-google"></i
            ></a>

            Instagram
            <a
                class="btn btn-link btn-floating btn-lg text-dark m-1"
                style="color: white; background: white"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fa fa-instagram"></i
            ></a>

            Linkedin
            <a
                class="btn btn-link btn-floating btn-lg text-dark m-1"
                style="color: white; background: white"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fa fa-linkedin"></i
            ></a>
            Github
            <a
                class="btn btn-link btn-floating btn-lg text-dark m-1"
                style="color: white; background: white"
                href="#!"
                role="button"
                ><i class="fa fa-github"></i
            ></a>
            </section>
            </div>
            Section: Social media
        </div>
        Grid container

        Copyright
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2024 Copyright:
            <a class="" href="#" style="color: white;">rentacar.com</a>
        </div>
        Copyright
        </footer> -->

        <!-- End demo content -->
        </div>


</body>
</html>