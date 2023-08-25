<?PHP
include("atlantis_core/base.inc.php");
include($settings['atlantis_core']."feedcreator.class.php");

$site_url = "http://".$_SERVER['SERVER_NAME'];

$rss = new UniversalFeedCreator(); 
$rss->useCached(); // use cached version if age<1 hour
$rss->title = $settings['main_title']." artikelen"; 
$rss->link = $site_url."/artikelen"; 
$rss->description = "Mac, webdesign en de Mac als webserver"; 

$rss_query = "SELECT art_heading title, art_intro description, DATE_FORMAT(art_date_insert,'%a, %d %b %Y %T') newsdate, art_postname link FROM ac_article a WHERE a.art_date_insert < NOW() AND NOW() < a.art_date_end  AND a.art_active = '1' ORDER BY art_date_insert DESC";
$db = new Core_Database();

if($result = $db->db_array($rss_query)) {
	foreach($result as $db_row) {
		$item = new FeedItem(); 
		$item->title = $db_row['title'];
		$item->date = $db_row['newsdate']." ".date('O'); // add the date plus the correct timezone support		
		$item->additionalElements['guid'] = $site_url."/artikel/".$db_row['link']; // W3C recommendation for 'permalinks'		
		$item->author = $settings['contact_email']." (D. Burger)"; // W3C recommended format
		$item->link = $site_url."/artikel/".$db_row['link'];
		$item->description = stripslashes($db_row['description']); 
		$item->source = $site_url; 
		$rss->addItem($item); 
	} 
	// Valid format strings are: 
	// RSS0.91, RSS1.0, RSS2.0, PIE0.1 (deprecated), MBOX, OPML, ATOM, ATOM0.3, HTML, JS
	echo $rss->saveFeed("RSS2.0", "article_rss.xml");
} else {
	echo("No data");
}
?> 