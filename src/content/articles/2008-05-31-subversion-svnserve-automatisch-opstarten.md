---
title: "Subversion svnserve automatisch opstarten"
description: "Subversion heeft ook een eigen svnserve deamon zodat het svn:// protocol gebruikt kan worden. Met een launchd plist (XML) bestand wordt bij het opstarten van de Mac automatisch de svnserve daemon gestart."
pubDate: 2008-05-31
---

# Subversion svnserve automatisch opstarten

Dit artikel gaat ervan uit dat [Subversion al op de Mac draait](http://www.atlantisdesign.nl/artikel/subversion-versie-beheer-op-mac-os-x). Plus dat er een vaste plek is waar de Subversion Repositories staan. In dit voorbeeld staan de repositories op de volgende locatie:

### Subversion repository pool

	/Library/Subversion/Repository

Natuurlijk kun is deze plek niet verplicht.

## SVN repositories benaderen

Er zijn een aantal manier om een SVN repository te benaderen. Via het file-system zelf, als de repository op dezelfde computer staat als waar de working-copy staat. Dit gaat dan bijvoorbeeld via:

#### Local file-system

Een SVN checkout ziet er dan als volgt uit:

	svn checkout file:///Library/Subversion/Repository/mijn-project/trunk mijn-project/

Op deze manier kun je heel snel verbinding maken met de lokale repository.

#### Apache met mod_dav en mod_svn

Apache ondersteunt webDAV en hiermee kun je ook een Subversion repositories beschikbaar maken via het HTTP protocol (port 80):

	svn checkout http://ip-nummer-mac/svn/mijn-project/trunk mijn-project/

Deze manier is wat langzamer omdat het eerst via Apache verbinding moet maken. Het voordeel is wel dat je met Apache de toegang tot de repositories kun beperken met een **usernames en passwords.**

Voor deze opzet is een apart artikel geschreven: [Subversion beschikbaar maken via Apache](http://www.atlantisdesign.nl/artikel/subversion-beschikbaar-maken-via-apache).

#### Via Subversions eigen `svn://` protocol

Als Subversion is geinstalleerd wordt ook het **svnserve** Unix programma mee geinstalleerd.

Dit is een lichtgewicht achtergrond server / daemon waarmee je direct met een SVN repository kan communiceren. Het draait op z'n eigen protocol, namelijk `svn://`. Een svn checkout zou er dan ongeveer zo uit kunnen zien:

	svn checkout svn://ip-nummer-mac/mijn-project/trunk mijn-project/

Dit is een snellere manier dan met Apache. Want je maakt direct verbinding met de repository. Bovendien kun je op deze manier ook usernames en passwords toekennen aan bepaalde svn repositories.

#### Via snvserve en ssh

Er is nog een extra veiligheids techniek die toegepast kan worden op bovenstaande `svn://` manier. Dat is svnserve toeganklijke maken via een SSH (secure shell) tunnel. Lees hiervoor de [gratis documentatie](http://svnbook.red-bean.com/) van Subversion. In de [PDF versie](http://svnbook.red-bean.com/en/1.4/svn-book.pdf) vanaf **pagina 171**.

##Firewall en port nummer

Het voordeel van de **Apache** of **svnserve** manier is dat je de SVN repositories beschikbaar kan maken via het netwerk. Dus ook aan Linux en Windows gebruikers.

Uiteraard heeft dit ook weer te maken met de firewall en beveiliging op de Mac. De port nummer die svnserve gebruikt is **port nummer 3690**. Met het shareware programma [DoorstopX](http://opendoor.com/doorstop/) kun je makkelijk de ingebouwde Unix [ipfw](http://en.wikipedia.org/wiki/Ipfirewall) firewall configureren.

## Configueren van svnserve

In dit artikel gaan we svnserve configureren en automatisch laten opstarten als de Mac opstart. Daarbij geven we aan welke hoofdmap (parent directory) we willen serveren via `svn://`. Dit heeft als bijkomend voordeel dat de URL's (paden) korter worden en makkelijker te typen en onthouden zijn.

### Handmatig svnserve opstarten

Open de Terminal en typ onderstaande in. Vervang het laatste stuk met het pad waar de SVN repositories staan:

	sudo svnserve -d -r /Library/Subversion/Repository

Met **-d** geef je aan dat je **svnserve** als een Unix daemon (achtergrond programma / proces) wilt draaien. Met bovenstaand pad geef je met **-r** aan waar de svn repository **parent-directory** staat. De repositories staan dus een map verder, bijvoorbeeld:

	/Library/Subversion/Repository/mijn-project

Op deze manier zijn alle repositories die achter -r vermeld staan bereikbaar via het eigen SVN protocol:

	svn://ip-nummer-mac/mijn-project

	svn://ip-nummer-mac/mijn-tweede-project

Dit is aanzienlijk korter.

### hosts file

Met het [hosts file](http://en.wikipedia.org/wiki/Hosts_file) (Windows, Mac en Linux) kun je ook makkelijk zelf een soort **nepdomein** aanmaken waardoor bovenstaande er zo uit kan zien:

	svn://mijn-mac.local/mijn-project

In het hosts bestand wordt het IP nummer van de Mac ge-mapped aan de naam mijn-mac.local. Hier is het artikel te klein voor dus zoek op internet naar uitleg over het hosts bestand.

In het artikel Apache mod_vhost_alias virtual hosts en Apache virtual hosts wordt dit concept ook uitgelegd.

## launchd

Natuurlijk is het een beetje vermoeiend en omslachtig om elke keer met de hand s**vnserve met parameter** te starten. Uiteraard heeft de Mac ook een soort manager die automatisch achtergrond programma's en Unix processen opstart, genaamd: [launchd](http://en.wikipedia.org/wiki/Launchd).

De configuratie bestanden, die launchd inleest, zijn allemaal in XML formaat en bevatten Unix commando's die bijvoorbeeld door de Unix root user uitgevoerd worden. Hiermee wordt bijvoorbeeld de Apache webserver, de MySQL database en vele andere Apple Mac gerelateerde achtergrond processen opgestart.

#### Lingon

Met het **gratis** programma [Lingon](http://lingon.sourceforge.net/) kunnen we ook zelf zo'n XML plist opstart bestand maken. Daar gaan we verder niet op in.

Eigenlijk is alles al aanwezig nadat [Subversion is geinstalleerd](http://www.atlantisdesign.nl/artikel/subversion-versie-beheer-op-mac-os-x). Het enige dat nodig is is een [plist bestand](http://en.wikipedia.org/wiki/Property_list) (property list, welke in XML formaat is) om aan te geven welke commando's geladen moet worden tijdens het opstarten van de Mac.

### Voorbeeld plist bestand

Download het voorbeeld [org.tigris.subversion.svnserve.plist](http://www.atlantisdesign.nl/public/svnserve_launchd_plist.txt) bestand:

	<?xml version="1.0" encoding="UTF-8"?>
	<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
	<plist version="1.0">
	<dict>
		<key>KeepAlive</key>
		<false/>
		<key>Label</key>
		<string>org.tigris.subversion.plist</string>
		<key>ProgramArguments</key>
		<array>
			<string>/usr/local/bin/svnserve</string>
			<string>-d</string>
			<string>-r</string>
			<string>/Library/Subversion/Repository</string>
		</array>
		<key>RunAtLoad</key>
		<true/>
	</dict>
	</plist>

 &hellip; en bewaar deze op de volgende locatie met de juiste naam:

	/Library/LaunchDaemons/org.tigris.subversion.svnserve.plist

In dit plist bestand staat in feite wat we net zelf hebben ingetyped in de Terminal. Met het **Terminal** programma (`/Applications/Utilities/Terminal`) geven de juiste rechten aan dit bestand:

	sudo chown root:wheel /Library/LaunchDaemons/org.tigris.subversion.svnserve.plist

	sudo chmod 644 /Library/LaunchDaemons/org.tigris.subversion.svnserve.plist

### Herstarten

Nu staat het opstart bestand op de juist plek. Met een herstart kunnen we zien of de Mac het nu zelf heeft opgestart. Met het Apple **Activity Monitor** programma (`/Applications/Utilities/Activity Monitor`) kunnen we zien of svnserve ook daadwerkelijk automatisch is opgestart. Zoek rechtsbovenin naar **svnserve**.

#### Unix commando

Dit kun je ook achterhalen met een Unix commando:

	ps -ax | grep svnserve

Als er twee regels in beeld komen (1 van grep en een andere) betekend dat het proces draaid.

## Handmatig opstarten launchd plist bestanden

Het plist xml bestand kunnen we ook handmatig in de Terminal in laden en laten starten. Al heb ik deze manier nog niet werkend gezien.

#### Inladen plist bestand in launchd

Let op! Dit is 1 lange regel zonder afbrekingen.

	sudo launchctl load /Library/LaunchDaemons/org.tigris.subversion.svnserve.plist

#### Handmatig starten van svnserve via launchd

Ook dit is 1 lange regel zonder afbrekingen.

`sudo launchctl start /Library/LaunchDaemons/org.tigris.subversion.svnserve.plist`

## User management

Met svnserve draaiend en de repositories bereikbaar via `snv://` kunnen we zelf users gaan aanmaken die (beperkte) toegang krijgen tot de SVN repositories.

Lees hiervoor de gratis online (of download de [PDF versie](http://svnbook.red-bean.com/en/1.4/svn-book.pdf), vanaf **pagina 169**, hoofdstuk **Built-in authentication and authorization**) [documentatie](http://svnbook.red-bean.com/) van Subversion.