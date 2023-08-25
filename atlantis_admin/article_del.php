<?PHP 
session_start();
$backend = true;
include("../atlantis_core/base.inc.php");	// Atlantis module 
include("../atlantis_core/secure.inc.php");	// Backend security module 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?PHP echo($settings['main_title']) ?> - Article list</title>
<link href="../css/backend.css" rel="stylesheet" type="text/css" />
<script src="js/bbcode.js" type="text/javascript"></script>

<meta name="copyright" content="Atlantisdesign 2005" />
<meta name="created" content="august 2005" />
<meta name="author" content="D. Burger" />

</head>
<body>

<div id="header">
	<div class="header_left">
		<div class="header_right">
			<h1><?PHP echo($settings['main_title']) ?> - Article list</h1>
		</div>
	</div>			
</div>

<div id="content">
	<?PHP
		$article_admin = new mod_article_edit();
		if($_GET['article_id']) $article_admin->id = $_GET['article_id'];
		
		$article_admin->cat = $_POST['cat'];
		$article_admin->intro = $_POST['intro'];
		$article_admin->heading = $_POST['heading'];	
		$article_admin->body = $_POST['art_body'];
		$article_admin->date_end = $_POST['end_year'].$_POST['end_month'].$_POST['end_days']."000000";
					
		
		// insert or update
		if($_POST['insert']){
			$article_admin->insert();
		} elseif($_POST['update']){
			$article_admin->update();	
		}	
		$article_admin->article_list();
	?>
</div>

</body>
</html>