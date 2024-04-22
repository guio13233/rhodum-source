<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

	class mailHandler {
		public static function sendMail($message, $altmessage, $to, $nameofuser) {

            require_once "vendor/autoload.php";

            $mail = new PHPMailer(true);

            //Enable SMTP debugging.
            $mail->SMTPDebug = false;                               
            //Set PHPMailer to use SMTP.
            $mail->isSMTP();            
            //Set SMTP host name                          
            $mail->Host = "";
            //Set this to true if SMTP host requires authentication to send email
            $mail->SMTPAuth = true;                          
            //Provide username and password     
            $mail->Username = "";                 
            $mail->Password = "";                           
            //If SMTP requires TLS encryption then set it
            $mail->SMTPSecure = "tls";                           
            //Set TCP port to connect to
            $mail->Port = 587;                                   

            $mail->From = "";
            $mail->FromName = "Rhodum Mailing";

            $mail->addAddress($to, $nameofuser);

            $mail->isHTML(true);

            $mail->Subject = "Rhodum verification code";
            $mail->Body = $message;
            $mail->AltBody = $altmessage;

            try {
                $mail->send();
            } catch (Exception $e) {
                exit("send failed");
            }
		}
	}
?>