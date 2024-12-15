<?php
include ('connect.php');

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
    
    $user_id = $_GET['id'];
?>

<?php
    include ('connect.php');
    $id = "";
    $name = "";
    $email = "";
    $contact = "";
    $password = "";

    $error = "";
    $success = "";

    if($_SERVER['REQUEST_METHOD']=='GET') {
        if(!isset($_GET['id'])) {
            header('location: system.php');
            exit;
        }

        $id = $_GET['id'];
        $qry = "SELECT * FROM users WHERE id = '$id'";
        $result = $conn->query($qry);
        $row = $result->fetch_assoc();

        while(!$row) {
            header('location: system.php');
            exit;
        }

        $name = $row['name'];
        $email = $row['email'];
        $contact = $row['contact'];
        $password = $row['password'];
    }
    else {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $password = $_POST['password'];

        $qry = "UPDATE users SET name='$name', email='$email', contact='$contact', password='$password' WHERE id=$user_id";
        $result = $conn->query($qry);
        header("location: user_dashboard.php?type=&id=$user_id");
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
        <div class='vertical-nav' id='sidebar'  style="background: #0B3C5D; color: white;">
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
        
        
        <ul class="nav flex-column mb-0"  style="color: white">
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
        <div class="page-content p-5" id="content">
        
        <!-- Demo content -->

        <h1 class="mb-3">MY ACCOUNT</h1>

        <form id="innerLog" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">System Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp" value="<?php echo $name ?>">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Email</label>
                <input type="email" class="form-control" id="exampleInputPassword1" name="email" value="<?php echo $email ?>">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Contact</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="contact" value="<?php echo $contact ?>">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1" class="form-label">About</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="password" value="<?php echo $password ?>">
            </div>

            <button type="submit" name="submit" class="btn btn-success mt-5">Save</button>
            <a href="user_dashboard.php?type=&id=<?php echo $user_id; ?>" class="btn btn-danger mt-5 ms-2">Cancel</a>
        </form>

        

        <!-- End demo content -->
        </div>


</body>
</html>