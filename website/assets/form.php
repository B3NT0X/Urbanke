<?php

$to = "bennet@commun-it.net";
$name = trim( substr($_POST["name"], 0, 50));
$email = trim( substr($_POST["email"],0, 50));
$phone = trim( substr($_POST["phone"],0, 50));
$message = trim( substr($_POST["message"], 0, 500));
$button = trim( substr($_POST["submit"],0, 20));
$honeypotName = $_POST['realname'];
$honeypotEmail = $_POST['realemail'];
$meldung = [];


if($button){
    if( empty($name) ){
        $meldung[] = "Bitte Name angeben";
    } else {
        echo htmlspecialchars($name)
    }

    if( empty($email) ){
        $meldung[] = "Bitte E-Mail angeben";
    } else {
        echo htmlspecialchars($email)
    }

    if( empty($phone) ){
        $meldung[] = "Bitte telefon angeben";
    } else {
        echo htmlspecialchars($phone)
    }
    
    if( empty($message) ){
        $meldung[] = "Bitte Nachricht angeben";
    } else {
        echo htmlspecialchars($message)
    }

    if( !empty($honeypotName) || !empty($honeypotEmail)){
		$meldung[] = "Fehler";
	}
    elseif( filter_var($email, FILTER_VALIDATE_EMAIL) == false ){
        $meldung[]="Bitte geben Sie eine gültige Email-Adresse ein";
    }

    if(count($meldung) == 0) {
        mail($to, $name, $phone, $message, "From: $name <$email>");
    
        header("Location: http://bennet.helix-marketing.de/urbanke/");
        
    }
}
include ('index.php');

?>

