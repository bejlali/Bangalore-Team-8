<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
if (empty($_POST['email']) || empty($_POST['password'])) {
$error = "email or Password is empty";
}
else
{
// Define $username and $password
$email=$_POST['email'];
$password=$_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("http://ec2-52-69-232-19.ap-northeast-1.compute.amazonaws.com/", "root", "code4good");
// To protect MySQL injection for Security purpose
$email = stripslashes($email);
$password = stripslashes($password);
$email = mysql_real_escape_string($email);
$password = mysql_real_escape_string($password);
// Selecting Database
$db = mysql_select_db("mysql", $connection);
// SQL query to fetch information of registerd users and finds user match.
$query = mysql_query("select * from registration where password='$password' AND email='$email'", $connection);
$rows = mysql_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$email; // Initializing Session
//header("location:course.php"); // Redirecting To Other Page
} else {
$error = "Email or Password is/are invalid";
header('Location: clientLogin.php');
}
mysql_close($connection); // Closing Connection
}
}
?>
