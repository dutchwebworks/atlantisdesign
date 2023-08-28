---
title: "PHP5 op MacOS X Tiger"
description: "PHP is een Open-Source Server Side scripting taal welke zeer populair is en blijft groeien. Ondertussen is men bij versie 5. Op onze Mac staat versie 4."
pubDate: 2005-07-31
---

# PHP5 op MacOS X Tiger

Let op! Er is een update op dit artikel beschikbaar voor PHP5 op Apple's [MacOSX Leopard v10.5](http://www.atlantisdesign.nl/artikel/php5-op-macosx-leopard).

Op bijna alle versies van Mac OS X (ook de client versie) draait PHP4. PHP is een Server Side script taal welke een uitbereiding, module, is voor bijvoorbeeld de Apache webserver. Wat inhoud dat de scripts op de webserver uitgevoerd worden alvorens deze de HTML pagina naar de gebruiker stuurt. Hierdoor kunnnen HTML pagina's voorzien worden van **dynamische content**. Bijvoorbeeld met behulp van een database. Op de Nederlandse versie van [WikiPedia: PHP](http://nl.wikipedia.org/wiki/Php) kunt u lezen wat PHP nu eigenlijk inhoud.

In dit artikel leest u hoe u de huidige PHP4 versie, die standaard op de Mac al aanwezig is, kunnen updaten naar PHP5. Zonder compilers en ingewikkelde Unix codes in de terminal. Aan het einde van dit artikel wordt beschreven hoe u kunt switchen tussen PHP4 en de nieuwe PHP5 module. Zeer handig in een website ontwikkel omgeving. Dit artikel is van toepassing op **Mac OS X v10.3 Panther en v10.4 Tiger** client versie. Niet de server versie van Mac OS X.

Allereerst wordt beschreven hoe u de huidige PHP4 module kunt activeren. Daarna wordt uitgelegd hoe u PHP5 kunt installeren en configureren. Het verschil tussen deze versies, voor een leek en beginner, is te verwaarlozen. Natuurlijk is een hoger versie nummer beter maar om zo eens wat te spelen met PHP4 al voldoende. Een goede aanrader is het **PHP boek voor dummies** en goed begin. Hierin staan de beginselen van het PHP programmeren.

Het is niet noodzakelijk om eerst onderstaande PHP4 methode te activeren om later PHP5 te kunnen gebruiken. U kunt ook direct naar het stuk over PHP5 gaan.

## PHP4 activeren

Als u nog in PHP4 bent geinteresseerd volgt hier een aanwijzing hoe u deze kunt activeren. PHP4 staat standaard uit op een installatie van Mac OS X (client). Via de terminal kunt u deze makkelijk activeren. Zodoende kun u eens spelen met PHP op de Mac en een simpele dynamische website opzetten.

### Bewerken van de Apache configuratie

De Apache server is verantwoordelijk voor veel websites op internet. Als u een adres in uw browser intikt is negen van de tien keer de achterliggende webserver uitgerust met Apache en draait op Linux. Open de Mac OS X **Terminal** (`/Applications/Utilities`) en typ het volgende commando in gevolgd door een enter:

	sudo pico /etc/httpd/httpd.conf

Voor leken en beginners gebruiken we de Unix Pico tekst editor. Zoek, met behulp van `ctrl+w`, naar *php4*. De cursor springt naar een regel waar dit voorkomt. Aan het begin van deze regel staat een hekje **#**. Dit betekend dat de regel een 'comment' is welke niet mee genomen wordt met het opstarten van de Apache webserver (via het Web Sharing voorkeuren paneel op de Mac). Dit hekje halen we weg door er eerst met de cursor bovenop te gaan staan. Druk op 'delete' om het hekje te verwijderen.

Deze regel ziet er als volgt uit. Haal het hekje weg aan het begin van de regel:

	#LoadModule php4_module libexec/httpd/libphp4.so

Dit voeren we nogmaals uit op onderstaande regel. Zoek nogmaals (met `ctrl+w`) een paar keer naar *php4*. Op onderstaande regel moet ook het hekje ook verwijderd worden.

	#AddModule mod_php4.c

###Bewaren en Apache opnieuw opstarten

Alles is gereed om PHP4 te laten draaien op de Mac. Bewaar het document met `ctrl+x`, druk de letter y in en dan op enter. Open `Appel'tje > System Preferences > Sharing`. Vink daar het hokje van **Personal Web Sharing** uit en weer aan. Of vink het aan als u nog nooit Personal Web Sharing heeft gebruikt.

### PHP testen

De PHP module draait nu mee met de Apache webserver. Hoe testen we dat? PHP heeft een pagina waarop informatie staat wat van toepassing is op onze Mac. Waaronder welke versie van PHP er momenteel draait.

