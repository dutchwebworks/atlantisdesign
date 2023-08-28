---
title: "Apache deflate en expire-headers"
description: "Comprimeren van bepaalde bestandstypen voordat deze naar de eindgebruiker gestuurd worden. Daarbij kunnen we ook aangeven dat bepaalde bestanden voor langere tijd bewaard kunnen worden in de webbrowser cache."
pubDate: 2008-05-31
---

# Apache deflate en expire-headers

Een standaard module in Apache 2.x (MacOS X Leopard) is de [Apache mod_deflate module](http://httpd.apache.org/docs/2.0/mod/mod_deflate.html). In Apache 1.x wordt de mod_gzip module gebruikt met vergelijkbare werking.

Elke keer als een webserver een bestand verstuurd wordt deze vooraf gegaan aan **header** informatie. Hierin staat bijvoorbeeld wat voor soort bestand het is zodat de webbrowser weet wat deze ermee moet doen (plaatjes, video, Flash bestanden of platte HTML). Dit heet ook wel de [mime-type](http://en.wikipedia.org/wiki/Internet_media_type) van een bestand.

### Compressed content

In deze header informatie kan ook staan dat het bestand is gecomprimeerd met bijvoorbeeld [gzip](http://en.wikipedia.org/wiki/Gzip). Ook wordt de **expiratie datum** van dit bestand vermeld en nog wat andere zaken. Zodat de webbrowser weet wanneer deze een nieuwe versie moet ophalen.

Deze header informatie kunnen we ook beinvloeden.

## Safari developer tools

In de Safari webbrowser (Mac en Windows) zit een handige tool om te kijken of bepaalde content met de gzip-encoding is verstuurd. Standaard staan de Developer Tools in Safari uit. In de voorkeuren van Safari (v3.1) onder het tabblad **Advanced** kunnen we dit aanzetten.

Voor Safari v2.x is er een [Terminal commando](http://www.macosxhints.com/article.php?story=20030110063041629) om dit aan te zetten.

	defaults write com.apple.Safari IncludeDebugMenu 1

Ga naar een willekeurige website en open de Safari webinspector via `Develop > Show Web Inspector`. Linksonderin zit een optie **Network** waarmee we een soort [Gannt-chart](http://en.wikipedia.org/wiki/Gantt_chart) kunnen zien van alle bestanden die bij de webpagina horen, in welke volgorde ze zijn binnen geladen en wat de bestandsgrote is.

Klik op een CSS of Javascript regel zodat de **file-header** getoond worden. Daar zou kunnen staan dat de content-encoding is gedaan met **gzip**. Het kan ook zijn dat daar niks over vermeld wordt. Blijf even zoeken dus op andere websites met de Web Inspector.

## YSlow extentie voor Firefox

Veel webdesigners en developrs gebruiken de geprezen [Firebug](http://getfirebug.com/) plugin (ofwel add-on) voor het debuggen van CSS en Javascript code.

Yahoo heeft voor de Firebug plugin ... een plugin gemaakt genaamd YSlow. Een extra'tje voor Firebug dus. Hiermee kun je makkelijk de bestand headers zien (**Components** tabblad in **Firebug**), hoe groot de bestanden zijn en of deze met gzip-encoding verstuurd zijn.

## Comprimeren

Het voordeel hiervan is dat de bestanden in de meeste gevallen zo'n 40% kleiner kunnen worden. Dit is zeker merkbaar bij grote websites waarbij een typisch CSS bestand als zo'n gauw 3000 regels bevat.

### Apache .htaccess

Met een .htaccess bestand kunnen we voor de website kleine (toegelaten) configuratie wijzigingen maken voor onze website.

In dit **.htaccess** bestand gaan we aangeven dat we de CSS en Javascript bestanden willen comprimeren met **gzip**. Dit type bestanden eindigen alijd met de extentie `.css` en `.js`.

Download dit [voorbeeld .htaccess bestand](http://www.atlantisdesign.nl/public/apache_deflate_headers.txt) 

	########################################
	## Compress these file-types before sending
	########################################
	
	<IfModule mod_deflate.c>
		<FilesMatch "\.(js|css)$">
			SetOutputFilter DEFLATE
		</FilesMatch>
	</IfModule>
	
	########################################
	## Sent default expire headers
	########################################
	
	ExpiresActive On
	ExpiresDefault "access plus 4 days"
	
	########################################
	## Caching
	########################################
	
	<FilesMatch "\.(xml|txt|html|js|css)$">
		Header append Cache-Control "proxy-revalidate"
	</FilesMatch>
	
	<FilesMatch "\.(jpg|jpeg|png|gif|swf)$">
		Header append Cache-Control "public"
	</FilesMatch>

&hellip; en plaats dit bestand met de correcte naam in de root van de website:

	/Users/kees/Sites/vogelfotografie/.htaccess

Als voorbeeld nemen we weer de vogelfotografie website van de fictieve gebruiker `kees`.

### Verborgen bestanden

Bestanden die met een punt beginnen (als eerste karakter) zullen verborgen zijn voor de Mac Finder. Gebruik dus bijvoorbeeld het **gratis** [TextWrangler](http://www.barebones.com/products/textwrangler/) om makkelijk deze (Unix) bestanden te openen en te bewaren.

### Apache mod_deflate

In het voorbeeld bestand staat vanaf **regel 6** dat er eerst gekeken wordt of de mod_deflate module aanwezig is op de webserver.

Op **regel 6** staan de bestandsextenties die met de mod_deflate module eerst gecomprimeerd worden. Pas daarna zullen dit type bestanden verstuurd worden.

Het comprimeren op de server kost even tijd, je merkt er eigenlijk vrij weinig van. Dit wordt elke keer uitgevoerd bij het opvragen van dit type bestanden. De bekende webbrowsers (Internet Explorer, Firefox, Safari en Opera) ondersteunen allemaal gecomprimeerde content. CSS en javascript files zijn heel goede kandidaten hiervoor.

## Testen

Met het .htaccess bestand op de goede plaats kunnen we de **vogelfotografie** website opnieuw bekijken. Eerst kijken of alles nog werkt.

Open dan de Safari **Web Inspector** of de **YSlow** plugin in Firefox. Voor de CSS en Javascript kunnen we zien dat deze met gzip-content encoding verstuurd zijn. Aan de Gannt-chart kunnen we zien dat het bestand aanzienlijk kleiner is geworden.

## Expire headers in .htaccess

Met een .htaccess bestand (zie dit voorbeeld):

	########################################
	## Sent expire headers by type
	########################################
	
	ExpiresActive On
	
	# Expire after 4 days in client cache
	ExpiresByType text/css "access plus 4 days"
 
  &hellip; in bijvoorbeeld de `/css/` (Cascading Stylesheet) directory kunnen we aangeven wat de expiratie is van deze bestanden. In het voorbeeld wordt aangegeven dat dit 4 dagen is.

Dit kun je dan ook doen voor de `/js/` directories. Plaats daar ook hetzelfde .htaccess bestanden in en verander de **content-type** per file type

#### Javascripts

	application/x-javascript

en / of

	application/javascript

&hellip; en voor plaatjes in de `/img/` directory.

#### gif plaatjes

`ExpiresByType image/gif "access plus 4 days"`

#### jpg plaatjes

	ExpiresByType image/jpg "access plus 4 days"

Met de **YSlow extentie** kunnen we zien dat op deze typen bestanden een expiratie datum is vermeld. Dit helpt de webbrowser en webserver om te bepalen of de webbrowser een cached versie van hetzelfde plaatje kan ophalen. Dit voorkomt dat er meerdere onnodige requests van de webserver gevraagd worden.