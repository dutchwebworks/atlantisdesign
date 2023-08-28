---
title: "PureFTPDd installeren op MacOS X Leopard"
description: "Een betere, makkelijkere te onderhouden FTP server op Mac OS X. Met gebruik van virtual-users."
pubDate: 2007-11-30
---

# PureFTPDd installeren op MacOS X Leopard

Dit is eigenlijk een soort nieuwe versie op de [Tiger editie](http://www.atlantisdesign.nl/artikel/pureftpd-installeren-op-macosx-tiger) van PureFTPd. In dit artikel gaan we PureFTPd installeren op **Mac OS X Leopard v10.5**. Kijk op bovenstaand artikel voor de Tiger versie.

Apple heeft in alle versies van Mac OS X een aardig werkende FTP server al ingebouwd. Via `Apple'tje > System Preferences > Sharing` ... vink aan **File Sharing**, klik dan op **Options**. kunnen we deze aanzetten en deels configureren.

### Nadeel van de ingebouwde FTP server

Net als voorgaande varianten van Mac OS X heeft deze FTP server weinig opties te bieden. Een groot nadeel van deze FTP server is dat, zodra iemand vanaf een andere computer is ingelogd, de gehele Mac kan bekijken. Afhankelijk van het type Mac OS X account waarmee men inlog kan deze persoon **alle bestanden zien, bewerken en zelfs verwijderen!**

Dit zou zeker niet handig zijn als we een FTP account aan een derde geven zodat deze bestanden kan uploaden naar de Mac. Bovendien als we ftp-only-users (gebruikers die geen echte Mac OS X account hebben) willen is dit wel mogelijk sinds Mac OS Leopard v10.5.

### Virtual ftp users

Beter zou zijn als we **virtual-ftp-users** kunnen aanmaken. Dit zijn geen echte Mac OS X accounts, krijgen ook al die overbodige mappen niet in hun thuismap, hiermee blijven de echte Mac OS X accounts (mensen die fysiek achter de Mac kunnen inloggen) beperkt tot de mensen die echt werken achter de Mac.

### Waarom geen Mac OS X accounts?

Echte Mac OS X accounts hebben een eigen thuis map in de `/Users` map op de Mac. Compleet met (voor ftp-only-users) overbodige mappen als **Library, Pictures, Sites, Documents** en bijvoorbeeld **Desktop**. Wat moeten deze ftp-only-users hiermee? Die willen alleen een mapje aangewezen krijgen op de Mac waar ze hun bestanden of een website kunnen uploaden.

## PureFTPd Manager

Dit is een **donation-ware** (**gratis**, donaties zijn zeer welkom) van fransman **Jean Matthieu**. De Mac OS X Leopard versie heeft een tijdje op zich laten wachten. Het bevat een bekende PureFTPd Unix ftp-server, welke veel gebruikt wordt in Unix en Linux webservers.

[PureFTPd Manager](http://jeanmatthieu.free.fr/pureftpd/) bevat speciaal voor Mac OS X (Tiger en Leopard) een manager om alle benodigde elementen te installeren en de bestaande Apple FTP server te vervangen door PureFTPd. Daarbij zit er een prachtig Mac programma (de Manager) om de PureFTPd server daadwerkelijk te beheren, **virtual-users aan te maken** en deze mappen aan te wijzen op de Mac die fungeren als home directories.

## Het doel

Onderstaande klinkt moeilijk maar dat is het zeer zeker niet. Als we hiermeer klaar zijn kunnen we veel, heel veel, ftp-only-users aanmaken die speciaal bedoelt zijn om bestanden uit te wisselen met de Mac.

* De bestaande FTP server vervangen door PureFTPd
* Virtual ftp-only gebruikers aanmaken met eigen home directory
* Iets geavanceerdere authentication methode via een MySQL database

## Downloaden en installeren

[Download PureFTPd Manager](http://jeanmatthieu.free.fr/pureftpd/). Voordat je deze nieuwe FTP server installeerd moet je er zeker van zijn dat de **oude FTP server uit staat. Dit is belangrijk!**

### Bestaande FTP server uitzetten

Ga naar `Apple'tje > System Preferences > Sharing` ... klik op **File Sharing** en dan rechsonderin op Options. Vink uit: **Share files and folder using FTP**.

### Installeren

Installeer nu de PureFTPd Manager package. Volg de aanwijzingen op het scherm. Het is aan te raden na de installatie het programma van de `/Applications` map te verplaatsen naar de `/Applications/Utilities` map.

PureFTPd Manager is een meer utility om de FTP server te beheren en gebruikers aan te maken. Op deze manier blijven dit soort programma's goed georganiseerd bij elkaar.

### Volg de aanwijzingen op het scherm

Start nu PureFTPd Manager. Omdat een FTP server dingen in het Mac systeem moet veranderen, en gebruikers kan toevoegen, wordt elke keer om een Mac OS X administrator wachtwoord gevraagd. Volg de aanwijzingen op het scherm. Sla de stap voor **anonymous users** over, dit hebben we niet nodig. We willen niet dat gebruikers kunnen inloggen **zonder username en password**.

Aan het eind wordt gevraagd om de PureFTPd server daadwerkelijk te configureren. Hierdoor wordt de oude FTP server vervangen door PureFTPd.

### PureFTPd starten

In het hoofdscherm van PureFTPd klikken we rechtsonderin op **Start**. Aan de linkeronderkant van het scherm kunnen we zien dat nu PureFTPd server draait.

## Testen

Start bijvoorbeeld een **FTP client** als [Fetch](http://www.fetchsoftworks.com/), [Transmit](http://www.panic.com/transmit/), het gratis [Classic FTP](http://www.nchsoftware.com/classic/index.html) (for Mac) of het **gratis** [CyberDuck](http://cyberduck.ch/). Typ bij het IP nummer het volgende in. Dit betekend gewoon 'je eigen Mac', ofwel deze Mac zelf.

	localhost

Gebruik vervolgens je **eigen Mac OS X account met username en password**. Als het goed is zie je nu je eigen thuis map (ofwel home directory). Blader nu in het **console window** (een lijst met commando's die worden uitgevoerd door het FTP programma) iets terug en we zien daar dat Mac OS X nu gebruik maakt van **PureFTPd**.

## Virtual users aanmaken

Bovenin het scherm van PureFTPd klikken we op de button **User Manager**. PureFTPd kan op verschillende manieren gebruikers (users) bewaren. De meest gebruikte optie in PureFTPd is PureDb. Dat is een eigen indeling om gebruikers te bewaren en nog wat andere specifieke eigenschappen voor gebruikers in op te slaan.

Klik bovenaan het scherm op de knop New. Aan de linkerkant verschijnt straks de username die we gaan aanmaken. Hier worden die virtual users aangemaakt. Vul de gevraagde gegevens in en **verzin zelf een username en password** waarmee ingelogd moet worden.

#### Home directory aanwijzen en restricties opleggen

Als deze gebruiker inlogd komt deze ergens in een map terecht op onze Mac. Dit kunnen we hier aangeven waar dat is. Let op! Het voordeel van dit alles is dat het elke map kan zijn die je maar wilt. **Zelfs op externe hardeschijven!**

## Restrict user access to his home directory

Vink aan **Restict user access to his home directory**. Hiermee voorkom je dus waar het in het begin van dit artikel over ging. Dat deze gebruiker niet in de mappen structuur omhoog mag klimmen en naar andere delen van de Mac mag gaan.

Samen met de virtual-users en het toekennen van een eigen home directory zijn dit de grootste argumenten om PureFTPd te installeren in plaats van gebruik te blijven maken van de bestaande ingebouwde Apple FTP server.

Op dezelfe manier kunnen we nu de nieuwe FTP users gaan testen.

## MySQL authentication

In het artikel [MySQL op Mac OS X Leopard](http://www.atlantisdesign.nl/artikel/mysql-op-macosx-leopard) wordt uitgelegd hoe je een MySQL database kan installeren. PureFTPd kan met de MySQL database overweg om gebruikers gegevens in te bewaren.

Maak hiervoor, met bijvoorbeeld het **gratis** [Navicat Lite](http://www.navicat.com/download.html), een nieuwe database aan, die alleen gebruikt gaat worden door PureFTPd.

### Eigen MySQL gebruiker

Eventueel kun je speciaal voor PureFTPd een eigen MySQL user aanmaken die alleen z'n eigen database mag beheren. Maar is voor deze opzet niet nodig. De reden waarom je dit zou doen is dat het wachtwoord waarmee PureFTPd inlogt op de MySQL database (en daar z'n gebruikers gegevens opvraagd en bewaard) gewoon als **plain-text** op de harde schijf van de Mac bewaard in de map `/etc/pure-ftp/pure-ftpd-mysql.conf`.

Het zou niet zo netjes zijn als een kwaadwillend persoon dit kan achterhalen en alle rechten op de MySQL databases kan uitvoeren.

### MySQL support aanzetten

In PureFTPd kun je via `Preferences` ... kies dan `Authentication` op de **Add** button klikken. Vul bij Server host in dat we de localhost willen gebruiken. Zodat PureFTPd inlogd op de lokale MySQL server die op de Mac al draait. Vul ook de naam van de database in die PureFTPd mag gebruiken samen met de username en password van deze database.

#### Let op!

Zorg ervoor dat als je een nieuwe / eigen gebruiker hebt aangemaakt, in MySQL, speciaal voor PureFTPd dat deze MySQL gebruiker lees (**select**) maar zeker ook schrijf (**create / alter / update**) rechten heeft in de desbetreffende MySQL database.

Bij het bewaren vraagd PureFTPd Manager om de deamon (achter service) te herstarten. Zodat gebruik gemaakt wordt van de nieuwe instellingen.