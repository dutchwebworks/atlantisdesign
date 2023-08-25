<?PHP include("atlantis_core/base.inc.php");	// Atlantis modules ?>
<?PHP new page_inc("default-html-dtd.inc.html"); ?>
<head>

<?PHP new page_inc("default-html-head.inc.html"); ?>

<meta name="description" content="Fout in het verwerken van het formulier" />
<meta name="keywords" content="contact, atlantisdesign, email" />

<title><?php print($settings['main_title']); ?> &raquo; Fout in het verwerken van het formulier</title>

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
			<p>Verwerkingsfout!</p>
		</blockquote>
	</div>
	
	<div class="clear">&nbsp;</div>

	<div id="side" class="grid_5">
		<h2>Artikelen</h2>
		<?PHP 
			$art_list = new mod_article_list(); 
			$art_list->template = "std_article_list_small.tmp"; 					
			$art_list->article_list();
		?>			
		<h2>Made on a Mac</h2>		
		<?PHP new page_inc("madeonamac.inc.html"); ?>		
	</div>
	
	<div id="main" class="grid_11 omega">
		<h1>Fout in het verwerken van het formulier</h1>
		<ul>
			<li>Heeft u alle verplichte velden (voorzien van een * en licht gekleurd) ingevuld?</li>
			<li>En de <strong>correcte</strong> <a href="http://nl.wikipedia.org/wiki/Captcha" target="_blank">captcha-code</a> overgenomen?</li>
			<li>Probeert u het later <a href="/contact/">opnieuw</a>.</li>
		</ul>		
	</div>
</div>

<?PHP new page_inc("footer.inc.html"); ?>

</body>
</html>