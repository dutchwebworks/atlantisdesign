---
title: "Subversion post commit update op test website"
description: ""
pubDate: 2005-07-31
---

# Subversion post commit update op test website

Dit is een vervolg op het artikel over Subversion versie beheer op Mac OS X. Dit artikel gaat er vanuit dat je Subversion hebt geinstalleerd en een beetje overweg kan met de working copies en de Apache webserver. Dit artikel zal hoogstwaarschijnlijk ook werken op Linux servers.

### Inspiratie

De werking van deze truuk heb ik niet zelf verzonnen. Het is geinspireerd op een praktijk ervaring met Microsoft Visual Source Safe's **Shadow directory** feature. De oplossing is geinspireerd op de website van [Netmojo.ca](http://www.netmojo.ca/blog/2007/05/03/subversion-webdav-osx/) met soortegelijke insteek.

## Het doel

Als voorbeeld nemen we een website. Deze website staat onder Subversion versie beheer. We willen een automatische update van de website naar een andere map, een test website. Deze map is bijvoorbeeld een **Apache virtual-host** (met webadres) waarnaar een kant kan kijken.

Je kunt deze opzet natuurlijk ook gebruiken op **niet-websites** maar op andere bestanden waarvan je altijd een copy (mirror) wilt hebben op een andere locatie. Bijvoorbeeld een backup server of een externe harde schijf, voor **backup**.

## Auto update een andere checkout working copy

Het komt vaak voor in webdesign / webdevelopment dat je op je eigen computer aan een website werkt, bijvoorbeeld met XHTML, Css en PHP scripts ... zodra je de benodigde aanpassingen aan de website hebt gemaakt wil je een **commit** actie uitvoeren (een nieuwe revisie toevoegen aan de Subversion repository). En er voor zorgen dat **diezelfde update** die je zojuist gemaakt hebt ook **elders direct geupdate** wordt.

### Hooks

Subversion heeft een aantal features, genaamd **hooks**. Met deze hooks kun je acties ondernemen als er bepaalde dingen gebeuren in de repository. In dit artikel gaan we het volgende opzetten:

### Twee checkout directories

**De eerste staat** op onze eigen Mac waarmee we werken en de website aanpassingen in maken: de **working copy**.

De **tweede checkout** van de repsository werken we eigenlijk niet aan. Dit is altijd de **head-revision** (laatste of jongste revisie) van de repository. Deze **checkout** staat in een **Apache virtual host** welke door bijvoorbeeld de klant te bezichten is via een test URL.

## De opzet

Zet de website eerst in een Subversion repository (zie artikel [Subversion versie beheer op Mac OS X](http://www.atlantisdesign.nl/artikel/subversion-versie-beheer-op-mac-os-x)) Maak een eigen working copy op je Mac.

### Apache Virtual-host

Maak een [Apache virtual host](http://www.atlantisdesign.nl/artikel/apache-virtual-hosts) aan in een andere map op je Mac. Deze fungeert als test site waar de klant naar kijkt. Hiervoor heb je wel een DNS server nodig zodat je bijvoorbeeld subdomeinen kunt aanmaken. Daar is dit artikel niet voor bedoelt.

Deze virtual-host opzet is natuurlijk niet perse nodig maar komt vaak voor in de praktijk.

## svn post commit

Blader met de Mac OS X Finder naar de map waar de Subversion repository bewaard wordt. Daarin staat een map genaamd **hooks**. Bestanden (Unix shell scripts of bijvoorbeeld perl / python programma's) die hierin geplaats worden, met een **specifieke naam**, worden uitgevoerd nadat er een corresponderende actie gebeurt in de repository.

Wat wel willen bereiken is dat als er een commit gemaakt wordt in de repository dat een script gestart wordt die een update uitvoert in een andere map (de test website wordt geupdate).

In deze map staan templates, voorbeelden, hoe je ze kunt gebruiken. Kopieer het volgende bestand.

	post-commit.tmpl

Hernoem het bestand naar ...

	post-commit

Open dit bestand daarna in bijvoorbeeld [TextWrangler](http://www.barebones.com/products/textwrangler/) (of [BBEdit](http://www.barebones.com/products/bbedit/)) of een andere tekst-editor. Verwijder alles wat hierin staat, dit is toch maar een voorbeeld.

### Unix bash shell script

Plaats vervolgens [dit stuk script](http://www.atlantisdesign.nl/public/svn_post_commit.txt) hierin. 

	#!/bin/sh
	
	REPOS="$1"
	REV="$2"
	
	# Export an update on working copy
	export LANG="en_US.UTF-8"
	umask 002
	cd /Library/WebServer/vhosts/vogelfotografie_demo/httpdocs
	/usr/local/bin/svn cleanup
	/usr/local/bin/svn -q --non-interactive update

Dit is een klein stukje **Unix bash shell scripting**. Het enige wat het doet is naar een bepaalde map gaan, dan een `svn cleanup` actie uitvoeren een `svn update` naar de laaste (head) revisie uitvoeren op de desbetreffende **working copy**.

## Verander het script

In het klein stukje script wordt verwezen naar een bepaalde map, namelijk:

	cd /Library/WebServer/vhosts/vogelfotografie_demo/httpdocs

Dit **pad** moet je natuurlijk veranderen naar het pad waar je de **test website** hebt staan, ofwel de **tweede checkout**. In dit voorbeeld een Apache virtual-host.

## Unix executable rechten geven

Het Unix bash script moet nu nog voorzien worden van de correcte uitvoer rechten (chmod). Zodat Subversion dit script ook mag uitvoeren op de Mac. Open de Terminal (/Applications/Utitilies/Terminal) en typ het volgende in.

Met spatie erachter:

	cd 

Sleep nu de **hooks** map (die in de repository map staat) **op het Terminal venster** en druk op enter. Dit is een snelle manier om met de Terminal naar een bepaalde map te gaan (in plaats van het `cd` commando).Typ nu het volgende in om het **post-commit** bestand Unix uitvoer rechten te geven.

	sudo chmod ugo+x post-commit

### Wat betekend dit hierboven allemaal?

Met `sudo` wil je (tijdelijke voor deze actie) administrator rechten op het Unix systeem, waardoor je dus een administrator password moet invullen. Met `chmod` wil je de rechten veranderen van de type gebruikers **u**sers, **g**roep en **o**thers, je wil execute rechten toevoegen (**+**) aan het bestand post-commit.

Dit betekend dus dat het bestand uitgevoerd mag worden. Met andere woorden het script mag gedraaid worden als Subversion dit start.

## Automatische update op de test website

Zodra er nu een `svn commit` gemaakt wordt (bijvoorbeeld met **gratis** Mac OS X programma's als [svnX](http://www.lachoseinteractive.net/en/community/subversion/svnx/) of [ZigVersion](http://zigversion.com/)) zal dit scirpt gestart worden. En een nieuwe update wordt gemaakt op de test website / map.