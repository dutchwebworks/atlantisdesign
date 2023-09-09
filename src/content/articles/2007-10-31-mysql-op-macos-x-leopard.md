---
title: "MySQL op MacOS X Leopard"
description: "Er is bij het schrijven van dit artikelen nog geen officiele versie uit van MySQL voor Mac OS X Leopard v10.5. Hier een omweg."
pubDate: 2007-10-31
---

* In een vorig artikel over [MySQL voor Tiger v10.4](http://www.atlantisdesign.nl/artikel/mysql-op-macosx-tiger) is uitgelegd hoe je MySQL v4.1.x aan de praat kan krijgen. Sinds enige tijd heeft Apple zijn nieuwste vier voeter los gelaten in het wild. **Hier volgt een update op dit artikel**.

Apple heeft de Apache webserver ge-update naar versie 2 (die al een tijd uit is naturulijk) en heeft ons ook voorzien van een pre-installed PHP5 waar we prima mee uit de voeten kunnen.

Het wordt tijd om MySQL erbij te installeren!!

**Let op!** Onderstaande methode heb ik niet zelf uitgevonden maar ook van het internet geplukt.

## MySQL v4.1.x downloaden

Voor het gemak neem ik niet de laaste stable versie (bij het schrijven is dat iets van versie 5 ofzo). Versie 4.1 doet het ook prima voor thuis gebruik en kleine website.

Ga naar de MySQL website en [dowload versie 4.1](http://dev.mysql.com/downloads/mysql/4.1.html#macosx-dmg) voor Mac OS X Tiger v10.4. Let goed op of je een Intel Mac hebt of een oudere PowerPc versie.

## Installeren

Installeer de MySQL 4.1.x package zoals je normaal zou doen voor Mac OS X Tiger. Als de ze klaar is installeer je de `MySQLStartupItem.pkg` en de **MySQL.prefPane**.

### MySQLStartupItem.pkg

Installeer deze zoals gebruikelijk. Dit zou er voor moeten zorgen dat de MySQL database automatisch mee opstart als de Mac opstart. Dit gaat **bijna** werken. Verderop in het artikel gaan we in de Terminal een regeltje typen die dit gaat fixen.

### MySQL.prefPane

Deze laatste (het Systeem voorkeuren paneel) zal niet gaan werken omdat sommige Unix dingen in Mac OS X Leopard anders zijn dan bij Tiger. De startup-item zal ook nog niet z'n werk doen.

Totdat MySQL AB, die MySQL onderhouden en vast in de toekomst nog wel een MySQL voor Leopard installer zullen gaan maken, kunnen gewoon gebruik maken van deze versie van MySQL.

## Goed, nu de 'hard-stuff'

In de Mac OS X **Terminal** (`/Applications/Utilities/Terminal`) gaan we de volgende commando's uit voeren. Copy + paste onderstaande Unix code in de Terminal en typ een administrator wachtwoord in.

### MySQL StartupItem een handje helpen met een Unix symbolic link

	sudo ln -s /tmp/mysql.sock /var/mysql/mysql.sock

#### Foutmelding?

**Let op!** Als je een foutmelding krijgt dat de map `mysql` (nog) niet bestaat moet je deze eerst aanmaken, en geef een administrator wachtwoord op. Probeer nu bovenstaande symbolic link opnieuw.

	sudo mkdir /var/mysql

MySQL installeerd zich in een bepaalde map die afwijkt van de map waar bijvoorbeeld de door Apple pre-installed PHP5 en andere zaken de MySQL database zouden verwachen. Het stukje `ln -s` betekend vrij vertaald dat we een symbolische (permanente) Unix link / alias maken van de ene map of file naar de andere. Beide zijn dus te gebruiken door Mac OS X.

Hierdoor zal de zojuist geinstalleerde **MySQLStartupItem** zijn werk **wel** doen.

## Dan nu een andere oplossing voor de MySQLPrefPane

In onze systeem voorkeuren staat een paneel waarmee je de MySQL database kan starten en stoppen. Hiermee kun je de MySQL niet meer starten of stoppen omdat we nu op Leopard zitten welke iets anders werkt.

Er zal waarschijnlijk door MySQL AB ooit wel een nieuwe **PrefPane** komen die wel werkt.

### MySQL starten en stoppen

We keren terug naar de Terminal (/Applications/Utilities/Terminal). Nu gaan we 2 slimme commando's (ofwel shortcut commando's) maken waarmee we de MySQL database server makkelijk kunnen starten en stoppen.

**Let op!** Dit heb ik ook niet zelf verzonnen maar van een [andere website gekopieerd](http://www.simplisticcomplexity.com/2007/10/27/start-and-stop-mysql-in-mac-os-x-105-leopard/).

In de Terminal gaan we een verborgen Unix 'bash profile' bestandje maken. 'Waar is dit voor' zul je denken?. Zodra we het Terminal programma starten zorgt dit bestandje ervoor dat alles wat hierin staat direct wordt uitgevoerd.

Dat kan op 2 manier. Als je al bekend bent met de Terminal en de vi editor (of PICO) is het een fluitje van een cent. De tweede manier is via een Mac OS X text editor die je gratis kunt downloaden. Het is aan te raden om het gratis [TextWrangler](http://www.barebones.com/products/textwrangler/) (of de commerciele broer [BBEdit](http://www.barebones.com/products/bbedit/index.shtml)) te installeren.

Start TextWrangler (of BBEdit) en laat het de command line tools installeren. We kunnen nu aan de slag. Als je gebruik maakt van **BBEdit** is het commando om bestanden te bewerken (vanuit de Ternimal) `bbedit` in plaats van `edit` welke **TextWrangler** gebruikt.

### Methode 1. Via de Terminal

	vi .bash_profile

### Methode 2. Via TextWrangler of BBEdit

	edit .bash_profile

Er opent zich een leeg scherm, of text file voor het geval je BBEdit of TextWrangler hebt gebruikt. Copy en Paste de onderstaande 2 regels in hetzelfde lege document.

#### Plak onderstaande in het .bash_profile bestand

	alias start_mysql="/Library/StartupItems/MySQLCOM/MySQLCOM start"

	alias stop_mysql="/Library/StartupItems/MySQLCOM/MySQLCOM stop"

Voor de Terminal versie bewaar je het document door eerst op **ESC** te drukken, typ dan een **dubbele punt** in, daarna de letter `w` en de letter `q` achter elkaar. Dus zoals onderstaande:

	:wq

Dat betekend vrij vertaald: Ga naar de command modus van de VI editor, bewaar het file ofwel w van 'write' en sluit de vi editor af ofwel de `q` van 'quit'.

Voor degene die **TextWrangler** of **BBEdit** gebruiken plakken ook de 2 regels in het document, bewaar en sluit het bestand. Sluit het Terminal programma af en start het op nieuw op.

Het `.bash_profile` bestandje is geladen. In het geheugen van de Terminal zijn nu 2 commando's ofwel shortcuts (alias) beschikbaar.

## Starten van de MySQL database server

Sluit het Terminal programma af en open het opnieuw, zodat de zojuist aangemaakte shortcuts / aliasses werken, (/Applications/Utilities/Terminal) en typ vervolgens in:

#### Start MySQL database

	start_mysql

Dit is de alias / shortcut die we zojuist hebben aangemaakt. In beeld zal de tekst verschijnen dat de MySQL database server bezig is met opstarten. Even wachten en de promt (knipperende cursor) komt terug.

**De MySQL server draait nu!!** Lees op de [vorige versie](http://www.atlantisdesign.nl/artikel/mysql-op-macosx-tiger) van dit artikel over extra (hulp) programma's om met de MySQL database server te communiceren.

#### Vergeet vooral niet het root wachtwoord in te stellen!

In het [vorige artikel](http://www.atlantisdesign.nl/artikel/mysql-op-macosx-tiger) kun je meer lezen over het root wachtwoord.

Stoppen van de MySQL database server is ... je raad het al, net zo makkelijk als onderstaande commando in de Terminal te typen.

#### Stoppen van MySQL database

	stop_mysql

## Maar nu ... moet ik die commando's elke keer intypen?

Nee, dat hoeft niet. Als je de symbolic link in de Terminal aan heb gemaakt (lees het stukje hierboven bij '**Goed, nu de hard-stuff**') zijn bovenstaande commando's na een herstart nooit meer nodig. Bij een herstart van de Mac wordt toch gebruik gemaakt van het StartupItem welke de MySQL database zelf opstart.

## MySQL database beheren

Er zijn diverse programma's om de MySQL database te beheren. De bekendste is [phpMyAdmin](http://www.phpmyadmin.net/). Het is een website dat gebruik maakt van PHP.

### Navicat Lite

Een aanrader is het **gratis** [Navicat v7 Lite](http://www.navicat.com/download.html). Hiermee kun je de basic dingen met MySQL doen zoals z'n commerciele variant. De commerciele versie heeft een interne optie op backups te maken. Dit heeft de lite versie niet maar je kunt wel SQL dump files (exports van je databases) mee maken.

### MySQL Query Browser en Administrator
De mensen die MySQL onderhouden, MySQL AB, hebben ook 2 gratis tools ter beschikking gesteld. Met [MySQL Query Browser](http://www.mysql.com/products/tools/query-browser/) kun je SQL queries maken en los laten op je database. Met de [MySQL Administrator](http://www.mysql.com/products/tools/administrator/) kun je de databases beheren en backupen.