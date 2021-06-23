<?php

$atsakymas = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Change this to your connection info.
$DATABASE_HOST = '';
$DATABASE_USER = '';
$DATABASE_PASS = '';
$DATABASE_NAME = '';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
	
	if($_POST['password'] != $_POST['password2'])
	{
	echo json_encode(array('atsakymas' => 'Suvesti slaptažodžiai ne vienodi!'));
	exit();	
	}
	
	if($_POST['tikras_kodas'] != "'".$_POST['kodas']."'")
	{
	echo json_encode(array('atsakymas' => 'CAPTCHA atsakyta neteisingai!'));
	exit();	
	}
	
	if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
	echo json_encode(array('atsakymas' => 'Slaptažodis privalo būti nuo 5 iki 20 simbolių!'));
	exit();
	}
	
	if (preg_match('/[^A-Za-z0-9]+/', $_POST['username'])) {
	echo json_encode(array('atsakymas' => 'Netinkamas prisijungimo vardas!'));
    exit();
	}
	
	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	echo json_encode(array('atsakymas' => 'Netinkama El. Pašto forma!'));
	exit();
	}

	if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		$atsakymas = 'Vartotojo vardas jau užimtas!';
	}else {
		// username,email doesnt exists, insert new account
if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)')) {
	// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
	$stmt->execute();
	$atsakymas = 'Jūsų registracija buvo sėkminga! <br>Norint prisijungti spauskite <a href="login.php"><b>čia</b></a><br><br><br>';
	
	mysqli_query($con,"INSERT INTO accounts_profile (account_id) SELECT id FROM accounts WHERE username='".$_POST['username']."'");
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	$atsakymas = 'Could not prepare statement!';
}
	$stmt->close();
	mysqli_close($con);
}
	}else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	$atsakymas = 'Could not prepare statement!';
}

$con->close();
}
echo json_encode(array('atsakymas' => $atsakymas));


?>