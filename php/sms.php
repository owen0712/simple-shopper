<?php
    require_once '../db/conn.php';
    require_once '../vendor/autoload.php';
    use Twilio\Rest\Client;
    if(isset($_POST['btnPhone']))
    {   
        $phone = $_POST['Number'];
        if($user->checkPhone($phone))
        {
            if($user->checkPhoneExist($phone))
            {
                try {
                    $AccountSid = "AC2afcafb499e46db279adf7b992616f2f";
                    $AuthToken = "9e025fe79b6cf78d3df0648bac5c6407";
                    $client = new Client($AccountSid, $AuthToken);
                    $otp=mt_rand(1000,9999);
                    date_default_timezone_set("Asia/Kuala_Lumpur");
                    $minutes_to_add = 80;
                    $expires = new DateTime(date("Y-m-d h:i:sa"));
                    $expires->add(new DateInterval('PT' . $minutes_to_add . 'M'));
                    $expires = $expires->format('Y-m-d H:i');
                        
                    $number=  $_POST['Number'];
                    $word="+6";
                    $word2="6";
                    $word3="-";
                    if(strpos($number, $word) === false)
                    {
                        $number = "+6".$number; 
                    }
                    $number = str_replace("-", "", $number);    
                    $client->messages->create(
                        // the number you'd like to send the message to
                        $number,
                        [
                            // A Twilio phone number you purchased at twilio.com/console
                            'from' => '+19284408537',
                            // the body of the text message you'd like to send
                            'body' => "We received a password reset request. The otp number:$otp"
                        ]
                    );
                        
                        
                    $word="+6";
                    $word2="6";
                    $word3="-";
                    if(strpos($number, $word) !== false)
                    {
                        $number = str_replace("+6","",$number); 
                    }elseif(strpos($number, $word2) !== false){
                        $number = str_replace("6","",$number); 
                    }elseif(strpos($number, $word3) !== false){
                        $number = str_replace("-","",$number); 
                    }
                        
                    $user->deletePreviousPhone($number);
                    $user->insertOtpPhone($number,$otp,$expires);
                    header("Location: ../php/otp.php?phone=$number");
                }catch(Exception $e){  
                    echo "."; 
                    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                    echo '<script>
                    swal({
                       title: "Warning",
                       text: "Verification for this Phone number still in pending. We sincerely apologize. We will finished it soon.",
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
                echo ".";
                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script>
                swal({
                   title: "Error",
                   text: "Phone number does not match exist",
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
            echo ".";
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script>
                swal({
                  title: "Error",
                  text: "Phone number invalid",
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