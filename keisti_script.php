<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$atsakymas = "";
$duombazes_password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	if (strlen($_POST['newpassword1']) > 20 || strlen($_POST['newpassword1']) < 5) {
	echo json_encode(array('atsakymas' => '<center>Naujas slaptažodis privalo būti nuo 5 iki 20 simbolių!</center>'));
	$con->close();
	exit();
	}
	if (strlen($_POST['newpassword2']) > 20 || strlen($_POST['newpassword2']) < 5) {
	echo json_encode(array('atsakymas' => '<center>Naujas slaptažodis privalo būti nuo 5 iki 20 simbolių!</center>'));
	$con->close();
	exit();
	}
		
// Change this to your connection info.
$DATABASE_HOST = '';
$DATABASE_USER = '';
$DATABASE_PASS = '';
$DATABASE_NAME = '';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

$sql5 = "SELECT password FROM accounts WHERE username='".$_POST['nickname']."'";
			$result = $con->query($sql5);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					
					if (!password_verify($_POST['oldpassword'], $row['password'])) {
					echo json_encode(array('atsakymas' => '<center>Senas slaptažodis įvestas neteisingai!</center>'));
					$con->close();
					exit();
					}
				}
			}


$sql = "UPDATE accounts SET password='".password_hash($_POST['newpassword1'], PASSWORD_DEFAULT)."' WHERE username='".$_POST['nickname']."'";
mysqli_query($con, $sql);

            $atsakymas = "<center>Slaptažodis sėkmingai pakeistas!</center>";
	
$con->close();
}
echo json_encode(array('atsakymas' => $atsakymas));

?>