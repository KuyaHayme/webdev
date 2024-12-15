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
            header('location: rent_a_car/users.php');
            exit;
        }

        $id = $_GET['id'];
        $qry = "SELECT * FROM users WHERE id = $id";
        $result = $conn->query($qry);
        $row = $result->fetch_assoc();

        while(!$row) {
            header('location: rent_a_car/users.php');
            exit;
        }

        $name = $row['name'];
        $email = $row['email'];
        $contact = $row['contact'];
        $password = $row['password'];
    }
    else {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $password = $_POST['password'];

        $qry = "UPDATE users SET name='$name', email='$email', contact='$contact', password='$password' WHERE id='$id'";
        $result = $conn->query($qry);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</head>

<body>
    <div>
        <form method="post">

            <div>
                <h1>Edit</h1>
            </div>

            <input type="hidden" type="id" name='id' value="<?php echo $id ?>" class="form-control">

            <div>
                <label for="name">Name</label>
                <input type="text" value="<?php echo $name ?>" id="name" name="name">
            </div>

            <div>
                <label for="email">Email</label>
                <input type="text" value="<?php echo $email ?>" id="email" name="email">
            </div>

            <div>
                <label for="contact">Contact</label>
                <input type="text" value="<?php echo $contact ?>" id="contact" name="contact">
            </div>

            <div>
                <label for="about">Password</label>
                <input type="text" value="<?php echo $password ?>" id="password" name="password">
            </div>

            <div>
                <button name="submit">Submit</button>
            </div>

            <div>
                <a class="btn btn-info" type="submit" name="cancel" href="users.php"></a>
            </div>
        </form>
    </div>
</body>
</html>