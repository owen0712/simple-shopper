<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['btnSubmit1']))
{
	require 'config.php';
	require_once '../db/conn.php';
	$email = $_POST['email'];

	//if user enter email
   if($user->checkEmail($email))
   {
	 if($user->checkEmailExist($email))
	 {
		//converts arbitary string length to hexadecimal values
		$selector = bin2hex(random_bytes(8));
		$token    = random_bytes(32);

		$url      = "http://localhost/oars/create-new-password.php?selector=".$selector."&validator=".bin2hex($token);

		$otp=mt_rand(1000,9999);
		date_default_timezone_set("Asia/Kuala_Lumpur");
		$minutes_to_add = 4;
		$expires = new DateTime(date("Y-m-d h:i:sa"));
		$expires->add(new DateInterval('PT' . $minutes_to_add . 'M'));

		$expires = $expires->format('Y-m-d H:i');
		//$expires = strtotime(date("Y-m-d h:i:sa"));
		//$expires = date('G:i', strtotime('+3 minutes', $expires));


		require '../vendor/autoload.php';
		$user->deletePreviousEmail($email);
		$user->insertOtp($email,$otp,$expires);
		$mail = new PHPMailer(true);
		  
		try {
			$mail->SMTPDebug = 2;                                       
			$mail->isSMTP();
			$mail -> SMTPAuth = true;
			$mail -> SMTPSecure ="ssl";
			$mail -> Host = 'smtp.gmail.com';
			$mail -> Port = '465'; 
			$mail->isHTML();
			$mail->SMTPOptions = array(
				'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
				)
			);
			$mail->Username   = "simpleshopper666@gmail.com";                                                      
			$mail->Password   = 'dclb fdqh zupp duzn';                        
			$mail->setFrom('no-reply@ss.org');           
			$mail->addAddress($email);	                                 
			$mail->Subject = 'OTP verification(Reset password)';
			$mail->Body    = '<b>We received a password reset request. The otp number:'. $otp.'</b> ';
			$mail->AltBody = 'If you did not make this request, you can ignore this email.';
			$mail->send();
			
			header("Location: ../php/otp.php?email=$email");
		} catch (Exception $e) {
			echo "ASdasd";
			header("Location: ../php/validateEmail.php");
			exit();
		}
	 }
   }
}

?>