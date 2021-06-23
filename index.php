<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" integrity="sha512-QKC1UZ/ZHNgFzVKSAhV5v5j73eeL9EEN289eKAEFaAjgAiobVAnVv/AGuPbXsKl1dNoel3kNr6PYnSiTzVVBCw==" crossorigin="anonymous" />
		
		<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/8d3db33563.js" crossorigin="anonymous"></script>
		<title>Žaidėjų pagalbininkas</title>
		<style>
		@import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";
		body {
			font-family: 'Poppins', sans-serif;
			background: #fafafa;
		}
		
		btn:focus, a:focus
		{
			outline: none;
		}
		.navbar-toggler:focus
		{
			outline: none !important;
			box-shadow: none;
		}
		
		.btn:focus
		{
			outline: none !important;
			box-shadow: none;
		}
		.features-icons .features-icons-item .features-icons-icon i {
		font-size: 4.5rem;
		}
		.features-icons {
		padding-top: 7rem;
		padding-bottom: 7rem;
		}
		carousel .item img {
		max-height: 768px !important;
		min-width: auto;
		}
		.carousel-inner{
		width:100%;
		max-height: 500px !important;
		}
		.collapsing {
		-webkit-transition: none;
		transition: none !important;
		display: none;
}
		
		
		</style>
	</head>
<body>
<?php 
$DATABASE_HOST = '';
$DATABASE_USER = '';
$DATABASE_PASS = '';
$DATABASE_NAME = '';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);


if (isset($_COOKIE['loggedin']) && isset($_COOKIE['username']) && $_COOKIE['loggedin'] == true) {
	
	if(isset($_POST["atsijungti"]))
{
	session_destroy();
    unset($_COOKIE['username']);
	unset($_COOKIE['loggedin']);
	setcookie("username", "", time() - 3600, '/');
	setcookie("loggedin", "", time() - 3600, '/');
	header("Location: index.php");
	exit();
}

	if(isset($_POST["naikinti"]))
{
	$sql = "DELETE FROM accounts WHERE username='".$_COOKIE['username']."'";
	mysqli_query($con, $sql);
	session_destroy();
    unset($_COOKIE['username']);
	unset($_COOKIE['loggedin']);
	setcookie("username", "", time() - 3600, '/');
	setcookie("loggedin", "", time() - 3600, '/');
	header("Location: index.php");
	exit();
}



$sql = "SELECT id FROM accounts WHERE username='".$_COOKIE['username']."'";
	$result = $con->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			
			$id = $row['id'];
		}
	}


