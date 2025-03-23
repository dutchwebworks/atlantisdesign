---
title: "Apache htaccess en mod_rewrite op MacOS X Tiger"
description: "MacOS X Leopard heeft de Apache 2.x webserver. Ook hier gaan we de mod_rewrite module gebruiken. Eigelijk moet er maar 1 configuratie regel aangepast te worden."
pubDate: 2007-08-31
---

**Let op!** Er is een update op dit artikel beschikbaar voor [Apache .htacces en mod_rewrite op Apple's MacOSX Leopard v10.5](http://www.atlantisdesign.nl/artikel/apache-htaccess-en-mod_rewrite-op-macosx-leopard).

Website optimalisatie en **SEO** ([Search Engine Friendly](http://en.wikipedia.org/wiki/Search_engine_optimization)) url's maken. Maar hoe zetten we deze techniek aan op onze eigen lokale Mac OS X Tiger (v10.4.x)?

#### Alle credits voor deze tutorial gaan uit naar [Michael Krol](http://michaelkrol.com/2005/11/21/enable-mod_rewrite-on-os-x-104-tiger/)

De specifieke aanpassingen aan het Apache configuratie bestand heb ik niet zelf uitgevonden. Maar ik heb er een artikel omheen geschreven met uitleg en ervaringen in het Nederlands.

## Wat is Apache mod_rewrite? En wat kan ik ermee?

[Apache](http://httpd.apache.org/) is natuurlijk de OpenSource HTTP webbserver die bij elke installatie op onze Mac al aanwezig is. Je kunt deze aanzetten in de `System Preferences > Sharing > Personal Web Sharing`. Op internet wordt deze webserver veel vuldig gebruikt op Linux webservers. Het kan ook op Windows draaien.

### mod_rewrite

Het is een module (vandaar de naam 'mod\_') die bij de standaard installatie van Apache wordt geleverd. Bij het opvragen van een webadres typt men een website naam in of je surf van link naar link op een website. Dit veranderd de URL in de webbrower.

Hoe die URL eruit ziet verschilt nogal per website. Waar het bij mod_rewrite om gaat is hoe deze URL eruit komt te zien. Het is natuurlijk **slordig** en vooral **lelijk** als je website URL's in de adres regel heeft staan als:

### &hellip; niet mooi

    http://www.uwwebsite.nl/article_show.php?artikel_id=2

Ten eerste kun je aan de URL **niet zien** of raden waar de pagina over gaat. Bovendien kunnen zoekmachines ook deze URL niet goed indexeren ... want het 'zegt' niks over de pagina. Natuurlijk gaan zoekmachines de URL wel volgen en indexeren maar het kan vele malen beter.

Het zou veel mooier zijn als de bovenstaande URL er als volgt uitziet. Dit worden ook wel **permalinks** (permanente link) genoemd.

### Mooi!!!

    http://www.uwwebsite.nl/artikel/apache-mod-rewrite

## Pure voodoo!! Hoe werkt het nou eigenlijk?

De mod_rewrite module kan, als een webadres wordt opgevraagd, de URL herschrijven. De webbrowser vraagt de **mooie URL** aan de Apache webserver. De mod_rewrite module herschrijft de URL naar de **niet mooie URL** maar laat de mooie URL wel in het webbrowser staan. In de achtergrond (op de Apache webserver) wordt de niet mooie URL aangevraagd. Daar zit, in dit voorbeeld, een PHP script die de URL met extra info (achter de URL) verwerkt en een resultaat terug stuurd naar webbrower.

### Voor het voorbeeld

In bovenstaand voorbeeld wordt `?artikel_id=2` herschreven naar **apache-mod-rewrite**. Natuurlijk is een nummer niet hetzelfde als een naam. Het is als voorbeeld gebruikt hoe dit beter gedaan kan worden. In dit geval zoekt het PHP script niet naar een nummer in de database maar gaat het naar de naam **apache-mod-rewrite** zoeken.

Het herschrijven (en de PHP) is moeilijk uitleggen maar het is o zo mooi voor een professionele website. Het zorgt er ook voor dat webadressen voorspelbaar worden en makkelijk onthouden worden.

## Meer informatie als het straks allemaal werkt

Als straks de mod_rewrite module werkt (lees dit artikel vooral door!) ... hoe moet ik dan verder? Hoe pas ik het daadwerkelijk toe? U moet ondertussen een beetje begrijpen wat het kan en dat het om het vertalen van URL's gaat. Lees op de [Apache pagina](http://httpd.apache.org/docs/1.3/mod/mod_rewrite.html) (in het engels) waar het eigenlijk om gaat. Een beetje kennis van **regex** (Regular Expressions) kan ook heel handig zijn. Anders snapt u niet echt hoe **URL rewriting** werkt.

Daar zijn veel website over te vinden op internet. Hier volgt een kort lijstje:

- [Naar voren.nl - Vriendelijke URL's](http://www.naarvoren.nl/artikel/vriendelijke_urls/)
- [Regular Expression beginners guide](****)
- [Alistapart: URL's URL's URL's](http://www.alistapart.com/articles/urls/)
- [Alistapart: Slashforward](http://www.alistapart.com/articles/slashforward/)
- [Alistapart: How to succeed with URL's](http://www.alistapart.com/articles/succeed/)
- [Tips en truuks hoe je .htaccess file moet schrijven en diverse URL's en compleiteit kan herschrijven](http://www.askapache.com/htaccess/apache-htaccess.html#chap4).
- [Permanent redirects](http://www.gnc-web-creations.com/301-redirect.htm)
- [Comprehensive guide to .htaccess](http://www.javascriptkit.com/howto/htaccess.shtml)
- [.htaccess password generator](http://www.tools.dynamicdrive.com/password/)
- [.htaccess cheat sheet](http://www.ilovejackdaniels.com/mod_rewrite_cheat_sheet.pdf)
- [Rewrite cookbook](http://rewrite.drbacchus.com/)
- [Mod_rewrite a beginners guide](http://www.sitepoint.com/article/guide-url-rewriting/4)

Het boek [The Definitive Guide To Apache mod_rewrite](http://www.apress.com/book/view/1590595610) van uitgever [Apress](http://www.apress.com/) is zeker een aanrader. `ISBN10: 1590595610 | ISBN13: 9781590595619`

## Hoe gaan we dit toepassen op onze eigen Mac?

In de standaard installatie van onze Mac z'n standaard Apache webserver zit deze module al inbegrepen. Het staat alleen **niet standaard aan**.

### Waarom zou ik dit op mijn eigen Mac willen?

Bijna alle websites kunnen gebruik maken van deze techniek. De Apache webserver staat bij hosting providers standaard geconfigureerd om deze techniek aan te bieden. Het wordt jammer genoeg niet altijd gebruikt.

Dus als u een **zelf gemaakte website** heeft draaien op internet (en deze ook zelf onderhoud) heeft u vast de website ook op uw **eigen computer** draaien. Zodat u lokaal (op uw eigen Mac) de website kan ontwerpen, aanpassen en misschien wel programmeren.

Standaard is op de Mac (client versie, niet server versie) deze module wel aanwezig maar staat **niet standaard aan**. Om mod_rewrite eens te proberen kunt u dat beter op uw eigen Mac doen en niet op een live website.

## BBedit TextWrangler's command line tools

We gaan de standaard configuratie van de al aanwezige Apache webserver iets aanpassen. Dit kan op twee manier gedaan worden: Via de **Terminal** applicatie of we maken gebruik van de gratis code-text editor [BBEdit TextWrangler](http://www.barebones.com/products/textwrangler/).

Start **TextWrangler** (of BBEdit) en laat het de **command line tools** installeren. We kunnen nu aan de slag. Als je gebruik maakt van BBEdit is het commando om bestanden te bewerken (vanuit de Ternimal) 'bbedit' in plaats van 'edit' welke TextWrangler gebruikt.

## Waarom een code-text editor?

Als u bekend ben met Unix terminal commando's en de **vi editor** (of Pico) hoeft u geen gebruik te maken van TextWrangler's **command line** tools. Met de command line tools kunt u in de Terminal een tekst document bewerken met een Mac OS X teksteditor.

Als u een (al dan niet verborgen Unix) file wilt bewerken typt u in: `sudo vi /etc/httpd/httpd.conf`. Maar we gaan het text document openen met de TextWrangler command line tools. [Download](http://www.barebones.com/products/textwrangler/download.shtml) daarom BBEdit TextWrangler, open het programma en laat het de command line tools installeren. Dit vergemakkelijkt het proces straks om Unix text documenten mee te bewerken. Als u de commerciele grote broer BBEdit al heeft kunt u BBEdit gebruiken in plaats van TextWrangler. De werking hieronder is precies hetzelfde.

Zo ... heeft u ook gelijk een mooie gratis text editor voor bijvoorbeeld HTML / Css / Javascript / PHP etc.

## Apache configuratie aanpassen

Voordat we die geweldige command line tools kunnen gebruiken moeten we toch eerst in de Terminal duiken. Start daarom de Terminal applicatie op in de map `Applications > Utilities > Terminal` vanaf onze Mac OS X schijf. En typ het volgende in en geef een enter:

    cd /etc/httpd

En vervolgens:

    ls -l

We zien nu een lijst met bestanden die in deze map staan. Het bestand dat we gaan aanpassen heet **httpd.conf**. Voor het gemak en goede orde maken we eerst een backup van dit bestand:

    sudo cp httpd.conf httpd.conf_backup

Met wat meer Unix kennis kunt u met rm en mv de backup weer terug zetten.

Nu gaan we de TextWrangler command line tools gebruiken om het Unix configuratie bestand van de Apache webserver te openen en te bewerken. Let op! Als u dus kennis heeft van de **vi** editor kunt u ook gewoon `sudo vi httpd.conf` in typen. Typ in:

    edit httpd.conf

TextWrangler opent zich met het Apache configuratie bestand. Als u goed kijkt is dit bestand **nog niet bewerkbaar**. Dit kunt u zien aan het potloodje met een streep er doorheen. Klik hierop en vul een administrator wachtwoord in. Dit configuratie bestand kan niet zomaar bewerkt worden vanwege **restricties / rechten** (permissions) op het Unix systeem en de werking van Apache. We hebben een backup gemaakt en u gaat natuurlijk precies doen wat hieronder staat.

Wat nu volgt is iets wat letterlijk overgenomen (maar vertaald) van de [Michael Krol website](http://michaelkrol.com/2005/11/21/enable-mod_rewrite-on-os-x-104-tiger/).

## De mod_rewrite module aanzetten

We gaan een paar regeltjes aanpassen. De regel nummers worden genoemd waar **ongeveer** in het text document de bewerking moet worden gemaakt. Let hier dus heel goed op wat u doet en zoek de goede regel op.

Met TextWrangler (of BBEdit) voor ons gaan we (met `Apple'tje + j`) naar **regel 223** waar het volgende staat.

    #LoadModule rewrite_module libexec/httpd/mod_rewrite.so

Haal het hekje **#** aan het begin van de regel weg. Dit heet wel **uncommenten** wat vanaf nu in de rest van dit artikel zo genoemd wordt.

Ga vervolgens naar **regel 267** en **uncomment** de regel waar staat:

    #AddModule mod_rewrite.c

Nu naar **regel 408** waar staat `AllowOverride`. Zorg ervoor dat deze regel zo geschreven staat:

    AllowOverride All

Uncomment **regel 454** waar onderstaande staat. Dit bepaalt hoe de bestanden heeten die we gaan gebruiken om de mod_rewrite module aan te sturen.

    AccessFileName . htaccess

Het bestand is niet direct te bewaren vanwege Unix permissies. Vul een adminitrator wachtwoord in (of klik op het potloodje) en bewaar het bestand.

### Uw eigen Sites map in uw thuis map

We zijn bijna klaar. De mod_rewrite module werkt nu (na een herstart van Apache) in de map `/Library/WebServer/Documents` welke de hoofdmap is van onze webserver. In de `/etc/httpd` map staat nog een specifieke '**users**' map waar we ook twee dingen gaan veranderen.

Elke gebruiker op Mac OS X heeft een eigen `Sites` map waar u zelf uw eigen website kunt bewaren en bekijken via `http://localhost/~uweigennaam/` met bijvoorbeeld Safari. Vervang de tekst '**uweigennaam**' in de naam van uw thuismap.

Elke gebruiker heeft ook een soort **mini configuratie bestand** voor Apache speciaal voor die Sites map. Deze gaan we ook aanpassen. Terug in de Terminal die nog open staat typen we in:

    cd /etc/httpd/users

En we willen een lijst zien:

    ls -l

Hier staat een configuratie bestand met uw korte gebruikersnaam (ofwel de mapnaam van uw thuismap). Deze gaan we ook openen met TextWrangler (of BBEdit).

    edit uwnaam.conf

Vervang de '**uwnaam**' door de naam van u korte gebruikersnaam. Het bestand bevat maar een paar regels. Verander de twee regels zodat het eruit ziet als onderstaande:

    Options All

En de regel ...

    AllowOverride All

### Apache herstarten

Laat de rest van het bestand dus intact. Pas alleen die twee regels aan. Bewaar het bestand en we gaan nu de Apache webserver herstarten. Dit kan op twee manier. De makkelijkste manier is terug te gaan naar de `System Preferences > Sharing > Personal Web Sharing` ... vink deze **uit** en weer **aan**. Maar als u toch in de Terminal bezig bent kunt u ook intypen:

    sudo apachectl graceful

De Apache webserver neemt nu de **mod_rewrite module mee**. Nu kan de URL rewrite magie beginnen.

## Dank aan Michael Krol's webpagina

Naar deze tutorial was ik al enige tijd opzoek. Mijn dank ik is groot! Het herschrijven van URL's is zeker mooi in een website. Het aanzetten van de module is nu gedaan ... nu is het aan u om hiermee aan de slag te gaan. Lees er boeken over en zoek op internet hoe u het kunt toepassen. Hoe dit verder werkt met bijvoobeeld PHP scripting of MySQL databases is aan u.
