<?PHP include("atlantis_core/base.inc.php");	// Atlantis modules ?>
<?PHP new page_inc("default-html-dtd.inc.html"); ?>
<head>

<?PHP new page_inc("default-html-head.inc.html"); ?>

<meta name="description" content="Denk je dat je verstand hebt van webdesign? Lees de aangerade boeken" />
<meta name="keywords" content="webdesign, javascript, php, mysql, unobtrusive, progressive enhancement, graceful degradation, jeremy keith, jeffrey zeldman, eric meyer" />

<title><?php print($settings['main_title']); ?> &raquo; Webdesign &raquo; Conditional comments</title>

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
			<p>Dit is een heel handige truuk om juist de Internet Explorer 6 en 7 webbrowsers iets extra's te geven zodat ze ook netjes meespelen in de wereld van webstandaarden.</p>
		</blockquote>
	</div>
	
	<div class="clear">&nbsp;</div>

	<div id="side" class="grid_5">
		<h2>Pagina index</h2>
		<ul>
			<li><a href="#voorbeeld">Voorbeeld</a></li>
			<li><a href="#webbrowser-sniffers-vies">Webbrowser sniffer</a></li>
			<li><a href="#welke-webbrowser">Welke webbrowser?</a></li>
			<li><a href="#meer-informatie">Meer informatie</a></li>
		</ul>
	</div>
	
	<div id="main" class="grid_11 omega">
			<h1>Conditional comments</h1>
			<p> Internet Explorer heeft af en toe wel eens een verkeerde interpretatie van bepaalde HTML en/of CSS toepassingen. Het komt dus wel eens voor dat onderstaande CSS goed en gewenst is voor webbrowsers als <strong>Mozilla Firefox</strong>, <strong>Apple's Safari </strong>en <strong>Opera</strong>.</p>
			<h4>Compliant webbrowser CSS waarde</h4>
			<code>
			#mainContent {<br />
			&nbsp;&nbsp; width: 230px;<br />
			}
			</code>
			
			<h3>Internet Explorer</h3>
			<p>In <strong>IE6</strong> bijvoorbeeld past bovenstaande HTML element net niet tussen andere HTML blokken, die bijvoorbeeld floaten. Het liefst zou IE6 een <strong>andere waarde</strong> moeten krijgen als onderstaande. Maarja, hoe vertellen we IE6 dat hij de onderstaande waardes moet gebruiken?</p>
			<h4>IE6/7 CSS waarde</h4>
			
			<code>
			#mainContent {<br />
			&nbsp;&nbsp; width: 225px;<br />
			}	</code>	
			
			
			<h2 id="voorbeeld">Conditional comment, een voorbeeld</h2>
			<p>In de HTML-head van de pagina plaatsen we onderstaande regels. Let op! Dit moet <strong>na</strong> alle andere css-stylesheets geplaats worden.</p>
			<code> &lt;!--[if ie 6]&gt;<br />
		&lt;link href=&quot;css/ie6.css&quot; type=&quot;text/css&quot; rel=&quot;stylesheet&quot; media=&quot;screen&quot; /&gt; <br />
		&lt;![endif]--&gt;</code>
			<p>Goed, wat gebeurt hier? Na alle stylesheets wordt hier bekenen, alleen door Internet Explorer versies op het Windows platform, of de huidige Internet Explorer versie aan de <strong>IF</strong> statement voldoet. </p>
			<p><strong>Gebruikt men in dit voorbeeld de IE6 webbrowser</strong>, dan wordt bij alle andere stylesheets ook nog het <strong>ie6.css</strong> stylesheet bij geladen. In dit <strong>aparte</strong> stylesheet zijn de afwijkende waardes geschreven (zie voorbeeld aan het begin van deze pagina) die ervoor zorgen dat IE6 de CSS layout van een website ook goed op het scherm laat weergeven. </p>
			<p>In bovenstaand <strong>IF statement</strong> voorbeeld kunnen veel meer dingen getest worden. Zoals IE7, <strong>IE versies lager dan IE7</strong> (of IE6). In plaats van een stylesheet kan ook een ander stuk HTML geplaats worden, zoals een javascript.</p>
			<h3>W3C HTML-validatie</h3>
			<p>Het grote voordeel hiervan is dat <strong>alleen Internet Explorer</strong> dit leest. Omdat dit stukje code tussen valide HTML comment staat zal de HTML pagina die hiervan gebruik maakt gewoon valideren.</p>
			<h3>Nog een voorbeeld</h3>
			<p>Bekijk de HTML-source code van de pagina eens voor en goed voorbeeld.</p>
			<h2 id="webbrowser-sniffers-vies">Waarom webbrowser 'sniffers' vies zijn</h2>
			<p>Er is een tijdperk geweest dat er veel Javascripting gebruikt werd om te detecteren welke webbrowser de gebruiker van een website gebruikt. Hierdoor is het mogelijk voor de webdesigner om een zo goed mogelijk werkende website te serveren aan de gebruiker. Ondersteunt een bepaalde browser sommige features niet dan werden er andere oplossingen bedacht. Dit was ook in de tijd van de <a href="http://en.wikipedia.org/wiki/Browser_wars" target="_blank">browser wars</a>.</p>
			<p>Bij elke release van een nieuwe versie webbrowsers moet deze buggy javascripting weer getest worden. Het komt maar al te vaak voor dat deze scripting toch niet helemaal goed geschreven is en vaak resulteerd in onbruikbare HTML pagina's. Alleen maar ellende voor de eindgebruiker die met zijn nieuwste versie webbrowser graag informatie wil.</p>
			<h2 id="welke-webbrowser">Welke webbrowser gebruikt men?</h2>
			<p>Webdesigners willen graag weten welke webbrowser men gebruikt zodat er geen rare dingen zich voordoen in de zorgvuldig gemaakt website. <strong>IE6 en IE7 spannen de kroon wat betreft het niet zo volledig mogelijk volgen van webstandaarden</strong>. Deze browsers moeten we een handje helpen zodat de gemaakte website er ook goed uitziet in de webbrowsers die jammer genoeg het meeste marktaandeel hebben.</p>
			<p>Als de website eenmaal klaar is kunnen we deze gaan testen in de befaamde IE6 en IE7 webbrowsers. Komen er dan dingen aan het licht die niet helemaal kloppen kunnen we ons uren druk gaan maken en allerlei manier proberen om toch dezelfde CSS te gebruiken maar net zo lang pielen totdat het ook goed werkt in IE6 en IE7.</p>
			<p>Conditional comments zorgen ervoor dat je <strong>verschillende versies</strong> van Internet Explorer ook verschillende 'extra' stylesheets, javascripting etc. mee kan geven. Hierdoor kan de website gemaakt worden voor compliant webbrowsers als Mozilla Firefox, Apple's Safari en Opera <strong>EN</strong> Internet Explorer 6 en 7.</p>
			<h2 id="meer-informatie">Meer informatie over gebruik van conditional comments</h2>
			<p>Op de website van <strong>Peter-Paul Koch</strong>, <a href="http://www.quirksmode.org/css/condcom.html" target="_blank">QuirksMode</a>, worden ook wat zaken hierover uitgelegd. Conditional comments  is notabene een uitvinding van <a href="http://msdn2.microsoft.com/en-us/library/ms537512.aspx" target="_blank">Microsoft</a> zelf.</p>
		</div>	
	</div>

<?PHP new page_inc("footer.inc.html"); ?>

</body>
</html>