$sql = "SELECT * FROM accounts_profile WHERE account_id='".$id."'";
	$result = $con->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			
			$username = $_COOKIE['username'];
			$level = $row['level'];
			$xp = $row['xp'];
			$vip = $row['vip'];
		}
	}
	
	
	?>
	<div class="fixed-top">
	  <nav class="navbar navbar-dark bg-dark row d-flex align-items-center justify-content-md-left">
			<div class="col-sm-auto row">
				&nbsp;&nbsp;<button class="navbar-toggler d-flex align-items-center" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
				  <span class="navbar-toggler-icon"></span>
				&nbsp;NAVIGACIJA</button>
				&nbsp;&nbsp;<button class="navbar-toggler d-flex align-items-center" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent3" aria-controls="navbarToggleExternalContent3" aria-expanded="false" aria-label="Toggle navigation">
				  <span class="navbar-toggler-icon"></span>
				&nbsp;PASKYRA</button>
			</div>
			<div class="col-sm-auto text-left">
				<a class="navbar-brand d-flex align-items-center" href="#">
					<img src="./images/logo.png" width="50" height="50" class="d-inline-block align-top" alt="" loading="lazy" style="margin-bottom: 5px;">
					<h2 style="margin-bottom: 0px;">ŽAIDĖJŲ PAGALBININKAS</h2>
				</a>
			</div>
			<div class="col-sm-auto text-right ml-auto">
				<button class="navbar-toggler btn-lg" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent2" aria-controls="navbarToggleExternalContent2" aria-expanded="false" aria-label="Toggle navigation">
				  <i class="fas fa-download"></i>&nbsp;ATSISIŲSTI
				</button>
			</div>
	  </nav>
	  <div class="row">
		  <div class="w-25 collapse" id="navbarToggleExternalContent">
			<div class="bg-dark p-4 col-sm-8 rounded-bottom" style="padding-left: 15px !important;padding-right: 0 !important;padding-bottom: 0 !important;padding-top: 0 !important;">
				<div class="btn-group-vertical w-100">
					<button type="button" class="btn btn-dark"><i class="fas fa-gamepad"></i>&nbsp;Žaidimai</button>
					<button type="button" class="btn btn-dark"><i class="fas fa-info-circle"></i>&nbsp;Apie mus</button>
					<button type="button" class="btn btn-dark"><i class="fas fa-user-secret"></i>&nbsp;Privatumas</button>
					<button type="button" class="btn btn-dark"><i class="fas fa-wrench"></i>&nbsp;Atnaujinimai</button>
					<button type="button" class="btn btn-dark"><i class="fas fa-question-circle"></i>&nbsp;Pagalba</button>
				</div>
			</div>
		  </div>
		  	<div class="w-25 collapse" id="navbarToggleExternalContent3">
			<div class="bg-dark p-4 col-sm-8 rounded-bottom" style="margin-left: 25%;padding-left: 0px !important;padding-right: 0 !important;padding-bottom: 0 !important;padding-top: 0 !important;">
				<div class="btn-group-vertical w-100">
					<button type="button" style="opacity:1;" class="btn btn-info text-white rounded-0" disabled><h5 style="margin-bottom: 0rem;">Bendra informacija</h5></button>
					<button type="button" style="opacity:1; font-size: 0.75rem;" class="btn btn-dark text-white rounded-0 btn-lg" disabled><img style="width:150px;height:150px;" class="rounded-circle" src="./images/pp.jpg"><br><div style="font-size: 1rem;"><i class="fas fa-user"></i>&nbsp;<?=$username;?></div><br><div class="row" style="align-items: center; justify-content: center;"><i class="fas fa-chart-line"></i>&nbsp;Aktyvumo lygis:&nbsp;<div class="progress" style="width:40%; margin-top:2px;"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?=$level?>" aria-valuemin="0" aria-valuemax="10" style="width:<?=$level?>0%"><?=$level?>/10</div></div></div><br><div class="row" style="align-items: center; justify-content: center;"><i class="fas fa-comments"></i>&nbsp;Forumo patirtis:&nbsp;<div class="progress" style="width:40%; margin-top:1px;"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?=$xp?>" aria-valuemin="0" aria-valuemax="100" style="width:<?=$xp?>%"><?=$xp?>/100</div></div></div><br><?php if($vip == 1){?><i class="fas fa-user-cog"></i>&nbsp;Nario statusas:&nbsp;Administracija <?php } else { ?><i class="fas fa-user-cog"></i>&nbsp;Nario statusas:&nbsp;Narys <?php } ?><br><button data-toggle="modal" data-target="#keitimolangas" type="button" class="btn btn-dark active"><i class="fas fa-wrench"></i>&nbsp;Nustatymai</button></button>
					<form method="post" class="w-100"><button type="submit" class="btn btn-info text-white rounded-0 w-100" name="atsijungti">Atsijungti</button></form>
				</div>
			</div>
		  </div>
		  <div class="w-25 collapse ml-auto text-white" id="navbarToggleExternalContent2">
			<div class="bg-dark p-4 rounded-bottom" style="padding-left: 0px !important;padding-right: 0 !important;padding-bottom: 0 !important;padding-top: 0 !important;">
				<div class="btn-group-vertical w-100">
					<button type="button" class="btn btn-info btn-lg text-white rounded-0"><i class="fab fa-windows"></i>&nbsp;Windows 10 - 32/64bit</button>
					<button type="button" class="btn btn-success btn-lg text-white rounded-0"><i class="fab fa-linux"></i>&nbsp;Linux - 32/64bit</button>
				</div>
			</div>
		  </div> 
	  </div>
	</div>
