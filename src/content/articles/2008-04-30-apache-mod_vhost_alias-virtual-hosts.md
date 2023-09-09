---
title: "Apache mod_vhost_alias virtual hosts"
description: "Snel en makkelijk virtual-hosts gebruiken. Door simpelweg twee mappen aan te maken en een regel in het hosts file."
pubDate: 2008-04-30
---

In het artikel [Apache Virtual hosts](http://www.atlantisdesign.nl/artikel/apache-virtual-hosts) werd al uitgelegd hoe je via configuratie blokken makkelijk een nieuwe virtual host kan aanmaken. Daarbij maak je dan een nieuwe regel in de /etc/hosts file zodat de nieuwe virtual host naar je eigen Mac wijst. Apache herkent het **nep-domein** en serveert de website vanuit de goede map.

Deze eerste stap kan ook **geautomatiseerd** worden. Immers ga je op je lokale Mac niet zoveel Apache wijzigingen maken die in een virtual host blok moeten staan. De configuratie van een website is meestal hetzelfde voor alle virtual-hosts voor lokale web-ontwikkeling.

Met de Apache mod_vhost_alias module kun je snel en eenvoudig zo'n virtual host toevoegen. Massa's virtual hosts als je dat wilt! Daarom wordt het ook wel een oplossing genoemod voor **mass virtual-hosting**.

Onderstaande opzet is getest op MacOS X Leopard v10.5. De werking hiervan is identiek voor MacOS X Tiger, al staat het Apache configuratie bestand van Tiger ergens anders: `/etc/apache/conf/httpd.conf`.

### Andere virtual-hosts configuraties

**Let op!** Mocht je volgens het andere artikel al virtual-hosts serveren dan kunnen er rare dingen optreden. Maak een keuze in het toepassen van een virtual-hosts techniek.

Als je voor deze mod_vhost_alias methode kiest kun je **naderhand wel** kleine wijzigingen maken voor een specifieke virtual-host. Doe dit volgens de methode zoals besproken is in het andere artkel. Let er dan wel op dat je **niet nogmaals een (andere) DocumentRoot aangeeft**.

## Het doel

Onderstaande is straks **de procedure** om een nieuwe Apache virtual-host toe te voegen aan je eigen Mac. Dit werkt het snelst en je hoeft er naderhand niets voor aan te passen of te herstarten.

Twee mappen maken op een specifieke plek en de laatste heeft een specifieke naam. Daarna voegen we slechts 1 regel toe aan het hosts file, zodat het nieuwe nep-domein naar onze eigen Mac.

## Host file

Met een hostfile (`/etc/hosts`) kun je aangeven wat bijvoorbeeld een webbrowser als moet doen als er een URL ingetypt wordt. Eerst wordt het hosts file geraadpleegd, als hier geen aparte regel / verwijzing in staat voor deze URL dan pas gaat je computer deze URL vragen aan een DNS server op internet.

## Hoe werkt mod_vhost_alias?

Standaard staat deze module al geactiveerd in de Apache webserver. Het is een kwestie van de Apache webserver aanzetten via `Apple'tje > System Preferences > Sharing`, aanvinken: **WebSharing**.

Met mod_vhost_alias **map** (ofwel 'vertaal') je een hostname (of specifieke URL), of een deel ervan, naar een map op je eigen computer.

### Voorbeeld wat we willen bereiken

Als voorbeeld neem ik een fictieve website over vogels: **vogelfotografie**. Deze is op onze eigen Mac ontwikkeld en moeten we ook testen op onze eigen Mac. Daarnaast hebben we nog een website over **racewagens**. Die we ook als virtual host willen gebruiken.

We gaan maar **1x een configuratie** wijziging maken in Apache en daarna worden de virtual-hosts automatisch geserveerd vanuit de goede map.

In de `/etc/hosts` file van onze Mac staat bijvoorbeeld een regel als:

	127.0.0.1 vogelfotografie.local

Dit betekend dat als we in een webbrowser op dezelfde Mac onderstaande URL intypen:

	http://vogelfotografie.local/

Dat de webbrowser deze website gaat vragen aan het IP nummer wat ervoor staat. In dit geval is dat een bekend IP nummer voor computers (Windows/Mac/Linux etc.) want dit IP nummer betekend '**deze computer**'. Hij verwijst dus naar zichzelf.

De Apache webserver krijgt dit verzoek (**request**) binnen. Via de virtual-host configuratie serveerd Apache de website vanuit onderstaande map:

	/Library/WebServer/vhosts/vogelfotografie/httpdocs/

De werking van onze virtual hosts zijn **elke keer hetzelde**. Nog een voorbeeld met de racewagen website.

	http://racewagens.local/

Deze website staat in de onderstaande map op onze Mac:

	/Library/WebServer/vhosts/racewagens/httpdocs/

Zoals je kunt zien veranderd eigenlijk alleen het **eerste stuk van de URL en de een na laatse map naam** van waaruit Apache de website serveerd. Ofwel: **die naam komt overeen**.

### Apache mod_vhost_alias

Met een alias laten we een stukje van de URL overeen komen met een map naam op onze eigen Mac. Zolang we maar gebruik blijven maken van deze opzet (want anders werkt het niet correct):

* altijd dezelfde logica in URL's die naar onze eigen Mac wijzen (via het host file)
* altijd dezelfde mappen structuur aanhouden, zodat het eerste deel van de URL overeen komt een map op onze eigen Mac

Deze opzet wordt veelvuldig toegepast bij hosting bedrijven die heel veel virtual-hosts op hun (veelal Linux) computers hebben draaien.

Voorbeelden die niet werken

* `http://testvogelfotogafie/`
* `http://mijn.vogelfotogafie.local/`
* `http://www.vogelfotografie.local/`

Deze URL logica komt niet overeen. Het eerst woord in de URL, wat voor een punt staat, komt overeen.

## Stap 1: juiste mappen structuur opzetten

Volgens bovenstaande opzet gaan we eerst een **generieke mappen structuur** aanmaken. Zodat straks de URL's naar de juiste mappen verwijzen. In de Finder gaan we naar de volgende map toe;

	/Library/WebServer

Ofwel de Library map van onze opstartschijf en dan de WebServer map. Maak hier de juiste mappen aan voor de **vogelfotografie** website. Het ziet er dan als volgt uit:

	/Library/WebServer/vhosts/vogelfotografie/httpdocs

In de laatst map (httpdocs) staan de bestanden voor de vogelfotografie website. Daar komt dus de index.html (of PHP bestand) te staan.

### Waarom helemaal op die plek?

Apple heeft deze structuur opgezet en serveerd vanuit die structuur ook de **Document** map aan wat de `http://localhost/` is. Hier staat ook een **CGI-Executables** map waarin Perl scripts uitgevoerd kunnen worden.

Een logishe opzet dus om hier dynamisch de virtual-hosts te plaatsen. Houd alles lekker bij elkaar!

### Website op project basis

Deze opzet vind ik prettig werken. Omdat je de **vogelfotografie** map als een project kan zien met daarin de website zelf (httpdocs) samen met bijvoorbeeld andere mappen die bij het project horen.

* Een werkmap: `/Library/WebServer/vhost/vogelfotografie/werkmap`.
* Een backup map: /`Library/WebServer/vhost/vogelfotografie/backup`
* Documentatie: `/Library/WebServer/vhost/vogelfotografie/docs`

1 geheel, 1 project, op 1 plek.

Om makkelijk bij deze mappen te komen kun je **op het buroblad een alias** (snelkoppeling) maken naar `/Library/WebServer/vhosts/`.

## Apache configuratie aanpassen

We voegen 1 regel toe aan het Apache configuratie bestand en zetten in een nieuw configuratie bestand de opzet zoals hierboven gedemonstreerd is met mod_vhost_alias.

### Unix bestanden bewerken met TextWrangler

Download eerst het **gratis** [TextWrangler](http://www.barebones.com/products/textwrangler/) of gebruik zijn commerciele broer [BBEdit](http://www.barebones.com/products/bbedit/). Hiermee kunnen we straks makkelijk aanpassingen maken aan Unix configuratie bestanden op onze Mac. TextWrangler of BBedit zijn echte Mac OS X text-editors. Hiermee kun je ook website met de hand maken, PHP programmeren en nog veel meer op het gebied van text-editten.

Start **TextWrangler** (of BBEdit) en laat het de **command line tools** installeren.

Open de **Terminal** (`/Applications/Utilities/Terminal`) en typ onderstaande in om het Apache configuratie bestand te openen in TextWrangler:

	edit /etc/apache2/httpd.conf

Ga (bijvoorbeeld met Apple'tje + j) naar **regel 461**. Daar staat al iets over virtual-hosts. Plak onder deze regel het volgende:

	Include /private/etc/apache2/extra/httpd-vhost-alias.conf

Het bestand dat we hierboven willen **includen** bestaat natuurlijk nog niet. Maak een nieuw bestand aan plak hierin dit [mod_vhost_alias voorbeeld](http://www.atlantisdesign.nl/public/apache_vhost_alias.txt). 

	########################################
	## Default
	########################################
	
	# Override the default httpd.conf directives.  Make sure to
	# use 'Allow from all' to prevent 403 Forbidden message.
	<Directory /Library/WebServer/vhosts>
		Options ExecCGI FollowSymLinks
		AllowOverride all
		Allow from all
	</Directory>
	
	########################################
	## Dynamic creation of vhosts
	########################################
	
	UseCanonicalName Off
	VirtualDocumentRoot /Library/WebServer/vhosts/%1/httpdocs

Bewaar dit bestand met de juiste naam op de juiste plek:

	/private/etc/apache2/extra/httpd-vhost-alias.conf

### Finder truuk

Als je niet op die plek kunt komen met de Finder kun je ook `Apple'tje + shift + g` intypen. Kopieer en plak het eerste stuk van het pad en vul daarna de bestandsnaam in om deze te bewaren. Dit werkt overigens ook in de Finder en alle **open / bewaar schermen** van programma's.

## Uitleg van het nieuwe configuratie bestand

In het eerste stuk staat wat de **toegangs rechten** zijn voor de /Library/WebServer/vhosts map. Dit geldt dan ongeveer voor alle onderliggende mappen vanaf dat punt.

Het tweede stuk is eigenlijk waar het allemaal om draait. Met een **VirtualDocumentRoot** geven we aan waar onze websites staan, ofwel wat onze **structuur** is. De plek waar de variable **%1** staat wordt dan **vervangen** door het **eerste stuk (woord) van de URL**. Samen vormt dit een pad op de harde schijf.

Meer informatie over deze variablen zijn te vinden in de [Apache mod_vhost_alias documentatie](http://httpd.apache.org/docs/2.0/mod/mod_vhost_alias.html) pagina's.

### Apache herstarten

Om deze configuratie te gebruiken moeten we de Apache webserver herstarten:

	sudo apachectl graceful

## Stap 2: host file aanpassen

Apache snapt wat hij straks met de specifieke URL's moet doen. Nu moeten ervoor zorgen dat de `http://vogelfotografie.local/` URL verwijst naar onze eigen Mac. In de **Terminal** typen we het volgende in om de host file te bewerken in TextWrangler:

	edit /etc/hosts

Er opent zich een file dat betrekkelijk klein en leeg is. **Wees hier voorzichtig mee**. Want alles wat van onze Mac aan het internet gevraagd wordt komt eerst hier langs.

Op deze manier kun je bijvoorbeeld Google.nl naar heel andere website laten verwijzen. In de webbrowser blijft het orignele adres staan.

Onderaan dit host file voegen de vogelfotogafie website toe:

	127.0.0.1 vogelfotografie.local

Ikzelf zet altijd **local** er achter omdat deze URL op het internet zo goed als nooit voor komt. Daarnaast kun je zelf zien dat het dan om een **lokale website** gaat. Bewaar het hosts bestand met een administrator wachtwoord.

## Testen

Open een webbrowser en typ de nieuwe virtual-host in:

	http://vogelfotografie.local/

De **vogelfotografie** website wordt nu geserveerd op een dynamische manier met Apache mod_vhost_alias.

### Nog een website toevoegen

Dit was makkelijk! Maak nogmaals de juiste mappen structuur aan en plaats de **racewagen** website hierin:

	/Library/WebServer/vhosts/racewagens/httpdocs

Open het host file nog een keer en voeg ook deze URL onderaan toe:

	127.0.0.1 racewagens.local

Open weer webbrowser en typ de nieuwe virtual host in:

http://racewagens.local

Ook deze website wordt uit de juist map (**dynamisch**) geserveerd. Daarvoor hebben we **niets moeten configureren of herstarten**.

Op deze manier kun je veel websites toevoegen en een eigen nep-domeinnaam geven. Nu kun je ook paden naar bestanden [root-relative](http://kb.adobe.com/selfservice/viewContent.do?externalId=tn_15427) maken.

## Virtual-hosts requests in Apache log bestanden verwerken

**Deze stap is optioneel voor degene die ook de Apache log bestanden wil bewerken / bekijken per virtual-host.**

Met Apple's **Console** programma (`/Applications/Utilities/Console`) kun je vele log bestanden op de Mac bekijken. Ook die van Apache. Deze houd alle **request** en **errors** bij in twee log bestanden. In deze log worden nu alle requests opgenomen, ongeacht of ze via een virtual-hosts aangevraagd worden.

Open de **Console** en in de linker lijst zoeken we de Apache **access_log** &hellip;

	LOG FILES /var/log/apache2/access_log

&hellip; en de error_log.

	LOG FILES /var/log/apache2/error_log

Hierin staan alle requests die Apache heeft gekregen. Van onze eigen webbrowser (localhost / virtual-hosts) of via het netwerk / internet. Zo ook het IP nummer van onze eigen (interne / lokale) Mac:

	127.0.0.1

Zoals je ziet staat hier **geen vermelding** in dat we bepaalde requests via een virtual-host hebben gedaan. Alles komt van hetzelfde IP nummer.

### Apache configuratie aanpassen

We openen de Apache configuratie bestand weer met **TextWrangler** via de Terminal. Of open het configuratie bestand direct in TextWrangler als je weet waar het staat.

	edit /etc/apache2/httpd.conf

We moeten een stukje toevoegen aan de **log-format regel**. We gaan met Apple'tje + j naar **regel 274** daar staat het volgende (in het **IfModule log_config_module** blok).

	LogFormat "%h %l %u %t \"%r\" %>s %b" common

Dit is het **format** hoe Apache specifieke regels schrijft in de log bestanden. Nu staat er niet bij dat Apache moet vermelden dat het ook de **Servername** (ofwel virtual-host in dit geval vogelfotografie.local of racewagens.local) moet vermelden in dit log bestand. Met **%V** vooraan in de regel zal Apache de naam van de virtual-host erbij zetten. Zodat we kunnen zien welke virtual-host de request heeft gemaakt.

Plak onderstaande format regel op een **nieuwe regel** onder de hier boven genoemde regel. Zet voor bovenstaande regel een hekje (dan is het een comment) zodat deze niet meer mee genomen wordt bij het loggen van requests.

	LogFormat "%V %h %l %u %t \"%r\" %>s %b" vcommon

We hebben `%V` toegevoegd (dit staat voor de naam van de virtual-host) en achteraan **vcommon** aangegeven als format variable. Verderop moeten we aangeven dat we het **nieuwe format** (vcommon) willen gebruiken bij de Apache access_log. Zoek op:

	CustomLog /private/var/log/apache2/access_log common

Hier staat waar Apache het log bestand wegschrijft. Met de **Console** kunnen we dit bestand dus weer bekijken. Achteraan (als variable) staat in welk **format** dit log bestand beschreven zal worden. Hier moeten we dus aangeven dat we de **vcommon** formattering willen gebruiken (zie laatste stuk):

	CustomLog /private/var/log/apache2/access_log vcommon

Bewaar het Apache configuratie bestaand met een administrator wachtwoord. **Herstart nu de Apache** server zodat het nieuwe log formaat, met vermelding van de virtual-hosts, bekeken kan worden met Apple's Console programma.

	sudo apachectl graceful

Open een webbrowser en bekijk bijvoorbeeld de `vogelfotografie.local` of `racewagens.local` websites. Open nu de **Console** weer en blader weer naar de Apache access_log. Nu wordt wel de naam van de virtual-host getoond per request.

### Log bestanden live in de Terminal bekijken

Voor de Unix freaks kun je ook log bestanden bekijken met het Unix `tail` programma. Met `tail` laat je altijd het 'laatste stuk' van een bestand zien. Ook als deze gewijzigd wordt, heel handig om log bestanden te zien.

	tail -f /var/log/apache2/access_log

Natuurlijk kun je hiermee ook het `error_log` bestand bekijken. Met `ctrl + c` sluit je het Unix tail programma af en komt de Terminal promt weer terug.