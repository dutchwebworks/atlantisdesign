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
<script src="js/bbcode.js" type="text/javascript"></script>

<meta name="copyright" content="Atlantisdesign 2005" />
<meta name="created" content="august 2005" />
<meta name="author" content="D. Burger" />

</head>
<body>

<div id="header">
	<div class="header_left">
		<div class="header_right">
			<h1><?PHP echo($settings['main_title']) ?> - Article uploads</h1>
		</div>
	</div>			
</div>

<div id="content">
	<?PHP
		$article_upload = new file_upload();
		if($_FILES['file']['tmp_name']){
			$article_upload->file_to_upload = $_FILES['file']['tmp_name'];
			$article_upload->file_new_name = $_FILES['file']['name'];
			$article_upload->max_width = 200;			
			$article_upload->destionation_dir = $settings['backend'].$settings['atlantis_uploads'];		
		}		
		$article_upload->upload();
		
		$file_list = new file_list();
		$file_list->path = $settings['backend'].$settings['atlantis_uploads'];
		$file_list->get_file_list();
		
	?>
</div>

</body>
</html>