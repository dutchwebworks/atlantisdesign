<?php 
require_once("atlantis_core/base.inc.php");
require_once("atlantis_core/php-captcha.inc.php");

if($_POST['ajaxresponse']) $ajaxresponse = true;								// ajax response retur
$view_template = false;															// view template output first
$template = new Core_Template("atlantis_core/modules/templates/email.tmp.html");		// import static mail HTML template containing {placeholders}

// check for website url validation, or leave blank
if($_POST['website']) {
	if(validateUrl($_POST['website'])) {
		$website = $_POST['website'];
		//echo("goede url");
	} else {
		$website = false;
		//echo("fout url");
	}
	$template->placeholder("{website}", $website);
}

// fil with dyn. data
$template->placeholder_array($_POST);					// fill the template's {placeholders} with the same POST vars from the posted HTML form
$template->cleanup_placeholders();						// cleanup redundant placeholders

// create stmp object
$smtpMail = new atlantisStmpHtml();						// create mail object
$smtpMail->html = $template->return_as_string();		// give the HTML template to the mail object as string
//$stmpMail->text = "my plain text alternative";		// plain text alternative, if not specified, a stripped HTML version will be used
//$stmpMail->force_headers = true;						// some smtp server require a forced mail headers FLAG, experiment with it!

// redirects
$redirect_thanks = $settings['contact_bedankt_pagina'];
$redirect_error = $settings['contact_fout_pagina'];

// ajax response messages
$ajaxSuccessMessage = "<h3>Succesvol verstuurd</h3><p>Het formulier is succesvol verstuurd. Bedankt voor uw reactie.</h3>";
$ajaxFailedMessage = "<h3>Fout in het verwerken van het formulier</h3><ul><li>Heeft u alle verplichte velden (voorzien van een * en licht gekleurd) ingevuld?</li><li>En de <strong>correcte</strong> <a href=\"http://nl.wikipedia.org/wiki/Captcha\" target=\"_blank\">captcha-code</a> overgenomen?</li><li>Probeert u het later <a href=\"/contact/\">opnieuw</a>.</li></ul>";

// check for a 'naam' field, valid email adres and case sensitive (=false parameter) captcha string
if($_POST['naam'] && validateEmail($_POST['email']) && PhpCaptcha::Validate($_POST['user_code'], true)){
	// set mail headers and validate email adres
	$smtpMail->to = array($settings['main_title'] => $settings['contact_email']);
	$smtpMail->from = array($_POST['naam'] => $_POST['email']);
	$smtpMail->subject = stripslashes($_POST['onderwerp']);
} else {
	// check for ajax response	
	if($ajaxresponse) {
		echo($ajaxFailedMessage);
		return;
	} else {
		header("location:".$redirect_error);
	}
}

if($view_template) {
	die($template->return_as_string()); // view template
} else {
	if($smtpMail->send_mail()) { // mail template
		$ajaxMessage = "<h3>Succesvol verstuurd</h3><p>Het formulier is succesvol verstuurd. Bedankt voor uw reactie.</h3>";
		$redirect_header = $redirect_thanks;
	} else {
		$ajaxMessage = "<h3>Fout in het formulier</h3><p>Er is een verwerkingsfout opgetreden in het formulier. Probeer het nogmaals.</h3>";
		$redirect_header = $redirect_error;
	}

	// handle response
	if($ajaxresponse) {
		echo($ajaxMessage);
		return;
	} else {
		header("location:".$redirect_header);
	}
}
?>