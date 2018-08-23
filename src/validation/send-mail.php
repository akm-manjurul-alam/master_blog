<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

//Load Composer's autoloader
require '../../vendor/autoload.php';

function sendMail($fullname, $emailadresse, $phone, $msg, $radio_value)
{
    $mail = new PHPMailer();
    try {
        //Server settings
        if ($_SERVER['SERVER_NAME'] === 'coworking.pixolith.de') {
            $mail->Host = 'localhost';
            $mail->Port = 25;
        } else {
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '9f3f919a156b66';
            $mail->Password = 'c2df742216ace1';
            $mail->Port = 2525;
        }

        //Recipients
        $mail->setFrom('coworking@pixolith.de', 'Coworking');
        $mail->addAddress('info@pixolith.de', 'Coworking');
        $mail->addReplyTo($emailadresse, $fullname);
        $mail->CharSet = 'UTF-8';

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Anfrage Coworking';
        $body = '<h1>Anfrage über das Coworking-Kontaktformular</h1>';
        $body .= 'Name: ' . $fullname . '<br>';
        $body .= 'E-Mail: ' . $emailadresse . '<br>';
        $body .= 'Telefon: ' . $phone . '<br>';
        $body .= 'Variante: ' . $radio_value . '<br>';
        $body .= 'Nachricht: ' . $msg . '<br>';

        $mail->Body = $body;

        $mail->send();
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
