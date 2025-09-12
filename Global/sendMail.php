<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;





class sendMail
{
    public function send_Mail($conf, $mailCnt)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $conf['smtp_host'];                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $conf['smtp_user'];                     //SMTP username
            $mail->Password   = $conf['smtp_pass'];                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = $conf['smtp_port'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($mailCnt['email_from'], $mailCnt['name_from']);
            $mail->addAddress($GLOBALS['user_data']['email'], $GLOBALS['user_data']['name']);

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $mailCnt['subject'];
            $mail->Body    = 'Hello ' . $GLOBALS['user_data']['name'] . ", Welcome to Benir's Application";
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return true; // Message has been sent
        } catch (Exception $e) {
            error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            return false; // Indicate failure
        }
    }
}
