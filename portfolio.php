<?PHP include("atlantis_core/base.inc.php");	// Atlantis modules ?>
<?PHP new page_inc("default-html-dtd.inc.html"); ?>
<head>

<?PHP new page_inc("default-html-head.inc.html"); ?>

<link href="/themes/base/css/lightbox.css" rel="stylesheet" type="text/css" media="screen" />

<meta name="description" content="Persoonlijke portfolio voor Photoshop collages en webdesigns" />
<meta name="keywords" content="portfolio, foto, fotografie, persoonlijk, mac, apple, wolken, webdesign, collages, photoshop" />

<title><?php print($settings['main_title']); ?> &raquo; Portfolio</title>

</head>

<body id="portfolio" class="">
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
			<p>Hieronder een greep uit mijn persoonlijke portfolio.</p>
		</blockquote>
	</div>
	
	<div class="clear">&nbsp;</div>

	<div id="side" class="grid_5">
		<h2 class="headTitle">Opleiding</h2>
		<p>
			In het dagelijks leven ben ik een <strong>Multimedia Vormgever</strong> en heb mijn studie enige jaren geleden succesvol afgerond aan het 
			<a href="http://www.glr.nl/" title="Grafisch Lyceum Rotterdam" target="_blank">Grafisch Lyceum Rotterdam</a>.
			Mijn dagelijks werkzaamheden bestaan uit het vervaardigen van websites. Van concept tot uitvoering en onderhoud.
			Daarbij hoort vormgeving, HTML programmering en veel communicatie tussen vormgevers, programmeurs en klanten.
		</p>
		
		<h2>Made on a Mac</h2>
		<?PHP new page_inc("madeonamac"); ?>
	
		<h2>Artikelen</h2>
		<?PHP 
			$article_list = new mod_article_list();
			$article_list->template = "std_article_list_small.tmp";
			$article_list->article_list();
		?>	
		
		<h2>Links</h2>
		<?PHP
			$side = new mod_link_list();
			$side->cat_split = true;
			$side->link_list();
		?>	
	</div>
	
	<div id="main" class="grid_11 omega">
			<h1>Portfolio &amp; fotografie</h1>
	
			<p>
				Ik vind het leuk om collages te maken waardoor een hele nieuwe wereld gecre&euml;erd wordt
				waarin de schaal niet klopt en vooral om verschillende seizoenen bij elkaar te brengen.
				Het is op datum gesorteerd dus het oudste werk staat onderaan.
			</p>
	
			<h2>Update</h2>
			<p>
				Hier komt binnenkort een overzicht van mijn webdesign werk te staan. Onderstaand is eigenlijk materiaal wat ik vroeger op school gemaakt had.
			</p>		
	
	
			<h2>Photoshop collages, fotografie en zomaar wat foto's</h2>
			<p>
				Hieronder staan een paar portfolio plaatjes die ik destijds op school gemaakt heb.
				Tevens staat hier wat fotografie werk en natuurlijk foto's van Apple producten waar we trots op zijn.
			</p>	
	
			
			<?PHP 
				$gallery_list = new mod_gallery_list();
				$gallery_list->template = "std_gallery_table.tmp";
				$gallery_list->gallery_list();
			?>	
		
			<p>
				De plaatjes die hierboven verschijnen zijn willekeurig van soort en komen uit verschillende categorie&euml;n.
				Bovenstaande image photogallery is een plekje op de website waar ik leuke collages neer zet. Ik vind het leuk om collages te maken waarin de schaal niet klopt
				of juist dat het tijdstil helemaal niet klopt. Zoals een strand scene in een bevroren bos neerzetten. Het geeft verassende beelden op.
			</p>		
		</div>	
	</div>

<?PHP new page_inc("footer.inc.html"); ?>

<script src="/themes/base/js/prototype.js" type="text/javascript"></script>
<script src="/themes/base/js/scriptaculous.js?load=effects" type="text/javascript"></script>
<script src="/themes/base/js/lightbox.js" type="text/javascript"></script>

</body>
</html>