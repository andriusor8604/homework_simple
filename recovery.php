<!DOCTYPE html>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_GET['hash'] != "") {

$DATABASE_HOST = '';
$DATABASE_USER = '';
$DATABASE_PASS = '';
$DATABASE_NAME = '';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);


$sql = "SELECT username FROM accounts WHERE hash='".$_GET['hash']."'";
	$result = $con->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$nickname = $row["username"];
		}
	}else
	{
		header("Location: index.php");
		die();
	}


?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Paskyros susigrąžinimas</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="stilius.css" rel="stylesheet" type="text/css">
		<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	</head>
	<body>
	<center>
		<img src="./images/logo.png" width="100" height="100" alt="" loading="lazy" style="margin-bottom: 5px; margin-top:80px;">
	</center>
		<input id="hash" name="hash" value="<?=$_GET['hash']?>" hidden>
		<div class="register">
			<h1>Paskyros susigrąžinimas</h1>
			<form enctype="multipart/form-data" method="POST">
				<label for="username" id="label_user" name="label_user">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="<?=$nickname?>" id="username" disabled>
				<label for="password" id="label_pw" name="label_pw">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Slaptažodis" id="password" required>
				<label for="password2" id="label_pw2" name="label_pw2">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password2" placeholder="Pakartokite slaptažodį" id="password2" required>
				<center>
				<p id="demo"><br>Prašome įvesti naująjį slaptažodį kurį naudosite prisijungiant į šią paskyrą.</p>
				<br></center>
				<input type="button" id="submit" name="submit" value="Pakeisti slaptažodį">
			</form>
		</div>
<script type="text/javascript">

    $(document).ready(function(){
        $("#submit").click(function(){
            $.ajax({
                type: 'POST',
                url: 'recovery_script.php',
				data: {
				password: $('#password').val(), hash: $('#hash').val(), password2: $('#password2').val()},
				dataType : 'json',
                success: function(data) {
						document.getElementById("demo").innerHTML = data.atsakymas;
						
						if(data.atsakymas == "<center>Slaptažodis sėkmingai pakeistas!<br>Norėdami prisijungti spauskite <a href='login.php'>čia</a></center>")
						{
							document.getElementById('password').style.visibility = 'hidden';
							document.getElementById('password').style.display = 'none';
							document.getElementById('label_pw').style.visibility = 'hidden';
							document.getElementById('label_pw').style.display = 'none';
							document.getElementById('submit').style.visibility = 'hidden';
							document.getElementById('submit').style.display = 'none';
							document.getElementById('username').style.visibility = 'hidden';
							document.getElementById('username').style.display = 'none';
							document.getElementById('label_user').style.visibility = 'hidden';
							document.getElementById('label_user').style.display = 'none';
							document.getElementById('password2').style.visibility = 'hidden';
							document.getElementById('password2').style.display = 'none';
							document.getElementById('label_pw2').style.visibility = 'hidden';
							document.getElementById('label_pw2').style.display = 'none';
						} else
						{
							document.getElementById('password').style.visibility = 'visible';
							document.getElementById('label_pw').style.visibility = 'visible';
						}
						
						
                }
				
            });
   });
});
</script>
		
<?php
}
$con->close();
?>
	</body>
</html>