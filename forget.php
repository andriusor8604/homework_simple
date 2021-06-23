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
	
		<div class="register">
			<h1>Paskyros susigrąžinimas</h1>
			<form enctype="multipart/form-data" method="POST">
				<label for="email" name="label_email" id="label_email">
					<i class="fas fa-envelope"></i>
				</label>
				<input type="email" name="email" placeholder="El. Paštas" id="email" required>
				<label id="label_kodas" for="kodas" style="width: 50px;height: 200px;">
					<i class="fas fa-key"></i>
				</label>
				<?php echo '<img id="capta" style="width: 310px;height:150px;position:relative;" src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA code"></img>'; ?></input>
				<input type="text" name="kodas" placeholder="CAPTCHA" id="kodas" style="position:relative;left: 25px;bottom: 50px;" required>
				<center>
				<p id="demo">Prašome užpildyti visus pateiktus laukelius, tam jog galėtume jums išsiųsti paskyros susigrąžinimo nuorodą.</p>
				<br></center>
				<input type="button" id="submit" name="submit" value="Susigrąžinti paskyrą">
			</form>
		</div>
		<input type="hidden" id="tikras_kodas" name="tikras_kodas" value="'<?=$_SESSION['captcha']['code']?>'">
<script type="text/javascript">

    $(document).ready(function(){
        $("#submit").click(function(){
            $.ajax({
                type: 'POST',
                url: 'forget_script.php',
				data: {
				email: $('#email').val(), tikras_kodas: $('#tikras_kodas').val(), kodas: $('#kodas').val()},
				dataType : 'json',
                success: function(data) {
						document.getElementById("demo").innerHTML = data.atsakymas;
						if(data.atsakymas != "<center>Kažkas nepavyko!<br>Prašome pabandyti dar kartą.</center>" && data.atsakymas != "CAPTCHA atsakyta neteisingai!" && data.atsakymas != "Netinkama El. Pašto forma!")
						{
							document.getElementById('email').style.visibility = 'hidden';
							document.getElementById('email').style.display = 'none';
							document.getElementById('label_email').style.visibility = 'hidden';
							document.getElementById('label_email').style.display = 'none';
							document.getElementById('submit').style.visibility = 'hidden';
							document.getElementById('submit').style.display = 'none';
							document.getElementById('kodas').style.visibility = 'hidden';
							document.getElementById('kodas').style.display = 'none';
							document.getElementById('capta').style.visibility = 'hidden';
							document.getElementById('capta').style.display = 'none';
							document.getElementById('label_kodas').style.visibility = 'hidden';
							document.getElementById('label_kodas').style.display = 'none';
						}
                }
				
            });
   });
});
</script>
		
	</body>
</html>