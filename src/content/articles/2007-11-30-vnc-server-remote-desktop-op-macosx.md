---
title: "VNC server remote desktop op MacOSX"
description: "Natuurlijk bestaat er Apple Remote Desktop. Windows computers kunnen ook gebruik maken van RDP (Remote Desktop Connection). Maar het is ook mogelijk om vanaf een Windows computer, met VNC, een Mac of Linux computer te besturen."
pubDate: 2007-11-30
---

**VNC** (Wikipedia: [Virtual Network Computing](http://en.wikipedia.org/wiki/Virtual_Network_Computing)) bestaat al heel lang. Het steld de mogelijkheid om vanaf een andere computer de desktop te delen met een andere computer. Men ziet werkelijk de muis bewegen op het scherm alsof iemand er achter zit te werken. Deze persoon logt in via een **viewer** (programma waarmee verbinding gemaakt wordt met een remote desktop) om alle muis en toetsenbord handelingen over te nemen.

Het voordeel van VNC is dat het **open-source** is en als server (en als viewer) zijnde is het **gratis** te gebruiken.

### VNC server

De **server** is degene waar in de achtergrond een programama'tje draait die toelaat dat deze computer overgenomen kan worden door een **viewer**. De muis en toestenbord worden op het scherm bestuurd door de **viewer**.

### VNC viewer

De **viewer** is de andere computer waarmee je inlogt op de **VNC server**. In dit scherm (al dan niet fullscreen) komt de desktop van de remote **server** te staan. Je kunt je eigen muis en toetsenbord gebruiken om de server te besturen.

Voor Windows zijn er veel **gratis** viewers beschikbaar (bijvoorbeeld [TightVNC](http://www.tightvnc.com/) of [UltraVNC](http://www.uvnc.com/download/index.html)) met elk hun voor en nadelen. Voor de Mac zijn er 2 goede bekende gratis te verkrijgen namelijk die zojuist genoemde [VNC viewer](http://www.redstonesoftware.com/downloads/index.html) en [Chicken of the VNC](http://sourceforge.net/projects/cotvnc/).

### Type operating system

De server kan een Mac, Linux/Unix of Windows computer zijn. De viewer kun je ook op Mac, Linux/Unix of Windows draaien. Dat **maakt niet uit** hoe je dus verbinding maakt. Je neem de muis en het toetsenbord gewoon over van de server. Het gaat nog best snel als je gebruik maakt van VNC.

## Bestaande software

Apple heeft natuurlijk haar **Apple Remote Desktop** en Windows heeft **Remote Desktop**.

Voor Mac's heeft Microsoft zelfs een gratis viewer geschreven ([RDP for Mac](http://www.microsoft.com/mac/otherproducts/otherproducts.aspx?pid=remotedesktopclient)) die verbinding kan maken met een Windows XP computer. Remote Desktop Connection (afgekort tot RDP) staat standaard op Windows XP Professional. Maar niet in de Home editie van Windows XP. Dit moet je uiteraard apart downloaden en erbij installeren.

## Mac OS X Leopard en iChat screen sharing feature

Apple heeft in Leopard eigenlijk al een VNC server ingebouwd. Maar deze ingebouwde VNC server is eigenlijk bedoelt voor [Apple iChat](http://www.apple.com/macosx/features/ichat.html) (screen sharing) en de eigen [Remote Desktop](http://www.apple.com/nl/remotedesktop/). Vanaf een andere computer met een Mac, via VNC, communiceren **kan heel langzaam zijn**.

Dit komt omdat de Mac desktop heel veel (miljoenen) **kleurtjes gebruikt en heel grafisch is**. Daardoor moet er veel informatie over het netwerk / internet verstuurd worden. Daarom lijkt het alsof de Mac ineens (gezien vanaf de viewer) erg traag is. **Dat is dus niet zo maar ligt aan de scherm resolutie, kleur modus en internet verbinding waarmee de viewer kijkt**.

Op Windows, met Remote Desktop, kun je wat opties instellen zodat via remote desktop bijvoorbeeld hooguit 256 kleuren gebruikt wordt. Hierdoor wordt aanzienlijk de snelheid hoger van remote desktop computing.

Met VNC kun je wat opties instellen zoals minder kleuren en JPG compressie. Dan valt zelfs via internet nog aardig te werken met een bijvoorbeeld een thuis Mac.

## Het doel

De Mac willen we besturen vanaf een Windows computer (kan ook een andere Mac zijn met [Chicken of the VNC](http://sourceforge.net/projects/cotvnc/)). Gebruik maken van de open-source VNC Vine server. De Mac wordt de **server** en de Windows computer wordt de **viewer**.

Onderaan laat ik nog een truuk zien voor diegene die een beetje verstand hebben van **Unix, SSH en de command line**, hoe je de VNC server weer op kan starten als deze er plosteling mee stop, crashed of dat we geen verbinding meer krijgen.

## Redstone Vine Server

Download [Redstone Vine Server voor Mac OS X](http://www.redstonesoftware.com/products/vine/server/vineosx/index.html). Hierin zijn zowel de VNC server als de VNC viewer in begrepen. Sleep de VNC viewer naar de `/Applications` map en de VNC server naar de Mac's `/Applications/Utilities` map. Dit doen we omdat de VNC server een utility is, een achtergrond programma. Zodat alles netjes op z'n plek staat op de Mac.

### VNC server instellen

Start Vine Server. Direct zal de VNC server in de achtergrond (Unix deamon) draaien. Dit wordt ook in het onderste venster getoond. We willen natuurlijk niet dat iedereen zomaar kan inloggen.

#### VNC server password

In Mac OS X Leopard zit in `Apple'tje > System Preferences > Sharing` ... vink `Screen Sharing` aan en kies dan `Computer settings` ... ook een standaard optie om gebruikers van VNC viewers te vragen om een **password** alvorens toe te laten voor scrreen sharing.

## Apple's screen sharing uitzetten

Om gebruik te maken van Vine Server moeten we de bestaande screen sharing feature van Mac OS X Leopard eerst uitzetten, als deze nog niet aan stond natuurlijk. Via `Apple'tje > System Preferences > Sharing` ... vink `Screen Sharing` uit.

## Port nummer, firewall en router port-forwarding

In feite gebruikt straks VNC server dezelfde port nummers als Apple's iChat screen sharing feature dat doet. Deze twee achtergrond programma's mogen elkaar niet in de weg zitten met hetzelfde port nummer. Zorg ervoor dat als je gebruikt maakt van een **firewall** dat port nummer **5900 open staat**.

Met een mooi **share-ware** programma als [DoorStopX](http://www.opendoor.com/doorstop/) kun je heel makkelijk zelf de ingebouwde firewall van Mac OS X (Tiger of Leopard) beheren en porten door laten. Dit kan ook met [WaterProof](http://www.hanynet.com/waterroof/), een **gratis** alternatief op bovenstaande.

Als je namelijk de screen sharing feature van Apple zelf uitzet zal ook de firewall port voor deze service gesloten worden terwijl we die juist met VNC nodig hebben.

### Port forwarding

Als je achter een **router** zit (bijvoorbeeld in een netwerk) dan moet je er straks wel voor zorgen dat op de router port nummer 5900 doorverwijst naar de VNC server (in dit geval de Mac). Zodat alle requests (van de VNC viewer) naar de Mac gestuurd worden. Vraag een systeem beheerder om dit verder uit te leggen en in te stellen op de internet router.

Staat de Mac direct op internet aangelosten dan is het allemaal wat makkelijker.

## VNC server password instellen

In de Vine Server gaan we naar de `Preferences`. Op het tabblad `Connection` staat een optie voor Authentication. In feite is dit bijna hetzelfde als de Apple variant in de System Preferences.

### Let op!

Kies een **niet te voorspellen wachtwoord** wat bestaat uit minstens **8 karakters** welke een mix is van **hoofdletters, kleine letters en cijfers**. Immers is het gebruik van een VNC server **best gevaarlijk** omdat je hierdoor compleet toegang biedt tot je Mac in al haar glorie.

### Configuratie

Onder het tabblad **Sharing** geven we ook aan dat we maar 1 VNC connectie tegelijk aan bieden. Vink aan **Allow only one VNC connection at a time, en Keep existing viewer if a new viewer tries to connect**. Vink uit dat we automatisch beschikbaar worden gesteld via **Bonjour**.

Dit voorkomt dat we op Leopard Mac's (in bijvoorbeeld een direct bedrijfsnetwerk) ineens in het linker deel van de **Finder** beschikbaar komen als **screen-sharing computer**.

## Verbinding maken met de Mac VNC server

Nu is het grote moment aangebroken dat we vanaf een andere computer verbinding gaan maken met de Mac voor screen sharing. **Dit gaan we vanaf Windows XP** doen.

### Windows als viewer gebruiken

Download en installeer [TightVNC](http://www.tightvnc.com/) viewer voor Windows XP. We kiezen speciaal deze viewer omdat uit eigen ervaring blijkt dat met deze viewer en wat instelling nog aardig te werken is met de Mac's vele kleurtjes en toeters en bellen omtrent de traagheid van VNC in het algemeen.

Terug op de Mac in Vine Server kijken we naar het hoofdschermpje waar ook vermeld wordt wat het **IP nummer** is van onze Mac. Op de Pc maken we via TightVNC verbinding met dit IP nummer, vul het zojuist zelf verzonnen VNC password in om verbinding te maken met de Mac. Je kunt hier wat opties instellen waar ik zojuist over had met JPG compressie en manier van verbinding maken.

### De Mac desktop!!

De desktop van de Mac wordt zichtbaar en je kunt nu met toetsenbord en muis aan de slag vanaf de Windows computer. Linksbovenin het Windows VNC viewer scherm kun je opties kiezen als fullscreen en de connectie als een bestand (al dan niet met wachtwoord) bewaren. Zodat je de volgende keer alleen maar dit bestand hoeft op te starten om met de Mac een VNC verbinding te openen.

### Virtueel thuis werken

Deze opzet is heel handig voor thuis gebruik. Zet VNC server op een thuis Mac aan. Maak via bijvoorbeeld Windows op het werk verbinding en je kunt alles doen op Mac alsof je thuis zit te werken.

## IP nummer wat wel eens veranderd: DHCP

Computers die via een router een automatisch IP nummer krijgen toegewezen ([DHCP](http://en.wikipedia.org/wiki/Dynamic_Host_Configuration_Protocol): Dynamic Host Configuration Protocol) veranderen wel eens van IP nummer. Houdt dus in de gaten wat het IP nummer is van de Mac als je met VNC geen verbinding krijgt.

## System server

Het zou nog mooier zijn als de VNC server, met wachtwoord, **automatisch opstart als we de Mac aan zetten**. Via de `Preferences` van Vine Server en het tabblad **Startup** kunnen we van de huidige settings een System Server maken. Zodat de VNC server met deze instelling de volgende keer gewoon opstart als we de Mac aanzetten.

## Op afstand de VNC server weer opstarten

Het kan wel eens voorkomen dat het achtergrond (ofwel deamon) programma van deze VNC server er **plotseling mee stopt**. Dan hebben we geen verbinding meer met de Mac. Of het programma crashed.

De enige manier zou zijn om daadwerkelijk naar die Mac te lopen en via de Mac Finder en een muis die VNC server weer aan te klikken. Maar dat gaat natuurlijk niet zo makkelijk als je op je werk zit met de viewer en de VNC server Mac staat thuis.

### SSH (secure shell)

Voor diegene die verstand hebben van Unix en de **command line** volgt hier een handige optie om de VNC server via SSH op de Mac weer op te starten. Zorg hiervoor dat je met SSH kan inloggen op de Mac. Via `Apple'tje > System Preferences > Sharing` vinken we **Remote login (SSH**) aan. Hiermee kunnen we op het IP nummer van de Mac inloggen met een Terminal programma.

#### Console arguments

De VNC server wordt gestart met een aantal arguments. Deze arguments worden normaal gesproken door het Mac OS X Vine server programma gestart. Deze arguments kun je ook zien in de Mac's **Console** programma (`/Applications/Utilities/Console`) voor log analyse. Ofwel in `/var/log/system.log.

### VNC server starten

Maak met een teksteditor 2 onzichtbare bestandjes aan in je **eigen home directory**. Genaamd `.vnc_start` en `.vnc_stop`. Geef het met `chmod 700` Unix uitvoer rechten aan deze 2 bestanden zodat ze via een terminal commando uitgevoerd kunnen worden door alleen jouw als gebruiker.

In Vine Server laten we vervolgens de VNC server als achtergrond programma starten. In de Mac OS X **Console** kunnen we precies zien **welke arguments** er gebruikt worden. Kopieer deze arguments naar het .vnc_start bestandje.

In het bestandje ziet het er dan ongeveer als volgt uit:

#### .vnc_start

    /Applications/Utilities/Vine\ Server.app/osxvnc-server -rfbport 0 -desktop IP-NUMMER-VAN-DE-MAC -rfbauth /Users/MIJN-NAAM/.vinevncauth -nevershared -restartonuserswitch N -UnicodeKeyboard 0 -keyboardLoading N -pressModsForKeys N -EventTap 3 -swapButtons -rendezvous Y &

Natuurlijk zijn 2 dingen in bovenstaande regel veranderd. Dat is het **IP nummer** van de Mac en waar het VNC password bestand staat op je eigen Mac. Voor de oplettende kijker kun je hier ook zien dat het VNC server programma in de `/Applications/Utilities` map bewaard wordt. Pas deze paden dus goed aan!

In het stop bestandje zetten we onderstaande shell scripting.

#### .vnc_stop

    sudo killall osxvnc-server

## Wat te doen als VNC server crashed of we krijgen geen verbinding meer

Je kan natuurlijk via SSH inloggen op de Mac met het **Terminal** programma (`/Applications/Utilities/Terminal`). En met een reboot commando de Mac laten herstarten zodat deze de VNC system server weer opstart.

    sudo reboot

Dit is nogal **overkill** en gaan we niet doen. We gaan de VNC server (de achtergrond 'service' ofwel deamon) opnieuw opstarten met de zojuist gemaakte **uitvoer scriptjes**.

**Login met SSH op de Mac**. Mac gebruikers doen dit via het **Terminal** programma, Windows gebruikers kunnen met het **gratis** [Putty SSH](http://www.chiark.greenend.org.uk/~sgtatham/putty/download.html) doen. Uiteraard moet je een beetje verstand hebben van de Unix terminal en commando's als `ssh -l`.

Zodra we inlogt zijn op de Mac voeren we de volgende commando's uit om er zeker van te zijn dat **VNC niet mee draait**. Dit kun je natuurlijk ook gebruiken om zelf de VNC server te stoppen. En geef een Mac OS X administrator wachtwoord op.

    sudo ./.vnc_stop

Nu kunnen we de VNC server weer **opstarten** door simpel weg het start bestandje te starten.

    sudo ./.vnc_start

Het Unix [sudo](http://en.wikipedia.org/wiki/Sudo) (super user do) commando is misschien niet altijd nodig. De **punt en slash voor de bestandsnamen** betekend dat we deze willen **uitvoeren / starten** vanaf de command line. Met even geduld komen er wat Unix log meldingen voorbij en de promt is weer terug. De VNC server draait weer. Nu kunnen we met de VNC viewer weer inloggen op de Mac.

Op deze manier kunnen we onze Mac scherp in de gaten houden en allerlei andere dingen doen zoals email lezen en schrijven. Eens wat uitproberen met een Mac programma of in de Finder bestanden beheren. Of je kan op deze manier ervoor zorgen dat alleen als je via SSH inlogt en de VNC server met de hand start, dat het mogelijk is om op de Mac met een VNC viewer verbinding te maken.

## Energy saver: automatisch opstarten

Combineer deze hele truuk met de Mac OS X ingebouwde **Energy Saver**. Hier kun je instellen dat de Mac 's morgens om bijvoorbeeld half negen automatisch aangaat. De VNC server gaat dan ook aan en je kan direct aan de slag.
