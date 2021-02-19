<?php




if (filter_has_var(INPUT_POST, 'submit')){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $office = $_POST['office'];
    $message = $_POST['message'];
    $honeypotname = $_POST['realname'];
    $honeypotemail = $_POST['realemail'];

    $mailto = "bennet@commun-it.net";
    $txt =  $message;

    if ( !empty($honeypotname) || !empty($honeypotemail)){
		return false;
    }

 
    mail($mailto, $name, $phone, $office, $message, "From: $name <$email>");

    header("Location: http://bennet.helix-marketing.de/urbanke/");
            
}


?>
