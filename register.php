<?php
    include ('connect.php');
    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $password = $_POST['password'];
        $qry = "INSERT INTO `users` (`name`, `email`, `contact`, `password`) VALUES ('$name', '$email', '$contact', '$password')";

        $query = mysqli_query($conn,$qry);
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
    
    <style>
        body {
            background: #EFEFEF;
        }
    </style>
</head>

<body>
    <div>
        <form method="post">
            <div>
                <h1>Register</h1>
            </div>

            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name">
            </div>

            <div>
                <label for="email">Email</label>
                <input type="text" id="email" name="email">
            </div>

            <div>
                <label for="contact">Contact</label>
                <input type="text" id="contact" name="contact">
            </div>

            <div>
                <label for="about">Password</label>
                <input type="text" id="password" name="password">
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