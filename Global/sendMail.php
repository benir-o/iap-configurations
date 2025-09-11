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
        //Load Composer's autoloader (created by composer, not included with PHPMailer)


        //Create an instance; passing `true` enables exceptions
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
            $mail->addAddress($mailCnt['email_to'], $mailCnt['name_to']);

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $mailCnt['subject'];
            $mail->Body    = $mailCnt['body'];
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            //echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        return "<h1>Hello, ICS C Community</h1>";
    }
}