<?php 
}else {
?>
<div class="fixed-top">
	  <nav class="navbar navbar-dark bg-dark row d-flex align-items-center justify-content-md-left">
			<div class="col-sm-auto row">
				&nbsp;&nbsp;<button class="navbar-toggler d-flex align-items-center" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
				  <span class="navbar-toggler-icon"></span>
				&nbsp;NAVIGACIJA</button>
				</button>
			</div>
			<div class="col-sm-auto text-left">
				<a class="navbar-brand d-flex align-items-center" href="#">
					<img src="./images/logo.png" width="50" height="50" class="d-inline-block align-top" alt="" loading="lazy" style="margin-bottom: 5px;">
					<h2 style="margin-bottom: 0px;">ŽAIDĖJŲ PAGALBININKAS</h2>
				</a>
			</div>
			<div class="col-sm-auto text-right ml-auto">
				<button class="navbar-toggler btn-lg" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent2" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
				  <i class="fas fa-download"></i>&nbsp;ATSISIŲSTI
				</button>
			</div>
	  </nav>
	  <div class="row">
		  <div class="w-25 collapse" id="navbarToggleExternalContent">
			<div class="bg-dark p-4 col-sm-8 rounded-bottom" style="padding-left: 15px !important;padding-right: 0 !important;padding-bottom: 0 !important;padding-top: 0 !important;">
				<div class="btn-group-vertical w-100">
					<button type="button" class="btn btn-dark"><i class="fas fa-gamepad"></i>&nbsp;Žaidimai</button>
					<button type="button" class="btn btn-dark"><i class="fas fa-info-circle"></i>&nbsp;Apie mus</button>
					<button type="button" class="btn btn-dark"><i class="fas fa-user-secret"></i>&nbsp;Privatumas</button>
					<button type="button" class="btn btn-dark"><i class="fas fa-wrench"></i>&nbsp;Atnaujinimai</button>
					<button type="button" class="btn btn-dark"><i class="fas fa-question-circle"></i>&nbsp;Pagalba</button><hr>
					<button type="button" class="btn btn-info text-white rounded-0"><a href="register.php" style="text-decoration: none; color:white;"><i class="fas fa-door-open"></i>&nbsp;Registracija</a></button>
					<button type="button" class="btn btn-success btn-lg text-white rounded-0"><a href="login.php" style="text-decoration: none; color:white;"><i class="fas fa-sign-in-alt"></i>&nbsp;Prisijungimas</a></button>
				</div>
			</div>
		  </div>
		  <div class="w-25 collapse ml-auto text-white" id="navbarToggleExternalContent2">
			<div class="bg-dark p-4 rounded-bottom" style="padding-left: 0px !important;padding-right: 0 !important;padding-bottom: 0 !important;padding-top: 0 !important;">
				<div class="btn-group-vertical w-100">
					<button type="button" class="btn btn-info btn-lg text-white rounded-0"><i class="fab fa-windows"></i>&nbsp;Windows 10 - 32/64bit</button>
					<button type="button" class="btn btn-success btn-lg text-white rounded-0"><i class="fab fa-linux"></i>&nbsp;Linux - 32/64bit</button>
				</div>
			</div>
		  </div>  
	  </div>
	</div>
<?php 
}
?> <!-- VISAS VIRŠUS BAIGIASI ČIA. -->
	
				<div id="carouselExampleInterval" class="carousel slide" data-ride="carousel" style="padding-top:81px;">
				  <div class="carousel-inner">
					<div class="carousel-item active" data-interval="10000">
					  <img src="./images/1.jpg" class="d-block w-100" alt="...">
					</div>
					<div class="carousel-item" data-interval="2000">
					  <img src="./images/2.jpg" class="d-block w-100" alt="...">
					</div>
					<div class="carousel-item">
					  <img src="./images/3.jpg" class="d-block w-100" alt="...">
					</div>
				  </div>
				  <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				  </a>
				  <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				  </a>
				</div> 
