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

    function mySelect($mycategory, $custom_input) {
        echo ("
            <script>
            document.getElementById('$mycategory').addEventListener('change', function() {
                var select = this;
                var customInput = document.getElementById('$custom_input');
                if (select.value === '') {
                    customInput.style.display = 'block';
                } else {
                    customInput.style.display = 'none';
                }
            });
            </script>
            ");
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
            header('location: manage_car.php');
            exit;
        }

        $car_id = $_GET['car_id'];
        $qry = "SELECT * FROM vehicle WHERE car_id = $car_id";
        $result = $conn->query($qry);
        $row = $result->fetch_assoc();

        while(!$row) {
            header('location: vehicle.php');
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
        header('location: vehicle.php');
        exit;
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
    <h1 class="mb-4"><?php echo $name ?></h1>
    <form id="innerLog" method="post">
     
    <input type="hidden" type="id" name='car_id' value="<?php echo $car_id ?>" class="form-control">

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Type</label>
            <select class="form-select" name="type" id="type-select">
                <option value="<?php echo $row['type']; ?>"><?php echo $row['type']; ?></option>
                <?php
                    // Retrieve the value to display from the database
                    $selected_value = ''; // Retrieve your selected value from the database

                    // Query to fetch options from the database
                    $query = "SELECT DISTINCT type FROM vehicle";
                    $result = $conn->query($query);

                    // Check if query executed successfully
                    if ($result) {
                        // Loop through the results and populate the select options
                        while ($row = $result->fetch_assoc()) {
                            // Check if the current option's value matches the selected value
                            $selected = ($row['type'] == $selected_value) ? 'selected' : '';

                            // Output the option with the selected attribute if it matches
                            echo '<option value="' . $row['type'] . '" ' . $selected . '>' . $row['type'] . '</option>';
                        }
                    }
                    ?>
                <option value="">Custom Input</option>
            </select>
            <input type="text" class="form-control" id="customType" style="display: none;">

            <?php
                echo mySelect('type-select', 'customType');
            ?>

            <script>
                // Function to update the select option based on the custom input value
                function updateSelect() {
                    var customTypeValue = document.getElementById('customType').value;
                    var select = document.getElementById('type-select');

                    // Get the option that represents the custom input
                    var customOption = select.querySelector('option[value=""]');

                    // Update the value of the custom option
                    if (customOption) {
                        customOption.value = customTypeValue;
                        customOption.text = customTypeValue;
                    }
                }

                // Add event listener to the custom input to update the select on change
                document.getElementById('customType').addEventListener('change', updateSelect);
            </script> 
        </div>


            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Capacity</label>
                <input type="text" class="form-control" id="capacity" name="capacity" value="<?php echo $capacity ?>">
            </div>




        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Transmission</label>
            <select class="form-select" name="transmission" id="transmission-select">
            <option value="<?php echo $transmission ?>"><?php echo $transmission ?></option>
                <?php
                include ('connect.php');
                    // Retrieve the value to display from the database
                    $selected_value = ''; // Retrieve your selected value from the database

                    // Query to fetch options from the database
                    $query = "SELECT DISTINCT transmission FROM vehicle";
                    $result = $conn->query($query);

                    // Check if query executed successfully
                    if ($result) {
                        // Loop through the results and populate the select options
                        while ($row = $result->fetch_assoc()) {
                            // Check if the current option's value matches the selected value
                            $selected = ($row['transmission'] == $selected_value) ? 'selected' : '';

                            // Output the option with the selected attribute if it matches
                            echo '<option value="' . $row['transmission'] . '" ' . $selected . '>' . $row['transmission'] . '</option>';
                        }
                    }
                    ?>
                <option value="">Custom Input</option>
            </select>
            <input type="text" class="form-control" id="customTransmission" style="display: none;">

            <?php
                echo mySelect('transmission-select', 'customTransmission');
            ?>

            <script>
                // Function to update the select option based on the custom input value
                function updateSelect() {
                    var customTransmissionValue = document.getElementById('customTransmission').value;
                    var select = document.getElementById('transmission-select');

                    // Get the option that represents the custom input
                    var customOption = select.querySelector('option[value=""]');

                    // Update the value of the custom option
                    if (customOption) {
                        customOption.value = customTransmissionValue;
                        customOption.text = customTransmissionValue;
                    }
                }

                // Add event listener to the custom input to update the select on change
                document.getElementById('customTransmission').addEventListener('change', updateSelect);
            </script> 
        </div>


        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Fuel</label>
            <select class="form-select" name="fuel" id="fuel-select">
                <option value="<?php echo $fuel ?>"><?php echo $fuel ?></option>
                <?php
                    // Retrieve the value to display from the database
                    $selected_value = ''; // Retrieve your selected value from the database

                    // Query to fetch options from the database
                    $query = "SELECT DISTINCT fuel FROM vehicle";
                    $result = $conn->query($query);

                    // Check if query executed successfully
                    if ($result) {
                        // Loop through the results and populate the select options
                        while ($row = $result->fetch_assoc()) {
                            // Check if the current option's value matches the selected value
                            $selected = ($row['fuel'] == $selected_value) ? 'selected' : '';

                            // Output the option with the selected attribute if it matches
                            echo '<option value="' . $row['fuel'] . '" ' . $selected . '>' . $row['fuel'] . '</option>';
                        }
                    }
                    ?>
                <option value="">Custom Input</option>
            </select>
            <input type="text" class="form-control" id="customFuel" style="display: none;">

            <?php
                echo mySelect('fuel-select', 'customFuel');
            ?>

            <script>
                // Function to update the select option based on the custom input value
                function updateSelect() {
                    var customFuelValue = document.getElementById('customFuel').value;
                    var select = document.getElementById('fuel-select');

                    // Get the option that represents the custom input
                    var customOption = select.querySelector('option[value=""]');

                    // Update the value of the custom option
                    if (customOption) {
                        customOption.value = customFuelValue;
                        customOption.text = customFuelValue;
                    }
                }

                // Add event listener to the custom input to update the select on change
                document.getElementById('customFuel').addEventListener('change', updateSelect);
            </script>           
        </div>
        

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Cost</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="cost" value="<?php echo $cost ?>">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1" class="form-label">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">
                    <?php echo $description; ?>
                </textarea>
            </div>

            <div class="form-group mt-4">
            <div class="col-md-5 mb-2">
                <label for="" class="control-label mb-2">Car Image</label>
                <input type="file" class="form-control" name="image" id="imageInput">
            </div>

            <div class="col-md-5">
                <img class="img-fluid" src="../assets/vehicle/<?php
                include ('connect.php');
                $table = "vehicle";
                $id = $car_id;
                $column = "image";  
                $img_path = "";   
                $qry = "SELECT * FROM $table WHERE car_id = $id";
                $results = $conn->query($qry);

                if (!$results) {
                    die("Invalid query: " .$conn->error);
                }

                while ($row = $results->fetch_assoc()) {
                    $img_path = "$row[$column]";
                }
                echo $img_path ?>" alt="" id="imgPreview">
            </div>
            </div>


                    <button type="submit" class="btn btn-success mt-5">Save</button>
                    <a href="vehicle.php" class="btn btn-danger mt-5 ms-2">Cancel</a>
            </form>
        <!-- End demo content -->
    </div>
</body>
</html>