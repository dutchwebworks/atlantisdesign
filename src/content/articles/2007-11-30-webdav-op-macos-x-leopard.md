---
title: "webDAV op MacOS X Leopard"
description: ""
pubDate: 2007-11-30
---

## Wat is WebDAV?

WebDAV staat voor **Web-based Distributed Authoring and Versioning**. Meer informatie kun je vinden op Wiki-Pedia en WebDAV.org. Het wordt gebruik om meerdere mensen (platform onafhankelijk) bestanden te laten delen via het internet. Natuurlijk ligt dit leuks allemaal achter wachtwoorden.

Voor Mac gebruikers is het fenomeen iDisk (ofwel [.Mac](http://www.apple.com/nl/dotmac/), spreek uit als 'Dot Mac') wel bekend. Je hebt online een soort eigen folder die je op je Mac desktop kunt 'mounten' en die als netwerkschijf kan gebruiken om bestanden op te zetten.

## Wat heb ik er aan?

Als je als webdesigner / programmeur bezig ben kun je vanaf elke locatie, eventueel met meerdere mensen tegelijk, aan een website werken. Dit allemaal op afstand. Het WebDAV protocol is een extentie op het HTTP protocol en wordt ook ondersteunt door de Apache webserver die al op onze Mac aanwezig is.

Het is een makkelijke manier om een map op onze Mac te delen via internet. Het allermooiste is weer dat alles al geinstalleerd staat op onze Mac! Onderstaande is een kleine procedure om het allemaal aan de praat te krijgen. Dat duurt echt niet lang!

## Apache 2.x configuratie backup maken

Voor deze opzet hebben we de Apache webserver nodig. Zet deze aan via `Apple'tje > System Preferences > Sharing` en vink **Web Sharing** aan. Voordat we dingen eventueel stuk maken gaan we eerst een backup maken van de Apache webserver configuratie. Open de **Terminal** applicatie (`/Applications/Utilities/Terminal`). We gaan eerst een backup maken van het Apache configuratie bestand.

Ga eerst naar de map waar het configuratie bestand staat:

    cd /etc/apache2

Vraag een lijst met bestanden op. Deze stap is perse nodig:

    ls -l

Hier zien we welk bestand we moeten hebben, namelijk `httpd.conf`. Typ het volgende commando in en geef een administrator wachtwoord op.

#### Backup maken

    sudo cp httpd.conf httpd.conf_backup

Vraag met `ls -l` opnieuw een lijst op en we zien dat er een backup bestand is gemaakt. Voor degene die met de Unix terminal overweg kunnen weten hoe ze met de commando's `rm` en `mv` de backup weer terug kunnen zetten.

## Unix bestanden bewerken met TextWrangler

Download eerst het **gratis** [TextWrangler](http://www.barebones.com/products/textwrangler/) of gebruik zijn commerciele broer [BBEdit](http://www.barebones.com/products/bbedit/). Hiermee kunnen we straks makkelijk aanpassingen maken aan Unix configuratie bestanden op onze Mac. TextWrangler of BBedit zijn echte Mac OS X text-editors. Hiermee kun je ook website met de hand maken, PHP programmeren en nog veel meer op het gebied van text-editten.

Start **TextWrangler** (of BBEdit) en laat het de **command line tools** installeren. We kunnen nu aan de slag. Als je gebruik maakt van **BBEdit** is het commando om bestanden te bewerken (vanuit de Ternimal) `bbedit` in plaats van `edit` welke **TextWrangler** gebruikt.

## Apache configuratie aanpassen

Open de Terminal en typ het volgende commando in:

    edit /etc/apache2/httpd.conf

TextWrangler opent het configuratie bestand van de Apache 2.x webserver. Ga met `Apple'tje + j` naar **regel 467**. Daar staat onderstaande:

    Include /private/etc/apache2/extra/httpd-dav.conf

Hier gaan we een extra regel onder plakken:

    Include /private/etc/apache2/extra/httpd-webdav.conf

### WebDAV configuratie voorbeeld

Dit configuratie bestand bestaat nog niet. In TextWrangler maken we een nieuw bestand aan. Plak hierin dit [Apache webDAV](http://www.atlantisdesign.nl/public/apache_webdav_conf.txt) configuratie voorbeeld.

Bewaar het bestand met de juiste naam op de volgende locatie:

    /etc/apache2/extra/httpd-webdav.conf

In het 'bewaar' venster van TextWrangler (of elk ander open/bewaar scherm op MacOS X) typ je in `shift + Apple'tje (ofwel command) + g`. Er verschijnt een scherm waar je het eerste stuk van de locatie kan in typen (of plakken). Bewaar het bestand op de juiste plek.

In het configuratie bestand staat dat we via de URL alias `/dav/vogelfotografie`, wat overeen komt met (127.0.0.1 of localhost is hetzelfde):

    http://127.0.0.1/dav/vogelfotografie

de volgende map onze Mac kunnen benaderen:

    /Users/kees/Sites/vogelfotografie

Straks moeten we de Apache server herstarten zodat deze de nieuwe configuratie voor webDAV inleest. Uiteraard de webDAV toegang nog beveiligen met een username en password.

##Uitleg van het directive

Bij de regel `Alias` wordt vermeld welke map er gedeeld wordt. Het stukje bij `Location` geeft aan dat .htaccess bestanden genegeerd moeten worden. Met een .htaccess bestand kun je de configuratie van de server aanpassen. De .htaccess bestanden moeten zeker genegeerd worden als er bijvoorbeeld gebruik wordt gemaakt van de [Apache mod_rewrite module](http://www.atlantisdesign.nl/artikel/apache-htaccess-en-mod_rewrite-op-macosx-leopard). Anders kun je via webDAV zo'n map waar een .htaccess bestand in staat, niet bekijken.

Het stukje **Directory** geven we aan wat Apache moet doen als deze toegang wil tot die map. De DAV module wordt geactiveerd en via een basic Apache realm authentication systeem wordt naar een `valid user` gevraagd uit het password bestand. Die we nog moeten aanmaken.

### PHP uitschakelen voor webDAV

Ook het gebruik van PHP wordt vanaf deze URL uitgezet met `php_value engine off`. Anders worden PHP bestanden direct uitgevoerd door Apache als ze opgevraagd worden.

## Apache password bestand aanmaken

Met een password bestand, waar een gebruikersnaam en gecodeerd wachtwoord in staat, kun je zelf verzonnen en zoveel gebruikers als je wilt instellen wie toegang heeft tot de webDAV map op de Mac.

Voor Unix kenners: uiteindelijk is het wel de www user die bestanden aan het schrijven is op de webDAV map. En dus ook Unix rechten (permissions) moet hebben op die map.

Open de Terminal en typ het volgende commando in. Dit zorgt ervoor dat er een Apache password bestand aangemaatk wordt op de plek waar we dat aangegeven hadden in het webDAV **directive**. Dit doen we voor de gebruiker `kees`.

    htpasswd -c /etc/apache2/.passwd kees

In de Terminal wordt om het nieuwe wachtwoord gevraagd voor de gebruiker `kees`.

### Meerdere gebruikers aanmaken

In bovenstaand Unix commando wordt met de optie `-c` (create) een nieuw password bestand aangemaakt. Als er meerdere gebruikers moeten worden toegevoegd aan hetzelfde password bestand, gebruik dan onderstaand Unix commando. Zonder de -c optie.

    htpasswd /etc/apache2/.passwd piet

## DAV Locks map aanmaken

WebDAV moet een map hebben waar deze zijn [DavLocks](http://httpd.apache.org/docs/2.0/mod/mod_dav_fs.html#davlockdb) kan neerzetten. In de Terminal typen we in:

    mkdir /Library/WebServer/DavLocks/

Nu moeten we nog de Unix rechten goed zetten, zodat Apache (webDAV) in deze map mag schrijven. Dit is de Unix www user.

    sudo chown www:www /Library/WebServer/DavLocks/

    sudo chmod 777 /Library/WebServer/DavLocks/

In bovenstaande commando's geven we aan dat de map **DavLocks** van de Unix gebruiker `www` is, ofwel Apache. De tweede regel geeft aan dat Apache ook mag schrijven in deze map, ofwel de **lock database** kan gebruiken die daar wordt bewaard. Met het Unix commando kunnen we dit ook controleren.

    ls -l /Library/WebServer

## Apache herstarten

De configuratie is nu klaar. Apache moet herstart worden zodat deze de webDAV modules aanzet en de map deelt die we in het **directive** hebben aangegeven. Eerst testen we de configuratie die we net hebben aangepast.

#### Configuratie syntax testen

    sudo httpd -t

Het command `sudo` is niet altijd nodig. Als er geen fouten in beeld komen kunnen we de Apache server herstarten. Dit kan op twee manier, via `Apple'tje > System Preferences > Sharing`, en dan de optie **Web Sharing** even uit en weer aan vinken. Of nog sneller via een Unix commando:

#### Apache herstarten

    sudo apachectl graceful

## Unix rechten op de webDAV mappen

Er is nog een ding waar we rekening mee moeten houden: de Unix rechten op mappen. Elke map op de Mac, net als in Unix en Linux, heeft toegangs rechten. Normaal gesproken als je op de Mac een map aanmaakt is deze map van jou, ofwel je **korte gebruikersnaam** (naam van je thuis map) met een aantal (chmod) rechten voor toegang en overschrijven van data. Zodat niemand ander aan jou bestanden mag komen.

Mocht je denken dat als je in het password bestand dezelfde gebruiker aanmaakt als je eigen Mac account zul je het mis hebben. Alles wat via webDAV gedaan wordt gaat allemaal langs en door de **Apache** webserver. Alle programma's, ook Apache en Mac accounts, zijn gebruikers op een Unix systeem met elk hun eigen rechten. Als de verbinding is opgezet, via webDAV, vanaf een andere computer naar de Mac ... zijn de bestanden die over en weer worden gestuurd van de Apache gebruiker. Ofwel de `www` gebruiker wat we eerder in dit artikel gezien hebben. **Niet van de fictieve gebruiker kees**.

Het kan dus voorkomen dat de map die we gespecifieerd hebben in het **directive** nog niet toegankelijk zijn (Unix rechten) voor de Apache (www) gebruiker. Mocht je dus vanaf de andere Mac een bestand op de webDAV map gesleept hebben en een melding krijgen dat het niet naar de webDAV server gekopieerd mag worden, moeten we de rechten veranderen van de vogelfotografie map. Open de Terminal en geef alle rechten aan de **vogelfotografie** map, zodat bestanden geplaats mogen worden door de Apache gebruiker (ofwel www user).

    sudo chmod -R 777 /Users/kees/Sites/vogelfotografie

Met **-R** geef je aan dat je dit **recursief** wilt toepassen op alle onder liggen de mappen en bestanden. Nu kun je vanaf een andere computer wel de bestanden lezen en schrijven.

## Verbinding maken via webDAV

Dit kunnen we op 2 manieren testen. Via onze eigen Mac of via een andere Mac. Als we op onze eigen Mac testen kunnen we een bekend IP nummer gebruiken: 127.0.0.1, dit betekend eigenlijk '**deze computer**'. Als we het op een andere Mac testen moeten het IP nummer weten van de Mac waar webDAV opgezet is (`Apple'tje > System Preferences > Network`).

Op een andere Mac gaan we in de `Finder naar Go > Connect to Server`. Vul het IP nummer in van de webDAV Mac (hieronder wordt een voorbeeld IP nummer gebruikt):

    http://192.168.1.201/dav/vogelfotografie

De Mac zal om de gebruikers gegevens vragen, die in het `password` bestand staan, dus niet een echte Mac account. Als deze goed zijn verschijnt er op het buroblad een webDAV server, ala iDisk.

**Verbinding maken via webDAV doe je niet via een webbrowser. Daar is het protocol niet voor bedoelt.**

## Meerdere mappen delen

Het is uiteraard mogelijk meerdere mappen te delen via webDAV. Kopieer daarvoor het stukje vanaf het grote comment blok nogmaals onderaan het configuratie bestand. Pas de relevantie stukken aan, controleer of de map die je wilt delen via webDAV ook bestaat en zet de Unix rechten (chmod 777) correct. Zodat de www users (ofwel Apache) bestanden mag schrijven in die map.

Maak in het **password** bestand nog meer gebruiker aan zoals eerder uitgelegd. Of gebruik steeds dezelfde gebruiker. Vergeet niet de Apache webserver te herstarten

    sudo apachectl graceful

## Verbinding maken vanaf Windows XP met de webDAV Mac

WebDAV is een uitbreiding, extention, op het [HTTP protcol](http://nl.wikipedia.org/wiki/Hypertext_Transfer_Protocol) (Apache zeg maar). Andere computers (Unix, Linux, Mac en Windows) kunnen websites bekijken via de Apache webserver, maar nu ook met onze gedeelde map verbinding maken.

Op Windows XP gaat dat natuurlijk iets anders. Volg de aanwijzingen op [deze website](http://blog.dreamhosters.com/kbase/index.cgi?area=2913). Ofwel, even kort uitgelegd, ga naar het Windows netwerk, rechtsklik op het netwerk in de Verkenner, kies daar voor **Map network drive**, klik op de hyperlink tekst voor opslag op een ander soort netwerk of **online storage** (achtig iets). Kies voor de optie `choose other network location` en vul hetzelfde adres in zoals we op de andere Mac hebben gedaan maar **met een toevoeging** (het IP nummer is een voorbeeld)!

    http://192.168.1.201/dav/vogelfotografie/#

Standaard snapt Windows XP deze opzet naar een webDAV verbinding niet. Natuurlijk Microsoft weer!! Let dus op de laatste `/#` stukje. Het slaat eigenlijk nergens op maar als je dit niet toevoegd blijft Windows om het wachtwoord vragen, ofwel het wachtwoord is volgens Windows niet goed.

Een andere methode is het vermelden van de port nummer bij het stukje over de host.

    http://192.168.1.201:80/dav/vogelfotografie/

Hier wordt expliciet vermeld dat we verbinding willen maken met dit IP nummer op **port nummer 80**.

In de Windows Verkenner verschijnt op een zelfde soort manier een netwerk map zoals op de Mac dit gebeurt. Het eigenaardige is weer dat je nu in staat bent om bestanden heen en weer te kopieren maar je kunt niet bestanden direct openen vanaf deze locatie!!

### Eigenwijze Windows

Microsoft zal Microsoft niet zijn om een stuk open-source implementatie **net niet helemaal goed te integreren**. Er is namelijk een verschil in de werking van webDAV op Windows 2000 (waar het wel goed in werkt) en Windows XP waar het maar half in werkt.

Mac's en Linux computers kunnen direct inloggen op de webDAV server en bestanden direct daar vanaf bewerken. Helaas kan Windows XP dat niet standaard. Met bovengenoemde wijze kun je wel bestanden zien staan, er naar toe kopieren en vanaf kopieren. Maar de **kracht van webDAV is het direct bewerken** van bestanden op de webDAV server.

#### WebDrive

Download [WebDrive](http://www.southrivertech.com/products/webdrive/index.html), waarmee je op een goede verbinding kunt maken met een webDAV server. Nu is het wel mogelijk om bestanden te bewerken direct op de webDAV server. Dit is wel **trialware** en zul je aan moeten schaffen.

### Netdrive

Je kunt ook een alternatief gebruiken genaamd Netdrive. Niet direct te verkrijgen maar via een [omweg](http://www.mathematics.jhu.edu/help/netdrive.exe) kun je een oudere versie downloaden. Deze versie schijnt wel gratis te zijn. Bij bovenstaande link wordt ook [uitgelegd hoe het werkt](http://www.mathematics.jhu.edu/help/netuse-webdav.htm).

Met beide programma's is het mogelijk een **Windows drive-letter** aan bijvoorbeeld een webDAV server (of FTP server) te **koppelen**.

## Conclusie

Op deze manier kun je thuis een Mac hebben staan, met deze opzet, en op het werk (Mac of Windows) verbinding maken met de Mac thuis om bestanden te delen. Het enige wat je moet weten is het externe IP nummer van de Mac thuis.

### iCal server

Op deze manier zou je dus een eigen **iCal server** op kunnen zetten. Exporteer een iCal kalender (deze krijgt de bestands extentie .ics) en plaats deze in een map die gedeeld wordt via webDAV. En maak de juiste Apache configuratie aan (in `/etc/apache2/extra/http-webdav.conf`). Vergeet niet de Apache server te herstarten (`sudo apachectl graceful`).

Op een andere Mac (in iCal) abonneer je je op zoiets als onderstaande (IP nummer is een voorbeeld):

    http://192.168.1.201/ical/kees/mijn_kalender.ics

In dit voorbeeld is de alias `/ical/kees` in de Apache directive voor webDAV, in plaats van `/dav/vogelfotografie`.

Let erop dat als je buiten je eigen netwerk zit dat je dan het externe IP nummer moet weten van de Mac. Deze kun je op internet heel makkelijk opvragen als je achter de bewuste webDAV Mac met [What's my IP](http://whatsmyip.org/) bijvoorbeeld.
