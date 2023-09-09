---
title: "Entropy PHP5 met GDLib op Leopard"
description: "De PHP 5.x versie op Entropy.ch (Marc Liyanage) bevat onder andere de GDLib library waarmee dynamisch plaatje gegeneerd kunnen worden. Deze GDLib library staat helaas niet standaard op de default installatie van PHP die Apple ons biedt."
pubDate: 2008-05-31
---

De Entorpy PHP5 versie is vele malen uitgebreider dan de standaard versie die Apple op de Mac heeft voor geinstalleerd.

Bij het schrijven van dit artikel is er nog geen goede binary installer van [PHP 5.x](http://www.entropy.ch/software/macosx/php/) met [GDLib](http://nl2.php.net/gd) voor Mac OS X Leopard op de Entropy website. Via een [forum post](http://www.entropy.ch/phpbb2/viewtopic.php?t=2945) wordt het een en ander al uitgelegd over een toekomstige versie.

De standaard PHP installatie van Apple gaan we niet gebruiken. Deze gaan we vervangen door de Entropy versie. Bij het schrijven van dit artikel is dat **PHP 5.2.5** beta 6 (op het [Entropy forum](http://www.entropy.ch/phpbb2/viewtopic.php?t=2945)).

### Bron

Deze tutorial heb ik niet zelf uitgevonden maar ook van het [internet geplukt](http://www.maltete.com/blog/index.php?pdf/388/). Hier volgt de Nederlandse vertaling met wat meer uitleg.

## Huidige PHP versie uitzetten

Als de standaard PHP van Apple al wel werkt moet deze eerst uitgezet worden. Open de **Terminal** (`/Applications/Utilities/Terminal`) en bewerk het Apache configuratie bestand, bijvoorbeeld met het **gratis** [TextWrangler's](http://www.barebones.com/products/textwrangler/index.shtml) **edit** commando.

	edit /etc/apache2/httpd.conf

Zoek onderstaande regel op (ongeveer op **regel 114**):

	LoadModule php5_module libexec/apache2/libphp5.so

Zet er een hekje voor (comment), zodat deze versie van PHP het niet meer doet:

	#LoadModule php5_module libexec/apache2/libphp5.so

### Oude Entropy versie verwijderen

In dit artikel gaan we ervan uit dat er nog nooit een Entropy versie van PHP op de Mac is geinstalleerd. Mocht dat wel het geval zijn moet deze eerst verwijderd worden.

	sudo mv /usr/local/php ~/Desktop/php5.old

Op de Desktop verschijnt nu de oude Entropy versie die we later weg kunnen gooien.

## Nieuwe Entropy versie downloaden

Download eerst de [PHP 5.2.5 (beta 6)](http://www2.entropy.ch/download/php5-5.2.5-6-beta.tar.gz) versie van de Entropy website. De download is best groot.

Pak het `.tar.gz` bestand uit door gewoonweg dubbelklikken. Zorg ervoor dat de map de volgende naam krijgt:

	php5

## Verplaatsen

Open de **Terminal** (`/Applications/Utilitis/Terminal`) en ga naar de map waar de nieuwe PHP is gedownload. Verplaats deze nu met een Unix commando naar de juist directory:

	sudo mv php5 /usr/local/

De Entropy PHP versie hoeft niet geinstalleerd te worden. Deze is direct bruikbaar voor MacOS X Leopard.

## PHP error display

Standaard in deze Entropy PHP5 versie staan de **error messages** die PHP op het scherm zet uit. Bij een syntax error bijvoorbeeld. Dit is natuurlijk bijzonder vervelend bij het maken van een PHP website. We maken eerst een kopie van de bestaande Entropy **php.ini-recommended**:

	sudo cp /usr/local/php5/lib/php.ini-recmmended /usr/local/php5/lib/php.ini

Bewerk nu deze nieuwe PHP configuratie met bijvoorbeeld het **gratis** [TextWrangler's](http://www.barebones.com/products/textwrangler/index.shtml) edit:

	edit /usr/local/php5/lib/php.ini

#### Default error handling

Ga met (Apple'tje + j) naar **regel 341** wat het level van error handling is en haal de ; ervoor weg (comment):

	error_reporting = E_ALL & ~E_NOTICE

### Te veel errors

Ga naar **regel 354** en zet daar een **;** voor. Dit was de standaard manier van errors weergeven die iets te veel onnodige errors weergeeft:

	;error_reporting = E_ALL

### Display errors

Nu moeten we de nog aangeven dat we bovenstaande manier ook nog in beeld willen krijgen als er PHP errors optreden. Ga aar **regel 372** en zet de display errors aan:

	display_errors = On

## Apache configureren voor Entropy PHP5

Nu moeten we de Apache webserver laten weten dat het deze versie van PHP moet gebruiken. Met een Unix **symbolic link** in de Apache map, zorgen we ervoor dat als Apache opnieuw opgestart wordt deze de nieuwe configuratie automatisch meeneemt.

	sudo ln -s /usr/local/php5/entropy-php.conf /etc/apache2/other/+entropy-php.conf

## Apache herstarten

Met een herstart van Apache zorgen we ervoor dat deze nu de Entropy PHP5 versie **met onder andere GDLib** gebruikt:

	sudo apachectl graceful

## Testen

Maak een zogenaamd **phpinfo** bestand aan. [Download dit voorbeeld](http://www.atlantisdesign.nl/public/phpinfo.txt):

	<?php phpinfo(); ?>

&hellip; en plaats deze in je eigen Sites map:

	/Users/korte-gebruikersnaam/Sites/phpinfo.php

Open een webbrowser en typ onderstaande adres in. Vervang **korte-gebruikersnaam** door de naam van je thuismap.

	http://127.0.0.1/~korte-gebruikersnaam/phpinfo.php

Er verschijnt een pagina met paarse balken en een bericht dat dit de Entropy versie van PHP is. Zoek nu naar **gd**.