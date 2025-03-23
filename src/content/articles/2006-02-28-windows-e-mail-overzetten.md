---
title: "Windows e-mail overzetten"
description: "Oke, je hebt nu je eigen Mac. Zou het niet handig zijn om je oude e-mail van je Pc Outlook Express naar je Mac te kunnen krijgen?"
pubDate: 2006-02-28
---

We gaan de Pc Microsoft Outlook Express (kan volgens mij ook met de gowone versie) e-mail overzetten naar onze Mac. Het eindresultaat is dat alle e-mail van je oude Pc overgebracht is in Apple's Mail programma met een paar tussen truuks en een programma.

Er zijn hier ook, misschien wel gratis, alternative kant en klare programma'tjes om dit doen maar hier volgt een manier die zeker werkt. Er is zelfs een commercieel programma **Little Machines** [O2M](http://www.littlemachines.com/) dat dit voor je kan doen.

## Wat hebben we hierbij nodig?

- De Pc met Outlook Express
- Een manier om tussen de Pc de Mac bestanden over te zetten, zoals een netwerk, USB stick of gewoon een ouderwets cd'tje bakken
- De trail ofwel **test-drive** versie van [Microsoft Office 2004](http://www.microsoft.com/mac/default.aspx?pid=office2004td) voor Mac

Microsoft Entourage (Microsofts nieuwe Office versie van Outlook voor Mac OS X) gaan we gebruiken als tussen programma om het uiteindelijk in Apple's Mail te importeren. De manier waarop de verschillde mail programma's hun opslaan verschilt nogal. Apple heeft ervoor gekozen om elke mailtje als een aparte file op te slaan op de harde schijf. Zie de map `~/Library/Mail/<pop account>/INBOX.mbox/messages/` (de ~ staat voor je eigen thuis map) daar staan allemaal zogenaamde .emlx bestanden.

#### Waarom losse bestanden?

Apple's Mail programama bewaard deze mails los zodat de zoek technologie [Spotlight](http://www.apple.com/nl/macosx/features/spotlight/) ook kan zoeken in mailtjes die je ontvangen hebt.

## Eerste stap is op de Windows computer

Duik achter je oude Windows computer en start Microsoft Outlook Express op. Maak op de dekstop (of direct via het netwerk een verbinding naar je Mac) een map aan die bijvoorbeeld **Pc mail** heet.

Zorg ervoor dat je in je Inbox van Outlook met ctrl+a alle mailtjes selecteerd in het overzicht. Sleep nu alle mailtjes over naar deze map op je desktop. Dat zal een tijdje duren omdat de Windows computer met Outlook alle mailtjes gaat omzetten naar `.eml` betanden.

Als je in je Outlook programma meerdere mappen hebt aangemaakt kun je deze truuk natuurlijk apart doen voor elke map. Zodoende kun je deze structuur ook weer terug op de Mac.

Kopieer nu deze hele map met .eml bestanden over het netwerk naar de Mac toe. Of zet ze op een cd'tje of via een USB stick.

## Microsoft Entourage op de Mac

Download en installeer de **gratis** test-drive versie van [Microsoft Office 2004](http://www.microsoft.com/mac/default.aspx?pid=office2004td) voor de Mac. Zorg ervoor dat Entourage niet het standaard email programma op de Mac wordt. We willen natuurlijk gebruik blijven maken van Apple's eigen [Mail](http://www.apple.com/nl/macosx/features/mail/) programma.

Open Entourage en maak een demo/nep account aan die we niet gaan gebruiken. Maak in de Inbox een nieuwe map aan die we voor het gemak **importeer** noemen. **Sleep** nu de losse .eml bestanden die van de Pc vandaan komen in deze importeer map.

#### Let op!

Sleep de bestanden **niet** naar de echte Inbox van Entourage. Let er ook op dat **wat** je selecteerd tijdens deze sleep actie **ook alleen maar** `.eml` bestanden zijn.

#### Uitwisselbaarheid

Entourage gaat de mailbox binnen z'n eigen programma opnieuw opbouwen. Immers zijn beide programma's, Outlook en Entourage, van Microsoft zelf. Dus de uitwisseling van deze programma's kunnen we goed gebruiken.

## Apple's Mail import actie

Als alle email bestanden in de goede mappen in Entourage staan kunnen we deze structuur overbrengen naar Apple's Mail programma. Voor de goede orde laten we Entourage z'n eigen ge?mporteerde mail database even opnieuw opbouwen. Sluit Entourage. Houdt de Option toets (ofwel Alt) vast en start Entourage opnieuw op. Kies in het menu voor **Rebuild Database**. Sluit na deze actie Entourage weer af

Open Apple's Mail en maak eventueel, als je het voor de eerste keer gebruikt, een account aan. Onder `File` kies je voor `Import`. Kies voor **Microsoft Entourage** en volg de instructies op het scherm.

Na enige tijd komen er zogenaamde import mappen aan de linkerkant te staan waar de mail in staat die voorheen op je Windows Outlook Express computer stonden. Nu kun je zelf de mail die voorheen in de Inbox stond op de Pc verslepen naar de echte Inbox van je Mac's Mail programma.