<!-- SLIDERIO PABAIGA -->
	
	<section class="features-icons bg-light text-center">
		<div class="container">
		<h1 class="mx-auto">Kaip tai veikia?</h1><br><br><br>
		  <div class="row">
			<div class="col-lg-4">
			  <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
				<div class="features-icons-icon d-flex" style="padding-bottom:15px;">
				  <i class="icon-screen-desktop m-auto text-primary"></i>
				</div>
				<h3>ŽAIDĖJUI</h3>
				<p class="lead mb-0">Patarimai kaip tobulėti žaidime, daiktų komplektacijos, statistikos, pamokos, pokalbiai ir t.t.</p>
			  </div>
			</div>
			<div class="col-lg-4">
			  <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
				<div class="features-icons-icon d-flex" style="padding-bottom:15px;">
				  <i class="icon-layers m-auto text-primary"></i>
				</div>
				<h3>ŽAIDIMUI</h3>
				<p class="lead mb-0">Gerinamas žaidimo pažinimas, tobulinama patirtis, pakeliamas aukštesnis laipsnis žaidime ir t.t.</p>
			  </div>
			</div>
			<div class="col-lg-4">
			  <div class="features-icons-item mx-auto mb-0 mb-lg-3">
				<div class="features-icons-icon d-flex" style="padding-bottom:15px;">
				  <i class="icon-check m-auto text-primary"></i>
				</div>
				<h3>KOMPANIJAI</h3>
				<p class="lead mb-0">Suartinamas žaidėjų kolektyvas, reklama, patirtis ir t.t.</p>
			  </div>
			</div>
		  </div>
		</div>
	</section> <!-- Kaip tai veikia pabaiga -->
	<div class="row bg-dark mx-auto">
		<div class="col-sm-9">
			<h1 class="mx-auto text-center text-muted"><br><br>Naujienos & Atnaujinimai<br><br></h1>
			<div class="card-columns p-4">
			<!-- čia prasideda naujienų ciklas -->
			<?php
			
			$sql = "SELECT * FROM articles";
			$result = $con->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {   ?>
					<div class="card">
						<img src="<?=$row['img']?>" class="card-img-top" alt="...">
						<div class="card-body">
						  <h5 class="card-title"><?=$row['title']?></h5>
						  <p class="card-text"><?=$row['text']?></p>
						</div>
						<div class="card-footer">
						  <small class="text-muted"><?=$row['date']?></small>
						</div>
					</div>
			<?	}
			}
			?>
			 <!-- čia baigiasi naujienų ciklas -->
			</div>
			<nav>
			  <ul class="pagination justify-content-center">
				<li class="page-item disabled">
				  <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Ankstesnis</a>
				</li>
				<li class="page-item"><a class="page-link" href="#">1</a></li>
				<li class="page-item disabled"><a class="page-link" href="#">2</a></li>
				<li class="page-item disabled"><a class="page-link" href="#">3</a></li>
				<li class="page-item disabled">
				  <a class="page-link" href="#" tabindex="-1" aria-disabled="true">...</a>
				</li>
				<li class="page-item disabled"><a class="page-link" href="#" >8</a></li>
				<li class="page-item disabled">
				  <a class="page-link" href="#">Kitas</a>
				</li>
			  </ul>
			</nav>
		</div>                             <!-- naujienos pabaiga -->
		<div class="col-sm-3 p-5">
		<h1 class="mx-auto text-center text-muted" style="margin-bottom: 31px;"><br>Bendraukime!<br><br></h1>
			<div class="card">
				<div class="card-header p-2">
				  <a target="_blank" href="https://discord.com/invite/NRRbT2YU7v"><img src="./images/discord.png" class="card-img-top" alt="..."></a>
				</div>
				<div class="card-body">
				  <h5 class="card-title">Naujausios forumo diskusijos</h5>
				  <?php
			
					$sql = "SELECT * FROM forum_topics WHERE popular = 0";
					$result = $con->query($sql);
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {   
							?>
							&#8226;&nbsp;<a href="#" class="card-text"><?=$row['title']?></a><br>
							<?php	
						}
					}
					?>
					<br>
					<h5 class="card-title">Populiariausios forumo diskusijos</h5>
				  <?php
				  $sql = "SELECT * FROM forum_topics WHERE popular = 1";
					$result = $con->query($sql);
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {   
							?>
								&#8226;&nbsp;<a href="#" class="card-text"><?=$row['title']?></a><br>
							<?php 
						}
					}
						?>
				</div>
				<div class="card-footer p-3">
				   <a target="_blank" href="https://www.instagram.com/dirmontaite/"><img src="./images/instagram.png" href="#" class="card-img-top" alt="..."></a>
				</div>
			  </div>
		</div>   <!-- bendrauk pabaiga -->
	</div>   <!-- naujienų langas pabaiga -->
	
	<!-- Modal nustatymai-->
