<?PHP include("atlantis_core/base.inc.php");	// Atlantis modules ?>
<?PHP new page_inc("default-html-dtd.inc.html"); ?>
<head>

<!-- begin artikelen RSS feed -->
<link rel="alternate" type="application/rss+xml" title="<?PHP echo($settings['main_title']) ?> artikelen RSS" href="/<?PHP echo($settings['site_url']) ?>artikelen/rss" />
<!-- begin artikelen RSS feed -->

<?PHP new page_inc("default-html-head.inc.html"); ?>

<meta name="description" content="Artikelen over  Mac OS X en de inrichting als webserver" />
<meta name="keywords" content="php, mysql, ftp, pureftpd, mac, os x, tiger, php, apaache, apple, postfix, firewall, beveiliging" />

<title>Atlantisdesign &raquo; Error 403, forbidden</title>

</head>

<body class="">
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
				Error 403, forbidden</p>
		</blockquote>
	</div>
	
	<div class="clear">&nbsp;</div>

	<div id="side" class="grid_5">
		<h2>Links</h2>
		<?PHP
			$link = new mod_link_list();
			$link->link_list();
		?>			
	</div>
	
	<div id="main" class="grid_11 omega">
		<h1>Verboden toegang</h1>
	
		<p>U heeft geen toegang om de opgevraagde pagina of map te bekijken.</p>
			
		<h2>Artikelen</h2>
		<?PHP 
			$art_list = new mod_article_list();
			$art_list->template = "std_article_list_table.tmp";
			$art_list->cat_split = true;
			$art_list->short_intro = true;
			$art_list->article_list();
		?>	
		
		<h2>Willekeurige afbeelding</h2>
		<p>Klik op de foto voor meer van deze photogallery</p>

		<?PHP
			$show_pic = new mod_gallery_detail();
			$show_pic->template = "std_gallery_detail_single.tmp";
			//$show_pic->detail_id = 3;
			$show_pic->cat_id = 5;
			$show_pic->random = true;
			$show_pic->gallery_detail();
			
		?>		
		
		<h2>Made on a Mac</h2>
		<?PHP new page_inc("madeonamac.inc.html"); ?>	
	</div>
</div>

<?PHP new page_inc("footer.inc.html"); ?>

</body>
</html>