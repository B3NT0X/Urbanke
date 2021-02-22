<?php

if($_POST) {

$name = htmlspecialchars(stripslashes(trim($_POST['name'])));
$email = htmlspecialchars(stripslashes(trim($_POST['email'])));
$phone = htmlspecialchars(stripslashes(trim($_POST['phone'])));
$office = htmlspecialchars(stripslashes(trim($_POST['office'])));
$message = htmlspecialchars(stripslashes(trim($_POST['message'])));
$honeypotname = htmlspecialchars(stripslashes(trim($_POST['realname'])));
$honeypotemail = htmlspecialchars(stripslashes(trim($_POST['realemail'])));

$recipient = "bennet@commun-it.net";
$subject = "Nachricht von ".$name;
$headers = "MIME-Version: 1.0" ."\r\n";
$headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";
$headers .= "Von: ".$email;
$body = '<h3>Kontakt Form</h3>
          <h4 style="text-decoration:underline;">Name:</h4><p>'.$name.'</p>
          <h4 style="text-decoration:underline;">Büro:</h4><p>'.$office.'</p>
					<h4 style="text-decoration:underline;">E-Mail:</h4><p>'.$email.'</p>
					<h4 style="text-decoration:underline;">Telefonnummer:</h4><p>'.$phone.'</p>
					<h4 style="text-decoration:underline;">Nachricht:</h4><p>'.$message.'</p>
				';


if (!empty($honeypotname) || !empty($honeypotemail)) {
  return false;
} else {
  mail($recipient, $subject, $body, $headers);
}

// if(!preg_match("/^[A-Za-z .'-]+$/", $name)){
//   return false;
// }
// if(!preg_match("/^[0-9-+\s()]*$/", $name)){
//   return false;
// }
// if(!preg_match("/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/", $email)){
//   return false;
// }
  
header("Location: http://bennet.helix-marketing.de/urbanke/");
}

?>
