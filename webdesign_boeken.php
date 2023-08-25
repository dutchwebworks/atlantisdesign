<?PHP include("atlantis_core/base.inc.php");	// Atlantis modules ?>
<?PHP new page_inc("default-html-dtd.inc.html"); ?>
<head>

<?PHP new page_inc("default-html-head.inc.html"); ?>

<meta name="description" content="Denk je dat je verstand hebt van webdesign? Lees de aangerade boeken" />
<meta name="keywords" content="webdesign, javascript, php, mysql, unobtrusive, progressive enhancement, graceful degradation, jeremy keith, jeffrey zeldman, eric meyer" />

<title><?php print($settings['main_title']); ?> &raquo; Webdesign &raquo; Boeken</title>

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
				Een aantal boeken welke zeker een aanrader zijn voor elke webdesigner / webdeveloper
			</p>
		</blockquote>
	</div>
	
	<div class="clear">&nbsp;</div>

	<div id="side" class="grid_5">
		<h2>Pagina index</h2>
		<p><a href="/webdesign">&laquo; Webdesign</a></p>

		<h2>Happy webbies</h2>
		<p>Leuke opzet van een website voor <strong>webnerds</strong>. Download 
		<a href="http://www.happywebbies.com/download" title="Desktop achtergronden" target="_blank">wallpapers</a> van je favoriete webguru.</p>
	
		<h2>Firebug</h2>
			<p><a href="http://www.getfirebug.com/?link=2" title="Firebug is a free web development tool for Firefox">
			<img src="/img/firebug2-trans.png" width="109" height="67" border="0" alt="Firebug - Web Development Evolved"/></a></p>
		<p>De tool voor webdesigners die met Css werken en bugs oplossen.</p>
		
		<h2>Links</h2>
		<?PHP
			$link = new mod_link_list();
			//$link->cat_split = false;
			$link->link_list();
		?>		
	</div>
	
	<div id="main" class="grid_11 omega">
		<h1>Webdesign boeken</h1>
			<p>
				Onderstaand staat een rijtje boeken die elke webdesigner zou moeten lezen. Voor het maken van een goede website komen heel wat technieken kijken.
			</p>
			
			<h4>Css Zengarden</h4>
			<p>
				Neem zeker een kijkje op <a href="http://www.csszengarden.com/" title="Mooiste voorbeelden van Css gebruik" target="_blank">Css Zengarden</a> en blader eens 
				door de verschillende Css stylesheets. De meest mooie ontwerpen (allemaal gemaakt met Css) zijn hier te zien.
			</p>
			
			<h2>Boek reviews</h2>
			
			<div class="bookReview">
				<h3 id="jeffrey-zeldman"><a href="http://www.zeldman.com/dwws/" title="Designing with web standards" target="_blank">Jeffery Zeldman - Desiging with web standards (2e edition)</a></h3>
				
				<p>
					<a href="http://www.zeldman.com/dwws/" title="Designing with web standards" target="_blank">
					<img class="float_right" src="/img/dwws2.jpg" alt="Boek cover - Desiging with web standards" /></a>
					Een goed boek dat iedere webdesigner / webdeveloper moet lezen is
					<a href="http://www.zeldman.com/" title="Jeffery Zeldman presents: The Daily Report" target="_blank">Jeffery Zeldman's</a> - Desiging with web standards
					<em>(nu in 2e edition)</em>.
				</p>
				
				<p>
					Het boek gaat niet in detail vertellen hoe je moet vormgeven of wat nodig hebt om een goede website te maken. 
					<strong>Het legt waarom we webstandaarden moeten gebruiken</strong> en wat de overduidelijke voordelen er van zijn.
					Ook wordt verteld hoe je andere (collega's, bazen en klanten) zal overtuigen van het gebruik van web standaarden.
					Niet veel boeken die over websites bouwen gaan, HTML programmering en Css nemen alle web browser en platformen eens tegen het licht. 
					De mensen die er echt verstand van hebben
					blijven gelukkig niet allemaal op het Microsoft platform met Internet Explorer hangen.
				</p>
			</div>
			
			<div class="bookReview">
				<h3 id="steve-krug"><a href="http://www.sensible.com/buythebook.html" title="Don't make me think" target="_blank">Steve Krug - Don't make me think! (2e edition)</a></h3>
				
				<p>
					<a href="http://www.sensible.com/buythebook.html" title="Don't make me think" target="_blank">
					<img class="float_right" src="/img/dmmt2.jpg" alt="Boek cover - Don't make me think" /></a>
					Geweldig en af en toe grappig boek over de manier waarop we het internet echt gebruiken. Hoe mensen meer <strong>pagina's scannen</strong> 
					dan daadwerkelijk lezen. Hij verteld veel over
					de dingen die eigenlijk heel normaal, gewoon en vooral voorspelbaar zijn in maken van een goede website.
				</p>
				
				<p>
					Hoe bepaalde elementen zich op een website zich voorspelbaar maken en gedragen. En ook op de goede plek staan. Maar vooral! <strong>Don't make me think</strong>.
				</p>
				
				<p>	
					Je gezonde verstand gebruiken en <strong>gebruikers van websites niet laten na denken</strong> over de navigatie of hoe bepaalde dingen werken op een website.
				</p>
			</div>
			
			<div class="bookReview">
				<h3 id="jeremy-keith-domscripting"><a href="http://www.domscripting.com/book/" title="DomScripting" target="_blank">Jeremy Keith - DomScripting</a></h3>
				<p>
					<a href="http://www.domscripting.com/book/" title="DomScripting" target="_blank">
					<img src="/img/domscripting.gif" class="float_right" alt="DomScripting by Jeremy Keith" /></a>
					Voor webdesigners die al wat kennis van Css hebben maar ook graag JavaScript willen leren is dit een heel goed boek. Als je voorstander ben van 
					webstandaarden, het scheiden van content, structuur, behaviour en presentation is een
					goede aanvulling in deze gedachte gang. <a href="http://en.wikipedia.org/wiki/Progressive_enhancement" target="_blank">Progressive enhancement</a> &amp; Graceful 
					degradation zijn de sleutelwoorden en zoals ik graag website wil maken.
				</p>
			</div>
			
			<div class="bookReview">
				<h3 id="jeremy-keith-bulletproof-ajax"><a href="http://bulletproofajax.com/" title="Bulletproof Ajax" target="_blank">Jeremy Keith - Bulletproof Ajax</a></h3>
				
				<p>
					<a href="http://www.bulletproofajax.com//" title="Bulletproof Ajax" target="_blank">
					<img src="/img/bulletproof_ajax.gif" class="float_right" alt="DomScripting by Jeremy Keith" /></a>
					<a href="http://domscripting.com/blog/display/41" title="Jeremy Keith about Hijax" target="_blank">Hijax</a>, een goede unobtrusive manier voor het 
					implementeren van Ajax technieken.
				</p>
				
				<p>
					Ajax ... het <strong>buzzword</strong> van de laatste tijd op webdesign gebied. Er zijn veel voordelen maar net zoveel nadelen te noemen over deze 
					techniek die toch al een aantal jaar bestaat.
				</p>
			</div>
			
			
			<div class="bookReview">
				<h3 id="john-resig-pro-javascript-techniques"><a href="http://jspro.org/" title="Pro Javascript Techniques" target="_blank">John Resig - Pro Javascript Techniques</a></h3>
				
				<p>
					<a href="http://jspro.org/" title="Pro Javascript Techniques" target="_blank">
					<img src="/img/pro_javascript_book.jpg" class="float_right" alt="Pro Javascript Techniques by John Resig" /></a>
					Heel goed boek als volgende stap om te lezen na <strong>DomScripting</strong> . <a href="http://ejohn.org/" target="_blank">John Resig</a> legt uit 
					hoe je bepaalde routines kan vergemakkelijken en functies kan schrijven die elkaar aanvullen.
				</p>	
				<p>	
					Op deze manier wordt je Javascript code heel kort en krachtig. Op de manier zoals hij het uitlegt kun je makkelijk de DOM tree aflopen. Het is een 
					pittig boek na DomScripting maar heel goed te doen.
				</p>
				<p>
					John Resig is ook de uitvinder, schrijven van <a href="http://jquery.com/" target="_blank">jQuery</a>.
				</p>
			</div>		
			
			<div class="bookReview">
				<h3 id="eric-meyer-more-eric-meyer-on-css"><a href="http://more.ericmeyeroncss.com/about-book.html" title="More Eric Meyer on Css" target="_blank">Eric Meyer - More Eric Meyer on Css</a></h3>
				
				<p>	
					<a href="http://more.ericmeyeroncss.com/about-book.html" title="More Eric Meyer on Css!" target="_blank">
					<img class="float_right" src="/img/more_e_meyer_css.jpg" alt="Boek cover - More Eric Meyer on Css!" /></a>
					Dit is ook al weer de <strong>2e editie</strong> van <a href="http://www.meyerweb.com/" target="_blank">Eric Meyer</a> op het gebied van Css webdesign. 
					Dit boek bevat leuke voorbeelden van het gebruik van Css.
				</p>
				
				<p>
					Een aantal praktijk voorbeelden worden hier gegeven op het gebied van Css. Het bouwen van een mooie photogallery, stylen van een raport en 
					een goed voorbeeld van een redesign van een fictieve website. Hierin laat hij zien hoe het met old-school tabellen is gebouwd en hoe deze website
					om te bouwen is naar Css.
				</p>
			</div>
			
			<div class="bookReview">
				<h3 id="eric-meyer-cascading-style-sheets"><a href="http://www.oreilly.com/catalog/css2/" title="More Eric Meyer on Css!" target="_blank">Eric Meyer - Cascading Style Sheets: The Definitive Guide (2e edition)</a></h3>
				<p>
					<a href="http://www.oreilly.com/catalog/css2/" title="More Eric Meyer on Css!" target="_blank">
					<img class="float_right" src="/img/css_oreilly.jpg" alt="Boek cover - Cascading Style Sheets: The Definitive Guide, Second Edition" /></a>
					Hij is wel de <strong>koning</strong> op het gebied van Css. Hij heeft ook voor <a href="http://www.oreilly.com/" title="O'Reilly website" target="_blank">O'Reilly</a> 
					een aantal boeken geschreven over Css.
				</p>
				
				<p>
					Dit boek bevat vooral veel naslag werk en hoe de verschillende elementen van Css werken. Erg saai dus maar wel leerzaam.
					Op <a href="http://meyerweb.com/eric/css/edge/" title="Complexe voorbeelden met Css" target="_blank">css/edge</a> staan een paar complexe voorbeelden van het 
					gebruik van Css in websites.
				</p>
			</div>	
		</div>	
	</div>

<?PHP new page_inc("footer.inc.html"); ?>

</body>
</html>