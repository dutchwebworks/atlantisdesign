<?PHP include("atlantis_core/base.inc.php");	// Atlantis modules ?>
<?PHP new page_inc("default-html-dtd.inc.html"); ?>
<head>

<?PHP new page_inc("default-html-head.inc.html"); ?>

<meta name="description" content="Artikelen over  Mac OS X en de inrichting als webserver" />
<meta name="keywords" content="php, mysql, ftp, pureftpd, mac, os x, tiger, php, apaache, apple, postfix, firewall, beveiliging" />

<title><?php print($settings['main_title']); ?> &raquo; Mozilla Firefox</title>

</head>

<body id="firefox" class="">
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
				Graag deel ik mijn ervaring op het gebied van Mac OS X.
				Ik vind het leuk om met  Unix te spelen op de Mac en daarmee mijn kennis verder uit te breiden.
				Veel informatie kunt u hier vinden over het opzetten van een Mac webserver.
			</p>
		</blockquote>	
	</div>
	
	<div class="clear">&nbsp;</div>

	<div id="side" class="grid_5">
		<h2 class="headTitle">Firebug</h2>
		<p><a href="http://www.getfirebug.com/?link=2" title="Firebug is a free web development tool for Firefox"><img src="/img/firebug2-trans.png" width="109" height="67" border="0" alt="Firebug - Web Development Evolved"/></a></p>
		<p>De tool voor webdesigners die met Css werken en bugs oplossen.</p>		
		
			<h2>Artikelen</h2>
			<?PHP 
				$art_list = new mod_article_list(); 
				//$art_list->cat_split = false; 
				$art_list->template = "std_article_list_small.tmp"; 			
				$art_list->article_list();
			?>	
	</div>
	
	<div id="main" class="grid_11 omega">
				<h1>Mozilla Firefox</h1>
				<p>
					De Firefox browsers is naar mijn smaak de beste webbrowser. En het is nog <strong>gratis</strong> ook! Er zijn veel extentions voor beschikbaar die het maken van websites, voor webdesingers, erg handig maakt.
					Bovendien volgt deze browser wel de <a href="http://www.w3.org/TR/xhtml1/" title="World Wide Web Consortium XHTML specificaties" target="_blank">W3C (X)HTML standaarden</a> en de Css ondersteuning werkt zoals het is bedoeld. Dat kunnen we niet zeggen van Microsoft Internet Explorer.
				</p>
				
				<h2>Download Mozilla Firefox vandaag nog!</h2>
				<p>
					De <a href="http://www.mozilla.com/firefox/" title="Download Firefox" target="_blank">Firefox webbrowers</a> is ook in het <a href="http://www.mozilla-europe.org/nl/products/firefox/" title="Nederlands talige Firefox" target="_blank">Nederlands verkrijgbaar</a>.
				</p>
				
				<p>
					<a href="http://www.spreadfirefox.com/?q=affiliates&amp;id=0&amp;t=213"><img alt="Firefox 2" title="Firefox 2" src="/img/mozilla_get_firefox.png"/></a>
				</p>
				
				<h2>Mozilla Thunderbird, mail programma</h2>
				<p>
					Het alternatief op het Microsoft Outlook (Express) mail programma. Tevens ook <strong>gratis</strong>! Veel minder vatbaar voor virussen en ander gespuis. Doordat deze niet standaard emails met schadelijke programma's zomaar laat opstarten bijvoorbeeld.
					
				</p>
				<p>
					<a href="http://www.spreadfirefox.com/?q=affiliates&amp;t=176" target="_blank"><img alt="Get Thunderbird!" title="Get Thunderbird!" src="/img/mozilla_thunderbird_logo.png"/></a>				
				</p>
				
				<h2 id="firefox-addons">Handige extentions voor webdesigners </h2>
				<p>Firefox (en Netscape 9) kun je uitbereiden met vele <a href="https://addons.mozilla.org/" target="_blank">add-ons</a>. Hieronder een lijst met mijn persoonlijke favorieten.</p>
				<ul>
						<li><a href="http://chrispederick.com/work/webdeveloper/" target="_blank">WebDeveloper toolbar</a></li>
						<li><a href="http://www.joehewitt.com/software/firebug/" target="_blank"> FireBug</a></li>
						<li><a href="http://www.puidokas.com/portfolio/gridfox/" target="_blank"> GridFox</a></li>	
						<li><a href="http://users.skynet.be/mgueury/mozilla/download.html" target="_blank">HTML Validator</a></li>
						<li><a href="http://www.iosart.com/firefox/colorzilla/" target="_blank">ColorZilla</a></li>
						<li><a href="https://addons.mozilla.org/en-US/firefox/addon/2076" target="_blank">JS View</a></li>
						<li><a href="https://addons.mozilla.org/firefox/260/" target="_blank">TabClicking Options</a></li>
						<li><a href="http://www.microsoft.com/downloads/details.aspx?FamilyID=e59c3964-672d-4511-bb3e-2d5e1db91038&amp;displaylang=en" target="_blank">Internet Explorer WebDev toolbar</a></li>
						<li><a href="http://ieview.mozdev.org/installation.html" target="_blank">IEView</a></li>
						<li><a href="http://operaview.mozdev.org/install.html" target="_blank">Opera view</a></li>
						<li><a href="http://css.weblogsinc.com/2006/02/14/firefox-extensions-i-couldnt-live-without/" target="_blank">Verzamel pagina</a></li>				
				</ul>
				
				<h2>CSS Refresh truuk</h2>
				
				<p>Deze truuk zorgt ervoor dat je alleen de CSS in een Mozilla webbrower (Firefox en Netscape) herlaad. Hierdoor wordt niet de gehele pagina herladen.</p>
				
				<p>1) Maak een bookmark aan op de Personal toolbar favorites.</p>
				
				<p>2) Geef het een naam als: CSS Refresch</p>				
				
				<p>3) Plak onderstaand Javascript in de 'location'.</p>
				
				<p>
					<code>
						javascript:void(function(){var i,a,s;a=document.getElementsByTagName('link');for(i=0;i&lt;a.length;i++){s=a[i];if(s.rel.toLowerCase().indexOf('stylesheet')&gt;=0&amp;&amp;s.href) {var h=s.href.replace(/(&amp;|%5C?)forceReload=d+/,'');s.href=h+(h.indexOf('?')&gt;=0?'&amp;':'?')+'forceReload='+(new Date().valueOf())}}})();				
					</code>
				</p>
				
				<p>
					Deze handige truuk heb ik niet zelf uitgevonden maar is terug te vinden op onderstaande website. Het ontwikkelen van websites 
					wordt soms heel complex en je hoeft ook niet altijd de complete pagina te herladen ... alleen de CSS als je met webdesign bezig bent. 
					Deze truuk biedt zeker uitkomst.
				</p>
				
				<p><em>Bron: <a href="http://www.ovelha.org/pasteler0/2007/02/25/css-refresh/" target="_blank">HowTo: CSS Refresh for Mozilla Firefox</a></em></p>
	</div>	
</div>

<?PHP new page_inc("footer.inc.html"); ?>

</body>
</html>