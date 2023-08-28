---
title: "MySQL op MacOS X Tiger"
description: "PHP kan goed samenwerken met de MySQL database. Het wordt veel toegepast op website met dynamische content. Het is gratis te gebruiken voor eigen gebruik en leer doeleinden."
pubDate: 2005-07-31
---

# MySQL op MacOS X Tiger

**Let op!** Er is een update op dit artikel beschikbaar voor [MySQL op Apple's MacOSX Leopard v10.5](http://www.atlantisdesign.nl/artikel/mysql-op-macosx-leopard).

We gaan MySQL installeren via een makkelijke installer package voor Mac OS X. **Mac OS X Panther en Tiger** zijn geschikt voor deze installer. Meer Nederlandse informatie over MySQL kunt u vinden op WikiPedia: MySQL.

## MySQL 4.1 downloaden

Bij het schrijven van dit artikel is versie 4.1 de laatste stabiele versie. [Download](http://dev.mysql.com/downloads/mysql/4.1.html#Mac_OS_X) de Mac OS X versie van de MySQL Ab website. Hierin zitten een aantal bestanden verwerkt:

* **MySQL 4.1 installer package**, dit is natuurlijk de MySQL database netjes verwerkt in een simpele installer.
* Een '**prefPane**' bestand, hiermee kun je via Apple's System Preferences de database be?nvloeden.
* Een **startupItem**, installeer dit bestand zodat de MySQL database opstart bij het opstarten van de Mac

## Installeren

Start de installer en volg de aanwijzingen op het scherm. Nadat de installatie voltooid is installeer je de 'prefPane'. Het is een goede zaak om nu te controleren of de database het ook daadwerkelijk doet. Open de System Preferences en klik onderaan op MySQL. Als het goed is staat er in het groen vermeld dat de database daadwerkelijk draait. Met dit scherm kunt u de database dus ook stop zetten. MySQL draaid als een proces, ofwel programma, in de achtergrond.

## #Root wachtwoord

De MySQL database heeft een gebruikers systeem net als elke andere Unix/Linux machine en net als uw eigen Mac. Alle gebruikers hebben een gebruikersnaam en een wachtwoord. MySQL user management is best complex en wordt uitgebreidt beschreven op de MySQL website. De superuser van MySQL heet '**root**' welke bij het installeren van de database nog geen wachtwoord heeft. Het is zeer verstandig om deze superuser van een wachtwoord te voorzien. Want deze gebruiker mag alles uithalen met uw database zonder restricties.

Gebruik een programma als [Navicat](http://www.navicat.com/) (commercieel) of de webtool [phpMyAdmin](http://www.phpmyadmin.net/) om de root user te voorzien van een wachtwoord.

## Waarmee kan ik MySQL gebruiken?

PHP is een goed voorbeeld om te gebruiken met een MySQL database. Het is snel en goed inzetbaar voor dynamische websites. Het wordt veelvuldig gebruikt op internet voor deze reden. Natuurlijk is MySQL veelzijdig en kunnen allerlei programma's verbinding maken met de databases in MySQL. Het gebruik van een database moet u wel bekend zijn.

## Hulp programma's

Nu MySQL draait en klaar is voor gebruik willen we wel eens zien hoe MySQL nu eigenlijk werkt en hoe we erop in kunnen loggen. Heeft u al enige [SQL](http://nl.wikipedia.org/wiki/SQL) kennis dan kunt u direct van start met onderstaande programma's. De programma's die hieronder beschreven worden zijn hulpmiddelen om de databases en records mee te beheren. Natuurlijk zijn er meerdere MySQL hulpprogramma's te krijgen op internet voor Mac OS X. Hier een greep uit een paar favorieten.

### Navicat

Mijn persoonlijke favoriet is Navicat. Het is een commercieel programma maar wel eentje die naar mijn smaak het beste samenwerkt met de MySQL database. Je kun hiermee ook MySQL databases benaderen op andere computers of platformen.

Een ideale tool om gebruikers te beheren, records en tabellen te bewerken. Bovendien kan men de queries bewaren en heel eenvoudig backups maken van complete database of deze direct overzetten naar een andere database of host.

Een van de mooiste feature is het 'vormgeven' van de SQL query. Via tabellen tekenen en lijntjes trekken tussen de tabellen wordt in de achtergrond automatisch de juiste SQL query geformuleerd. Op deze manier kun je ook aardig semi SQL leren. Het blijft natuurlijk beperkt binnen het programma want SQL is een complese taal. De volledige [feature lijst](http://www.navicat.com/feature.html) staat op de website van Navicat.

Er is ook een **gratis** [Navicat v7 Lite](http://www.navicat.com/download.html) uitgebracht. Hiermee kun je de basic dingen met MySQL doen zoals z'n commerciele variant. De commerciele versie heeft een interne optie op backups te maken. Dit heeft de lite versie niet maar je kunt wel SQL dump files (exports van je databases) mee maken.

### MySQL Query Browser](http://dev.mysql.com/downloads/query-browser/)

Dit is een **gratis** programma om queries uit te voeren, tabellen te maken en records mee te beheren. MySQL Query Browser is bij het schrijven van dit artikel nog in vroege 1.x status. Persoonlijk vind het niet prettig werken want bij een update van een record die veel tekst bevat knalt het programma er nog wel eens uit.

### [MySQL Administrator](http://dev.mysql.com/downloads/administrator/)
De makers van MySQL hebben tevens voor de Mac gebruikers een gratis MySQL Administrator voor u klaar staan. Hiermee kunt u databases exporteren, voor bijvoorbeeld backups, en gebruikers beheren via een programma. Het ziet er veel belovend uit maar echt practisch werkt het nog niet.

### [phpMyAdmin](http://www.phpmyadmin.net/)

Dit is ook een Open-Source pakket wat eigenlijk uit een complete website bestaat. Het beheren van MySQL gebruikers is via deze tool vele malen makkeler dat de boven beschreven MySQL Administrator. phpMyAdmin wordt vaak gebruikt om databases te beheren die op een webserver staan van een hostigbedrijf ofwel op een server op locatie.

#### Let op!

Hiervoor is wel PHP vereist op uw Mac. Lees hiervoor het artikel [PHP5 op Mac OS X Tiger](http://www.atlantisdesign.nl/artikel/php5-op-macosx-tiger).

Deze hosting bedrijven laten niet toe dat u, van buitenaf voor beveiligings redenen, verbinding kan maken met de MySQL database. Daarom moet u een tool hebben waarmee u de MySQL database wel kunt beheren alsof u achter de computer zelf zit. Hieronder staat een snelle versimpelde uitleg over het opzetten van phpMyAdmin. Het gebruik hiervan moet u zelf ondervinden.

Download de source bestanden ofwel de complete website van phpMyAdmin. Pak het geheel uit met bijvoorbeeld StuffIt Expander. Geef de map die eruit komt een makkelijkere naam voor uzelf, bijvoorbeeld: **phpmyadmin**. Verplaats de map naar uw eigen **Sites** map in uw home map. Open met een texteditor (Apple's TextEdit, of liever [BBEdit](http://www.barebones.com/products/bbedit/) of [Macromedia Dreamweaver](http://www.macromedia.com/software/dreamweaver/) maar zeker niet Microsoft Word!) het bestand `config.inc.php`.

Zoek onderstaande regel op:

	$cfg['Servers'][$i]['auth_type'] = 'config'

Verander **config** in **http**. Maak de **root username en het wachtwoord** veld ook leeg. Sla het bestand op en open de Safari webbrowser. Blader vervolgens naar deze map:

	http://localhost/~kortegebruikersnaam/phpmyadmin/

Vervang in bovenstaande URL de **kortegebruikersnaam** door de naam van uw thuismap. Vervolgens komt er een inlogscherm naar voren waar u uw root account gegevens moet invullen. Als dat is gebeurt kun u via deze web applicatie ook uw databases en gebruikers beheren.