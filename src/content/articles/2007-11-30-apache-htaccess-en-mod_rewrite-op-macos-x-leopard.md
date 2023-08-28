---
title: "Apache htaccess en mod_rewrite op MacOS X Leopard"
description: "MacOS X Leopard heeft de Apache 2.x webserver. Ook hier gaan we de mod_rewrite module gebruiken. Eigelijk moet er maar 1 configuratie regel aangepast te worden."
pubDate: 2007-11-30
---

# Apache htaccess en mod_rewrite op MacOS X Leopard

In het vorige artikel over [Apache .htaccess en mod_rewrite](http://www.atlantisdesign.nl/artikel/apache-htaccess-en-mod_rewrite-op-macosx-tiger) is uitgebreidt uitgelegt wat het allemaal precies is. **Hier volgt een update voor MacOSX Leopard v10.5**.

Nu Apple MacOSX Leopard heeft uitgebracht gaan we natuurlijk dezelfde voodoo toepassen maar dan met de Apache 2.x webserver.

## Apache 2.x configuratie backup maken

Open de **Terminal** applicatie (`/Applications/Utilities/Terminal`). We gaan eerst een backup maken van het Apache configuratie bestand.

Ga eerst naar de map waar het configuratie bestand staat

	cd /etc/apache2

Vraag een lijst met bestanden op. Deze stap is perse nodig

	ls -l

Hier zien we welk bestand we moeten hebben, namelijk `httpd.conf`. Typ het volgende commando in en geef een administrator wachtwoord op.

#### Backup maken

	sudo cp httpd.conf httpd.conf_backup

Vraag met `ls -l` opnieuw een lijst op en we zien dat er een backup bestand is gemaakt. Voor degene die met de Unix terminal overweg kunnen weten hoe ze met de commando's `rm` en `mv` de backup weer terug kunnen zetten.

## Apache 2.x override aanzetten

Standaard staat in deze versie van de Apache webserver bijna alles al goed qua configuratie. We moeten 1 regel aanpassen.

Dat kan op 2 manieren: met de Unix `vi` editor of het **gratis** [TextWrangler](http://www.barebones.com/products/textwrangler/) of de commerciele broer [BBEdit](http://www.barebones.com/products/bbedit/index.shtml).

Start **TextWrangler** (of BBEdit) en laat het de **command line tools** installeren. We kunnen nu aan de slag. Als je gebruik maakt van **BBEdit** is het commando om bestanden te bewerken (vanuit de Ternimal) `bbedit` in plaats van `edit` welke TextWrangler gebruikt.

### Methode 1. Unix vi editor

Open het **Terminal** programma (`/Applications/Utilities/Terminal`) en typ het volgende commando in, gevolgt door een adminitrator wachtwoord.

	sudo vi /etc/apache2/httpd.conf

Eerst drukken we op ESC en dan typen we onderstaande in om naar regel nummer 210 te gaan.

	:210

Daar staat een **directive** hoe de webserver moet omgaan met **overrides**. Met andere woorden **of** een .htaccess bestand de standaard configuratie mag overschrijven.

	AllowOverride None

Dit gaan we veranderen in onderstaande. Verander het woord `None` in `All`

	AllowOverride All

Bewaar het document door eerst op **ESC** te drukken en daarna het volgende in te typen.

	:wq

Wat wil zeggen dat we het file willen bewaren, ofwel `w` van **write** en dat we het programma vi willen afsluiten met `q` van **quit**.

### Methode 2. via TextWrangler

Open de Terminal en typ onderstaande commando in;

	edit /etch/apache2/httpd.conf

In TextWrangler gaan we met `Apple'tje + j` naar **regel 210**. Daar voeren we precies hetzelfde uit als bij de vi editor versie.

	AllowOverride None

Dit gaan we veranderen in onderstaande. Verander het woord `None` in `All`

	AllowOverride All

Bewaar het bestand en geef een administrator wachtwoord op. Dit moet je doen omdat het een Unix beveiligd bestand is.

## Apache herstarten

Nu gaan we de Apache 2.x webserver herstarten. Dit kan door via `Apple'tje > System Preferences`, zoek **Sharing** op en vink de **WebSharing** uit en even later weer **aan**.

Als we nog in de Terminal zitten voeren we het volgende commando uit

	sudo apachectl graceful

Hierdoor wordt de Apache server ge-herstart. We kunnen nu gebruik maken van .htaccess bestanden. De **mod_rewrite** module staat standaard al aan en werkt dus al.