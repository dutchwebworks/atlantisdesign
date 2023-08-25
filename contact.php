<?PHP include("atlantis_core/base.inc.php");	// Atlantis modules ?>
<?PHP new page_inc("default-html-dtd.inc.html"); ?>
<head>

<?PHP new page_inc("default-html-head.inc.html"); ?>

<meta name="description" content="Al geef ik geen uitgebreide ondersteuning op artikelen die ik geschreven hebt kunt u wel contact opnemen." />
<meta name="keywords" content="contact, atlantisdesign, email, artikelen, mac, php, mysql, unix" />

<title><?php print($settings['main_title']); ?> &raquo; Contact</title>

</head>

<body id="contact" class="">
<p id="skipNav" class="hide non_print"><a href="#main" accesskey="2">Direct naar de tekst</a></p>

<div id="wrapper" class="container_16 content">

	<div id="nav" class="grid_16">
		<?PHP new page_inc("main-nav.inc.html"); ?>
	</div>

	<div id="header" class="grid_16">
		<h1><?php print($settings['main_title']); ?></h1>
		<p><img class="hide" src="/img/atlantis_logo_print.gif" alt="<?php print($settings['main_title']); ?> logo" /></p>
		<h2 id="tagline"><span class="head">WEBdesign</span> &amp; the Mac</h2>
	</div>
	
	<div id="intro" class="grid_16">
		<blockquote>
			<p>Al geef ik geen uitgebreide ondersteuning op artikelen die ik geschreven hebt kunt u wel contact opnemen.</p>
		</blockquote>
	</div>
	
	<div class="clear">&nbsp;</div>

	<div id="side" class="grid_5">
		<h2>Made on a Mac</h2>
		<?PHP new page_inc("madeonamac.inc.html"); ?>	
	
		<h2>Links</h2>
		<?PHP
			$link = new mod_link_list();
			$link->link_list();
		?>			
	</div>
	
	<div id="main" class="grid_11 omega">
		<h1>Contactformulier</h1>
		<div id="contactDisplay">
		
			<!-- contact form -->
						
			
			<form name="contactForm" id="contactForm" method="post" action="/atlantisMail.php">
				<p><label for="naam">Naam*</label><input type="text" id="naam" name="naam" class="validateRequired" value="Uw voor- en achternaam" title="Uw naam lijkt me toch wel verplicht" tabindex="1" /></p>
				<p><label for="email">E-mail*</label><input type="text" id="email" name="email" class="validateEmail validateRequired" value="Een correct e-mail adres"  title="Een correct e-mail adres zou ook handig zijn voor een reactie!" tabindex="2" /></p>
				<p><label for="website">Website</label><input type="text" id="website" name="website" class="validateUrl" title="Een correcte webadres, met 'http://' zou helpen" value="Heeft u een website?" tabindex="3" /></p>			
				<p><label for="onderwerp">Onderwerp*</label><input type="text" id="onderwerp" name="onderwerp" class="validateRequired" value="Waar heeft uw vraag of opmerking betrekking op?" title="Wat is het onderwerp van uw vraag / opmerking?" tabindex="4" /></p>							
				<p><label for="bericht">Bericht*</label><textarea id="bericht" name="bericht" class="validateRequired" title="Heeft u geen vragen of niks te vertellen?" cols="20" rows="8" tabindex="5">... en uw vraag / opmerking is ...</textarea></p>
				<p><label><a href="http://nl.wikipedia.org/wiki/Captcha" target="_blank" title="Wat is dit?">Captcha</a></label><img src="/visual-captcha.php" id="captchaImg" alt="captcha code" /></p>
				<p><label for="user_code">Code*</label><input type="text" class="validateRequired" title="Typ de juiste code over van het plaatje" id="user_code" name="user_code" value="Typ de code hierboven over" /></p>				
				
				<div class="formIndent">
					<p>
						<input class="formButton" type="submit" id="submit" name="submit" value="Verzend" tabindex="6" />
						<input class="formButton" type="reset" name="reset" id="reset" value="Overnieuw beginnen" tabindex="7" />
					</p>
					<p><em>Licht gekleurde velden (met een sterretje) zijn verplicht.</em></p>					
				</div>
			</form>	

		</div>
		
		<h2>Artikelen</h2>
		<?PHP 
			$art_list = new mod_article_list();
			$art_list->template = "std_article_list_table.tmp";
			$art_list->cat_split = true;
			$art_list->short_intro = false;
			$art_list->article_list();
		?>	
		</div>
	
	</div>	

<?PHP new page_inc("footer.inc.html"); ?>

<script src="/themes/base/js/formvalidation.js" type="text/javascript"></script>
<script src="/themes/base/js/ajax_contactform.js" type="text/javascript"></script>

</body>
</html>