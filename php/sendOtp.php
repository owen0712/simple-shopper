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
			$mail->Password   = 'eoog hwal ncus iyjc';                        
			$mail->setFrom('no-reply@ss.org');           
			$mail->addAddress($email);	                                 
			$mail->Subject = 'OTP verification(Reset password)';
			$mail->Body    = '<b>We received a password reset request. The otp number:'. $otp.'</b> ';
			$mail->AltBody = 'If you did not make this request, you can ignore this email.';
			$mail->send();
			
			header("Location: ../php/otp.php?email=$email");
		} catch (Exception $e) {
			header("Location: ../php/validateEmail.php");
			exit();
		}
	 }else{
		 echo "<br>";
		 echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
		 echo '<script>
		 swal({
            title: "Error",
            text: "Email does not match exist",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
        .then((proceedLogin) => {
                if (proceedLogin) {
                  setTimeout(function(){window.location.href="../php/forgotPassword.php"}, 900);
                }
          });
		 </script>';
	 }
   }else{
		echo "<br>";
		echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
		echo '<script>
			swal({
			  title: "Error",
			  text: "Email invalid",
			  icon: "error",
			  buttons: true,
			  dangerMode: true,
			  })
		  .then((proceedLogin) => {
				  if (proceedLogin) {
					setTimeout(function(){window.location.href="../php/forgotPassword.php"}, 900);
				  }
			});
			</script>';
   }
}
?>

