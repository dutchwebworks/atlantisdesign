---
title: "Apache Protect"
description: "Als je de Mac gebruikt voor websites kun je met dit programma'tje makkelijk mappen voorzien van een zelf gemaakte username en wachtwoord."
pubDate: 2006-01-31
---

# Apache Protect

Met het kleine programma'tje [Apache Protect](http://homepage.mac.com/onar/apacheprotect/) kun je bepaalde mappen voorzien van een zogenaamde **Realm Authentication** doormiddel van .htaccess bestanden. In een internet browser zie je een inlogscherm verschijnen, niet in HTML gemaakt, maar de website vraagt je om een username en password. Het kan goed gebruikt worden om bepaalde mappen op je Mac webserver te beveiligen.

Dit werkt ook op elk ander platform (Windows en Linux/Unix) dat met Apache werkt. Echter is dit een programma'tje alleen voor de Mac waar je nu achter zit. Enige kennis van Apache en de Unix terminal is wel vereist. Maar stap voor stap wordt hier uitgelegd wat je moet veranderen. In princiepe heb je dit programma'tje niet nodig als je weet hoe Apache en .htaccess werkt. Maar wij werken op een Mac en daar kan het makkelijker mee natuurlijk.

Dit werk alleen in een internet browser als men bladerd naar deze map of via een website deze op vraagt. Het werkt dus niet in de Finder.

## Apache .htaccess

Door middel van Apache .`htaccess` bestanden kunnen mappen worden voorzien van een username en wachtwoord. Het programma maakt deze onzichtbare Unix bestanden aan en plaats deze in de map die je wilt beveiligen. Omdat het bestand met een punt begint zul je deze niet (standaard) zien in de Finder of via de internet browser. In dit bestand staat wat de naam is van de 'Realm' ofwel de naam van de beveiligde map en welke username(s) bevoegd is om in te loggen. Het wachtwoord wordt gecodeerd ergens anders opgeslagen. Je kunt dus zelf een gebruikersnaam en wachtwoord aanmaken. Dit staat helemaal los van de Mac systeem accounts.

## Hoe pas ik dat allemaal toe?

Open het programma'tje en het zal vragen of het iets mag veranderen in de standaard configuratie van de Apache 1.x webserver die al op de Mac aanwezig is. Vul je administrator wachtwoord in en wacht totdat het programma'tje klaar is en herstart de Apache webserver door deze uit en weer aan te vinken in **Personal Web Sharing** in de Apple System Preferences en dan Sharing.

Het is één kleine wijziging die het moet maken in de Unix configuratie van Apache. Voor geënteresseerde is het de

	AllowOverride

directive welke wordt voorzien van de 'AuthConfig' parameter dat in het bestand

	/etc/httpd/httpd.conf

staat. Hierdoor zal Apache naar de .htaccess bestanden zoeken. Enige vertraging in de webserver zal wel optreden. Maar of je daar echt wat van merkt op je eigen Mac?

De setup is klaar en we kunnen aan de slag met het programma'tje.

## UserFile aanmaken

Klik op het tabblad **Configure user file**. Klik op `New ...` en blader naar de map `/Library/Webserver`. Bewaar hier het bestand als `httpd_users.passwd`. Dit is als voorbeeld gebruikt welke werkt. Als je namelijk, op de Unix manier, de password bestanden in een Unix map bewaard (bijvoorbeeld `/etc/httpd/`) dan gaat het programam'je over z'n nek. Bewaar het bestand natuurlijk nooit in de `/Library/Webserver/Documents/` of in je eigen Sites map!!

### Gebruikersnaam en wachtwoord aanmaken

Onderaan het scherm maak je een username en password aan. Bovenin zal een lijst verschijnen met gecodeerde wachtwoorden.

### Map beveiligen

Ga nu terug naar het tabblad **Protect directory**. Selecteer nu een map die je wilt voorzien van ??n van de usernames die je zojuist hebt aangemaakt. Let op! Deze map moet natuurlijk wel te bereiken zijn via de Apache webserver. Dit kan dus een map zijn in je **eigen Sites** map of een map in `/Library/Webserver/Documents`. Bij Name geef je aan wat de gebruiker via de internet browser ziet als zijnde naam van de Realm of beveiligde map.

