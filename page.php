<?PHP include("atlantis_core/base.inc.php");	// Atlantis modules ?>
<?PHP new page_inc("default-html-dtd.inc.html"); ?>
<head>

<?PHP new page_inc("default-html-head.inc.html"); ?>

<meta name="description" content="Atlantisdesign" />
<meta name="keywords" content="webdesign, mac, macintosh, apple, webdevelopemnt, webserver, apache, php, mysql, mac os x, tiger" />

<title><?php print($settings['main_title']); ?></title>

</head>

<body id="" class="">
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
			<p>
				Graag deel ik mijn ervaring op het gebied van Mac OS X.
				Ik vind het leuk om met  Unix te spelen op de Mac en daarmee mijn kennis verder uit te breiden.
				Veel informatie kunt u hier vinden over het opzetten van een Mac webserver.
			</p>
		</blockquote>	
	</div>
	
	<div class="clear">&nbsp;</div>

	<div id="side" class="grid_5">
		<h2>Links</h2>
		<?PHP
			$side = new mod_link_list();
			$side->link_list();
		?>				
		<?PHP new page_inc($_GET['page']); ?>
	</div>
	
	<div id="main" class="grid_11 omega">
		<h2>Artikelen</h2>
		<?PHP 
			$art_list = new mod_article_list(); 
			$art_list->article_list();
		?>
	</div>	
</div>

<?PHP new page_inc("footer.inc.html"); ?>

</body>
</html>