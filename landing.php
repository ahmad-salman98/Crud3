<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0a9ca5a95a.js" crossorigin="anonymous"></script>
    <title>Document</title>
    <link rel="stylesheet" href="landing.css">
</head>


<body>
    <div class="welcome container row">
        <h1 class="col-md-12 text-center ">
            Hello There!
        </h1>
        <h5 class="text-center col-md-12>">
            Automated identity verification which enable you to verify your identity
        </h5>
        <img class="d-block mx-auto col-md-12" src="./imgs/My project.png" alt="Photo">
        <form action="" method="POST">
            <input type="submit" class="btn btn-primary" name="login" value="Login">
            <input type="submit" class="btn btn-danger" name="signup" value="Sign Up">
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</body>

</html>

<?php
require_once("connection.php");


if (isset($_POST['login'])) {
    header("Location:login.php");
}
if (isset($_POST['signup'])) {
    header("Location:signup.php");
}
?>