Maak bijvoorbeeld in je Sites map een map aan '**beveiligd**' en kies deze als map die u wilt beveiligen. Zet hier wat test bestanden in als een HTML voorbeeld of een plaatje.

Selecteer bij `Userfile` hetzelfde bestand als dat je zojuist hebt aangemaakt bij punt 1 (Configure user file tabblad). In ons geval `/Library/Webserver/httpd_users.passwd`.

Klik aan welke gebruikers er kunnen inloggen om deze map te bekijken. Klik vervolgens op Save.

##Testen

Open bijvoorbeeld Safari en blader naar de map die je beveiligd hebt. In bovestaand voorbeeld is dat `http://localhost/<korte_gebruikersnaam>/beveiligd/`. Nu verschijnt er een inlogscherm waarbij je de zojuist aangemaakte gebruikers gegevens moet invullen om de map te bekijken.

## Het werkt niet?

Als dit inlog scherm niet verschijnt moet je ??n ding even nakijken of veranderen in de Unix terminal. Zoals op het [MacFreak forum](http://macfreak.nl/cgi-bin/forums/topic.cgi?forum=8&topic=1814) al werd vermeld heeft het Apache Protect programma'tje een klein schoonheids foutje. Open de terminal en typ onderstaande in. Vervang **<korte_gebruikersnaam>** door de naam van uw thuis map.

sudo pico /etc/httpd/users/<korte_gebruikersnaam>.conf

Het bestand ziet er als volgt uit. Vervang AllowOverride **None** door **AllowOverrride** AuthConfig. Hierdoor laat je toe dat alle mappen in je thuis map, die voorzien zijn van zo'n .htaccess bestand, de configuratie kunnen veranderen van de Apache webserver. Druk op `ctrl+x` en druk op `y`. Sluit de terminal af en probeer het opnieuw in Safari.

	<Directory "/Users/<korte_gebruikersnaam>/Sites/">
		Options Indexes MultiViews
		AllowOverride AuthConfig
		Order allow,deny
		Allow from all
	</Directory>

## Hoe verwijder ik zo'n beveiliging?

Zoals hierboven al aangegeven kun je de .htaccess bestanden niet standaard zien met de Finder. Het is een kwestie van dit .htaccess bestand verwijderen uit de beveiligde map en de beveiliging is opgeheven.

Open wederom de terminal en blader naar de beveiligde map. Het handigste om daar te komen is het volgende truukje. Typ in: `cd` en een spatie. Sleep nu de beveiligde map (met het .htaccess bestand) op de terminal en druk op **enter**. We zitten nu in de map waar het onzichtbare `.htaccess` bestand staat. Typ nu in `ls -Fial` wat zo ongeveer betekend als: laat mij een lijst zien van alle bestanden, ook de onzichtbare bestanden. Hier zie je het .htaccess bestand aan het begin van de lijst staan.

### Let op wat je nu gaat doen!

Om het te verwijderen typ je in sudo `rm .htaccess` en druk vervolgens op **enter**. Geef het admin wachtwoord op en het bestand is verwijderd. Controleer dit nogmaals door

	ls -Fial

in te typen. **Let op!** Het bestand zal direct verwijderd worden door Unix in tegenstelling tot de Finder die het eerst in de prullenbak zet. Heel goed opletten wat je doet met het Unix rm commando want zonder restricties kun je heel veel schade aanrichten als je het verkeerd in typt.

## Nadeel van het programma'tje

Als je het programma'tje afsluit en later weer eens wilt gebruiken moet je de eerste handelingen weer overnieuw doen. Het schrijft natuurlijk Unix bestanden weg en doet er verder niks mee. Als je het programma'tje weer op start moet je de bestanden weer aanwijzen waar de wachtwoorden in staan. Immers kun je vele wachtwoord bestanden aanmaken dus het is niet echt een gemis als je weet hoe dat .htaccess een beetje werkt.

Op het [MacFreak forum](http://macfreak.nl/cgi-bin/forums/topic.cgi?forum=8&topic=1814) is nog meer te lezen wat de gebreken zijn aan het programam'tje met diverse meningen van Mac gebruikers.

Meer informatie over [.htaccess](http://httpd.apache.org/docs/1.3/howto/htaccess.html) is natuurlijk te vinden op de Apache website.

