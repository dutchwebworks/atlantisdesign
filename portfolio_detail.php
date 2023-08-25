<?PHP 
include("atlantis_core/base.inc.php");	// Atlantis module 
$gallery_detail = new mod_gallery_detail();
$gallery_detail->detail_id = $_GET['gallery_id'];
$gallery_detail->cat_id = $_GET['gal_cat'];	
$article_list = new mod_article_list();
$gallery_list = new mod_gallery_list();
$meta_data = $gallery_detail->getMetaData();
?>

<?PHP include("atlantis_core/base.inc.php");	// Atlantis modules ?>
<?PHP new page_inc("default-html-dtd.inc.html"); ?>
<head>

<?PHP new page_inc("default-html-head.inc.html"); ?>

<meta name="description" content="<?php print($meta_data['description']); ?>" />
<meta name="keywords" content="<?php print($meta_data['keywords']); ?>" />

<title><?php print($settings['main_title']); ?> <?php print($meta_data['title'] ? " &raquo; ".$meta_data['title'] : false); ?></title>

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
			<p>
				Portfolio
			</p>
		</blockquote>	
	</div>
	
	<div class="clear">&nbsp;</div>

	<div id="side" class="grid_5">
		<?PHP 
			$gallery_list->template = "std_gallery_list_side.tmp";
			$gallery_list->gallery_list();
		?>	
	</div>
	
	<div id="main" class="grid_11 omega">
		<?PHP $gallery_detail->gallery_detail(); ?>	
		<!--
		<p><a href="slideshow.php?gal_cat=<?php echo($_GET['gal_cat']); ?>">Bekijk als slideshow</a></p>
		-->		
	</div>	
</div>

<?PHP new page_inc("footer.inc.html"); ?>

</body>
</html>