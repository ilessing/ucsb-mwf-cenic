<?php
/* Return URL */
// Return URL is set to the main MWF UCSB site, by default
$return_url = 'http://mwf.library.ucsb.edu/';

require_once("Mail.php");


if(isset($_SERVER['HTTP_REFERER']))
{
	$return_url = $_SERVER['HTTP_REFERER'];
}

/* E-mail */
$name = '';
$email = '';
$message = '';
$success = false;
$errortext = NULL;

if($_SERVER['REQUEST_METHOD'] === "POST")
{
	$name = filter_var($_REQUEST['name'], FILTER_SANITIZE_STRING);
	$email = filter_var($_REQUEST['email'], FILTER_SANITIZE_STRING);
	$message = filter_var($_REQUEST['message'], FILTER_SANITIZE_STRING);
	
	if(!$name || trim($name) === '')
	{
		$errortext = "Please enter your name";
	}
	else if(!$email || trim($email) === '')
	{
		$errortext = "Please enter your e-mail address";
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$errortext = "Please provide a valid e-mail address";
	}
	else if(!$message || trim($message) === '')
	{
		$errortext = "Please provide a message";
	}

	if(!$errortext)
	{
		$from = $email;
		$to = "mark.grosch@sa.ucsb.edu";
		$subject = "Message From MWF Accessibility Page";
		$body = "Name: $name \n";
		$body .= "email: $email \n";
		$body .= "Message: $message \n\n";
		$body .= "originating IP: ".$_SERVER['HTTP_X_FORWARDED_FOR']." \n";
		$body .= "sent from: http://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']." \n";
		$body .= "user agent (browser): ".$_SERVER['HTTP_USER_AGENT']." \n";
		
		$host = "zimbra-mta1.library.ucsb.edu";
		 
		$headers = array (
			'From' => $from,
			'To' => $to,
			'Subject' => $subject
			);
		$smtp = Mail::factory('smtp',
			array (
				'host' => $host,
				'auth' => false,
				)
			);
		 
		$mail = $smtp->send($to, $headers, $body);
		 
		if (PEAR::isError($mail)) {
			$success = false;
			}else{
				
				$success = true;
				}
	}
}
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="height=device-height,width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;" />
	<meta name="format-detection" content="telephone=no" />

	<title>Accessibility</title>

	<link rel="stylesheet" href="http://mwf.library.ucsb.edu/assets/css.php" type="text/css" />

	<script src="http://mwf.library.ucsb.edu/assets/js.php" type="text/javascript"></script>
</head>
<body>
	<div id="header">
		<img src="http://mwf.library.ucsb.edu/assets/img/ucsb-header.png" alt="UCSB" />
		<span>Accessibility</span>
	</div>

	<?php
	
		// If message has been successfully sent, don't show intro message
		if(!$success):
	
	?>
	<div class="content-full content-padded">
		<div>
		
			<p>
				If any of the material on this page is not accessible to you, please send us an email and we will provide alternatives:
			</p>
		
		</div>
	</div>
	<?php
	
		endif;
		
	?>
	
	<?php
	
		// An error occurred, display error message
		if($errortext):
	
	?>
	<div class="content-full content-padded">
		<div>
		
			<p>
				<?php echo $errortext; ?>
			</p>
		
		</div>
	</div>
	<?php
	
		endif;
	
	?>
	
	<?php
	
		// E-mail has been sent, display success message
		if($success):
		
	?>
	<div class="content-full content-padded">
		<div>
		
			<p>
				Your message has been sent.
			</p>
		
		</div>
	</div>
	<?php
	
		// E-mail has not been sent (or an error occurred), display form
		else:
		
	?>
	<form method="POST" action="" class="form-full form-padded">
		<h1 class="light form-first">Contact Us</h1>
	
		<label for="contact-name">Name</label>
		<input type="text" name="name" id="contact-name" value="<?php echo htmlentities($name); ?>" />
		
		<label for="contact-email">E-mail</label>
		<input type="text" name="email" id="contact-email" value="<?php echo htmlentities($email); ?>" />
		
		<label for="contact-message">Message</label>
		<textarea id="contact-message" name="message"><?php echo htmlentities($message); ?></textarea>

		<input type="submit" value="Send Message" class="form-last" />
	</form>
	<?php
	
		endif;
		
	?>
	
	<a href="<?php echo $return_url; ?>" class="return-btn button-full button-padded">Go Back To Home</a>

	<div id="footer">
		<p>University of California &copy; 2011-12 UC Regents</p>
		<p class="mwf-credit">Powered by the <br /><a target="_blank" href="http://mwf.ucla.edu">Mobile Web Framework</a></p>
	</div>

</body>
</html>