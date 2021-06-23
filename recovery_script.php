<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$atsakymas = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
	echo json_encode(array('atsakymas' => 'Slaptažodis privalo būti nuo 5 iki 20 simbolių!'));
	exit();
	}
	
	if($_POST['password'] != $_POST['password2'])
	{
	echo json_encode(array('atsakymas' => 'Suvesti slaptažodžiai ne vienodi!'));
	exit();	
	}
	
	
// Change this to your connection info.
$DATABASE_HOST = '';
$DATABASE_USER = '';
$DATABASE_PASS = '';
$DATABASE_NAME = '';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "UPDATE accounts SET password='".$password."', hash='' WHERE hash='".$_POST['hash']."'";
mysqli_query($con, $sql);

            $atsakymas = "<center>Slaptažodis sėkmingai pakeistas!<br>Norėdami prisijungti spauskite <a href='login.php'>čia</a></center>";
	
$con->close();
}
echo json_encode(array('atsakymas' => $atsakymas));

?>