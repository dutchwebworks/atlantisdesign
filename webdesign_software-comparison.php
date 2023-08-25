<?PHP include("atlantis_core/base.inc.php");	// Atlantis modules ?>
<?PHP new page_inc("default-html-dtd.inc.html"); ?>
<head>

<?PHP new page_inc("default-html-head.inc.html"); ?>

<meta name="description" content="Denk je dat je verstand hebt van webdesign? Lees de aangerade boeken" />
<meta name="keywords" content="webdesign, javascript, php, mysql, unobtrusive, progressive enhancement, graceful degradation, jeremy keith, jeffrey zeldman, eric meyer" />

<title><?php print($settings['main_title']); ?> &raquo; Webdesign &raquo; Software</title>

</head>

<body id="webdesign" class="">
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
				Voor webdevelopment wordt veel verschillende (server) software gebruikt.
			</p>
		</blockquote>
	</div>
	
	<div class="clear">&nbsp;</div>

	<div id="side" class="grid_5">
		<h2>Pagina index</h2>
		<p><a href="/webdesign">&laquo; Webdesign</a></p>

		<h2>Artikelen</h2>
		<?PHP 
			$art_list = new mod_article_list();
			$art_list->template = "std_article_list_small.tmp"; 			
			$art_list->cat_split = true;
			$art_list->short_intro = false;
			$art_list->article_list();
		?>		
	</div>
	
	<div id="main" class="grid_11 omega">
		<h1>Software comparison</h1>
			<p>
				Hier volgt een soort <strong>comparison chart</strong> met meest gebruikte webdevelopment- en server software op het Windows platform in vergelijking met Mac / Linux (OpenSource) platform. 
				Veel van de software in deze lijst is ook een vergelijking met commerciele software waarvoor betaald moet worden. 
			</p>
			
			<p>	
				Dit in tegenstelling tot OpenSource (varianten) software wat je in de meeste gevallen gratis mag gebruiken.
			</p>
			
			<table border="0" summary="Software verschillen" class="design stripe">
					<tr>
							<th scope="col">Type software</th>
							<th scope="col">Windows</th>
							<th scope="col">Mac (OpenSource)</th>
					</tr>
					<tr>
							<td>Besturingssysteem</td>
							<td><a href="http://www.microsoft.com/windows/" target="_blank">Microsoft Windows</a></td>
							<td><a href="http://www.apple.com/macosx/" target="_blank">Mac OS X</a> / <a href="http://en.wikipedia.org/wiki/Linux" target="_blank">Linux</a></td>
					</tr>
					<tr>
							<td>Webserver</td>
							<td><a href="http://en.wikipedia.org/wiki/Internet_Information_Services" target="_blank">Microsoft IIS</a></td>
							<td><a href="http://en.wikipedia.org/wiki/Apache_%28HTTP_server%29" target="_blank">Apache</a></td>
					</tr>
					<tr>
							<td>Server side scripting</td>
							<td><a href="http://en.wikipedia.org/wiki/Active_Server_Pages" target="_blank">Microsoft ASP</a></td>
							<td><a href="http://en.wikipedia.org/wiki/Php" target="_blank">PHP</a> / <a href="http://en.wikipedia.org/wiki/Cold_Fusion_programming_language" target="_blank">ColdFusion</a></td>
					</tr>
					<tr>
							<td>&nbsp;</td>
							<td><a href="http://en.wikipedia.org/wiki/C_Sharp_%28programming_language%29" target="_blank">C#</a></td>
							<td><a href="http://en.wikipedia.org/wiki/Perl" target="_blank">Perl</a> / <a href="http://en.wikipedia.org/wiki/Python_%28programming_language%29" target="_blank">Python</a> / <a href="http://en.wikipedia.org/wiki/Ruby_%28programming_language%29" target="_blank">Ruby</a></td>
					</tr>
					<tr>
							<td>Webdevelopment frameworks</td>
							<td><a href="http://en.wikipedia.org/wiki/.NET_Framework" target="_blank">Microsoft .NET</a></td>
							<td><a href="http://en.wikipedia.org/wiki/Ruby_on_rails" target="_blank">Ruby on Rails</a></td>
					</tr>
					<tr>
							<td>Database</td>
							<td><a href="http://en.wikipedia.org/wiki/Mssql" target="_blank">Microsoft SQL</a></td>
							<td><a href="http://en.wikipedia.org/wiki/Mysql" target="_blank">MySQL</a> / <a href="http://en.wikipedia.org/wiki/Postgresql" target="_blank">PostgreSQL</a></td>
					</tr>
					<tr>
							<td>Version control</td>
							<td><a href="http://en.wikipedia.org/wiki/Microsoft_Visual_SourceSafe" target="_blank">Microsoft Visual Source Safe (VSS)</a></td>
							<td><a href="http://en.wikipedia.org/wiki/Subversion_(software)" target="_blank">CollabNet Subversion (SVN)</a></td>
					</tr>
					
					<tr>
							<td>Integrated Development Environment (IDE)</td>
							<td><a href="http://en.wikipedia.org/wiki/Microsoft_Visual_Studio" target="_blank">Microsoft Visual Studio</a></td>
							<td><a href="http://www.apple.com/macosx/developertools/xcode.html" target="_blank">Apple xCode</a> / <a href="http://en.wikipedia.org/wiki/Eclipse_ide" target="_blank">Eclipse</a></td>
					</tr>					
					<tr>
							<td>Code editor</td>
							<td><a href="http://www.ultraedit.com/" target="_blank">UltraEdit</a></td>
							<td><a href="http://www.barebones.com/products/bbedit/" target="_blank">BBEdit</a> / <a href="http://macromates.com/" target="_blank">TextMate</a></td>
					</tr>
					<tr>
							<td>File / folder comparison</td>
							<td><a href="http://www.scootersoftware.com/" target="_blank">Beyond Compare</a></td>
							<td><a href="http://www.changesapp.com/" target="_blank">Changes</a></td>
					</tr>
					<tr>
							<td>FTP client</td>
							<td><a href="http://filezilla-project.org/" target="_blank">FileZilla</a> / <a href="http://www.wsftp.com/" target="_blank">WS_FTP</a></td>
							<td><a href="http://www.panic.com/transmit/" target="_blank">Transmit</a> / <a href="http://fetchsoftworks.com/" target="_blank">Fetch</a></td>
					</tr>
					<tr>
							<td>Office productivity</td>
							<td><a href="http://en.wikipedia.org/wiki/Microsoft_Office" target="_blank">Microsoft Office</a></td>
							<td><a href="http://en.wikipedia.org/wiki/Openoffice" target="_blank">Sun OpenOffice.org</a></td>
					</tr>					
					<tr>
							<td>Design / Multimedia</td>
							<td><a href="http://en.wikipedia.org/wiki/Adobe_Creative_Suite" target="_blank">Adobe Creative Suite</a></td>
							<td><a href="http://en.wikipedia.org/wiki/Adobe_Creative_Suite" target="_blank">Adobe Creative Suite</a></td>
					</tr>					
			</table>
	</div>
</div>


<?PHP new page_inc("footer.inc.html"); ?>

</body>
</html>