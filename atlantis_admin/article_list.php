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
<title><?PHP echo($settings['main_title']) ?> - Edit article's</title>
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
			<h1><?PHP echo($settings['main_title']) ?> - Edit article's</h1>
		</div>
	</div>
</div>

<div id="content">
	<?PHP
		$article_admin = new mod_article_list();
		$article_admin->show_inactive = true;
		if($_POST['del_article']) $article_admin->del_article($_POST['del_article']);
		$article_admin->template = "backend_article_list.tmp";
		$article_admin->article_list();
	?>
</div>
</body>
</html>