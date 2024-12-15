<?php
include ('connect.php');

// Handle form submission
if(isset($_POST['submit'])) {
    // Retrieve the selected type from the form
    $type = $_POST['type'];
    // Redirect to available.php with the selected type as a parameter
    header("location: available.php?type=$type&id=$user_id");
    exit;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   
    
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

        #map {
    border: 2px solid #0B3C5D;
    border-radius: 10px;
    overflow: hidden;
    height: 400px;
    margin: 20px 0;
}

        

        .branch-list {
            list-style-type: none;
            padding: 0;
        }

        .branch-list li {
            margin: 15px 0;
        }

        .branch-list a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0B3C5D;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .branch-list a:hover {
            background-color: #007BFF;
        }

    </style>
    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

<body>

<!-- HTML -->
<script>document.getElementById('modalTrigger').click();</script>

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

    <div id="front">

<!-- Button trigger modal -->
<button style="display: none;" type="hidden" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" id="modalTrigger">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Reminder</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Please select pickup date, dropoff date, and type of car.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

        <?php 
            $media = scandir('assets/media/');
                foreach($media as $k=> $fname){
                    if(in_array($fname,array('.','..'))){
                        unset($media[$k]);
                    }
                }
                if(count($media) > 0):
		?>

        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                    $i = 0 ;
                    foreach($media as $fname):
                        $active = ($i == 0) ? 'active' : '';
                        $i++;
				?>

                    <div class="carousel-item <?php echo $active ?>" id="myCarousel">
						<img class="d-block w-100" src="assets/media/<?php echo $fname ?>" alt="">
					</div>

                    <!-- ############ -->
                    <!-- ############ -->
                <div class="page-content p-5 rounded" id="content" style="color: white; position: absolute; background: #0B3C5D2A; top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);">
                        
                    <!-- Demo content -->

                    <h1 class="text-center mb-3">Welcome to <?php echo getOne('system', '1', 'name'); ?></h1>

                    <div id="dateTime">
                        <form method="post" style="">
                            <div class="flatpickr page-title" style="display: flex;">
                                <div class="m-1 container-fluid text-center" id="myDate">
                                    <label for="exampleInputEmail1" class="form-label">Pickup Date</label>
                                    <input class="form-control" type="datetimelocal" placeholder="Select DateTime" id="pickup" name="pickup">
                                </div>

                                <div class="m-1 container-fluid text-center">
                                    <label for="exampleInputEmail1" class="form-label">Drop Off Date</label>
                                    <input class="form-control" type="datetimelocal" placeholder="Select DateTime" id="dropoff" name="dropoff">
                                </div>

                                <div class="m-1 container-fluid text-center">
                                    <label for="exampleInputEmail1" class="form-label">Type</label>
                                    <select class="form-select" name="type" id="type-select" required>
                                        <option value="Select Type">Select Type</option>
                                        <?php
                                            // Retrieve options from the database
                                            $query = "SELECT DISTINCT type FROM vehicle";
                                            $result = $conn->query($query);
                                            if ($result) {
                                                // Loop through the results and populate the select options
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<option value="' . $row['type'] . '">' . $row['type'] . '</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            

                            <div style="">
                                <center>
                                    <button type="submit" name="submit" class="btn btn-primary mt-4 fs-5 fw-bold">Find Availability</button>
                                </center>
                                <script>
                                    function myPick() {
                                        $(document).ready(function(){
                                            $('#exampleModal').modal('show');
                                        });
                                    }                              
                                </script>                               
                            </div>
                        </form>

                        <script>
                            
                            config = {    
                                minDate: "today",                         
                                enableTime: true,
                                dateFormat: "Y-m-d H:i",
                                altInput: true,
                                altFormat: "F j, Y (h:S K)",
                            }

                            flatpickr("input[type=datetimelocal]", config);
                            /*flatpickr("input[type=datetimelocal]", {wrap: true});*/
                        </script>

                        
                    </div>


                    <!-- End demo content -->
                </div>
                    <!-- ############ -->
                    <!-- ############ -->

                <?php endforeach; ?>
            </div>
        </div>

        <?php endif; ?>


    </div>
    
    <!-- ####################### -->

    <div id="content">
        <div class="container-fluid">
            <div class="px-lg-5">

                <!-- For demo purpose -->
                <div class="row py-5">
                <div class="col-lg-12 mx-auto">
                    <div class="text-white p-5 shadow-sm rounded banner" style="background: #0B3C5D;">
                    <h1 class="display-4 text-center">Our Vehicles</h1>
                    <p class="lead text-center m-3">Check our group categories </p>
                    </div>
                </div>
                </div>


                <div class="row mb-5">
                <?php
                    // Step 1: Connect to the Database
                    include('connect.php'); // Include the file containing database connection code

                    // Step 2: Retrieve Data from the Database
                    $query = "SELECT * FROM vehicle"; // SQL query to select all columns from the vehicles table
                    $result = mysqli_query($conn, $query); // Execute the query

                    // Step 3: Check for Errors and Fetch Data
                    if ($result) {
                        // Step 4: Loop through fetched rows
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Step 5: Display Data
                            ?>
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                <a href="view_vehicle.php?car_id=<?php echo $row['car_id']; ?>">
                                <div class="bg-white rounded shadow-sm">
                                    <img src="assets/vehicle/<?php echo $row['image']; ?>" alt="" class="img-fluid card-img-top">
                                    <div class="p-4" style="">
                                        <h5 class="text-center fs-2"> <a href="view_vehicle.php?car_id=<?php echo $row['car_id']; ?>" class="text-dark"><?php echo $row['name']; ?></a></h5>
                                        <a href="view_vehicle.php?car_id=<?php echo $row['car_id']; ?>">
                                        <p class="small text-muted mb-0">
                                            <?php echo "
                                                <div class='text-center'>
                                                </span> <span class='text-decoration-underline fs-4 text-center'>₱$row[cost] / day</span> <br>

                                                <span class='fs-6'>• $row[type]</span>

                                                <span class='fs-6 mx-2'>• $row[transmission]</span> <br>
                                                </div>
                                                "; 
                                            ?>
                                        </p></a>
                                        <a href="view_vehicle.php?car_id=<?php echo $row['car_id']; ?>" class="btn btn btn-outline-primary mt-1" style="width: 100%;">View Details</a>
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

            <div class="container">
    <h1>Our Branch Locations</h1>
    <ul class="branch-list">
        <li><a href="https://maps.app.goo.gl/7m4WCnWLHhxtyuzn7" target="_blank"><i class="fa fa-map-marker"></i>Lipa City, Batangas</a></li>
        <li><a href="https://maps.app.goo.gl/84G5BFaYBWub3mDp8" target="_blank"><i class="fa fa-map-marker"></i>Batangas City</a></li>
    </ul>
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
            <a class="text-light" href="#">rentacar.com</a>
        </div>
        <!-- Copyright -->
        </footer>
        
    </div>
        <!-- End of .container -->

        


<!-- JavaScript to trigger modal on page load -->
<!--
<script>
        $(document).ready(function(){
            $('#exampleModal').modal('show');
        });
    </script>
    -->

    
</body>
</html>