<div id="keitimolangas" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content nustatymai-->
    <div class="modal-content">
      <div class="modal-header">
	    <h4 class="modal-title">Vartotojo paskyros nustatymai</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
	  <br><br><br>
        <center><p>Jūsų slapyvardis: <b><?=$username?><br><br></b>
		<?php
		$sql = "SELECT email FROM accounts WHERE username='".$username."'";
					$result = $con->query($sql);
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {   
							?>
								Jūsų El.Pašto adresas: <b><?=$row['email']?></b><br><br><br>
							<?php 
						}
					}
		?>
		<button class="btn btn-dark btn-md" type="button" data-toggle="modal" data-target="#keitimo_slaptazodzio_langas">Keisti paskyros prisijungimo slaptažodį</button><br><br><br>
		
		   </p></center>
      </div>
      <div class="modal-footer">
	  <button class="btn btn-danger btn-sm mr-auto" data-toggle="modal" data-target="#naikintipaskyra">Pašalinti paskyrą</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti langą</button>
      </div>
    </div>

  </div>
</div>

	<!-- Modal slaptažodis-->
<div id="keitimo_slaptazodzio_langas" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content slaptažodis-->
    <div class="modal-content">
      <div class="modal-header">
	    <h4 class="modal-title">Slaptažodžio keitimas</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
	  <br><p><center>
	  <div class="form-group">
		<form enctype="multipart/form-data" method="POST">
		<i class="fas fa-user"></i>&nbsp;
				<label for="username" id="label_user" name="label_user">
					<input class="form-control" type="text" name="username" placeholder="<?=$username?>" id="username" value="<?=$username?>" disabled>
				</label><br>
				<i class="fas fa-lock"></i>&nbsp;
				<label for="password" id="label_pw" name="label_pw">
				<input class="form-control" type="password" name="password" placeholder="Senas slaptažodis" id="password" required>
				</label><br>
				<i class="fas fa-lock"></i>&nbsp;
				<label for="password2" id="label_pw2" name="label_pw2">
					<input class="form-control" type="password" name="password2" placeholder="Naujas slaptažodis" id="password2" required>
				</label><br>
				<i class="fas fa-lock"></i>&nbsp;
				<label for="password2" id="label_pw3" name="label_pw3">
					<input class="form-control" type="password" name="password3" placeholder="Pakartokite naująjį slaptažodį" id="password3" required>
				</label><br>
				<br><div id="atsakymas_keitimo"></div><br>
				<button class="btn btn-dark btn-lg" type="button" id="keisti_slaptazodi" name="keisti_slaptazodi">Keisti paskyros slaptažodį</button>
			</form>
		
		
		   </p></center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti langą</button>
      </div>
    </div>

  </div>
</div>
</div>

<div id="naikintipaskyra" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content nustatymai-->
    <div class="modal-content">
      <div class="modal-header">
	    <h4 class="modal-title">Vartotojo paskyros naikinimas</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
	  <br><br><br>
        <center><p>Ar tikrai norite neatkuriamai pašalanti vartotoją: <b><?=$username?><br><br></b>
		<br><br>
		<form method="post" class="w-100"><button type="submit" class="btn btn-danger btn-md" name="naikinti">Taip, panaikinti paskyrą</button></form><br><br><br>
		<br><br>
		   </p></center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti langą</button>
      </div>
    </div>

  </div>
</div>

	
	<footer class="p-5 mx-auto">
	<center><img src="./images/logo.png" width="50" height="50" class="d-inline-block align-top" alt="" loading="lazy" style="margin-bottom: 5px;"></img><br>Visos teisės saugomos UAB Žaidėjų Pagalbininkas. 2020<br> UAB „Žaidėjų pagalbininkas“ yra registruotas įmonės vardas, saugomas Lietuvos Respublikos įstatymų ir kitų teisės aktų.<br>
	Projekto eskizą atliko <b>Kauno Kolegijos</b> studentas <b>Nedas Šliamonas</b></center>
	</footer>
	
	<?php
	
	$con->close();
	
	?>
	
	<script type="text/javascript">
		$(document).ready(function () {
        $('body').click(function(){
            $(".collapse").collapse('hide');
        });
		
		    $("#keisti_slaptazodi").click(function(){
            $.ajax({
                type: 'POST',
                url: 'keisti_script.php',
				data: { nickname: $("#username").val(),
						oldpassword: $("#password").val(),
						newpassword1: $("#password2").val(),
						newpassword2: $("#password3").val()},
				dataType : 'json',
				timeout: 500, 
                success: function(data) {
						///$("#atsakymas_keitimo").html(data.atsakymas);	
						document.getElementById("atsakymas_keitimo").innerHTML = data.atsakymas;
                }
            });
   });
		
		
});
		</script>
	
	
</body>
</html>