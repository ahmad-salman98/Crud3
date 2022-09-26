<?php
require_once("connection.php");
// require_once("landing.php");
session_start();
$name = $_SESSION['username'];
echo "<h1> Welcome $name";
