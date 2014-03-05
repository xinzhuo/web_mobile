<?php

$db_host = 'stardock.cs.virginia.edu';
$db_user = 'cs4720sz4fb';
$db_pass = 'zsh210';
$db_name = 'cs4720sz4fb';

$con =mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if ($con->connect_error)
{
    echo "NOOOO";
    die('Connect Error (' . $con->connect_errno . ') ' . $con->connect_error);
}
else
{

$name = $_GET['name'];
$password = $_GET['password'];
$email = $_GET['email'];



$sql="INSERT INTO projectuser (username, password, nickname, question_num)
VALUES
('$email', '$password', '$name','1')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
echo "1 record added";

}
mysqli_close($con);
$home_url = 'index.php';
header('Location:'.$home_url);
?>