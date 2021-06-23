<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$atsakymas = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	echo json_encode(array('atsakymas' => 'Netinkama El. Pašto forma!'));
	exit();
	}
	
	if($_POST['tikras_kodas'] != "'".$_POST['kodas']."'")
	{
	echo json_encode(array('atsakymas' => 'CAPTCHA atsakyta neteisingai!'));
	exit();	
	}
	

$DATABASE_HOST = '';
$DATABASE_USER = '';
$DATABASE_PASS = '';
$DATABASE_NAME = '';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

$hash_kodas = substr(md5(microtime()),rand(0,26),30);

$sql = "UPDATE accounts SET hash='" .$hash_kodas. "' WHERE email='".$_POST['email']."'";
mysqli_query($con, $sql);

         $to = $_POST['email'];
         $subject = "Vartotojo susigrąžinimas";
         
         $message = "<b>Norėdami atnaujinti savo paskyros slaptažodį, spauskite šią nuorodą:</b><br>";
         $message .= "https://orloov.com/nedas/recovery.php?hash=".$hash_kodas;
         
         $header = "From:noreply@zaidimupagalbininkas.lt \r\n";
         $header .= "Cc:noreply@zaidimupagalbininkas.lt \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail($to,$subject,$message,$header);
         
         if( $retval == true ) {
            $atsakymas = "<center>Vartotojo susigrąžinimo nuoroda išsiųsta į <br> <b>".$_POST['email']."</b> el.pašto adresą.</center>";
         }else {
            $atsakymas = "<center>Kažkas nepavyko!<br>Prašome pabandyti dar kartą.</center>";
         }
	
$con->close();
}
echo json_encode(array('atsakymas' => $atsakymas));

?>