<?php

//check if form was sent
if($_POST){

	$to = 'some@email.com';
	$subject = 'Testing HoneyPot';
	$header = "From: $name <$name>";

	$name = $_POST['büro'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$email = $_POST['phone'];
	$message = $_POST['message'];

	//honey pot field
	$honeypotName = $_POST['realname'];
	$honeypotEmail = $_POST['realemail'];

	//check if the honeypot field is filled out. If not, send a mail.
	if( ! empty( $honeypot ) ){
		return; //you may add code here to echo an error etc.
	}else{
		mail( $to, $subject, $message, $header );
	}
}

?>

<?php

$empfaenger = "bennet@commun-it.net";

$name = trim( substr( @$_POST["name"], 0, 50));
$email = trim( substr( @$_POST["email"],0, 50));
$betreff = trim( substr( @$_POST["betreff"],0, 50));
$nachricht = trim( substr( @$_POST["nachricht"], 0, 500));
$button = trim( substr( @$_POST["button"],0, 20));


$meldung =[];

if($button){
    if( empty($name) ){
        $meldung[] = "Bitte Name angeben";
    }
    if( empty($betreff) ){
        $meldung[] = "Bitte Betreff angeben";
    }
    if( empty($email) ){
        $meldung[] = "Bitte E-Mail angeben";
    }
    if( empty($nachricht) ){
        $meldung[] = "Bitte Nachricht angeben";
    }
    #Email-Adresse nicht korrekt?
    elseif(filter_var($email, FILTER_VALIDATE_EMAIL) == false ){
        $meldung[]="Bitte geben Sie eine gÃ¼ltige Email-Adresse ein";
    }

    ########Formulardaten verarbeiten########
    #gibt es keine Meldung, dann Mail versenden
    #count(array) zählt die werte eines Array 
    #gab es keine User-Meldung, dass ist der Array leer
    
if(count($meldung) == 0) {
    ##Formulardaten als Mail versenden
    #mail(EmpfÃ¤nger, Betreff, Nachricht, Absender)
 mail($empfaenger, $betreff, $nachricht, "From: $name <$email>");
    
    #Antwortseite anfordern
    #im HTTP-Response wird eine Zeile untergebracht, die den Browser veranlasst, eine neue Seite anzufordern
header("Location: index.php");
}
}
#html fehler text
if($meldung){
    echo "<p style=\"color:red\">".implode("<br>",$meldung)."</p>";
    }

?>

<?php 
    if ($meldung) { ?>
     <p style="color:red;"><?php echo implode("<br>", $meldung) ?></p>
<?php}?> 

   
