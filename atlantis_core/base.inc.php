<?php
// gzip all php output
ob_start("ob_gzhandler");

// Define database username / password login
define('DB_HOST', '127.0.0.1');
// define('DB_USERNAME', 'atlanti');
define('DB_USERNAME', 'root');
// define('DB_PASSWORD', 'hijkb83');
define('DB_PASSWORD', '');
define('DB_NAME', 'atlantis');

// Database table's
$db_table['article'] = 					"ac_article";
$db_table['cat'] = 						"ac_cat";
$db_table['gallery'] = 					"ac_gallery";
$db_table['links'] = 					"ac_links";

// Settings
$settings['site_url'] =                 "/";
$settings['site_root'] =                "c:/Sites/atlantisdesign/httpdocs/";
$settings['backend'] =                  false;
$settings['require_url'] =				false;							// $backend wordt gezet door een boolean in pagina zelf
$settings['main_title'] = 				"Atlantisdesign";
$settings['includes'] = 				"includes/"; 										// User include files
$settings['atlantis_core'] =			"atlantis_core/";									// core directory
$settings['core_dir'] =			        "Core/";											// core directory
$settings['theme-name'] =				"ocean-view";										// theme name / dir. name

$settings['file_version_suffix'] =      "";

$settings['module_dir'] = 				$settings['atlantis_core']."modules/";
$settings['module_template_dir'] = 		$settings['module_dir']."templates/";
$settings['atlantis_uploads'] = 		"atlantis_uploads/uploads/";
$settings['gallery_upload_large'] = 	"atlantis_uploads/gallery_large/";
$settings['gallery_upload_thumb'] = 	"atlantis_uploads/gallery_thumb/";
$settings['article_rss_url'] = 			$settings['site_url']."artikelen/rss";

// Setting contact formulier en redirects
$settings['contact_email'] = 			"info@atlantisdesign.nl";
$settings['contact_bedankt_pagina'] = 	"/contact/bedankt"; 	
$settings['contact_fout_pagina'] = 		"/contact/fout"; 	

// Backend login
$settings['admin_username'] = 			"atlanti";
$settings['admin_password'] = 			"71f0597a04bcc3f3c8dc9c1002ca4e36"; 				// md5 hash
$settings['backend_homepage'] = 		"menu.php";

// Database abstracion class & template class import
require_once($settings['require_url'].$settings['core_dir']."Database.inc.php");
require_once($settings['require_url'].$settings['core_dir']."Template.inc.php");
require_once($settings['require_url'].$settings['core_dir']."Functions.inc.php");
require_once($settings['require_url'].$settings['core_dir']."Classes.inc.php");

// --------- BEGIN FRONT-END MODULE INCLUSION --------- //
require_once($settings['require_url'].$settings['module_dir']."page_inc.mod.php");			// Pagina include module
require_once($settings['require_url'].$settings['module_dir']."article.mod.php");			// Article module
require_once($settings['require_url'].$settings['module_dir']."links.mod.php");				// LInks module
require_once($settings['require_url'].$settings['module_dir']."links_edit.mod.php");		// Link module
require_once($settings['require_url'].$settings['module_dir']."gallery.mod.php");			// Gallery module
require_once($settings['require_url'].$settings['module_dir']."file_upload.mod.php");		// upload file module
// --------- END FRONT-END MODULE INCLUSION --------- //
