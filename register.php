<!DOCTYPE html>
<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("simple-php-captcha.php");
$_SESSION['captcha'] = simple_php_captcha();

?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Vartotojo registracija</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="stilius.css" rel="stylesheet" type="text/css">
		<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	</head>
	
	<body>	
	<center>
		<img src="./images/logo.png" width="100" height="100" alt="" loading="lazy" style="margin-top: 42px;">
	</center>
		<div class="register" style="margin-top: 42px;">
			<h1>Vartotojo registracija</h1>
			<form enctype="multipart/form-data" method="POST">
				<label for="username" id="label_username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Prisijungimo vardas" id="username" required>
				<label for="password" id="label_pw">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Slaptažodis" id="password" required>
				<label for="password2" id="label_pw2">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password2" placeholder="Pakartokite slaptažodį" id="password2" required>
				<label for="email" id="label_email">
					<i class="fas fa-envelope"></i>
				</label>
				<input type="email" name="email" placeholder="El. Paštas" id="email" required>
				<label for="kodas" style="width: 50px;height: 200px;" id="label_kodas">
					<i class="fas fa-key"></i>
				</label>
				<?php echo '<img id="kodas_2" style="width: 310px;height:150px;position:relative;" src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA code"></img>'; ?></input>
				<input type="text" name="kodas" placeholder="CAPTCHA" id="kodas" style="position:relative;left: 25px;bottom: 50px;" required>
					<br><center>
						<p id="demo" style="margin:0px;">Prašome užpildyti visus pateiktus laukelius</p>
					</center>
				<input type='button' id='submit' name='submit' value='Registruotis'>
					<!-- CAPTCHA -->
			</form>
		</div>
		<input type="hidden" id="tikras_kodas" name="tikras_kodas" value="'<?=$_SESSION['captcha']['code']?>'">
		<script type="text/javascript">

    $(document).ready(function(){
        $("#submit").click(function(){
            $.ajax({
                type: 'POST',
                url: 'register_script.php',
				data: {
				username: $('#username').val(),password: $('#password').val(), password2: $('#password2').val(), email: $('#email').val(),tikras_kodas: $('#tikras_kodas').val(), kodas: $('#kodas').val()},
				dataType : 'json',
                success: function(data) {
					console.log(data);
					console.log(data.atsakymas);
					document.getElementById("demo").innerHTML = data.atsakymas;
					
					if(data.atsakymas == 'Jūsų registracija buvo sėkminga! <br>Norint prisijungti spauskite <a href="login.php"><b>čia</b></a><br><br><br>')
					{
							document.getElementById('password').style.visibility = 'hidden';
							document.getElementById('password').style.display = 'none';
							document.getElementById('label_pw').style.visibility = 'hidden';
							document.getElementById('label_pw').style.display = 'none';
							document.getElementById('submit').style.visibility = 'hidden';
							document.getElementById('submit').style.display = 'none';
							document.getElementById('username').style.visibility = 'hidden';
							document.getElementById('username').style.display = 'none';
							document.getElementById('password2').style.visibility = 'hidden';
							document.getElementById('password2').style.display = 'none';
							document.getElementById('label_pw2').style.visibility = 'hidden';
							document.getElementById('label_pw2').style.display = 'none';
							document.getElementById('label_kodas').style.visibility = 'hidden';
							document.getElementById('label_kodas').style.display = 'none';
							document.getElementById('kodas').style.visibility = 'hidden';
							document.getElementById('kodas').style.display = 'none';
							document.getElementById('email').style.visibility = 'hidden';
							document.getElementById('email').style.display = 'none';
							document.getElementById('label_email').style.visibility = 'hidden';
							document.getElementById('label_email').style.display = 'none';
							document.getElementById('label_username').style.visibility = 'hidden';
							document.getElementById('label_username').style.display = 'none';
							document.getElementById('kodas_2').style.visibility = 'hidden';
							document.getElementById('kodas_2').style.display = 'none';
					}
                }
				
            });
   });
});
</script>
		
	</body>
</html>