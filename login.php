<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0a9ca5a95a.js" crossorigin="anonymous"></script>
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>


<body>


    <div class="welcome container row">
        <div>
            <form action="" method="POST">
                <button type="submit" name="back" class="back"> <i class="fa-solid fa-backward-step"></i> </button>
            </form>
        </div>
        <div>
            <h1 class="col-md-12 text-center ">
                Login
            </h1>
            <h5 class="text-center col-md-12>">
                Welcome back! Login with your credentials </h5>
            <form action="" method="POST">
                <label for="email">Email</label>
                <input type="email" name="userEmail" id="email" required placeholder="Enter your email here">

                <label for="password">Password</label>
                <input type="password" name="userPassword" id="password" required placeholder="Enter your password here">

                <input type="submit" class="btn btn-primary rounded-pill sbmtBtn" name="login" value="Login">
            </form>


            <p class="text-center"> Dont have an account? <a href="signup.php" id="toSignUp"> <b>Sign Up</b></a></p>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</body>

</html>
<?php
require_once("connection.php");


if (isset($_POST['back'])) {
    header("Location:landing.php");
}

if (isset($_POST['login'])) {
    $email = $_POST['userEmail'];
    $passowrd = $_POST['userPassword'];
    checkInfo($email, $passowrd);
}

function checkInfo($email, $password)
{
    $status = false;
    $pattern =  "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$^";

    if (preg_match($pattern, $password)) {
        global $conn;
        $getUsers = $conn->prepare("SELECT * FROM users");
        $getUsers->execute();
        $users = $getUsers->fetchAll();
        if (count($users) > 0) {
            foreach ($users as $user) {
                if ($user['pass'] === $password && $user['email'] === $email) {
                    $status = true;
                    session_start();
                    $_SESSION['username'] = $user['name'];
                    header("Location:index.php");
                }
            }
        } else {
            wrongInfo();
            echo "no users found";
        }
    } else {
        wrongInfo();
        echo "wrong pass typing";
    }
    if (!$status) {
        wrongInfo();
    }
}


function wrongInfo()
{
    echo '<script>alert("Wrong email or Password")</script>';


?>

    <head>
        <style>
            #password,
            #email {
                border: 1.3px red solid;
            }
        </style>
    </head>

<?php
    return false;
}


?>