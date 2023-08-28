---
title: "webDAV op MacOS X Tiger"
description: "Met webDAV kun je op een soort iDisk manier bestanden delen via het internet. Via Mac en Windows kunnen bestanden van en naar de Mac geschreven worden alsof het een netwerk schijf is."
pubDate: 2006-05-31
---

# webDAV op MacOS X Tiger

Deze tutorial heb ik **niet zelf uitgevonden** maar het werkt geweldig. Alle credits en lof van dit artikel gaan uit naar naar de schrijver van dit artikel [ISP-In-A-Box: Building a WebDAV Server for Remote Access](http://tigervittles.com/?p=10). Hieronder beschrijf (vertaal) ik een verkorte procedure hoe je op je eigen Mac een WebDAV server kan opzetten.

## Wat is WebDAV?

WebDAV staat voor **Web-based Distributed Authoring and Versioning**. Meer informatie kun je vinden op [Wiki-Pedia](http://nl.wikipedia.org/wiki/WebDAV) en [WebDAV.org](http://www.webdav.org/). Het wordt gebruik om meerdere mensen (platform onafhankelijk) bestanden te laten delen via het internet. Natuurlijk ligt dit leuks allemaal achter wachtwoorden.

Voor Mac gebruikers is het fenomeen iDisk (ofwel [.Mac](http://www.apple.com/nl/dotmac/), spreek uit als 'Dot Mac') wel bekend. Je hebt online een soort eigen folder die je op je Mac desktop kunt 'mounten' en die als netwerkschijf kan gebruiken om bestanden op te zetten.

## Wat heb ik er aan?

Als je als webdesigner / programmeur bezig ben kun je vanaf elke locatie, eventueel met meerdere mensen tegelijk, aan een website werken. Dit allemaal op afstand. Het WebDAV protocol is een extentie op het HTTP protocol en wordt ook ondersteunt door de Apache webserver die al op onze Mac aanwezig is.

Het is een makkelijke manier om een map op onze Mac te delen via internet. Het allermooiste is weer dat alles al ge?nstalleerd staat op onze Mac! Onderstaande is een kleine procedure om het allemaal aan de praat te krijgen. Dat duurt echt niet lang!

## Stap 1 - WebDAV activeren

Zoals al beschreven is WebDAV een uitbreiding, extentie, van het HTTP protocol. De Apache webserver op onze Mac is al helemaal uitgerust voor de ondersteunig van WebDAV als server.

### Apache configureren

We gaan eerst de Apache server (die al op onze Mac staat) configureren zodat het WebDAV ondersteunt en gebruikt. Voor de mensen die bekend zijn met de terminal zou ik eerst een kopie maken van het `http.conf` file. Open een terminal scherm en typ in:

	sudo pico /etc/httpd/httpd.conf

Nu opent zich het Pico terminal text-editor scherm met het configuratie bestand van de Apache webserver. Zoek met `ctrl+w` naar het woord **headers** en druk op **enter**. Voor deze regels staan # symbolen. Dit betekend dat deze regel een comment is en niet meegenomen zal worden tijdens het starten van de Apache webserver.

Nu moeten we voor vier van dit soort regels het # teken weghalen, ofwel 'uncommenten'. Dit geldt voor de volgende regels:

* LoadModule headers_module libexec/httpd/mod_headers.so
* LoadModule dav_module libexec/httpd/libdav.so
* AddModule mod_headers.c
* AddModule mod_dav.c

## Stap 2 - Toevoegen van de te delen mappen

Nu de WebDAV module zal worden gestart samen met Apache moeten we nog wat extra dingen aangeven. Open de Terminal en typ in:

	sudo pico /etc/httpd/httpd.conf

Vul je wachtwoord in om het bestand als administrator te bewerken. Enige ervaring me de Terminal is wel vereist. Er opent zich een text-editor. Aan het **einde** van dit document gaan we de volgende tekst toevoegen. Kopieer en plak dit in het Terminal scherm.

#### Kopieer en plak dit stuk aan het eind van het document

	# WebDAV module
	# http://tigervittles.com/?p=10
	
	# Set DAVLockDB for webdav support
	#
	
	DAVLockDB /private/var/run/davlocks/DAVLockDB
	
	#Fix headers for WebDAV
	BrowserMatch "^WebDAVFS/1.[012]" redirect-carefully
	BrowserMatch "Microsoft Data Access Internet Publishing Provider" redirect-carefully
	BrowserMatch "Microsoft-WebDAV-MiniRedir/5.1.2600" redirect-carefully
	BrowserMatch "^WebDrive" redirect-carefully
	BrowserMatch "^WebDAVFS" redirect-carefully
	
	<IfModule mod_headers.c>
		Header add MS-Author-Via "DAV"
	</IfModule>
	
	#Set up WebDAV directory rules
	Alias /map_naam "/Users/kort_naam/map_naam"
	<location /map_naam>
		DAV On
		AuthType Basic
		AuthName "WebDAV inlog"
		AuthUserFile /usr/local/dav.pw
		require valid-user
		Order allow,deny
		Allow from all
	</location>

Bewaar het document met `ctrl + x`, typ in `y`.

#### Let op!

Zorg er wel voor dat het stuk na **#Fix headers for WebDAV** genaamd **BrowserMatch** elk op een eigen regel staat.

### Uitleg bovenstaande code

De naam `/map_naam` is de locatie van de map die je wilt delen via WebDAV. In bovenstaand voorbeeld is dat bijvoorbeeld ~/Sites/map_naam. Een map in je eigen thuis map ? Sites ? map_naam.

Het stuk vanaf **#Set up WebDAV directory rules** kun je dus meerdere malen gebruiken in het stuk script. Zodoende kun je meerdere mappen delen via WebDAV.

#### Herstart Apache

Herstart nu de Apache webserver om de aangepaste configuratie toe te passen. `Apple'tje > System Preference > Sharing` en vink uit / aan **Personal Web Sharing**.

... of via een Unix commando voor gevorderden

`sudo apachectl graceful`

## Stap 3 - Aanmaken account file

Nu alles klaar is moeten we nog zogenaamd WebDAV accounts aanmaken. Alleen deze gebruikers, die helemaal los staan van Mac OS X accounts / gebruikers, kunnen inloggen op onze WebDAV server.

Open de terminal en we gaan een zogenaamde **htpasswd file** aanmaken. Ga naar de map `/usr/local`.

	cd /usr/local

Vervolgens gaan we een password file aanmaken genaamd `dav.pw`

	sudo htpasswd -c dav.pw admin

Zoals je kunt zien staat in het script (zie hierboven) waar dit password file wordt bewaard. De `-c` parameter betekend **create**. Het woord **admin** is een zelf verzonnen naam voor de **username**. Je kunt dus hier zelf wat van maken.

#### Let op!

Eerst zal om je **eigen wachtwoord** gevraagd worden van je Mac account. Dit komt omdat er `sudo` voor het commando staat. Als je dit goed invult zal om het nieuwe wachtwoord gevraagd worden voor de nieuwe user.

### Meerdere gebruikers aanvullen

Als je het gaat testen (zie hieronder) vraagt het inlogscherm om je username en password. Ofwel ... een valid-user. Om meerdere users aan te maken die in kunnen loggen moet je nogmaals het htpasswd Unix commando uitvoeren maar dan zoals hieronder.

	sudo htpasswd -m dav.pw nieuw_gebruiker

Met `-m` geef je aan dat je het bestaande password file, `dav.pw`, wilt **aanvullen** met meerdere gebruikers.

##Testen in een webbrowser

Als je in de een browser in typt `http://localhost/map_naam` (let op: map_naam moet dus overeen komen met wat je in het script hebt aangepast) komt er een inlog scherm met de naam **WebDAV inlog**. In bovenstaande code kun je dus zelf een naam verzinnen voor dit inlog scherm.

## Testen via het netwerk

We kunnen nu bijvoorbeeld via een andere Mac met `Apple'tje + k` verbinding maken met de WebDAV (ala iDisk) Mac. Typ in het schermpje van Server Adress het IP nummer van de WebDAV mac in.

	http://ip_nummer_van_de_mac/map_naam

De `map_naam` is weer de naam van de map die in het script is verwerkt.