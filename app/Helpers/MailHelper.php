<?php

namespace App\Helpers;

require_once __DIR__ . '/../Libraries/PHPMailer/Exception.php';
require_once __DIR__ . '/../Libraries/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/../Libraries/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailHelper
{
    public static function sendMail($to, $subject, $htmlContent)
    {
        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;

            $mail->Username   = 'fajar.ekasandiyuda@gmail.com';      
            $mail->Password   = 'oysp cmzx rpnb irla';  

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('fajar.ekasandiyuda@gmail.com', 'Admin Laboratorium');
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $htmlContent;
            $mail->AltBody = strip_tags($htmlContent);

            $mail->send();
            return true;

        } catch (Exception $e) {
            return "Email gagal dikirim: " . $mail->ErrorInfo;
        }
    }
}
