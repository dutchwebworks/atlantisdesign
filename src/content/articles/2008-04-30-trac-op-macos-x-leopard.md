---
title: "Trac op MacOS X Leopard"
description: "Via een lokale website makkelijk Subversion repository en changesets bekijken. Geintegreerde Wiki, issue- bugtracking systeem. Precies kunnen aangeven, d.m.v. integratie met Subversion en een ticketsysteem, wat er in bepaalde bestanden veranderd is en welke gebruikers zaken moeten oplossen."
pubDate: 2008-04-30
---

# Trac op MacOS X Leopard

[Trac](http://trac.edgewall.org/) is een **bugtracking / issue-tracking en Wiki systeem** ineen dat via een webpagina te beheren is. Het is niet zomaar een issue tracking systeem want het integreerd heel makkelijk met [Subversion](http://subversion.tigris.org/), wat op haar beurt een OpenSource **versie beheer** systeem is.[ WikiPedia: Trac](http://en.wikipedia.org/wiki/Trac). Deze twee worden samen veel vuldig gebruikt bij de ontwikkeling van software / websites.

De integratie met **Subversion** (of een ander versie beheer systeem) is echt geweldig. Men kan via Trac (wat gewoon een website interface is) de Subversion repository bekijken, revisies naast elkaar leggen en de verschillen zien tussen de bestanden, ofwel **changesets**.

Via **tickets** toekennen aan gebruikers kunnen meerdere mensen een project beheren en issues oplossen. Aan een ticket kan zo'n **changeset** gehangen worden om heel mooi aan te geven wat men heeft veranderd of waar men naar moet kijken als het om een bug / issue gaat.

### Subversion

Dit artikel gaat ervan uit dat [Subversion al geinstalleerd](http://www.atlantisdesign.nl/artikel/subversion-versie-beheer-op-mac-os-x) is op de Mac. En dat men weet hoe Subversion een beetje werkt. Het zou ook handig zijn als er een **SVN repositor**y aanwezig is. Als voorbeeld nemen we `/Library/Subversion/Repository/testwebsite`.

### Credits

Let op! Deze procedure heb ik **niet zelf uitgevonden** maar gelezen op een Trac tutorial pagina waar dit uitgelegd wordt door ene [Toby Thain](http://trac.edgewall.org/wiki/TracOnOsxNoFink#OSX10.5basicTracclearsilverbundledApache).

Ik heb er een Nederlandse versie van gemaakt en tevens wat dingen **uitgelicht en uitgebreid**t waar ikzelf tegenaan liep. Tevens is de URL waar het test Trac project draait **beveiligd door een Apache realm** inlog venster.

Deze Trac opzet is op Apple MacOS X Leopard v10.5.2 getest. Dezelfde procedure zou ook moeten werken op MacOS X Tiger v10.4.x.

## Wat hebben we nodig?

* Subversion, niet persee nodig maar de integratie hiermee is heel cool. Voor installatie zie het artikel [Subversion versie beheer op MacOS X](http://www.atlantisdesign.nl/artikel/subversion-versie-beheer-op-mac-os-x)
* [Apple xCode](http://developer.apple.com/tools/xcode/), versie 3 (voor Leopard) is voldoende. Dit hebben we nodig omdat bij de installatie van xCode ook een GCC compiler geinstalleerd wordt. Die compiler hebben we nodig om wat extra componenten te kunnen installeren.
* **Apache 2.0.x**, wat al op de Mac staat
* **Python**, wat ook al op de Mac staat
* [Clearsilver](http://trac.edgewall.org/wiki/ClearSilver), een template systeem voor Python
* [Trac](http://trac.edgewall.org/wiki/TracDownload), het daadwerkenlijke issue tracking systeem

## Apple's xCode

[Download Apple xCode](http://developer.apple.com/tools/xcode/) (ongeveer 300 MB) van de Developer website. Installer deze met de standaard opties. Eigenlijk hebben we niks aan xCode zelf maar we hebben een GCC compiler nodig om de Clearsilver source-code mee te compileren. Zo'n compiler staat niet standaard op de Mac. Compilen klinkt ingewikkeld maar valt reuze mee.

## Trac configureren en installeren

[Download Trac](http://trac.edgewall.org/wiki/TracDownload), bij het schrijven van dit artikel is dit v0.11b2. Pak het bestand uit en open de Unix Terminal (`/Applications/Utilities/Terminal`).

Met het Unix `cd` commando gaan we naar de map waar Trac is uitgepakt. Je kunt ook intypen 'cd ' (met een spatie dus) en sleep nu de map vanuit de Finder op het Terminal venster, en druk op ENTER. Waarschlijnlijk heeft de map trac een versie nummer erachter staan.

	cd ~/Downloads/trac

Typ het volgende, gevolgd door een ENTER en een administrator wachtwoord:

	sudo python ./setup.py install

Python gaat een installatie uitvoeren en een hoop bestanden kopieren.

## Clearsilver compileren en installeren

Trac is geprogrammeerd in [Python](http://en.wikipedia.org/wiki/Python_(programming_language)) (ook een **OpenSource** programmeer taal) welke gebruik maakt van het Clearsilver template systeem. **Download** [Clearsilver](http://trac.edgewall.org/wiki/ClearSilver) en pak deze uit.

Met de **Terminal** gaan we ook naar de map waar Clearsilver is **uitgepakt**. Net als bij Trac staat er waarschijnlijk een versie nummer achter de map van clearsilver.

	cd ~/Downloads/clearsilver

Typ het volgende **compileer commando** in gevolgd door ENTER en een administrator wachtwoord. Hier hadden we dus xCode voor nodig.

	sudo ./configure --with-python=`which python` --disable-ruby --disable-java --disable-perl --disable-apache --disable-csharp

Als deze zonder foutmeldingen klaar is met '**checking**' gaat hij de ruwe source code compileren. Typ daarna in:

	sudo make

Hiermee maak je het programma klaar om te installeren. Geef als laatste op dat het programma geinstalleerd moet worden:

	sudo make install

Nu moeten we een bestand verplaatsen naar de goede map.

	mv /System/Library/Frameworks/Python.framework/Versions/2.5/lib/python2.5/site-packages/neo_cgi.so /Library/Python/2.5/site-packages

## Apache configureren

We kunnen Trac (wat in feite een website is) laten draaien onder de **Apache webserver** die al op de Mac aanwezig is. Zorg dat deze aanstaat in de **Apple System Preferences**, onder Sharing.

### Unix bestanden bewerken met TextWrangler

Download eerst het **gratis** [TextWrangler](http://www.barebones.com/products/textwrangler/) of gebruik zijn commerciele broer [BBEdit](http://www.barebones.com/products/bbedit/). Hiermee kunnen we straks makkelijk aanpassingen maken aan Unix configuratie bestanden op onze Mac. TextWrangler of BBedit zijn echte Mac OS X text-editors. Hiermee kun je ook website met de hand maken, PHP programmeren en nog veel meer op het gebied van text-editten.

Start **TextWrangler** (of BBEdit) en laat het de **command line tools** installeren. We kunnen nu aan de slag. Als je gebruik maakt van **BBEdit** is het commando om bestanden te bewerken (vanuit de Ternimal) `bbedit` in plaats van '**edit**' welke **TextWrangler** gebruikt.

In de Terminal typen we het volgende:

### Apache FastCGI aanzetten

	edit /etc/apache2/httpd.conf

Met '**edit**' geven we aan dat we TextWrangler gaan gebruiken om bestanden te bewerken. TextWrangler opent het Apache configuratie bestand. We gaan (met **Apple'tje + j**) naar **regel 115**.

Daar halen we het hekje (comment) voor de regel weg waar staat:

	LoadModule fastcgi_module libexec/apache2/mod_fastcgi.so

Bewaar het bestand weer met een administrator wachtwoord.

In de Terminal moeten we een paar nog niet bestaande mappen aanmaken:

	sudo mkdir -p /System/Library/Frameworks/Python.framework/Versions/2.5/share/trac/cgi-bin/

Plaats nu het bestand **trac.fcgi** in bovenstaande map. Dit **trac.fcg**i bestand is te vinden in de map waar we Trac hebben uitgepakt. Dit kun je beter via de Ternimal doen. **Typ eerst (met een spatie erachter**:

	sudo cp

**Sleep** nu vanuit de Finder het **trac.fcgi** bestand op de Terminal (nog geen ENTER geven), typ eerst een spatie. Typ of kopieer hiernaa het volgende erachteraan, zodat het er ongeveer als volgt uitziet.

	sudo mv /Users/kees/Downlaods/trac/trac.fcgi /System/Library/Frameworks/Python.framework/Versions/2.5/share/trac/cgi-bin/

Geef een ENTER en vul een administrator wachtwoord in.

#### Waarom zo ingewikkeld?

Via de Finder heb je geen rechten om dit bestand daar te plaatsen.

## Unix hardlink naar Apache CGI

Nu moeten we een Unix hardlink maken van het trac.fcgi bestand naar de map waar de Apache webserver CGI bestanden kan uitvoeren. In de Terminal typen we in:

	sudo ln /System/Library/Frameworks/Python.framework/Versions/2.5/share/trac/cgi-bin/trac.fcgi /Library/WebServer/CGI-Executables/

Wat extra mappen aanmaken in de Terminal:

	sudo mkdir -p /var/lib/apache2/fastcgi

Daarna moeten we de Unix rechten goed zetten van deze map.

	sudo chown www:www /var/lib/apache2/fastcgi

## Trac configuratie aanmaken voor Apache

Om **Trac via Apache** beschikbaar te maken moeten we eerst aangeven waar Trac zijn mappen heeft staan. Alle Trac projecten gaan we in een centrale map bewaren waarbij elk project in z'n eigen submap krijgt.

	/Library/Trac

We gaan terug naar **TextWrangler**, maak een leeg bestand aan en plak [dit bestand](http://www.atlantisdesign.nl/public/trac.conf.txt) erin:

	########################################
	## Setting Trac parent dir.
	########################################

	ScriptAlias /trac /Library/WebServer/CGI-Executables/trac.fcgi

	<Location "/trac">
	  SetEnv TRAC_ENV_PARENT_DIR "/Library/Trac"
	</Location>

	FastCgiConfig -initial-env TRAC_ENV_PARENT_DIR=/Library/Trac

	########################################
	## Test website
	########################################

	<Location "/trac/testwebsite">
	  AuthType Basic
	  AuthName "Trac test envirorment"
	  AuthUserFile /etc/apache2/passwords/.htpasswd
	  Require user kees
	</Location>

Het eerste stuk geeft aan waar we onze Trac project omgevingen bewaren. Op deze manier kun je meerdere projecten in de map `/Library/Trac` bewaren en via een webbrowser allemaal beheren.

Het tweede stuk geeft aan dat we straks een testwebsite hebben die op een bepaalde URL te bereiken is. En is beveiligd met de username `kees`. Tevens staat er waar het wachtwoord bestand staat.

Bewaar dit configuratie bestand op de volgende locatie met als naam **trac.conf**:

	/etc/apache2/other/trac.conf

## Apache password file aanmaken

Zoals je kunt zien in het kleine stukje configuratie gaan we de Trac testwebsite beveiligen met een Apache realm. Zodat niet iedereen kan inloggen op ons testwebsite project.

In de Terminal gaan we een password file maken voor de fictieve gebruiker `kees`. Eerst een password map aanmaken, als die nog niet bestaat:

	sudo mkdir /etc/apache2/passwords

Maak nu een password file aan voor de fictieve gebruiker `kees`. Onthoud deze gegevens voor later in dit artikel.

	sudo htpasswd -c /etc/apache2/passwords/.htpasswd kees

Met `-c` geven we aan dat we het password file eerst aanmaken, want het bestand bestaat waarschijnlijk nog niet. Waar dit password file wordt bewaard hebben we hierboven al aangeven in de Apache configuratie bestand **trac.conf**.

Vul eerst je Mac's **administrator wachtwoord** (daar staat sudo voor) en vul daarna een nieuw wachtwoord in voor de gebruiker `kees`.

Nu is de configuratie, en password file, voor Apache gereed en moeten we deze herstarten in de Terminal:

	sudo apachectl graceful

Door Apache te **herstarten** wordt het **trac.conf** configuratie bestand ook meegenomen.

## Trac omgeving opzetten

Apache is gereed en Trac is geinstalleerd. We moeten een map aanmaken waar Trac een omgeving heeft, per project, om mee te werken.

We plaatsen alle Trac gerelateerde projecten (bijvoorbeeld een website welke al in Subversion versie beheer staat) in de volgende map /Library/Trac, op onze eigen Mac. In de Terminal maken we deze map eerst aan:

	mkdir -p /Library/Trac

Ga naar de map ...

	cd /Library/Trac

Maak een **Trac omgeving** aan voor het fictieve project **testwebsite**:

	trac-admin testwebsite/ initenv

Trac gaat nu een omgeving opzetten (**initialiseren**) met als naam **testwebsite**. Er worden een aantal simpele vragen gesteld over het project.

Geef het project een naam voor gebruik binnen Trac, je kunt daar gewoon hoofdletters en spaties voor gebruiken, in dit geval:

	Testwebsite

En druk op Enter. Druk gewoon op ENTER als er gevraagd wordt om een '**Database string**'. Standaard gebruikt Trac een SQLite database. En natuurlijk willen we svn, ofwel Subversion, gebruiken in dit project, druk op ENTER.

Geef als laatste op waar de Subversion (svn) repository staat. In dit voorbeeld is dat:

	/Library/Subversion/Repository/testwebsite

Er verschijnen een hoop regels en uiteinlijk staat er een '**Congratulations**!' melding in beeld. We hebben nu een Trac omgeving gekoppeld aan de Subversion repository van `/Library/Subversion/Repository/testwebsite`.

Nu moeten we aangeven dat Apache (ofwel de `www` **user** op Unix) schrijf rechten heeft in de Trac **testwebsite** mappen. Via een webbrowser gaan we namelijk het Trac project beheren.

	sudo chmod 777 -R /Library/Trac/testwebsite

## Trac admin rechten

Binnen Trac zijn er ook gebruikers die verschillende rechten hebben. Zoals **issue tickets aanmaken en Wiki pagina's** beheren. Als **beheerder** van een project, onder Trac, geven we de fictieve gebruiker `kees` (van daarnet) **admin** rechten binnen Trac. We loggen in op de testwebsite met de Terminal:

	trac-admin /Library/Trac/testwebsite

We zitten nu Trac. We geven admin rechten / permissions aan de (nieuwe) gebruiker kees:

	permissions add TRAC_ADMIN kees

We gaan weer uit Trac:

	quit

Open nu **Safari** en ga naar onderstaande URL, welke op onze eigen Mac staat:

	http://localhost/trac/testwebsite

Een **Apache realm** inlog venster verschijnt. Login met de zojuist aangemaakt fictieve Apache username `kees`.

Trac neemt deze gebruikersnaam over. Binnen Trac zijn we dan de gebruiker `kees`. Zojuist hebben we binnen Trac ook dezelfde gebruiker `kees` admin rechten gegeven.

Via de button **admin** (helemaal rechts in beeld) kunnen we diverse zaken in Trac beheren. Lees meer over het gebruik van Trac in de ingebouwde Wiki en op [TracGuide](http://trac.edgewall.org/wiki/TracGuide).

### Meerdere gebruikers

Via de admin pagina in Trac kunnen we meerdere gebruikers permissions geven. Via de Terminal en zo'n htpasswd password bestand kunnen we meerdere gebruikers aanmaken.

## Meerdere projecten onder Trac

In het **trac.conf** bestand stond dat we een **parent directory** hebben aangegeven voor Trac projecten. Wil je meerdere projecten onder Trac brengen is het een kwestie van een nieuwe Trac omgeving opzetten:

	trac-admin /trac/nog_een_website

Maak voor dit project ook weer een **Apache username en password** aan, dit kan in hetzelfde password file. Of gebruik natuurlijk steeds dezelfde user in Trac projecten.

	sudo htpasswd /etc/apache2/passwords/.htpasswd piet

Geef het nieuew wachtwoord op voor de gebruiker `piet`. In dit voorbeeld kunnen we -c weglaten omdat het password bestand `.htpasswd` al bestaat.

Kopieer nu het laatste stuk in **trac.conf** naar een nieuwe regel en pas de paden aan naar het Trac project zich bevindt, zoals in [dit bestand](http://www.atlantisdesign.nl/public/trac.conf2.txt):

	########################################
	## Nog een website
	########################################
	
	<Location "/trac/nog_een_website">
	  AuthType Basic
	  AuthName "Trac nog_een_website envirorment"
	  AuthUserFile /etc/apache2/passwords/.htpasswd
	  Require user piet
	</Location>

Zoals je kunt zien bij **Require user** mag alleen de gebruiker 'piet' inloggen op deze Apache realm en daarmee op het Trac project.

Om **meerdere gebruikers** te laten inloggen kun je deze regel (met spaties) uitvullen met meerdere gebruikers. Let op dat deze gebruikers dus in het **htpasswd bestand moeten voorkomen**. Deze regel leest dan bijvoorbeeld als volgt:

	Require user kees piet

Geef de Trac nog_een_website map weer de juiste Unix rechten:

	sudo chmod -R 777 /Library/Trac/nog_een_website

Log weer in in Trac &hellip;

	trac-admin /Library/Trac/nog_een_website

&hellip; en geef de gebruiker `piet` admin rechten binnen Trac

	permissions add TRAC_ADMIN piet

Open weer een webbrowser en ga naar ondertaande URL:

	http://localhost/trac/nog_een_website

Log in met de gegevens van gebruiker piet. Op deze manier kun je heel veel projecten, die in Subversion staan, bekijken en gebruiken in Trac. Een leuke feature is een lijstje met Trac projecten, typ in een webbrowser:

	http://localhost/trac

Nu verschijnt er een **lijstje** met de aanwezige Trac projecten.