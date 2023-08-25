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
<title>Atlantisdesign - admin</title>
<link href="../css/backend.css" rel="stylesheet" type="text/css" />

<meta name="copyright" content="Atlantisdesign 2005" />
<meta name="created" content="august 2005" />
<meta name="author" content="D. Burger" />

</head>
<body>

<div id="header">
	<div class="header_left">
		<div class="header_right">
			<h1><?PHP echo($settings['main_title']) ?> - Menu</h1>
		</div>
	</div>			
</div>

<div id="content">
<ul>
	<li><a href="article_edit.php" target="_top">New article</a></li>
	<li><a href="article_list.php" target="_top">Article list</a></li>	
	<li><a href="link_edit.php" target="_top">Links</a></li>
	<!--
	<li><a href="categorien.php" target="_top">Categoriën</a></li>
	<li><a href="gallery.php" target="_top">Gallery</a></li>
	-->
	<li><a href="index.php?action=logout" target="_top">Logout</a></li>
</ul>

</body>
</html>