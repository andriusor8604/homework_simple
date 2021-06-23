<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Change this to your connection info.
$DATABASE_HOST = '';
$DATABASE_USER = '';
$DATABASE_PASS = '';
$DATABASE_NAME = '';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
$atsakymas = "neprisijungta";
$string = $_POST['username'];
$string2 = $_POST['password'];

$sql = "SELECT * FROM accounts WHERE username='".$_POST['username']."'";
	$result = $con->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			
			if(password_verify($_POST["password"], $row["password"]))
			{
				$atsakymas = "prisijungta";
				$_SESSION['loggedin'] = true;
				$_SESSION['username'] = $string;
				setcookie("username", $string, time() + 86400, "/");
				setcookie("loggedin", true, time() + 86400, "/");
			}
			else
			{
				$atsakymas = "neprisijungta";
			}
		}
	} else
	{
		$atsakymas = "neprisijungta";
	}
	
	$con->close();
}
echo json_encode(array('atsakymas' => $atsakymas));

?>