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
  require 'utils.php';
  $helper = new Helper();

  //store error, if any.
  $mail_err = "";
  if (array_key_exists('submit', $_POST)) {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $mail_err = "Invalid email format";
    } else {
      $helper->SendMail($email);
    }
  }

  //function to avoid sql injection
  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>
</body>

</html>