<!DOCTYPE html>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Vartotojo prisijungimas</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="stilius.css" rel="stylesheet" type="text/css">
		<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	</head>
	<body>
	<center>
		<img src="./images/logo.png" width="100" height="100" alt="" loading="lazy" style="margin-bottom: 5px; margin-top:80px;">
	</center>
	
		<div class="register">
			<h1>Vartotojo prisijungimas</h1>
			<form enctype="multipart/form-data" method="POST">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Prisijungimo vardas" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Slaptažodis" id="password" required>
				<br><center>
				<p id="demo"><a href="forget.php" style="text-decoration: none!important; color:#5b6574;">Pamiršau slaptažodį / Prisijungimo vardą</a><br><br><a href="register.php" style="text-decoration: none!important; color:#5b6574;">Noriu susikurti naują paskyrą</a></p>
				<br></center>
				<input type="button" id="submit" name="submit" value="Prisijungti">
			</form>
		</div>
<script type="text/javascript">

    $(document).ready(function(){
        $("#submit").click(function(){
            $.ajax({
                type: 'POST',
                url: 'login_script.php',
				data: {
				username: $('#username').val(),password: $('#password').val()},
				dataType : 'json',
                success: function(data) {
					console.log(data);
					console.log(data.atsakymas);
					atsakymas = data.atsakymas;
					if(atsakymas == 'prisijungta')
					{
						document.getElementById("demo").innerHTML = "Jums sėkmingai pavyko prisijungti!";
						window.location.replace("index.php");
						window.location.href = "index.php";
					}
					else
					{
						document.getElementById("demo").innerHTML = "Deja, bet prisijungimo duomenys yra neteisingi.";
					}	
                }
				
            });
   });
});
</script>
		
	</body>
</html>