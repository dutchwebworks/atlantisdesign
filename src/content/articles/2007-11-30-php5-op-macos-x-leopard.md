---
title: "PHP5 op MacOS X Leopard"
description: "Apple heeft in haar nieuwe vier voeter voor ons de PHP5 module al voor geinstalleerd. Deze gaan we met 1 terminal commando aanzetten."
pubDate: 2007-11-30
---

# PHP5 op MacOS X Leopard

Apple heeft in Leopard voor de **Apache 2.x** webserver gekozen. In voorgaande systemen stond daar nog de Apache 1.3 webserver op geinstalleerd. Ook heeft Apple deze Apache 2.x webserver al voorzien van een gangbare installatie van PHP5. Vorige systemen hadden nog PHP4.

Echter staat deze niet standaard aan. In een voorgaand artikel over [PHP op MacOSX Tiger](http://www.atlantisdesign.nl/artikel/php5-op-macosx-tiger) heb ik al uitgelegd hoe we deze PHP module aan kunnen zetten.

## Apache 2.x configuratie backup maken

Open de Terminal applicatie (/Applications/Utilities/Terminal). We gaan eerst een backup maken van het Apache configuratie bestand.

#### Ga eerst naar de map waar het configuratie bestand staat:

	cd /etc/apache2

#### Vraag een lijst met bestanden op. Deze stap is perse nodig:

	ls -l

Hier zien we welk bestand we moeten hebben, namelijk `httpd.conf`. Typ het volgende commando in en geef een administrator wachtwoord op.

#### Backup maken

	sudo cp httpd.conf httpd.conf_backup

Vraag met `ls -l` opnieuw een lijst op en we zien dat er een backup bestand is gemaakt. Voor degene die met de Unix terminal overweg kunnen weten hoe ze met de commando's `rm` en `mv` de backup weer terug kunnen zetten.

## PHP5 aanzetten

Nu kunnen we op 2 manier de PHP5 module aan zetten. De Terminal methode is het moeilijks, maar als je gewent ben met Unix te werken is dit sneller. Of we maken gebruik van TextWranlger, een gratis MacOS X text-editor.

#### Methode 1. met de Terminal en Unix vi text-editor

Typ in de **Terminal** het volgende commando in en voer een administrator wachtwoord in. Dit is een Unix bestand wat beveiligd is met root rechten.

	sudo vi httpd.conf

Druk op **ESC** typ dan het volgende in waardoor het scherm naar **regel 114** springt.

	:114

#### Methode 2. Met een gratis echt MacOS X text-editor

Het is aan te raden om de programma's als het **gratis** [TextWrangler](http://www.barebones.com/products/textwrangler/) of de commerciele broer [BBEdit](http://www.barebones.com/products/bbedit/index.shtml) te gebruiken.

Start **TextWrangler** (of BBEdit) en laat het de **command line tools** installeren. We kunnen nu aan de slag. Als je gebruik maakt van **BBEdit** is het commando om bestanden te bewerken (vanuit de Ternimal) `bbedit` in plaats van `edit` welke **TextWrangler** gebruikt.

Nu kun je met een normaal MacOS X programma dit soort handelingen kan uitvoeren.

	edit httpd.conf

Druk op `Apple'tje + j`, en typ regel nummer **114** in.

## De PHP5 module opsporen

In beide gevallen hebben we nu de Apache configuratie file voor ons staan. met onderstaande regel.

	#LoadModule php5_module libexec/apache2/libphp5.so

De Apache webserver laad in deze lijst haar modules in waaronder PHP5. Hier staan ook vele configuraties die je kunt aanpassen. Maar daar gaan we niet aan zitten.

Zoals je aan het **#** (hekje ofwel een comment in programmeer taal) kunt zien wordt deze regel niet meegenomen met het opstarten van de Apache webserver.

### Terminal manier

Met de vi editor gaan de cursor op het hekje zetten en drukken dan de letter x (dat betekend delete). Bewaar het document weer door eerst op **ESC** te drukken, typ dan ondertaande in:

	:wq

Wat betekend dit allemaal? De letter `w` staat voor '**write**' en de letter `q` staat voor '**quit**'. Dus snel achter elkaar betekend het: bewaar dit bestand en sluit de vi editor af.

### TextWrangler of BBEdit manier

Verwijder het hekje dat voor deze regel staat. Bewaar het bestand en vul een administrator wachtwoord in.

## Apache webserver herstarten (of aan zetten)

Goed, we hebben nu PHP5 aangezet in de Apache webserver. Nu moeten we de Apache webserver herstarten, of aanzetten als deze nog niet aan staat.

Ga naar linksboven van het scherm: `Apple'tje > System Preferences`, zoek dan '**Sharing**' op en vink de **Websharing** optie aan. Als deze al aan staat vinken we deze uit en even later weer aan.

### Terminal manier

Als je gewent ben in Unix te werken kan ook onderstaant commando de Apache webserver herstarten.

	sudo apachectl graceful

## PHP testen

De PHP module draait nu mee met de Apache webserver. Hoe testen we dat? PHP heeft een pagina waarop informatie staat wat van toepassing is op onze Mac. Waaronder welke versie van PHP er momenteel draait.

Open TextWrangler of BBEdit. [En plak deze tekst erin](http://www.atlantisdesign.nl/public/phpinfo.txt):

	<?php phpinfo(); ?>

Bewaar dit PHP script als **phpinfo.php** in uw `Sites` map in uw eigen thuis map. Open nu Safari of een andere browser. Typ onderstaand adres in en vervang **kortegebruikersnaam** door de naam van uw home map ofwel uw korte gebruikersnaam.

	http://localhost/~kortegebruikersnaam/phpinfo.php

In uw browser verschijnt een lange pagina met paarse balken. Het ovale PHP logo staat in beeld met de daarbij behorende versie nummer. De PHP5 module is nu actief op de Apache 2.x webserver en klaar voor gebruik.