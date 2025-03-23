---
title: "Subversion beschikbaar maken via Apache"
description: ""
pubDate: 2007-11-31
---

Dit artikel is een uitbereiking op [Subversion versie beheer op Mac OS X](http://www.atlantisdesign.nl/artikel/subversion-versie-beheer-op-mac-os-x) en het artikel [WebDAV op Mac OS X Leopard](http://www.atlantisdesign.nl/artikel/webdav-op-mac-os-x-leopard).

We gaan er vanuit dat je met behulp van bovenstaande artikelen dat Apache draait en Subversion server ingericht is. Als voorbeeld project nemen we weer de **vogelfotografie** website van de fictieve persoon `kees`.

## Het doel

Maak de Subversion repository beschikbaar met behulp van WebDAV in Apache. Met een Apache username en password is het mogelijk om **via internet een checkout** te doen van bijvoorbeeld een website (deze wordt gedownload naar de remote computer). Hier kun je dan aan werken en de wijzigingen **terug sturen** naar de Subversion server als een nieuwe revisie.

## Apache 2.x configuratie backup maken

Voordat we dingen eventueel stuk maken gaan we eerst een backup maken van de Apache webserver configuratie. Open de **Terminal** applicatie (`/Applications/Utilities/Terminal`). We gaan eerst een backup maken van het Apache configuratie bestand.

#### Ga eerst naar de map waar het configuratie bestand staat:

    cd /etc/apache2

#### Vraag een lijst met bestanden op. Deze stap is niet perse nodig:

    ls -l

Hier zien we welk bestand we moeten hebben, namelijk `httpd.conf`. Typ het volgende commando in en geef een administrator wachtwoord op.

#### Backup maken

    sudo cp httpd.conf httpd.conf_backup

Vraag met `ls -l` opnieuw een lijst op en we zien dat er een backup bestand is gemaakt. Voor degene die met de Unix terminal overweg kunnen weten hoe ze met de commando's `rm` en `mv` de backup weer terug kunnen zetten.

## Unix bestanden bewerken met TextWrangler

Download eerst het **gratis** [TextWrangler](http://www.barebones.com/products/textwrangler/) of gebruik zijn commerciele broer [BBEdit](http://www.barebones.com/products/bbedit/). Hiermee kunnen we straks makkelijk aanpassingen maken aan Unix configuratie bestanden op onze Mac. TextWrangler of BBedit zijn echte Mac OS X text-editors. Hiermee kun je ook website met de hand maken, PHP programmeren en nog veel meer op het gebied van text-editten.

Start **TextWrangler** (of BBEdit) en laat het de **command line tools** installeren. We kunnen nu aan de slag. Als je gebruik maakt van **BBEdit** is het commando om bestanden te bewerken (vanuit de Ternimal) `bbedit` in plaats van `edit` welke **TextWrangler** gebruikt.

## Apache configuratie aanpassen

Open de **Terminal** (`/Applications/Utilities/Terminal`) en voer het volgende Unix commando in om in TextWrangler het Apache configuratie bestand te openen. Dit kun je ook gewoon via `File > Open hidden` ... in **TextWrangler** doen, als je weet waar het bestand staat.

    edit /etc/apache2/httpd.conf

Ga met `Apple'tje + j` naar **regel 467**. Daar staat de volgende regel. Deze moeten we un-commenten. Haal het haakje (**#**) weg voor deze regel.

#### WebDAV aanzetten

    Include /private/etc/apache2/extra/httpd-dav.conf

Nu zal WebDAV aangezet worden bij de volgende herstart van de Apache webserver. Open vervolgens dit nieuwe configuratie bestand. Daarin gaan we aangeven **welke Subversion repository** beschikbaar wordt via WebDAV en Apache. Dit kan in TextWrangler of met een Terminal commando.

    edit /private/etc/apache2/extra/httpd-dav.conf

Dit is een basis configuratie bestand waar ook een voorbeeld in staat van een Subversion repository.

### Subversion voorbeeld configuratie

Vervang de inhoud van dit bestand met het volgende [voorbeeld configuratie bestand](http://www.atlantisdesign.nl/public/apache_svn_webdav.txt):

    BrowserMatch "Microsoft Data Access Internet Publishing Provider" redirect-carefully
    BrowserMatch "MS FrontPage" redirect-carefully
    BrowserMatch "^WebDrive" redirect-carefully
    BrowserMatch "^WebDAVFS/1.[0123]" redirect-carefully
    BrowserMatch "^gnome-vfs/1.0" redirect-carefully
    BrowserMatch "^XML Spy" redirect-carefully
    BrowserMatch "^Dreamweaver-WebDAV-SCM1" redirect-carefully

    ########################################
    ## Default
    ########################################

    # Webdav and Subversion modules
    LoadModule dav_svn_module		libexec/apache2/mod_dav_svn.so
    LoadModule authz_svn_module		libexec/apache2/mod_authz_svn.so

    ########################################
    ## Websites
    ########################################

    # Volelfotografie svn repository
    <Location /svn/vogelfotografie>
    	DAV svn
    	SVNPath /Library/Subversion/Repository/vogelfotografie

    	# Set auto mime-type conversion (for simple HTML mime-type headers)
    	ModMimeUsePathInfo on

    	# Basic Apache realm authentication
    	AuthType Basic
    	AuthName "Vogelfotografie Subversion repository"
    	AuthUserFile /etc/apache2/passwords/.htpasswd

    	# only authenticated users may access the repository
    	Require valid-user
    </Location>

### Vogelfotografie website van Kees

Als voorbeeld nemen we weer de **vogelfotografie** website van **Kees**. In het bestandje staan de benodigde configuratie regels om webDAV aan te zetten en tevens een voorbeeld van een Subversion repository die beschikbaar wordt gesteld. Deze staat op de volgende locatie:

    /Library/Subversion/Repository/vogelfotografie

## Apache password bestand aanmaken

In het stukje `Location` wordt een autheticatie systeem opgenomen, een zogenaamde **realm**. Zodra we straks bijvoorbeeld op een Windows XP computer een checkout gaan maken, zal Apache eerst een om **gebruikersnaam en wachtwoord** vragen alvorens de vogelfotografie repository beschikbaar wordt gesteld.

Maak de volgende map aan als deze nog niet bestaat.

    mkdir /etc/apache2/passwords/

Als je nog geen password bestand heb gemaakt voeren we de volgende Unix code uit in de Termminal. Als er al een password bestand staat kun je **-c** weg laten. Als er al een user **kees** is zal het wachtwoord **overschreven** worden.

#### Deze stap is niet perse nodig als je al een password bestand hebt staan.

    htpasswd -c /etc/apache2/passwords/.htpasswd kees

Het **htpasswd** programma zal voor de gebruiker `kees` om een wachtwoord aanmaak vragen.

##Apache configuratie testen herstarten

In de Terminal gaan we de Apache configuratie eerst testen om te kijken of we geen fouten hebben gemaakt.

#### Apache configuratie op syntax controleren

    sudo httpd -t

Als er geen fouten in beeld komen kunnen we de Apache server **herstarten**.

    apachectl graceful

## Testen op eigen Mac

Nu is de vogelfotografie repository beschikbaar via het IP nummer van onze Mac. Dit kunnen we even testen op onze eigen Mac.

Open een webbrowser, bijvoorbeeld Safari en typ onderstaand adres hierin. Er zal een inlog scherm komen (de **realm**), vul de gegevens in van de zojuist aangemaakte gebruiker **kees** (Apache htpasswd van daarnet). Het IP nummer hieronder betekend eigenlijk '**de computer zelf**'.

    http://127.0.0.1/svn/vogelfotografie

Als het goed is verschijnt er een lijstje in beeld, met een revisie nummer, van de Subversion repository. Onderin de webbrowser staat heel fancy dat het Powered by Subversion is. **Het werkt!!** Je kun hier doorheen bladeren en zelfs bestanden downloaden. Een gewone standaard (.html) website is zelfs op deze manier ook direct vanuit Subversion te bekijken als een echte website.

## Testen vanaf een Windows computer met checkout

We kunnen nu een **checkout** doen op de Windows computer van Kees z'n website. We willen dus de website downloaden vanuit de Subversion repository die op de Mac staat.

Achterhaal eerst het IP nummer (intern of extern) van de Mac. Kijk in de `Apple'tje > System Preferences > Network` wat het **IP nummer** is van de Mac.

### TortoiseSVN plugin voor de Windows Verkenner

Voor Windows bestaat er een geweldige **gratis** plugin voor het werken met Subversion repositories, genaamd [TortoiseSVN](http://tortoisesvn.tigris.org/). Download dit programma en installeer het op de Windows computer.

Via de rechtermuistoets zijn nu de meest gangbare opties met het werken voor Subversion beschikbaar.

#### Mac versie

Voor de Mac OS X Finder is er een soortgelijke plugin te downloaden, genaamd [SCplugin](http://scplugin.tigris.org/). Deze werkt opzich wel maar is nog erg buggy en verkeerd al heel lang in beta-fase.

### Checkout maken

Maak bijvoorbeeld op de Windows desktop een lege map aan, genaamd **vogelfotografie**. Hierin willen we een checkout maken van Kees z'n website. Open deze map en klik met de **rechtermuistoets**, kies voor een **checkout**.

Vul hier het IP nummer in van de Mac met de extra paden erachter. Vervang onderstaand IP nummer door het goede IP nummer van de Mac.

    http://192.168.0.12/svn/vogelfotografie

Weer komt het inlog scherm in beeld. Voorzie dit scherm met de gebruikersnaam `kees` en het wachtwoord. In de Windows verkenner komen nu alle bestanden van Kees z'n vogelfotografie website te staan. Compleet met mooie icoontjes waaraan je kan zien of Subversion bestanden zijn aangepast.

### Het werkt

Geweldig!! Nu kun je op de Windows computer wijzigingen maken en deze via de rechtermuistoets op **commit** klikken om de wijzigingen (met username en password) weer terug te sturen naar de vogelfotografie repository op de Mac.

## SVN Update ophalen

Als Kees achter de Mac werkt en een update wil ophalen van de vogelfotografie website moet hij het volgende doen. Open [svnX](http://www.lachoseinteractive.net/en/community/subversion/svnx/features/) (zie artikelen die bovenaan genoemd worden), dubbeklik op de **working copy** naam **vogelfotografie** die op de Mac staat.

Klik bovenaan in het working copy window op de groene button voor een **SVN Update**. Vanuit de repository wordt nu de laatste versie opgehaald (welke dus op de Windows computer was gewijzigd) en wordt vermengt / ge-update met de versie die op de Mac staat.

### Meerdere repositories beschikbaar stellen

Hiervoor **kopieer** je het stuk `Location` van de vogelfotografie website in het configuratie bestand. Pas de paden aan naar de repositories en maak eventueel nieuwe (andere) gebruikers aan met het **htpasswd** programma in de Terminal.

Vergeet vervolgens niet de Apache server te herstarten met `apachectl graceful`.
