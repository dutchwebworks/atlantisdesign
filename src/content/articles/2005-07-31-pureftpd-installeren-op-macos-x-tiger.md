---
title: "PureFTPd installeren op MacOS X Tiger"
description: "Het opzetten van een goede FTP server hoeft niet moeilijk te zijn. Apple heeft een FTP server in alle versies van Mac OS X ingebouwd."
pubDate: 2005-07-31
---

FTP staat voor **File Transport Protocol**. Meer informatie over FTP kunt u ook lezen op [Wikipedia: FTP](http://nl.wikipedia.org/wiki/FTP). Het is een best wel oude manier waarmee Unix machines vroeger bestanden konden uitwisselen over het internet. Vandaag de dag wordt het nog veelvuldig gebruikt om websites en andere bestanden op internet te zetten of om te versturen naar een publieke webserver.

Dit artikelen is getest op Mac OS X Tiger client versie. Niet de server versie van Mac OS X. Als het goed is werkt dit ook op vorige versies van Mac OS X.

Apple heeft een ingebouwde FTP server al inbegrepen in alle versies van Mac OS X. Maar wat is er nu mis aan deze FTP server?

### Voordelen

Via het `Appel'tje > System Preferences > Sharing` en dan het vinkje **FTP Acces** kunnen we de ingebouwde FTP server van Apple activeren. Met een FTP programma als [Fetch](http://fetchsoftworks.com/) of (mijn voorkeur) Transmit, kunnen we een verbinding maken met een FTP server (of die van uw eigen Mac).

Heel eenvoudig gezien kunnen personen met een account op uw eigen Mac verbinding maken via FTP en hun eigen bestanden up- en downloaden. Er komt verder weinig bij kijken. Snel en simpel. Als u inlogd kunt u op de gehele Mac bladeren alsof u achter zit.

### Nadelen

Als u een klein beetje bekend bent met het FTP protocol, of wel eens gespeeld heeft met een FTP programma, kunt u tot de ontdekking komen dat de ingebouwde FTP server van Apple een flink **beveligings gat open heeft staan**. Of u kunt het een 'bug' noemen. Mocht u uw Mac gaan inzetten als webserver waarop onbekende personen bestanden kunnen up en downloaden moet u vooral doorlezen!

Het blijkt dat de FTP server die Apple gebruikt een steekje heeft laten vallen. Dat kan een voordeel zijn maar meestal is dat een nadeel. Als u inlogd op de Mac FTP server dan kunt u uit de map klimmen waarop u inlogd. Zogenaamd naar een 'parent' map gaan ofwel naar boven klimmen in de directory structuur van uw Mac. Op deze manier kan men uw hele Mac bekijken zonder restricties. Men kan zelfs bestanden weggooien! Niet echt handig.

## PureFTPd downloaden

We gaan de ingebouwde FTP server van Apple vervangen door een flexiblere versie met meer mogelijkheden. Daarnaast kunt u virturele gebruikers aanmaken en die andere mappen toewijzen.

Download [PureFTPd Manager](http://jeanmatthieu.free.fr/pureftpd/) van de franse website van Jean Matthieu. Dit is een installer package waarmee de FTP server vervangen zal worden door de Open-Source [PureFTPd](http://www.pureftpd.org/) server. Welke veel gebruikt wordt in de Linux wereld. Jean Matthieu heeft een progamma'tje gemaakt waarmee je de FTP server en diens gebruikers mee kunt beheren. Het bestaat eigenlijk uit twee delen. Het installeren en vervangen van de huidige Apple FTP server en het programma waarmee u op een visuele manier makkelijk de gebruikers kunt beheren.

## Installeren

Wat u **absoluut** eerst moeten doen is het **uitzetten** van Apple's ingebouwde FTP server. Anders gaat het intalleren en in gebruik nemen van de nieuwe FTP server helemaal fout. Via `Appel'tje > System Preferences > Sharing` vinken we uit: **FTP Acces**.

Installeer het programma door de package (.pkg) te openen in de disk-image. Start daarna vanuit de Application map het programma **PureFTPd Manager**. Er worden eerst een aantal stappen gevraagd voordat de FTP server goed ge?nstalleerd kan worden.

### Stap 1 - Introduction

Verteld wat er allemaal gaat gebeuren: kan je overslaan natuurlijk, druk op 'Continue'

### Stap 2 - Anonymous access

Hier kun je aangeven of je ?berhaupt gebruik wil maken van Anonymous (ofwel zonder wachtwoord) kan inloggen op je Mac. Dit wordt wel eens gebruikt door publieke FTP servers waar iedereen zomaar kan inloggen met z'n email adres en zonder wachtwoord. Dit zou ik uitzetten, straks, in de voorkeuren van het programma.

Eigenlijk kun je hier ook gewoon op 'Continue' klikken want alles staat al goed.

### Stap 3 - Virtual users

Dit is belangrijk. Hier gaat het programma in Mac OS X zogenaamde Virtual Users aanmaken. Er wordt op de Mac ??n user aangemaakt: 'ftpvirtual' met een daarbij behorende groep. Doordat de UID (user id) en de GID (groep id) boven de het nummer 1000 (geloof ik) liggen komt deze user ook niet voor in het inlogscherm waar je moet inloggen als je je Mac aanzet. Er is dus een verschil in Unix systeem users en echte Mac users die kunnen inloggen.

Hier hetzelfde, alles staat al goed dus klik op 'Continue'.

### Stap 4 - Server logging

Dit kan wel handig zijn om alles aan te vinken. Zodat je in het programma kunt zien wat er allemaal gebeurt met je FTP server: wie er inlogd en welke bestanden er heen en weer gestuurd worden in de achtergrond ofwel Unix laag van je Mac.

### Stap 5 - System settings

De eerste vink is natuurlijk het belangrijkste. Hiermee bepaal je of wel of niet wil toe staan dat men mag inloggen. Maar dit is in feite hetzelfde als het vinkje uitzetten bij: `Apple'tje > System Preferences > Sharing > FTP Access`. De tweede vink zou ik zeker aanzetten. Dan start de FTP server mee als je je Mac aan zet.

Bij de twee invul velden kun je aangeven of je alle 'mappen', die standaard door het programma worden aangemaakt, wilt veranderen. Het is dus hier mogelijk om de 'home directories' (als men inlogd met FTP en bestanden upload) op een andere locatie te laten zetten. Met een beetje soep fantasie kun je dus FTP users bestanden laten uploaden naar een externe schijf!

De standaard locaties staan al goed. Immers staat je eigen thuis map (home directory) ook in de map `/Users`. Dus de FTP gebruikers komen op de goede locatie, binnen Mac OS X, namelijk een map 'ftp' en dan VirtualUsers. Dit is de standaard locatie. Maar strakt binnen het programma kun je dat nog wijzigen. Dit zijn alleen standaard instellingen.

Wederom, druk gewoon op 'Continue'.

### Stap 6 - Conclusion

Hier wordt nog even opgesomd wat er straks, in de Unix laag met al die moeilijke codes enzo, wordt uitgevoerd. Klik op de knop 'Configure' en het programma gaat het Unix FTP programma PureFTPd installeren. De PureFTPd Manager is dus het Mac programma'tje om met de configuratie bestanden van deze Unix FTP te communiceren. Waarschijnlijk moet je het programma opnieuw opstarten.

De installatie is nu voltooid. Je kunt nu met bijvoorbeeld Transmit of Fetch (of vanaf een Windows/Linux computer) inloggen op je eigen Mac. Gebruik je Mac account inlog gegevens en vul bij 'host' in: `localhost`. Dat wil zeggen 'de computer waar ik nu achter zit. Als je vanaf een andere computer inlogd moet je natuurlijk bij 'host' het IP nummer invullen van je Mac.

### Anonymous access uitzetten

Open de voorkeuren van het programma en kies dan voor 'Anonymous'. Vink aan 'Disable anonymous access', zodat mensen niet kunnen inloggen zonder gebruikersnaam EN wachtwoord.

Doordat er nu Virtual Users zijn aangemaakt kun je alle gebruikers aanmaken via het PureFTPd Manager programma zelf. Hierdoor '**vervuil**' je je eigen Mac niet met echt 'Mac users' die ook in het lijstje komen van de Accounts in de Mac OS X system preferences. Virtual Users kunnen alleen inloggen en gebruik maken van een 'map' op je Mac.

## Eerste test

Nu alles gereed is kunt u met een FTP programma uw nieuwe, verbeterde, FTP server gaan testen. Open bijvoorbeeld Fetch of Transmit, of probeer het vanaf een Windows of Linux computer, en maak een verbinding met uw Mac. Gebruik uw bestaande Mac account gegevens voor deze test.

Op **twee dingen** moeten we hier letten.

* Gebruikt de Mac nu PureFTPd als FTP server?
* Kunnen we niet meer uit onze home map klimmen?

Zoek in het FTP programma, waarmee u verbinding heeft gemaakt met uw Mac, naar de '**console**'. Hier kunt u zien welke commando's het FTP programma naar de Mac FTP server stuurt. Hierin moet de naam van het FTP server programma vermeld staan. Als het goed is gebruikt onze Mac nu '**PureFTPd**'. Kijk of u niet meer uit uw home map kunt klimmen (een map hoger kunt komen). Dit is een optie die u kunt instellen voor elke virturele gebruiker van de FTP server.

## FTP gebruikers toevoegen

Op uw Mac zijn zogenaamde **human-users** aanwezig maar ook **non-human-users**. De gebruikers die u kunt zien in het Accounts paneel in de Mac System Preferences zijn de human users. Deze hebben een bestaande gebruikersmap en kunnen daadwerkelijk inloggen op uw Mac in het Apple inlogscherm. De non-human users zijn systeem gebruikers die de Unix laag van onze Mac gebruikt voor het draaien van Unix programma's zoals de Apache webserver, de Postfix mail server, Cron jobs en nog meer Unix gerelateerde programma's.

Als u meerdere gebruikers wilt toevoegen, voor FTP toegang, kunt u dat doen door echte gebruikers aan te maken in het Accounts paneel. Ofwel 'human-users'. Hierdoor krijgen deze gebruikers een home map aangewezen en allerlei extra mappen die deze gebruikers eigenlijk niet gebruiken. Het kan namelijk makkelijker door virturele gebruikers aan te maken welke alleen gebruik maken van de FTP functionaliteit van uw Mac. Zo houdt u uw Mac systeem schoon en simpel.

### Virtual Users

Open PureFTPd Manager en klik op **User Manager**. Klik bovenaan op '**New**' en vul de gegevens in voor deze gebruiker. Dit is een virturele gebruiker waarvan u de complete controle heeft. Deze gebruiker kan niet inloggen achter uw eigen Mac met het Apple inlogscherm. Kies een korte login naam (zonder spaties) en een wachtwoord.

#### Homedirectory

De homedirectory geeft aan welke map op uw Mac aan deze gebruiker wordt toegewezen zodra deze inlogd. Vink aan: '**Restrict user to acces to his home directory**' waardoor de gebruiker niet uit z'n home map mag klimmen (ofwel een map hoger mag gaan). Dit is waarom we Apple's FTP server vervangen door PureFTPd en gebruik maken van PureFTPd Manager. Tevens kunt u meer opties aangeven per gebruiker zoals u al kunt zien.

U kunt de virturele gebruiker 'mappen' naar een bestaande gebruiker op uw eigen Mac. Een netwerk beheerder kan u hierover meer vertellen. Dit heeft te maken met user-management op een Unix systeem.

## MySQL autorisatie

Een leuke aanvulling op het gebruik maken van PureFTPd Manager is de mogelijkheid om de virturele gebruikers te laten opslaan in een MySQL database. Waardoor het beheren van duizenden gebruikers nog eenvoudiger wordt.

Als u een MySQL database server opgericht heeft. Zie artikel [MySQL4 op Mac OS X](http://www.atlantisdesign.nl/artikel/3), dan kunt u via de Preferences van PureFTPd Manager ook de autorisatie via de MySQL database laten gaan.

### PHP applicatie

En een extra aanvulllig op bovenstaande is dat het dan mogelijk is een PHP web-applicatie te maken die de gebruikers kan beheren op afstand via internet. Heeft u een Mac webserver op locatie staan? Dan kunt u vanaf een andere locatie FTP gebruikers toevoegen vanuit uw luie stoel met uw webbrowser.

## Conclusie en dank

U kunt wel nagaan dat deze FTP server meer mogelijkheden biedt en veiliger is voor inzet als webserver op internet. Volgens deze methode kunt u eenvoudig een FTP server opzetten met meerdere gebruikers.

Het programma PureFTPd Manager is **donationware**. Wat ongeveer inhoud dat het gratis te gebruiken is. Als u uw voordeel hiermee doet is een donatie aan de maker altijd welkom.

Mijn dank aan Jean Matthieu's PureFTPd Manager.