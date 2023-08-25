<?PHP 
include("atlantis_core/base.inc.php");	// Atlantis module 
$article = new mod_article_detail();
//if($_GET['article_id']) $article->article_id = $_GET['article_id'];
if($_GET['postname']) $article->postname = $_GET['postname'];
$art_list = new mod_article_list();
$meta_data = $article->getMetaData();
?>

<?PHP new page_inc("default-html-dtd.inc.html"); ?>
<head>

<?PHP new page_inc("default-html-head.inc.html"); ?>

<meta name="date" content="<?php print($meta_data['date']); ?>" />

<meta name="description" content="<?php print($meta_data['description']); ?>" />
<meta name="keywords" content="<?php print($meta_data['keywords']); ?>" />

<title><?php print($settings['main_title']); ?> <?php print($meta_data['title'] ? " &raquo; ".$meta_data['title'] : false); ?></title>

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
			<p><?php $article->getIntro(); ?></p>	
		</blockquote>
	</div>
	
	<div class="clear">&nbsp;</div>

	<div id="side" class="grid_5">
		<h2 class="headTitle">Artikelen</h2>
		<?PHP  
			$art_list->template = "std_article_list_small.tmp"; 		
			$art_list->article_list(); 
		?>
	</div>
	
	<div id="main" class="grid_11 omega">
		<?PHP $article->article_detail(); ?>
	</div>
</div>


<?PHP new page_inc("footer.inc.html"); ?>

</body>
</html>