---
title: "Synergy delen van muis en toetsenbord"
description: "Stel je werkt op een Mac en daarnaast moet je ook wel eens op de Windows computer wat doen. Zou het dan niet handig zijn om slechts 1 muis en toetsenbord te (hoeven) gebruiken voor beide computers tegelijk? Zeer handig voor bijvoorbeeld meerdere laptops met externe toetsenborden en draadloze muizen. Daarbij wordt ook een simpel clipboard gedeeld tussen de computers."
pubDate: 2008-05-31
---

# Synergy delen van muis en toetsenbord

Met het OpenSource [Synergy](http://synergy2.sourceforge.net/) wordt het mogelijk om met slechts 1 muis en toetsenbord bijvoorbeeld een Mac, Linux en Windows computer te besturen.

Ga met de muis naar een zijkant van het ene scherm af en dan bestuur je de muis op de andere computer. Samen met het toestenbord kun je ook simpele dingen kopieren via het clipboard.

Zeer handig dus als je op een bureau meerdere computers (met verschillende platformen: Mac/Windows/Linux) hebt staan en geen plek hebt voor nog meer toetsenborden en muizen.

## Mac als hoofdcomputer

In dit voorbeeld gaan we het volgende opzetten: We gebruiken de Mac als hoofdcomputer (dit heet de **server**) waar we de muis en toetsenbord van willen gebruiken op een Windows XP computer (dit heet dan de **client**). Andersom kan natuurlijk ook.

**Deze opzet is successvol getest met MacOS X Leopard v10.5.3 en een Windows XP SP2 computer.**

## Setup op de Mac

Op de Mac moeten we de server versie van Synergy aanzetten. Download de laatste **OS X** versie van Synergy, zie de linkerkant van de website (**latest release**), welke je naar de download site van SourceForge.net brengt. Bij het schrijven van dit artikel is dat Synergy v1.3.11.

### Geen mooi MacOS X programma'tje?

Synergy is OpenSource. Eigenlijk is het enige dat je nodig hebt slechts **1 Terminal commando** om deze aan te zetten.

Er zijn wel MacOS X progamma'tje waarmee je dit makkelijk op schijnt te kunnen zetten zoals [QuickSynergy](http://quicksynergy.sourceforge.net/) en [SynergyKM](http://sourceforge.net/projects/synergykm). Maar geen van beide programma's schijnt goed te werken of uberhaupt het aan de praat te krijgen.

In dit voorbeeld gaan we het onszelf (uiteindelijk) heel makkelijk maken met slechts 1 Terminal commando.

### Configuratie

Pak het Synergy `.tgz` bestand uit (dubbelklikken) en op en het `synergy.conf` configuratie bestand. Wat er in staat lijkt allemaal ingewikkeld maar dat valt reuze mee.

Kopieer en plak het **Unix or MacOS X** voorbeeld zoals aangegeven staat op de `Documentation > Using Synergy` pagina of gebruik [deze voorbeeld](http://www.atlantisdesign.nl/public/synergy_conf.txt) versie welke precies hetzelfde is.

	section: screens
	       screen1:
	       screen2:
	    end
	    section: links
	       screen1:
	           right = screen2
	       screen2:
	           left = screen1
	    end

Zoals in de documentatie staat vermeld moeten we de **hostname** van de Mac invullen op de plek waar nu **screen1** staat. Synergy ziet screen1 als de server en **screen2** (en volgende nummres) als client(s).

#### Hostname

Als je de hostname van je Mac niet weet kun je dit opzoeken in `Apple'tje > SystemPreferences > Sharing`. Daar staat de naam van de Mac maar dit moet je aanvullen met **.local**.

Of typ onderstaande in de **Terminal** (`/Applications/Utitilies/Terminal`) wat sneller is:

	hostname

### Hostname van de Windows computer opzoeken

In het configuratie bestand op de Mac moeten voor zowel de server (screen1 ofwel de Mac) als de client (screen2 ofwel de Windows computer) de hostnames worden ingevuld.

Op de Windows computer werkt dit precies hetzelfde in de **MS-Dos promt**. Als je de hostname van de Windows computer niet weet klik dan op `Start > Run` (of uitvoeren op z'n Hollands) en typ het volgende in (ofwel command) gevolgt door een enter:

	cmd

Dan volgt een MS-Dos promt (vergelijk met de MacOS X / Unix Terminal) en vragen we de Windows hostname op:

	hostname

In het configurtie bestand vullen we bij **screen1** de hostname van de **Mac** (server) in en bij **screen2** vullen we de hostname in van de Windows computer (client) in. Doe dit respectievelijk voor elk vermelding van screen1 en screen2.

## Synergy als server starten op de Mac

We zijn bijna klaar op de Mac maar moeten eventueel nog rekening houden met de Mac en Windows firewall mocht deze aan staan.

### Firewall en port nummer

Synergy is een netwerk programma dat met netwerk poorten werkt om toegang te krijgen tot de andere computer(s). Volgens de documentatie gebruikt Synergy port nummer **24800**. Zorg ervoor dat deze port open staat in de **firewall**. Of zet tijdelijk de firewall uit.

#### Windows firewall

Op Windows XP staat dat op: `Start > Control Panel > Security Center > Windows Firewall`. In de Windows firewall kun je onder het tabblad `Exceptions` ook de port nummer toevoegen. Zorg ervoor dat deze open staat.

#### Mac firewall

Met het trailware programma [DoorstopX](http://opendoor.com/doorstop/) voor MacOS X kun je heel makkelijk de ingebouwde Apple [ipfw firewall](http://en.wikipedia.org/wiki/Ipfirewall) beheren.

## Synergy server starten

De configuratie op de Mac is klaar. Nu kunnen we de Synergy Server starten. Open de **Terminal** (`/Applications/Utilities/Terminal`) en doe het volgende:

Sleep vanuit de **Synergy download map** het bestand **synercys** (dit is de server versie van Synergy) op het Terminal venster gevolgd door een spatie (dit is belangrijk). En typ het volgende er achteraan met een spatie als laatste!

	-t --config

Sleep nu het configuratie bestand op het Terminal venster. Dit lijkt allemaal ingewikkeld maar hiermee geven we aan dat we Synergy willen starten met het opgegeven configuratie bestand. Het ziet er uiteindelijk ongeveer zo uit (zonder enters ertussen, het is 1 lange zin):

	/Users/korte_gebruikersnaam/Downloads/synergy-1.3.1/synergys -f --config /Users/korte_gebruikersnaam/Downloads/synergy-1.3.1/synergy.conf

In dit voorbeeld is **korte_gebruikersnaam** de naam van je thuis map. Geef een enter en er zullen een paar Unix regels komen die laten zien dat de server draait!

## Synergy client configuratie op Windows

Vanaf dezelfde website downloaden we de Synergy Intaller.exe voor Windows. Installeer het programma en start Synergy om deze te configureren op Windows.

We gebruiken de muis en het toetsenbord van de Mac dus we geven in dit scherm aan dat we de eerste optie willen gebruiken namelijk **Use another computer's shared keyboard and mouse (client)**.

Vul de **hostname van de Mac** in dit scherm in. Synergy op Windows gaat dan naar de Mac zoeken op netwerkport nummer 24800. Klik op **Test** om te zoeken naar de Mac.

Het zal niet direct lukken en als er een **timeout** melding komt kijk dan goed of de firewalls goed staan ingesteld of zet deze tijdelijk uit. Klik anders gewoon op **start**.

In het Mac Terminal scherm kunnen we zien welke computers er verbinding maken met Synergy. Als de hostname van de Windows computer in de Terminal voorbij komt is de setup geslaagd.

## Synergy magic!!

In deze opzet gaan we ervan uit dat de Mac aan de linkerkant staat en de Windows computer aan de rechterkant van de gebruiker. Ga met de Mac muis nu naar de rechterkant van het scherm af en kijk hoe je nu de muis op het Windows scherm te voorschijn ziet komen.

Geweldig!! Je kunt nu het toetsenboard, de muis en een simpel klipboard delen met de Windows computer. Bestanden overkopieren kan niet maar bijvoorbeeld wel een URL uit Safari kopieren naar Internet Explorer. Of een stukje tekst van uit TextEdit naar Windows.

### Schermen omdraaien

Als je de positie van de schermen wilt veranderen kun je dit in het configuratie bestand doen op de Mac. Onderaan in het configuratie bestand staat **right** en **left** van de respectievelijke computer **hostnames**.

## Synergy server stoppen

Omdat het een Unix programma is wat met een Terminal commando gestart is is er ook geen makkelijke manier om deze te stoppen. Er zijn twee opties.

### Activity Monitor

Open de **Activity Montitor** (`/Applications/Utilities/Activity Monitor`) en zoek op synergy. Klik het proces aan vervolgens kunnen we deze met de button **Quit** (of Force Quit) uit zetten.

### Terminal commando

In de Terminal gaat het allemaal veel makkelijker en sneller. Zoek eerst het proces ID op (ofwel PID):

	ps -ax | grep synergy

De PID id staat aan het begin van de regel vermeld. Onthoud dit nummer en vul het achteraan het volgende commando in, bijvoorbeeld:

	sudo kill 285

Waarbij **285** de PID ID zou kunnen van het Synergy proces. Dit nummer kun je ook terug vinden in de **Activity Monitor**.

## Moet ik dit alles elke keer doen?

Het lijkt allemaal een beetje omslachtig om dit aan de praat te krijgen. De eerste keer wel maar mensen met een beetje Unix kennis zijn niet anders gewend. Uiteindelijk is de configuratie gemaakt en is het maar 1 Unix commando om Synergy te starten.

Uiteindelijk kun je het allemaal makkelijker maken voor jezelf. Zoals het volgende met een Unix shell alias:

### Bash profile startup script

Maak een .bash_profile bestand aan (bewaar deze in de root van je eigen thuis map):

	~/.bash_profile

Dit gaat het makkelijks met bijvoorbeeld een goede code-editor als het gratis [TextWrangler](http://www.barebones.com/products/textwrangler/).

De inhoud van dit bestand wordt direct uitgevoerd als de Terminal applicatie gestart wordt. Plaats hierin een [Unix shell alias](http://en.wikipedia.org/wiki/Alias_(Unix_shell)):

	alias start_synergy="~/.bin/synergys -f --config ~/.bin/synergy.conf &"

In dit voorbeeld is een verborgen map (begint met een punt) aangemaakt genaamd **.bin** (staat voor binary ofwel Unix programma's) welk in de eigen `/Users/korte_gebruikersnaam` map staat (`~/`). Daarin staat het Unix Synergy server programma (synergys) en het configuratie bestand (synergy.conf) wat daarbij hoort.

De volgende keer als je Synergy wilt gebruiken hoef je in de Terminal alleen maar de alias naam in te typen om **Synergy server** te starten.

	start_synergy

Dan verschijnen dezelfde Unix regels. Daarna kun je het Terminal venster sluiten (deze geeft een waarschuwing maar dat geeft niet).