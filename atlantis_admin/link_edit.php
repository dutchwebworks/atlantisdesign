<?PHP 
session_start();
$backend = true;
include("../atlantis_core/base.inc.php");		// Atlantis module 
include("../atlantis_core/secure.inc.php");	// Backend security module 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Atlantisdesign - admin</title>
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
			<h1><?PHP echo($settings['main_title']) ?></h1>
		</div>
	</div>			
</div>

<div id="content">
	<?PHP
		$link_edit = new mod_link_edit();
		if($_GET['id']) $link_edit->id = $_GET['id'];
		if($_POST['del_link']) $link_edit->del_links($_POST['del_link']);
		
		$link_edit->heading = $_POST['insert_heading'];
		$link_edit->description = $_POST['insert_description'];
		$link_edit->url = $_POST['insert_url'];
		$link_edit->cat = $_POST['insert_categorie'];
		$link_edit->active = $_POST['active'] ? '1' : '0';
		
		if($_POST['insert']){
			$link_edit->insert();
		} elseif($_POST['update']){
			$link_edit->update();		
		}
		$link_edit->link_form();		
	
		$link_list = new mod_link_list();
		$link_list->show_inactive = true;
		$link_list->template = "backend_link_list.tmp";
		$link_list->link_list();
	?>
</div>

</body>
</html>