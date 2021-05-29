<?php
    require_once '../db/conn.php';
    require_once '../vendor/autoload.php';
    use Twilio\Rest\Client;
    
    $AccountSid = "AC2afcafb499e46db279adf7b992616f2f";
    $AuthToken = "f2d463ec68820f1fa5c93e3b544693fc";
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
    ?>