<?PHP 
session_start();
$backend = true;
include("../atlantis_core/base.inc.php");	// Atlantis module 

// login procedure
$auth = new mod_auth_base();
if($_GET['action'] == "logout"){
	$auth->logout();
} elseif(isset($_POST['username']) && isset($_POST['password'])){
	$auth->username = $_POST['username'];
	$auth->password = $_POST['password'];
	if($auth->login()) header("location:".$settings['backend_homepage']);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Login procedure</title>
<link href="../css/backend.css" rel="stylesheet" type="text/css" />

<meta name="copyright" content="Atlantisdesign 2005" />
<meta name="created" content="august 2005" />
<meta name="author" content="D. Burger" />

</head>
<body>

<div id="header">
	<div class="header_left">
		<div class="header_right">
			<h1><?PHP echo($settings['main_title']) ?> - Login</h1>
		</div>
	</div>			
</div>

<div id="content">
	<?PHP $auth->parse(); ?>
</div>
</body>
</html>