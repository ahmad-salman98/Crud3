<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0a9ca5a95a.js" crossorigin="anonymous"></script>
    <title>Document</title>
    <link rel="stylesheet" href="signup.css">
</head>


<body>


    <div class="welcome container row">
        <div>
            <div>
                <form action="" method="POST">
                    <button type="submit" name="back" class="back"> <i class="fa-solid fa-backward-step"></i> </button>
                </form>
            </div>
            <h1 class="col-md-12 text-center ">
                Sign Up
            </h1>
            <h5 class="text-center col-md-12>">
                Create an account, its free! </h5>
            <form action="signup.php" method="POST">
                <label for="name">Full name</label>
                <input type="text" name="userName" value="<?php if (isset($_POST['userName'])) echo $_POST['userName'] ?>" id="name" required placeholder="Your first and last name">

                <label for="email">Email</label>
                <input type="email" name="userEmail" value="<?php if (isset($_POST['userEmail'])) echo $_POST['userEmail'] ?>" id="email" required placeholder="Enter your email here">

                <label for="password">Password</label>
                <input type="password" name="userPassword" id="password" required placeholder="Enter your password here">
                <label for="confirmPassword" id="">Confirm Password</label>
                <input type="password" name="confirmPassword" id="confirmPassword" required placeholder="Confirm your password">

                <div class="row phoneAndDate ">
                    <div class="col-md-6  m-0 phone">
                        <label for="phone">Phone number</label>
                        <input type="tel" maxlength="14" name="userPhone" value="<?php if (isset($_POST['userPhone'])) echo $_POST['userPhone'] ?>" id="phone" required placeholder="Enter your phone number here">
                    </div>
                    <div class="col-md-6 m-0 date">
                        <label for="BD">Date of Birth</label>
                        <input type="date" name="userBd" value="<?php if (isset($_POST['userBd'])) echo $_POST['userBd'] ?>" id="BD" required>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary rounded-pill sbmtBtn" name="signUp" value="Sign Up">
            </form>


            <p class="text-center"> Already have an account? <a href="login.php" id="toLogin"> <b>Login</b></a></p>
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
if (isset($_POST['signUp'])) {

    $name = $_POST['userName'];
    $pass = $_POST['userPassword'];
    $email = $_POST['userEmail'];
    $mobile = $_POST['userPhone'];
    $dob = $_POST['userBd'];
    $passConf = $_POST['confirmPassword'];

    if (checkName($name) && checkPass($pass, $passConf) && checkPhone($mobile) && checkUserAge($age)) {
        // prepare and bind
        $stmt = $conn->prepare("INSERT INTO users (name, email, pass,mobile,dob) VALUES (:name, :email, :pass, :mobile, :dob)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':dob', $dob);
        $stmt->execute();
        session_start();
        $_SESSION['username'] = $user['name'];

        header("Location:index.php");
    }
}

// Checking functions 


function checkName($name)
{
    $pattern = '/(^[a-zA-Z][a-zA-Z\s]{0,20}[a-zA-Z]$)/';
    if (preg_match($pattern, $name))
        return true;
    else {
        wrongName();
        return false;
    }
}

function checkPass($pass, $confPass)
{
    if ($pass === $confPass) {
        $pattern =  "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$^";
        if (preg_match($pattern, $pass)) {
            return true;
        } else {
            wrongPass();
            return false;
        }
    } else {
        wrongPassConf();
        return false;
    }
}

function checkPhone($phone)
{
    $pattern = '/^\+?[1-9][0-9]{7,14}$/';
    if (preg_match($pattern, $phone)) {
        return true;
    } else {
        wrongPhone();
        return false;
    }
}

function checkUserAge($age)
{
    echo gettype($age);
    $today = date("Y-m-d");
    $diff = date_diff(date_create($age), date_create($today));
    if ($diff->format('%y') > 16) {
        return true;
    } else {
        wrongAge();
        return false;
    }
}



function wrongName()
{
    echo '<script>alert("only letters and white spaces are allowed")</script>';
?>

    <head>
        <style>
            #name {
                border: 1.3px red solid;
            }
        </style>
    </head>

<?php
}


function wrongPhone()
{
    echo '<script>alert("Wrond phone number")</script>';
?>

    <head>
        <style>
            #phone {
                border: 1.3px red solid;
            }
        </style>
    </head>

<?php
}



function wrongPass()
{
    echo '<script>alert("Password should contain upper and lower letters, one special letter, and minimum of 8 charecters")</script>';
?>

    <head>
        <style>
            #password {
                border: 1.3px red solid;
            }
        </style>
    </head>

<?php
}

function wrongPassConf()
{
    echo '<script>alert("poasswords do not match")</script>';
?>

    <head>
        <style>
            #confirmPassword {
                border: 1.3px red solid;
            }
        </style>
    </head>

<?php
}

function wrongAge()
{
    echo '<script>alert("You are under the allowed age")</script>';
?>

    <head>
        <style>
            #userBd {
                border: 1.3px red solid;
            }
        </style>
    </head>

<?php

}

?>