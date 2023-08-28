---
title: "Postfix mail server op MacOS X Tiger"
description: "Activeer de ingebouwde mail server van Mac OS X. U kunt nu vanaf uw eigen Mac direct mail versturen."
pubDate: 2005-07-31
---

# Postfix mail server op MacOS X Tiger

De ingebouwde mail server van Mac OS X Panther en Tiger staat standaard uit. Sinds Panther en nu ook Tiger heeft Apple de [Postfix](http://en.wikipedia.org/wiki/Postfix_(software)) mail server in onze Mac's ingebouwd. Alle Unix, en dus ook Mac OS X, en Linux systemen hebben een ingebouwde mail server.

Wat kan ik met deze **MTA** (Mail Transfer Agent)? Stel u heeft een iBook of Powerbook, u wisseld vaak van locaal netwerk en internet verbinding. U neemt uw laptop wel eens mee naar huis of naar een klant. U heeft een aantal websites draaien op uw eigen Mac die email versturen. Dan is het makkelijker om de mail server te gebruiken die al op uw Mac staat.

Veel internet providers laten niet toe dat u email verstuurd via hun eigen mail servers als u via een andere internet aanbieder bent ingelogd op het internet. Klikt ingewikkeld maar het komt vaak voor.

## Postfix

Op internet zijn er een aantal websites waar beschreven wordt hoe men de Postfix mail server kan activeren. Hierbij komen nogal wat Unix commando's en kennis bij kijken. Apple heeft de mail server ingebouwd maar deze **staat niet aan** voor de gewone gebruikers.

### Postfix Enabler

De Mac manier zou zijn om een programma'tje te downloaden die al die ingewikkelde Unix commando's voor ons uitvoerd. Ene **Bernard Teo** heeft speciaal voor de client versies van Mac OS X het **shareware** programma'tje [Postfix Enabler](http://www.cutedgesystems.com/software/PostfixEnabler/) gemaakt. Het shareware programma'tje kost $9,99-,

Download het programma en zorg ervoor dat u als administrator van uw Mac het programma opstart. Het enige wat u moet doen is uw naam invullen bij 'Administrator' en op de knop **Enable Postfix** te klikken. Nu gaan er in de achtergrond een paar Unix commando's draaien die bepaalde configuraties veranderd aan uw Mac. Zodra de boodschap verschijnt dat alles klaar en gelukt is heeft een volwaardige [SMTP](http://en.wikipedia.org/wiki/SMTP-AUTH) (uitgaande mail) server draaien.

##Configureren van Apple's Mail programma

Alle mail programma's, bijvoorbeeld Apple's Mail, Eudora, Mozilla Thunderbird en Microsoft Outlook Express en Entourage voor de Mac, kunnen ook zo ingesteld worden dat ze mail sturen met behulp van een andere SMTP server. Namelijk die nu op uw eigen Mac draaid.

Als voorbeeld nemen we Apple's Mail. In de voorkeuren van uw Account. `Mail > Preferences > Accounts` dan het tabblad `Account Information` staat onderaan een pulldown menu en een 'Settings' knop voor de **SMTP** opties. Hier kunt u aangeven dat ons mail programma de 'localhost' moet gebruiken als mail server.

Klik op **Server Settings** en voeg een nieuwe SMTP server toe met de volgende instellingen:

Outgoing Mail Server: `localhost`

Laat de port op 25 staan en klik op OK. U kunt nu een nieuw Mail bericht aanmaken en deze versturen naar bijvoorbeeld u zelf. Als de mail ook daadwerkelijk verstuurd wordt en door uw eigen mail programma weer ontvangen wordt werkt alles naar behoren.

U kunt de **mail headers** bekijken of er gebruik wordt gemaakt van uw eigen locale mail server. In Apple's Mail klikt u op `View > Message > Long Header`, u zult zien dat er extra informatie naar voren komt welke weg het mailtje, dat u zojuist heeft ontvangen, heeft afgelegd. Als het goed is staan daar teksten in als 'localhost' en 'postfix'.

## Postfix in en web ontwikkel omgeving

Als u webdesigner of webprogrammeur bent kunt u ook met behulp van PHP mail versturen vanaf uw eigen Mac. U ontwikkeld websites en test de PHP scripts op uw eigen Mac. Nu kunt u ook de **HTML mail formulieren** testen. De mail die verstuurd wordt door PHP zal gebruik gaan maken van de zojuist geactiveerde Postfix mail server.

## Conclusie

Postfix is net als Sendmail een heel ingewikkeld Unix mail programma. Het wordt veel gebruitk op internet en alle mail, die u heel makkelijk ontvangt met uw eigen Mail programma, is waarschijnlijk vertuurd via Postfix of Sendmail mail server op een Unix systeem.

Deze handleiding is alleen bedoeld om vanaf uw eigen Mac mail naar buiten te sturen. Met de Postfix Enabler zijn er nog veel mogelijkheden. U kunt ook de engelse instructies lezen op de download pagina van dit shareware programma.