---
title: "Webdesign & webstandaarden"
description: "Mijn visie op web design en gebruik van web standaarden"
pubDate: 2007-08-31
---

Webdesign hoeft niet moeilijk te zijn. Er zijn (op internet) al heel lang discussies gaande tussen webdesigners 'hoe' je een website het beste zou moeten maken. Hierbij gaat het alleen om de voorkant (front-end) van een website. De HTML, CSS en Javascript. Het punt is dat er geen één manier is hoe het goed doet.

[Yahoo! - Object Oriented CSS video](http://www.stubbornella.org/content/2009/03/23/object-oriented-css-video-on-ydn/)

## Webbrowsers

De bekendste is natuurlijk **Microsoft Internet Explorer** (afgekort: IE) op het Windows platform. Maar bij lange na niet de beste, zeker niet met **HTML** en **CSS** webstandaarden ondersteuning en zijn eigen eigenaardigheden op het gebied van incompatible Javascript.

Vanuit een webdesigners / webdevelopment (HTML/CSS/Javascript, webstandaarden) oogpunt is het een **schande** dat deze webbrowser juist het grootste marktaandeel heeft. De doorsnee beginner die zich op internet waagt denkt vaak dat Internet Explorer 'het' internet is.

### Browser Wars

[Netscape Navigator](http://browser.netscape.com/) had voor de tijd van de [browser wars](http://en.wikipedia.org/wiki/Browser_wars) (rond 1995) het grootste marktaandeel maar verloor deze strijd tegen **Microsoft's Internet Explorer**. Deze werd standaard geinstalleerd en gratis meegeleverd op elke nieuw Windows besturingssysteem.

Natuurlijk met de meeste features maar ook met de meeste HTML/CSS bugs. Maar er zijn natuurlijk nog meer webbrowser bijvoorbeeld [Mozilla Firefox](http://www.mozilla.com/) , [Apple's Safari](http://www.apple.com/macosx/leopard/features/safari.html) en [Operasoft's Opera](http://www.opera.com/). Dit zijn wel een beetje de bekendste alternatieven. Elk met hun eigen voordelen en nadelen, op het gebied van webstandaarden. **Geen enkele webbrowsers doet het perfec**t.

### Wat Internet Explorer 6 mist ten opzichte van andere webbrowsers

IE6 miste een paar essentiele zaken op het gebied van CSS ondersteuning (CSS level 2, en CSS level 3). Denk hierbij aan een aantal vormen van [css selectors](http://www.w3.org/TR/REC-CSS2/selector.html), **PNG** transparantie en bijvoorbeeld de mogelijkheid om alle HTML elementen te voorzien van een :hover effect. Daarbij interpreteerd IE6 sommige HTML en CSS waardes anders dan andere webbrowsers.

Al met al geen pretje dus om een website te bouwen voor Internet Explorer. Vorige versies (IE5.5 bijvoorbeeld) sloegen de plank al helemaal mis op nog meer gebieden wat webstandaarden heet.

### Microsoft Internet Explorer 7

Internet Explorer 6 kwam in 2001 uit en heeft et grootste webbrowser marktaandeel. Windows gebruikers moesten dus zo'n **5 jaar** wachten tot eind 2006 voordat er eindelijk een nieuwe, verbeterde, meer compliant webbrowser uit kwam

Gelukkig maakt IE7 een hoop goed op gebied van webdesign, compliant HTML en CSS. Een hoop bugs zijn verholpen.

## Mozilla Firefox

Voor een webdesigner / webdeveloper zijn een aantal factoren van belang voor het maken van een goede website. Dan gaat het even alleen om de HTML/Css en Javascripting en alles maken volgens de W3C regels (validatie). In ieder geval een goede webbrowser die zich aan de **W3C HTML specificaties** houdt.

### Waarom Firefox?

Het feit dat Internet Explorer het grootste marktaandeel heeft wil niet zeggen dat je voor die browser moet beginnen met het opzetten van je website. IE houdt zich niet altijd aan de HTML en CSS regels. Soms komen er rare bugs te voorschijn die je veel tijd kosten om op te lossen. Bekijk je je website vervolgens in een andere browser en kun je er achter komen dat sommige dingen niet goed uitgelijnd staan dat bepaalde truuken die je hebt toegepast gewoon niet werken.

Daarom, gebruik een webbrowser die zich zo veel mogelijk aan de W3C HTML regels houdt. Dat doen IE6 en in sommige gevallen IE7 dus niet. Webbrowsers als **Mozilla Firefox, Apple's Safari** en de **Opera** webbrowser zijn over het algemeen heel goed in deze specificatie en het ondersteunen van webstandaarden.

### Productie tijd

Bouw je website juist voor compliant webbrowser die allemaal HTML standaarden ondersteunen. Halverwege tijdens het bouwproces kun je eens gaan testen in IE6 en IE7. Mochten daar nog rare dingen naar voren komen kun je die meestal met weinig extra moeite ook oplossen. Dit **scheelt een hoop tijd** en met deze methode is de website, gemaakt met webstandaarden, voor de meest gangbare webbrowsers.

Een hele mooie oplossing hiervoor zijn [conditional comments](http://www.atlantisdesign.nl/webdesign/conditional-comments).

### Extra voordeel bij het gebruik van Mozilla Firefox

Firefox is uit te breiden met vele [add-ons](https://addons.mozilla.org/en-US/firefox/). Dit maakt het leven van een webdesign / webdeveloper vele malen makkelijker om CSS / Javascripts bugs op te lossen. Of om te kijken waarom en ontwerp niet goed past. Of om fouten op te lossen in de HTML.

Op Atlantisdesign staat ook een speciale pagina over Mozilla Firefox en de meest handige Firefox [Add-ons](http://www.atlantisdesign.nl/mozilla-firefox#firefox-addons).

## De 3 lagen van een website

Webdesign is ook de kunst van het goed, compliant schrijven van gestructureerde HTML. Dat begrijpen sommige (beginnende) webdesigners, of klanten, niet helemaal. Een website bestaat uit verschillende lagen.

Het woord 'design' is dan ook een beetje misleidend. Natuurlijk moet een website ook een beetje smoel hebben. Vaak wordt er een ontwerper (designer) gebruikt om de kleuren te bepalen, de compositie en de layout. Een copywriter gaat aan de slag om de juiste woorden te vinden die de boodschap duidelijk overdragen.

### Ultieme doel: seperatie
Het ultieme doel van websites bouwen is de **complete seperatie** van de 3 lagen. Structuur scheiden van presentatie en scheiden van interactie (ofwel behaviour). Door goede seperatie van HTML, CSS en Javascripting kunnen niet alleen webbrowsers gebruik maken van het omvangrijke internet maar ook PDA's, web-mobieltjes.

Daarmee helpen we ook de minder valide mens. Mensen die slect ziend zijn hebben meestal en hulp middel om internet pagina's voor te laten lezen. Om op deze manier toch informatie van het internet te verkrijgen. Deze mensen hebben het meeste aan laag 1 (structurele HTML). Een [screenreader](http://en.wikipedia.org/wiki/Screen_reader) leest de HTML voor aan de gebruiker, kijkt niet naar de opmaak (laag 2) en voert ookg een javascripting uit (laag 3).

Op basis van de voorgelezen tekst maakt de minder valide persoon een keus om verder te klikken op pagina's. Als de website een grote soep is aan tabellen en onzinnige HTML wordt het er voor die mensen ook niet duidelijker op.

### En het design dan?

Het design van een website is ook onderdeel van het traject. Apart gezien van het design komen er natuurlijk veel meer factoren bij kijken.

Hieronder een versimpelde uitleg over de 3 lagen van een website.

## Laag 1: Structuur, semantic, compliant HTML

Het W3C heeft altijd gezegd dat haar HTML specificaties een 'recomendation' zijn voor webbrowsers. De makers van webbrowsers gaven hier in de tijd van de browser wars hun eigen intepretatie aan. Waardoor er veel onzinnige HTML-tags en javascripting bedacht werd wat natuurlijk incompatible was met de andere webbrowsers.

Het komt er op neer dat HTML volgens de W3C regels geschreven wordt. Geschreven wordt naar de **betekenis** van een HTML-element (**semantic**). Een HTML **H1 element** wordt niet zomaar gebruikt omdat deze nou juist groot en bold is. Het H1 element heeft een betekenis, namelijk dat het de belangrijkste kop is op een HTML pagina. Met CSS kun je ervoor zorgen dat deze, bij standaard, grote kop juist heel klein met een niet opvallende kleur.

### Waar dient het voor?

De bedoeling van de eerste laag is een **gestructuureerde road-map** (ofwel **DOM**-tree) te maken waarop de volgende lagen hun specifieke toepassing op kunnen uit oefenen. Namelijk **CSS** (Cascading Style Sheets) en **Javascripting**.

Zonder deze gestructureerde basis laag hebben de volgende opzichzelf staande lagen niet veel nut. Schrijf de HTML zo netjes mogelijk. Zorg voor goede HTML nesting: geen block-level elementen in inline-elementen plaatsen.

#### Onderstaande is goede HTML

	<p>Deze paragraaf is netjes geschreven, dit <strong>woord</strong> is in bold gestyled</p>

#### Deze HTML is fout geschreven

	<p>Deze paragraaf is netjes geschreven, dit <div><font-weight:bold>woord</font></div> is in bold gestyled

## Laag 2: Presentatie, ofwel Cascading Style Sheet (CSS)

De basis kennis voor deze laag kan verassend simpel zijn. Door gebruik te maken van stylen en deze toe te kennen aan HTML elementen vormt zich een consistent geheel wat heel snel en makkelijk te onderhouden is.

### Waar dient het voor?

Deze laag wordt ook wel de **presentatie laag** van een HTML pagina genoemd. Het bepaald 'hoe' HTML elementen eruit ziet. Het bepaalt hoe groot de tekst is, wat de kleur is, wat de onderliggend relatie is met naast gelegen HTML element. Zo ook lichte vorm van effecten bij interactie met de muis.

Het mooiste is als de CSS apart in een extern bestand wordt bewaard en aan de HTML pagina's gelinked wordt.

Met een paar regels CSS is de gehele website te stylen over ontelbare pagina's. Als de klant toch besluit om alle links in de website niet blauw maar rood te laten maken is het een kwestie van 1 regels CSS aanpassen. Dit wordt door de hele website doorgevoerd.

### Boeken

[Eric Meyer](http://meyerweb.com/), de koning van CSS genoemd, heeft een aantal [goede boeken](http://www.atlantisdesign.nl/webdesign/boeken#eric-meyer-more-eric-meyer-on-css) hierover geschreven. Aan de hand van praktijk voorbeelden laat hij een re-design van een doorsnee website zien. Eerst de manier zoals het op de oude manier gemaakt zou zijn en daarna op de manier van gestructureerde HTML en CSS voor opmaak.

## Laag 3: Interactie, ofwel Javascripting

Met Javascripting kunnen interactive elementen in een HTML pagina gebruikt worden. Met interactie van de gebruiker kunnen verschillende effecten gerealiseerd worden. Van het simpel weg een plaatje vervangen door een andere, verborgen HTML elementen laten tonen tot complexe vormen en functies toekennen aan bepaalde elementen waarop geklikt kan worden. Zelfs animatie hoort tot de mogelijkheden.

### Waar dient het voor?

Deze laag zorgt voor interactie, verandering en vernieuwing. Zonder de eerste laag (gestructureerde HTML) kan deze laag zijn werk niet doen. Javascripting zelf heeft de **DOM-tree** nodig om bepaalde HTML elementen te veranderen, te vernieuwen, bij te bouwen, weg te halen en bepaalde effecten te bereiken. Dit kan niet zonder structuur van de eerste laag.

### Boeken

**Jeremy Keith** heeft een geweldig boek geschreven voor mensen die al wat verstand van HTML en CSS hebben en graag de stap willen maken naar Javascripting. In zijn boek [Dom-Scripting](http://www.atlantisdesign.nl/webdesign/boeken#jeremy-keith-domscripting) legt hij vanuit dit oogpunt uit hoe je verder Javascript kan toepassen op een **unobtrusive** manier.

Als dit allemaal onder de knie is gaat **John Resig**, met het boek [Pro Javascript Techniques](http://www.atlantisdesign.nl/webdesign/boeken#john-resig-pro-javascript-techniques), een stapje verder, ook met het uitgangspunt van Dom-Scripting, maar vereenvoudigd een hoop zaken waardoor de gemaakte Javascripts vele malen korter in notering worden en snel toegepast kunnen worden.