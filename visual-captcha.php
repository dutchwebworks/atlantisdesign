<?php
require("atlantis_core/php-captcha.inc.php");									// captcha class
$captchaFonts = array("atlantis_core/fonts/VeraMoBd.ttf","atlantis_core/fonts/serif.ttf");	// set fonts
$visualCaptcha = new PhpCaptcha($captchaFonts, 400, 50);		// create a captcha object, with specified fonts and image dimensions

// settings
$visualCaptcha->SetMinFontSize(22); 							// minimum fontsize
$visualCaptcha->SetMaxFontSize(28); 							// maximum fontsize
$visualCaptcha->SetCharSet("a-z,A-Z,1-9"); 						// character range
//$visualCaptcha->CaseInsensitive(false); 						// set to case sensitive
//$visualCaptcha->SetOwnerText("Atlantisdesign.nl"); 			// additional text below the image
//$visualCaptcha->SetBackgroundImages('img/captcha_bg.jpg'); 	// background in captcha image
$visualCaptcha->UseColour(true); 								// use color 'true' of gray-scale 'false'

// output an image
// usage: <img src="visual-captcha.php" alt="Captcha image" />
$visualCaptcha->Create();
?>