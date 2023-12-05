<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


    

require '../vendor/autoload.php';
        
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->Port = 2525;
      
       
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = 'f36959a4f6d8ae';
        $mail->Password = 'cb361a0e540cd9';
        $mail->setFrom($email, 'Employee');
        $mail->addAddress('from@example.com', 'Finance');
        $mail->Subject = 'Employee Regester';
        $mail->msgHTML('<p>Successfully Regesterd!!</p><p>Welcome to Our Team</p>');
        $mail->AltBody = 'This is a plain-text message body';
        $mail->addAttachment('../doc/task.csv');
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
        
        }

        function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';

    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);

    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);

    return $result;
}


        ?>