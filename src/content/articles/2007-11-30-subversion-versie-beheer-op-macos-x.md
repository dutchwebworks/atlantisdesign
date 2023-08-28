---
title: "Subversion versie beheer op MacOS X"
description: "Open-source versie beheer. Ideaal voor gebruik in het bouwen van websites waar bestanden vaak wijzigen, scripts getest worden en misschien niet meer werken. Dan is het handig om versies van alle bestanden centraal en handig te bewaren."
pubDate: 2007-11-30
---

# Subversion versie beheer op MacOS X

Bezig met webdesign / webdevelopement? Dan kan het wel eens voorkomen dat je aan een website bezig bent met veel scripts en losse bestanden die veel met elkaar te maken hebben. Werkt een website eenmaal dan wordt deze online gezet / ge-upload. De website zelf wordt misschien in een ZIP file bewaard met een naam als **website_versie_01.zip** en in een backup map gezet.

Deze werkwijze is niet echt handig te noemen met veel, heel veel, aanpassingen (revisies) op websites.

Op Wikipedia staat een hele waslijst aan [versie beheer software](http://en.wikipedia.org/wiki/List_of_revision_control_software). De bekenste zijn wel [Microsoft Visual SourceSafe](http://msdn2.microsoft.com/en-us/vs2005/aa718670.aspx) en het ouder wordende open-source CVS. Subversion wordt langzamerhand de opvolger en verbetering van CVS.

### Insteek

De insteek van dit artikel is het opzetten van Subversion op Mac OS X (Tiger of Leopard). Gebruik maken van en introductie met **svnX**. Dit alles voor lokaal (op je eigen Mac) werken met versie beheer software. Het is niet bedoeldt voor het opzetten van netwerk integratie met Subversion. Al is dat met Subversion natuurlijk ook mogelijk. Puur bedoelt voor **eigen gebruik** dus!

## Wat hebben hier allemaal voor nodig?

Subversion (afgekort tot **SVN**) is open-source en zeg maar **gratis**. Wordt veel toegepast op projecten waarbij oude versies van bestanden bewaard moeten blijven. Uitermate geschikt voor veel kleine bestanden die bij websites gebruikt worden. Wat hebben we nodig?

* [Tigris Subversion](http://subversion.tigris.org/) server, download de handig te installeren [Mac OS X binary van Martin Ott](http://homepage.mac.com/martinott/)
* Een client programma om met Subversion te communiceren. Bijvoorbeeld [svnX](http://www.lachoseinteractive.net/en/community/subversion/svnx/download/) (open-source, gratis) of [ZigVersion](http://zigzig.com/) (voor persoonlijk / thuis gebruik **gratis** met een license key te gebruiken).
* Klein beetje kennis van de Unix Terminal, wat echt niet moeilijk is.
* Eventueel de Mac OS X Finder contextual plugin [SCplugin](http://scplugin.tigris.org/servlets/ProjectDocumentList). Die het mogelijk maakt via de rechtermuisttoets allerlei Subversion acties in de Finder te maken. Maar is nog een beetje buggy.

## Website als voorbeeld project

Als voorbeeld gaan we in dit artikel uit van een bestaande website, genaamd **vogelfotografie**, welke we in Subversion gaan zetten, voor versie beheer. Zodat we van alle bestanden revivies kunnen bewaren om later weer terug te krijgen.

De website is ontwikkeld door een fictief persoon genaamd `kees`, de website wordt bewaard en ontwikkeld in z'n eigen Sites map. Hier wordt straks ook de **working copy** geplaats. Het pad naar deze website is:

#### Working copy

	/Users/kees/Sites/vogelfotografie

We moeten ook een plek hebben, een map, ergens op de Mac waar we de revivies (**repository**) gaan bewaren. Een goede locatie voor deze repository is de system Library:

#### Repository

	/Library/Subversion/Repository/vogelfotografie

Dit is de Library map van de opstartschijf, niet de Library map je eigen thuis map. Je kunt hiervoor ook een andere map gebruiken of zelfs een externe harde schijf (zolang je het Unix pad maar goed noteerd).

##Kleine introductie tot versie beheer

Er zijn natuurlijk vele soorte versie beheer sofware en programma's om hiermee te communiceren. Maar over het algemeen, en bij Subversion, werkt het ongeveer als volgt.

### Stap 1

Je hebt in een map een website staan welke uit verschillende bestanden en mappen bestaat. Dit wordt geimporteerd in een **repository**.

### Stap 2

Nu het in de repository staat (als **reviesie 1**) kunnen we de orginele map met website verwijderen.

### Stap 3

Met een zogenaamde **checkout** van de repository gaan we een kopie opvragen van de website. Deze kopie bevat een aantal verborgen bestanden en mappen waardoor de website **gelinked** blijft aan de repository. Hierin wordt bijgehouden welke bestanden zijn aangepast en nieuw zijn of verwijderd moeten worden.

### Stap 4

We gaan vrolijk verder met de website, wijzigingen maken, pagina's ombouwen, nieuwe bestanden toevoegen en verwijderen. Als we klaar zijn willen we de wijzigingen weer terug zetten in de repository, dit wordt een **commit** genoemd. Alle bestanden worden weer toegevoegd aan de database en de repository heeft nu een status van **revisie 2**. Dit nummer wordt elke keer als we een commit doen verhoogd.

De vorige versie, revisie 1, blijft nog steeds bestaan. Je kunt dus nog terug naar de vorige versie van bijvoorbeeld de homepage, een plaatje of een ander bestand. Dat is de kracht van versie beheer.

## Documentatie

Subversion is open-source en een [compleet boek](http://svnbook.red-bean.com/) ervan is online te vinden. Subversion wordt veel toegepast in de open-source en Linux community en is erg bekend. Veel informatie is te vinden in het **gratis** verkrijgbaar [SVN Book](http://svnbook.red-bean.com/en/1.4/svn-book.pdf), een **PDF versie** van de documentatie.

## Subversion op Mac OS X

Deze opzet heb is getest op Mac OS X Tiger en Leopard. De voorkeur gaat natuurlijk uit naar Leopard maar heeft verder geen voordelen.

### Subversion binary downloaden

[Download de laatste stable versie van Martin Ott's website](http://homepage.mac.com/martinott/). Bij het schrijven van dit artikel is dat **Subversion 1.4.4**. Dit is een binary installer wat zoiets wil zeggen dat het een gewone Mac OS X install pakketje is dat alles voor je installeerd. Je kunt Subversion (net als bijvoorbeeld Apache en MySQL) vanaf de C source code compilen, voor de echte Unix freaks.

###svnX, Mac OS X programma

Download ook het **gratis** Mac OS X programma [svnX](http://www.lachoseinteractive.net/en/community/subversion/svnx/download/) om te communiceren met Subversion repositories, checkouts en exports te maken. Bij het schrijven van dit artikel was dit **svnX 0.9.13**.

## Installeren

Installeer de **Subversion binary** installer. Zodra het geinstalleerd is gebeurt er verder eigenlijk vrij weinig en je kunt ook niets terug vinden in bijvoorbeeld de Mac OS X Application map.

Wat er eigenlijk is geinstalleerd zijn een paar Unix programma's in een verborgen map. Met deze programma's, of meer Unix commando's, kun je de **repository** mee beheren. Plaats het programma **svnX** in de Mac OS X Application map (`/Applications`).

## Client programma's

Ik kan 2 programma's aanraden om te communiceren met Subversion repositories. **Beide doen ze hetzelfde**. Namelijk [svnX](http://www.lachoseinteractive.net/en/community/subversion/svnx/download/), welke open-source is en gratis te gebruiken. En [ZigVersion](http://zigzig.com/), een goed Mac OS X programma welke voor persoonlijk / thuis gebruik gratis te gebruiken is met een gratis aan te vragen linsence-key. Bekijk het filmpje op de website van ZigVersion om een beetje inzicht te krijgen.

In mijn voorbeeld gebruik ik svnX ter introductie.

## svnX

Start svnX, en er verschijnen twee (op het eerste gezicht) lege vensters. Zet de twee schermen naast elkaar.

### Working copies

Het ene scherm is voor de **working copies**, waar een lijstje komt te staan waar je **checkouts** van repositories hebt staan. Bijvoorbeeld als je aan een website werkt dan staat hier vermeld waar deze website wordt bewaard. Dubbel klik je op zo'n **working copy** dan verschijnt er een scherm met alle **wijzigingen** die je hebt gemaakt. Het **vergelijkt jou aangepaste bestanden** met die van de laatste revisie (wordt ook wel **head-revision** genoemd) in de repository.

Het is een soort opsomming, wachtrij, van wat er gaat gebeuren. Hier kun je keuzes maken om aangepaste bestanden weer terug te sturen naar de repository (**commit**), verwijderde bestanden ook voor de nieuwe revisie uit de repository te laten verwijderen.

### Repositories

Een repository is een plaats (gewoon een map) ergens op de Mac waar een voorgedefineerd aantal mappen en bestanden die alle revisies van je bestanden bijhouden. Een soort database dus. Aan deze bestanden moet je ook niet zitten want dat wordt bijgehouden door de `svn admin`.

Als je een repository hebt staan op je Mac kun je met dit scherm aangeven waar die repositories staan. Dubbelklik je op zo'n repository dan kun je de inhoud en revivies zien van bestanden die erin staan. Hier kun je ook een **checkout** of een **export** maken van zo'n repository. Tevens kun je aangeven welke revisie van de website of project je wilt bekijken, danwel een checkout van wilt hebben of een export.

## De website in een repository zetten

We gaan eerst een lege repository aanmaken. Dit is de database waar de revivies in worden bewaard. Nu hebben we het **Terminal** programma nodig (`/Applications/Utilities/Terminal`). Typ de volgende Unix commando's in om naar de net aangemaakt map te gaan.

	cd /Library/Subversion/Repository

Deze map is verder leeg en we gaan hier zo'n repository aanmaken.

	svnadmin create vogelfotografie

We gaan nu de **volgelfotografie** website in de **repository** zetten, ofwel **importeren**. Omdat svnX niet uitgebreidt is om dit voor ons te doen (het schijnt dat **ZigVersion** dit wel kan met drag-and-drop vanuit de Finder) gaan we dit doen met een simpel Unix commando.

	svn import, alles hoort op 1 regel te staan in de Terminal
	svn import /Users/kees/Sites/vogelfotografie file:///Library/Subversion/Repository/vogelfotografie -m "Eerste opzet"

Druk op enter en er komen allerlei Unix regels voorbij. De website is nu toegevoegd aan de repository, als **revisie 1**.

### Uitleg over het commando

Wat betekend het allemaal hierboven? Met het **import** commando geven we aan dat we de map `/Users/kees/Sites/vogelfotografie` (met alle submappen en bestanden) willen **importeren** als revisie 1 in de **repository** die staat op de locatie `/Library/Subversion/Repository/vogelfotografie`. Het laatste stuk **-m "Eerste opzet"** is een **log comment**. Hierin beschrijf je wat er met deze changeset / update veranderd is.

### Moet ik dit elke keer doen bij nieuwe (importeer) projecten?

Voor het aanmaken van een **nieuwe repository** (database) moet je dit **inderdaad** via de Terminal doen. Het zijn maar 2 regels code (`cd` naar de juiste map, en `svn create`).

Met **ZigVersion** en **svnX** kun je vanuit de Finder met **drag-and-drop** een project importeren (zie filmpje op ZigVersion website). Via de Terminal is het ook handig om te weten hoe dit gedaan moet worden met het import commando.

Maar zodra een project in een repository staat hoef je niet meer naar de Terminal om te kijken.

## Repository bekijken

Nu is het moeilijkste stuk gedaan. We willen nu natuurlijk zien dat ons project in de repository staat. Open **svnX** en druk op het **plus icoontje** rechtsonderin van het **Repositories** window.

Vul een naam in zodat deze in de lijst komt te staan: vogelfotografie. Klik op het vergrootglas en blader naar de map waar de repository staat.

	/Library/Subversion/Repository/vogelfotografie

Dubbelklik nu op de **naam** (in de lijst) van de vogelfotografie repository. In dit scherm zien we een aantal dingen.

### Revisies

Bovenin het scherm komt een lijst te staan, met bullets ervoor, welke de revisies zijn die allemaal in de repositorie staan. Elke keer als we een **commit** sturen naar de repository (dus wijzigingen doorsturen) wordt deze lijst aangevuld.

## Advanced

Klik op het tabblad advanced om een extra tusenscherm erbij te krijgen. Hierin staat in een **log formaat** wat er gebeurt is bij de commit van die revisie.

### Root, de bestanden

Onderaan het scherm staat een representatie van onze website. Je kunt hier net als in de Finder gewoon doorheen bladeren om de bestands structuur te zien. We hebben nu **stap 1 van de introductie gehad**.

## Working copy maken

De website staat nu nog in de Subversion repository. We gaan een kopie (working copy) plaatsen (**checkout**) in Kees z'n Sites map zodat hij verder kan werken aan de website, maar dan is de website voorzien van versie beheer.

### Verwijder de orginele website

Verwijder de orginele map van de **vogelfotografie** website in Kees z'n Sites map. Deze hebben we niet meer nodig. Dit is **stap 2** van de introductie.

### Checkout maken

In de Finder gaan we een **lege map** maken in Kees z'n Sites map. Hierin komt de, onder versie beheer staande, vogelfotografie website. Het ziet er dus als volgt uit.

	/Users/kees/Sites/vogelfotografie

Dubbelklik op de naam **vogelfotografie** in het window van de Repositories. Bovenin het scherm staan 2 buttons, twee groene pijlen. **Klik op de button met het blauw svn icoontje eronder**, dit is de **checkout button**. De andere button doet bijna hetzelfde maar dat leg ik straks uit. Blader nu naar de lege **vogelfotografie** map in Kees z'n Sites map, zie hierboven.

Zodra je op **open** hebt geklikt komt het andere venster in svnX, de **Working copies**, in beeld en maakt alvast een nieuwe regel aan. Vul een naam in, bijvoorbeeld **vogelfotografie**, die we aan de woking copy geven. In de achtergrond is er een checkout gemaakt naar de **vogelfotografie** map van Kees van de hoofdrevisie (head revision) van de vogelfotografie repository. Dit is stap 3 van de introductie.

## De website is weer terug

Maar nu onder Subversion versie beheer. In de Mac OS X Finder zie je aan de bestanden niet veel bijzonders. Echter als je in de Terminal naar de map gaat ...

	cd /Users/kees/Sites/vogelfotografie

&hellip; en een lijst opvraagt, inclusief verborgen bestanden ...

	ls -Fial

### Verborgen .svn mappen

Dan zien we allemaal verborgen (in elke submap) mappen een map staan genaamd .svn. Omdat de map met een punt begint zien we deze niet in de Finder. Aan deze map moet je niet zitten en zeker niet verwijderen. Natuurlijk is dit geen onderdeel van de vogelfotografie wesite. In deze verborgen mappen wordt informatie opgeslagen over de aangepaste bestanden en de **relatie met de repository**.

## Revisie bewaren: commit

Kees gaat nu vrolijk verder met de website. Hij past een paar bestanden aan, maakt nieuwe bestanden aan (plaatjes en nieuwe HTML/PHP bestanden bijvoorbeeld). Kees is klaar met aanpassingen en wil een revisie van de website bewaren. Zodat hij deze ooit nog eens kan terug halen mocht de website bijvoorbeel dan niet meer werken in de toekomst.

Open svnX en dubbelklik nu in het **working copy** scherm op de juist naam. Er opent zich een scherm met aangepaste bestanden. Dit wordt vergeleken met de laatste revisie in de repository. Hier kun je precies zien wat Kees heeft aangepast.

#### Modified
Bestanden waar een **M** voorstaat staan voor **modified**. Hiervan is dus al een revisie aanwezig en zal worden geupdate naar een volgende revisie in de repository.

#### New

Bestanden waar een **?** (vraagtegen) voorstaat zijn meestal **nieuw**. Voordat je op commit klikt moet je de nieuwe bestanden eerst selecteren en op de `Add` knop klikken. Zodat svnX weet wat ermee moet gebeuren. Voor deze nieuwe bestanden komt een **A** te staan, van Add.

### Commit
Selecteer alle bestanden in het venster (of doe een Apple'tje + a). Druk nu op de **commit** button. Er verschijnt een leeg scherm waar je een **comment** (omschrijving) kwijt kunt bij deze revisie. Dit is eigenlijk hetzelfde als toen we een import actie gedaan hebben in de Terminal met het **-m "Eerst opzet"** stukje.

Vul wat relevantie informatie in zodat je voor jezelf kun bijhouden wat er gebeurt is. Deze comment kun je ook weer terug lezen in het andere scherm: **repositories**. Dit is stap 4 uit de introductie.

## De twee revisies bekijken

Keer terug naar het scherm van de repositories. Dubbeklik op de naam en je zult zien dat er nu **twee bullets** staan met een revisie nummer erachter. De vogelfotografie website heeft nu **2 revivies**. Je kunt nu op de bullets klikken van de revivies en onder het scherm kun je door de bestanden bladeren van deze revisies en de verschillen in bestands structuur zien.

###	Revisie terug zetten

Je kunt vanuit de Finder achtige onderkant nu (als je een keuze gemaakt hebt in revisie met de bullets) een bestandje terug slepen naar de vogelfotografie website. In feite haal je nu een oudere revisie van het bestand op en overschrijf je deze weer terug naar die revisie.

Natuurlijk komt er veel meer kijken bij het beheren van revisies. Zo kun je de gele website weer terug halen door eerst op de juiste (bullet) revisie te klikken en dan op de groene **checkout** button te kilkken om die versie weer terug te halen.

## Geavanceerdere toepassingen

Voor de basic SVN werkzaamheden hebben we aan svnX (of ZigVersion) genoeg. Wil je meer? Dan komt eigenlijk de Terminal weer om de hoek kijken (zie de [handleiding](http://svnbook.red-bean.com/en/1.4/svn-book.pdf)) waar veel meer kracht ligt verborgen om een working copy te beheren, updaten, wisselen van revisie en de verschillen te bekijken.

## De ander button in svnX: export

Ik zou nog vertellen waar die andere button, **export**, voor is. Subversion kent twee manier om iets uit een repository te krijgen, namelijk:

### checkout

Een checkout hebben we net gedaan. Hiermee behoudt je een link naar de repository en kun je aangepaste bestanden als een revisie laten bewaren. In een checkout worden al die `.svn` verborgen mappen ook in de website geplaats.

### Export

Als de website klaar is wil Kees die natuurlijk uploaden naar een live vogelfotografie website op internet. Dit is geen upload button. De procedure van deze button is hetzelfde. Echter met een export krijg je vanuit de repository ook een **kopie van de website**, echter dit maal **ZONDER** al die extra mappen als `.svn`.

**Let op!** Overschrijf hiermee natuurlijk **niet de working copy** van Kees z'n vogelfotogafie website (de checkout versie). Een export is bedoelt om een **schone kopi**e (directory tree) te krijgen.

Laat bijvoorbeeld op de Mac desktop de **export** komen van de **repository**. Op de desktop verschijnt een nieuwe map genaamd root, met daarin de website. Via een FTP programma kun je de website vanuit deze map direct (met alle submappen) uploaden naar de live website.

### Waarom op deze manier?

De verborgen `.svn` mappen zijn onderdeel van de revisie (versie) beheer server. Deze zijn **geen** onderdeel van de website, of zoals die online moet komen te staan. De .svn mappen kun je beter niet online zetten. Mocht je namelijk die weer downloaden terug in de website (die ook onder Subversion beheer staat) kunnen er vreemde dingen zich voordoen. Tevens staat het niet netjes om mappen die met een punt beginnen te bewaren op internet. In de meeste FTP programma's zie je die mappen ook niet meer terug.

## Meer mogelijkheden

Natuurlijk is dit maar een simpele eerste opzet en introductie tot Subversion versie beheer op Mac OS X. Veel programma's kunnen gebruik maken van de integratie met Subversion. [Apple's XCode](http://www.apple.com/macosx/developertools/xcode.html) kan ermee communiceren en versie beheer uitvoeren.

### BareBones BBEdit en TextWrangler

[BBEdit](http://www.barebones.com/products/bbedit/) is een geweldige source-code tekst-editor voor bijvoorbeeld het met de hand maken van websites, html, css, php etc. bestanden. BBEdit heeft ook een integratie met Subversion.

#### Regel voor regel verschillen zien tussen revisies

Daarmee kun je bijvoorbeeld, in BBEdit of het **gratis** TextWrangler, bestanden terug draaien naar een bepaalde revisie, **de verschillen (naast elkaar) leggen, tussen twee versies** van bijvoorbeeld HTML, Css, javascripts of PHP scripts. Zodat je kunt zien wat er veranderd is, regel voor regel.

In svnX kun je aangeven dat bijvoorbeeld Apple's FileMerge (onderdeel van Xcode), BBEdit of TextWrangler het programma is waarmee svnX de verschillen kan laten zien tussen revisies. Helaas kan ZigVersion dit niet met externe programma's, maar heeft z'n eigen interne verglijk tool.

Met BBEdit of TextWrangler kun je dan makkelijk de verandering van links naar rechts verschuiven. Dit heet ook wel [diff](http://en.wikipedia.org/wiki/Diff), in Unix taal.

Helemaal top!

### Andere programma's

snvX is een programma om te communiceren met de Subversion repositories. Maar er zijn nog meer (al dan niet commerciele) programma's om dit te doen. Deze kunnen uitgebreiden zijn maar zijn soms lang niet zo intuitief als svnX.

Een echt Mac alternatief is [ZigVersion](http://zigzig.com/). De werking van **SVN client**s is ongeveer hetzelfde (zie stappen-plan begin van dit artikel). Kijk op die website naar [het filmpje](http://zigzig.com/content/view/40/28/) om te zien hoe ZigVersion te werk gaat, voor sommige is dit makkelijker te begrijpen, met Subversion repositories.