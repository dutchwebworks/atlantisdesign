---
title: "Het maken van een ISO bestand"
description: "Op het Windows platform wordt meer gebruik gemaakt van een .iso als zijnde Master disc-image formaat. Via een Unix command en een simpele Automator workflow kunnen we dat ook op de Mac."
pubDate: 2008-06-30
---

**Deze truuk werkt ook op Mac OS X Leopard v10.5!**

Een [.iso file](http://en.wikipedia.org/wiki/Iso_%28file_format%29) is een net als een .dmg een ingepakte soort **volume**. Met het meegeleverde **Disc Utility** (`/Applications/Utilities`) hulp programama op onze Mac kun je zo'n .dmg volume ook zelf maken.

Via het internet worden ook veel Mac programma's aangeboden als een .dmg volume. Linux distributies worden bijvoorbeeld in dit .iso formaat aangeboden. Deze zijn dan precies de grote van een cd-r of DVD om op te branden.

Het Mac cd-burning programama gebruikt bijvoorbeeld het eigen .toast formaat. Zo'n disc-image formaat (iso, dmg, toast, cdr) bevatten alle informatie om het bestand op een cd te branden. **Disc Utility** op de Mac kan genoemde formaten ook zonder problemen direct op een cd-r of DVD branden. Zonder tussenkomst van een brand-programma.

**Alle credits van deze manier om een .iso bestand te maken gaan uit naar een forum lid van het [MacFreak forum](http://macfreak.nl/cgi-bin/forums/forum.cgi).**

## Automator workflow

Sinds Mac OS X Tiger hebben we de mogelijkheid om via [Automator](http://www.apple.com/nl/macosx/features/automator/) diverse taken zoals de naam al zegt, te automatiseren. Verderop in dit artikel staat een zeer eenvoudige manier om dit Unix commando in een Automator workflow te gieten. Het maken van zo'n .iso bestand is dan een kwestie van 2x klikken met de muis.

## Unix commando

De Mac heeft natuurlijk Unix als onderlaag. Deze Unix laag bevat veel (soms oude) verborgen programma'tjes die heel handig kunnen zijn. Voor het maken van zo'n .iso file hoef je geen duur Mac programma aan te schaffen. Onze eigen Mac kan dit met een simpel Unix commando ook.

### Terninal

Open de terminal en ga naar de map (met het `cd` commando) waar een map staat die je wilt converteren naar zo'n ingepakt .iso bestand.

#### Het Unix commando

    hdiutil makehybrid -iso -joliet -o mijn_iso_bestand.iso map_naam/

#### Bovenstaand commando bestaat uit 3 stukken

- De parameters **-iso** en **-joliet** geven aan dat je een hybride cd-image wil maken met de [ISO standaard](http://en.wikipedia.org/wiki/Iso_%28file_format%29). [Joliet](http://en.wikipedia.org/wiki/Joliet_%28file_system%29) betekend dat je ook een Windows indeling wilt.
- Het stukje -o betekend dat hier de **output** volgt, ofwel waar je het .iso bestand (met naam) wilt bewaren. In bovenstaand voorbeeld is dat dus **mijn_iso_bestand.iso**. Je kunt hier dus direct een pad opgeven waar je het wilt bewaren.
- Als laatste in het Unix commando geeft aan 'van-welke-map' (of coversie van een .dmg) je een .iso wilt maken. In bovenstaand voorbeeld wordt van de map **map_naam** een .iso bestand gemaakt.

In de laatste stap wordt de naam van de map de naam van de cd, die je uiteindelijk gaat branden. Je kunt dit ook zien door het zojuist gemaakte .iso bestand te openen op de Mac. Op de Desktop zie je dan een witte soort harde schijf (volume) te voorschijn komen. De inhoud van de map staat dan in de root van de cd.

###Spaties in de namen

Als de map_naam of de naam van je .iso bestand spaties moet bevatten moet je deze namen commenten, dus dan wordt het commando iets als:

    hdiutil makehybrid -iso -joliet -o "mijn iso bestand met spaties.iso" "map naam met spaties"

### Manual

Door het woord `man` (manual) voor een Unix commando / programma te typen kom je meer informatie te weten over het commando.

    man hdiutil

## Uitwisselen

De meeste Windows cd-buring software (Nero, Easy-cd Creator etc.) kunnen ook deze .iso bestanden maken. Op bovenstaande manier, geheel gratis!!, kunnen we op de Mac ook zo'n .iso bestand maken en uitwisselen met Windows, Unix/Linux en andere Mac gebruikers.

## Automator Workflow

Dit is erg leuk allemaal maar erg omslachtig en niet 'the Mac way'. Via het [MacFreak forum](http://macfreak.nl/cgi-bin/forums/forum.cgi) werd deze vraag ook gesteld en een lid van het forum heeft het Unix commando in een Automator workflow verwerkt.

Open **Automator** (`/Applications/Automator`) en kies voor Run Shellscript. Plak onderstaande code erin en kies bij Pass Input voor **as arguments**.

### Code

    for f in "$@"
    	do
    		[ -d "$f" ] && hdiutil makehybrid -iso -joliet -o "$f.iso" "$f"
    	done

#### Het ziet er dan ongeveer zo uit

##Als Finder plugin bewaren

Kies dan `File > Save as Plug-in` (voor de Finder) geef het een naam bijvoorbeeld **Create ISO image**. In de Finder kun je een willekeurige map aanwijzen, klik met de rechtermuistoets op de map en kies `Automator > Create ISO image`.

Voor **Mac OS X Leopard** kies je in de **Finder** met de rechtermuistoets: `More > Automator > Create ISO image`.

In dezelfde map wordt nu een Workflow gestart (zie bovenin de Finder balk naast de klok) en er zal een .iso bestand verschijnen. Zo makkelijk is het nu.

## Downloaden

Natuurlijk kun je de bovengenoemde **Automator Workflow** ook gewoon [downloaden](http://www.atlantisdesign.nl/public/automator_create_iso.zip). Start Automator, open het bestand in de zip file en volg de stappen bij het punt 'Als Finder plugin bewaren' nogmaals.
