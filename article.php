<?PHP include("atlantis_core/base.inc.php");	// Atlantis modules ?>
<?PHP new page_inc("default-html-dtd.inc.html"); ?>
<head>

<!-- begin artikelen RSS feed -->
<link rel="alternate" type="application/rss+xml" title="<?PHP echo($settings['main_title']) ?> artikelen RSS" href="/<?PHP echo($settings['site_url']) ?>artikelen/rss" />
<!-- begin artikelen RSS feed -->

<?PHP new page_inc("default-html-dtd.inc.html"); ?>
<head>

<?PHP new page_inc("default-html-head.inc.html"); ?>

<meta name="description" content="Artikelen over  Mac OS X en de inrichting als webserver" />
<meta name="keywords" content="php, mysql, ftp, pureftpd, mac, os x, tiger, php, apaache, apple, postfix, firewall, beveiliging" />

<title><?php print($settings['main_title']); ?> &raquo; Artikelen</title>

</head>

<body id="artikelen" class="">
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
		<h2 class="headTitle">Links</h2>
		<?PHP
			$side = new mod_link_list();
			//$side->cat_split = false;
			$side->link_list();
		?>		
	</div>
	
	<div id="main" class="grid_11 omega">
		<h1>Artikelen</h1>
		<p>
			<a href="http://www.apple.com/macosx/" title="Apple.com" target="_blank">Apple's Mac OS X</a> is een Unix variant die goed gebruikt kan worden als webserver. Hier vind u
			diverse artikelen voor het opzetten van een Mac webserver met PHP5, MySQL4 en PureFTPd.
			Verder vind u handige extra's voor Mac OS X en andere zaken die te maken hebben met het Mac OS X systeem.
		</p>
		
		<h3 class="attention">Let op!</h3>
		<p>
			Voor deze artikelen kan AtlantisDesign <strong>geen verantwoordelijkheid</strong> nemen voor eventuele schade aan uw 
			eigen systeem. U bent zelf verantwoordelijk voor uw eigen systeem. Het is aan te raden backups te maken
			van diverse Unix configuratie bestanden voordat u hieraan gaat sleutelen.
		</p>
		
		<p>
			AtlantisDesign geeft <strong>geen ondersteuning</strong> voor deze artikelen. De beschrijvingen bieden geen garantie tot succes.
			Deze artikelen zijn geschreven en worden beschreven aan de hand van eigen 'trial-and-error' situaties. Er wordt een methode beschreven
			wat het best uitpakt in een bepaalde situatie.
		</p>		
		
		<?PHP 
			$art_list = new mod_article_list();
			$art_list->template = "std_article_list_table.tmp";
			$art_list->cat_split = true;
			$art_list->short_intro = false;
			$art_list->article_list();
		?>
		
		<h2>Made on a Mac</h2>
		<?PHP new page_inc("madeonamac.inc.html"); ?>	
	</div>	
</div>

<?PHP new page_inc("footer.inc.html"); ?>

</body>
</html>