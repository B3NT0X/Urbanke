<?php
	// Message Vars
	$msg = '';
	$msgClass = '';

	// Check For Submit
	if(filter_has_var(INPUT_POST, 'submit')){
		// Get Form Data
		$name = trim( substr( htmlspecialchars($_POST['name']), 0, 100));
		$email = trim( substr(htmlspecialchars($_POST['email']), 0, 100));
		$phone = trim( substr(htmlspecialchars($_POST['phone']), 0, 100));
		$office = htmlspecialchars($_POST['office']);
		$message = trim( substr(htmlspecialchars($_POST['message']), 0, 800));
		$honeypotname = htmlspecialchars($_POST['realname']);
		$honeypotemail = htmlspecialchars($_POST['realemail']);

        // Check Honeypot
        if(!empty($honeypotName) || !empty($honeypotEmail)){
            $msg = "Ihre Nachricht wurde nicht verschickt.";
        }
		// Check Required Fields
		if(!empty($email) && !empty($name) && !empty($office)){
			// Passed
			// Check Email
			if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
				// Failed
				$msg = 'Ungültige E-Mail Adresse.';
				$msgClass = 'alert-danger';
			} else {
				// Passed
				$toEmail = 'bennet@commun-it.net';
				$subject = 'Von'.$name;
				$body = '<h2>Kontakt Form</h2>
					<h4>Name</h4><p>'.$name.'</p>
					<h4>Email</h4><p>'.$email.'</p>
					<h4>Nachricht</h4><p>'.$message.'</p>
				';

				// Email Headers
				$headers = "MIME-Version: 1.0" ."\r\n";
				$headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";

				// Additional Headers
				$headers .= "From: " .$name. "<".$email.">". "\r\n";

				if(mail($toEmail, $subject, $body, $headers)){
					// Email Sent
					$msg = 'Nachricht wurde verschickt.';
					$msgClass = 'alert-success';
				} else {
					// Failed
					$msg = 'Es gab leider einen Fehler.';
					$msgClass = 'alert-danger';
				}
			}
		} else {
			// Failed
			$msg = 'Füllen Sie bitte alle Felder aus.';
			$msgClass = 'alert-danger';
		}
	}
?>