<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Helper{

  //function to send mail
  function SendMail($recipient_mail)
  {
    try {
      $mail = new PHPMailer();
      //Server settings
      $mail->IsSMTP();  // telling the class to use SMTP
      $mail->SMTPDebug = 1;
      $mail->Host = "smtp.gmail.com";
      $mail->SMTPSecure = 'tls';
      $mail->Port       = 587;
      // Enable SMTP authentication
      $mail->SMTPAuth   = true;
      $mail->Username   = 'bishalmaji.in@gmail.com';     // SMTP username
      $mail->Password   = 'juiz cvit bypt uwsx';         // SMTP password
      //add sender and receiver address
      $mail->setFrom('bishalmaji.in@gmail.com', 'Bishal Maji');
      $mail->addAddress($recipient_mail, 'Recipient Name');
      //Add Attachments
      $mail->addAttachment('welcome.jpg');
      $mail->isHTML(true);
      $mail->Subject = 'This is the subject of the message';
      $mail->Body    = '<h1>This is the body heading</h1> <br><br><h4>This is sub-heading</h4>';
      if ($mail->send()) {
        echo "mail sent";
      } else {
        echo "not sent" . $mail->ErrorInfo;
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }
}