Open TextWrangler of BBEdit. [En plak deze tekst erin](http://www.atlantisdesign.nl/public/phpinfo.txt):

	<?php phpinfo(); ?>

Bewaar dit PHP script als `phpinfo.php` in uw **Sites** map in uw eigen thuis map. Open nu Safari of een andere browser. Typ onderstaand adres in en vervang **kortegebruikersnaam** door de naam van uw home map ofwel uw korte gebruikersnaam.

	http://localhost/~kortegebruikersnaam/phpinfo.php

In uw browser verschijnt een lange pagina met paarse balken. Het ovale PHP logo staat in beeld met de daarbij behorende versie nummer. Standaard staat op elke Mac OS X Mac PHP4 geinstalleerd. De PHP module is nu actief.

## Entropy PHP5 package downloaden

U kunt PHP5 downloaden van de [PHP.net](http://www.php.net/) website. Daarna kunt u met de Unix terminal heel ingewikkeld gaan doen met compilers, extra modules downloaden en proberen de Apache webserver zo te configureren dat deze PHP5 moet laden. Als leek of beginner trekt u vervolgens al uw haren uit het hoofd als het niet lukt. Waarbij het snel kan voorkomen dat u schade aanricht aan het Unix systeem. Er is natuurlijk een makkelijkere Mac manier. Een package dat de meest gangbare opties installeerd en samenwerkt met de huidige Apache 1.3.x webserver die al op uw Mac aanwezig is. Apple levert standaard de [Apache](http://www.apache.org/) 1.3 webserver bij alle versies van Mac OS X. Dit is een veelvuldig gebruikte webserver op internet.

Deze installer package is gemaakt door **Marc Liyanage** speciaal voor Mac OS X. Alles is al voor ge-compiled en in een handige Mac OS X installer package gestopt.

#### GDLib
Bij deze package is GDLib inbegrepen. Waarom is deze library handig? Met PHP kunnen on-the-fly grafieken gemaakt worden. Denk hierbij aan statistieken of andere zaken die het gebruik van server-side-graphics vereisen. Deze plaatjes worden gemaakt aan de hand van variablen binnen PHP. Dit is een veel gebruikte extensie op PHP. Voor ons gemak is de extra toevoeging al inbegrepen.

#### Downloaden
Download de [Entropy PHP5 package](http://www.entropy.ch/software/macosx/php/#install) voor Apache 1.3. Deze package is afgestemd op de huidige Apache webserver die we via `Appel'tje > System Preferences > Sharing` en dan '**Personal Web Sharing**' kunnen activeren.

#### Installeren en testen
Installeer de PHP5 package en volg de aanwijzingen van de installer. Om PHP5 te testen, en te zien welke versie we nu gebruiken, kunt u hetzelfde script gebruiken zoals we hierboven hebben gebruikt. Na de installatie opent u wederom Safari en bladert weer naar hetzelfde bestand.

	http://localhost/~kortegebruikersnaam/phpinfo.php

Nu zien we dat de Mac PHP5 gebruikt. De melding wordt gemaakt dat dit een Entropy PHP versie is. Gefeliciteerd!! U heeft een update van PHP4 naar PHP5 op uw Mac draaien.

### Configuratie nakijken

Het is niet vereist dat u deze stap volgt. Het is alleen voor de geinteresseerde onder ons. Nu onze Mac PHP5 heeft draaien kunt u de nieuwe configuratie bekijken van de Apache webserver. De PHP5 installer package heeft namelijk wat toegevoegd en veranderd in de manier welke PHP module de Apache server moet laden.

We gaan weer terug naar de terminal en kijken nogmaals in het bestand waar u hierboven de PHP4 module heeft geactiveerd. Typ in:

	sudo pico /etc/httpd/httpd.conf

Blader helemaal onderaan (met ctrl+v) in het document. Daar staat een regeltje welk de PHP5 module laad in plaats van de PHP4 module.

	Include /usr/local/php5/httpd.conf.php

De PHP5 installer heeft tevens de twee PHP4 regels, die we zojuist aangezet hebben, weer voorzien van een hekje aan het begin van de regel.

## Wisselen tussen PHP4 en PHP5

Goed, nu de PHP5 module actief is kunnen we ten alle tijden nog terug naar PHP4. Het is immers simpel de taak om de juiste configuratie aan de Apache webserver te geven. In het stuk hierboven hebben we gezien wat er veranderd is aan de Apache configuratie.

#### PHP4 terug zetten

U moet er voor zorgen dat de twee eerste PHP4 regels, zie helemaal aan het begin van dit artikel, niet voorzien zijn van een hekje. Dat wil dus zeggen dat de Apache server weer de PHP4 module moet laden. Hier volgen beide regels nogmaals zonder hekjes:

	LoadModule php4_module libexec/httpd/libphp4.so

	AddModule mod_php4.c

#### PHP5 weer uitzetten

Als laatste zorgen we ervoor dat PHP5 weer uitgezet wordt. Voorzie de volgende regel van een hekje:

	#Include /usr/local/php5/httpd.conf.php

U slaat het document weer op (met ctrl+x, zie hierboven) en herstart de Apache server weer in het **Personal Web Sharing** voorkeuren paneel. Herlaad de `phpinfo.php` pagina in uw Safari webbrowser om te kijken of de Mac nu weer PHP4 gebruikt.

## Bronvermelding en dank

Deze manier om PHP5 op de Mac te installeren is voort gekomen uit eigen ervaring en het lezen van de [engelse instructies](http://www.entropy.ch/software/macosx/php/#install) op de website van Marc Liyanage. Mijn dank aan Marc en zijn makkelijke PHP5 package installer voor Mac OS X.