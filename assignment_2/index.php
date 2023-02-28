<!DOCTYPE html>
<html lang="en">

<head>
  <title>Send Grettings Via Mail</title>
</head>

<body>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="email" name="email" value="Email"><span>$mail_err</span>
    <input type="submit" name="submit" value="Submit">
  </form>
  <?php

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require 'vendor/autoload.php';

  $mail_err = "";
  if (array_key_exists('submit', $_POST)) {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $mail_err = "Invalid email format";
    } else {
      SendMail($email);
    }
  }
  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
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
      $mail->addAddress($recipient_mail, 'Bishal Maji');
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
  ?>
</body>

</html>