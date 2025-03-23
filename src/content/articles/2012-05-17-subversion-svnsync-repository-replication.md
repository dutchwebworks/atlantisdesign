---
title: "Subversion svnsync repository replication"
description: "Met svnsync kan een slave-repository gesynchroniseerd worden met een master-repository. Een handige manier om een Subversion repository incrementeel te backupen. Dit kan naar een (externe) backup schijf of een andere computer over het netwerk."
pubDate: 2012-05-17
---

In het SVN-book, hoofdstuk **Repository Replication** (PDF vanaf pagina 155) wordt het niet helemaal duidelijk uitgelegd.

Hier volgt een uitleg hoe een bestaande **master-repository** gesynchroniseerd wordt naar een (lege) **slave-repository**. De master repository moet via een authentication systeem (Apache of svnserve) geserveerd worden. Dit heeft te maken met zogenaamde svn hooks die toegang verlenen tot svn repositories.

### Master-repository

De master-repository is te bereiken op onderstaande url. Lees het artikel over Subversion [svnserve automatisch opstarten](http://www.atlantisdesign.nl/artikel/subversion-svnserve-automatisch-opstarten) hoe je het `svn://` protocol aan de praat krijgt.

    svn://mijn-mac.local/mijnwebsite

Via het `/etc/hosts` bestand wordt het **127.0.0.1** IP nummer gekoppeld aan een fictieve `mijn-mac.local` nepdomein. Met deze opzet wordt er naar een domeinnaam verwezen welke in feite onze eigen Mac is.

### Slave-repository (empty)

In dit voorbeeld willen we de master-repository backupen naar een **externe backupschijf** welke direct aan de Mac hangt (bijvoorbeeld USB / Firewire). Deze repository is te bereiken via onderstaand pad met het normale `file://` protocol:

    file:///Volumes/Backupdisc/svn_sync/mijnwebsite

## Slave-repository aanmaken

De master-repository bestaat reeds en is al enige tijd mee gewerkt. De slave-repository moet leeg zijn voordat deze gebruikt kan worden als replication mirror.

Maak een lege slave-repository aan op de backup schijf, maak eventueel ook de juiste mappen aan (`svn_sync/`). Open de **Terminal** (`/Applications/Utilities/Terminal`)

#### Lege slave-repository

    svnadmin create /Volumes/Backupdisc/svn_sync/mijnwebsite

Deze slave-repository is nu leeg en klaar voor gebruik. **Gebruik deze repo. ook alleen voor synchronisatie doeleinden**. Niet voor dagelijks gebruik of andere zaken. Anders kan deze repo. niet goed meer geschroniseerd worden.

## Hooks

In de hooks map van de slave-repository moeten 2 hookscripts geplaats worden. Deze wordt gestart door Subversion bij bepaalde acties zoals het vooraf gaan aan een `svn commit` en **property-changes**.

In beide gevallen wordt gecontroleerd of de synchronisatie door de `syncuser` wordt uitgevoerd.

### start-commit (onderstaande is 1 regel)

Plaats dit voorbeeld [start-commit](http://www.atlantisdesign.nl/public/svnsync_start-commit_hook.txt) hookscript:

    #!/bin/sh
    USER="$2"
    if [ "$USER" = "syncuser" ]; then exit 0; fi
    	echo "Only the syncuser user may commit new revisions" >&2
    exit 1

&hellip; in de volgende map met de juiste naam:

    /Volumes/Backupdisc/svn_sync/mijnwebsite/hooks/start-commit

En zet de Unix permission met de **Terminal** zo dat dit script uitgevoerd kan worden (onderstaande is 1 regel).

    chmod ugo+x /Volumes/Backupdisc/svn_sync/mijnwebsite/hooks/start-commit

### pre-revprop-change (onderstaande is 1 regel)

Plaats dit voorbeeld [pre-revprop-change](http://www.atlantisdesign.nl/public/svnsync_pre-revprop-change_hook.txt) hookscript:

    #!/bin/sh
    USER="$3"
    if [ "$USER" = "syncuser" ]; then exit 0; fi
    	echo "Only the syncuser user may change revision properties" >&2
    exit 1

&hellip;in de volgende map met de juiste naam:

    /Volumes/Backupdisc/svn_sync/mijnwebsite/hooks/pre-revprop-change

Ook hiervan zetten we de juiste Unix permissions (onderstaande is 1 regel):

    chmod ugo+x /Volumes/Backupdisc/svn_sync/mijnwebsite/hooks/pre-revprop-change

## Usermanagement / password

De slave-repository wordt gebruikt om te synchorniseren. Deze maakt gebruik van bovenstaande hookscripts die controleren of een bepaalde gebruiker de syncrhonisatie mag uitvoeren. Namelijk de `syncuser`. In een password bestand wordt deze gebruiker aangemaakt me een plain text-password.

### passwd (onderstaande is 1 regel)

Plaats dit voorbeeld [passwd](http://www.atlantisdesign.nl/public/svnsync_passwd.txt):

    [users]
    syncuser = mysecret

&hellip; bestand in onderstaande map met de juiste naam:

    /Volumes/Backupdisc/svn_sync/mijnwebsite/conf/passwd

### Repository configuratie

Nu moeten we voor de slave-repository nog aangeven hoe deze is geconfigureerd. Plaats dit voorbeeld [svnserve.conf](http://www.atlantisdesign.nl/public/svnsync_svnserve_conf.txt)

    [general]
    anon-access = none
    auth-access = write
    password-db = passwd
    realm = my slave-repo name

&hellip; in de juist map met de juiste naam:

    /Volumes/Backupdisc/svn_sync/mijnwebsite/conf/svnserve.conf

In dit bestand kun je de slave-repository ook een goede naam geven:

    realm = my slave-repo name

## Initialisatie

De setup is bijna klaar. We geven nu aan dat de slave-repository geinitialiseerd moet worden aan de master-repository.

Deze zal dat vanaf nu onthouden. Bij een synchronisatie commando weet de slave-repository welke master-repository deze moet **repliceren** en waar deze de vorige keer is gebleven. Open de **Terminal** en typ onderstaande:

Onderstaande is 1 regel:

    svnsync init file:///Volumes/Backupdisc/svn_sync/mijnwebsite svn://mijn-mac.local/mijnwebsite/

In beeld verschijnt er een melding welke aangeeft dat de properties gekopieerd zijn van de master-repository.

`Copied properties for revision 0.`

## Synchroniseren

Met 1 commando naar de slave-repository geven we aan dat de master-repository alle **changesets** moet repliceren naar de slave-repository. De slave-repository intepreteerd alle **changesets** weer en maakt op die manier een exacte kopie van de master-repository. In de **Terminal**:

    svnsync sync file:///Volumes/Backupdisc/svn_sync/mijnwebsite

De volgende keer dat er weer gesynchroniseerd moet worden pakt de slave-repository het punt weer op waar de is gebleven ten opzichte van de master-repository.

### Unix shell scripts en cron-achtige preiodieke taken

Op deze manier kun je de synchronisatie commando's allemaal verzamelen in bijvoorbeeld 1 Unix shell script. Voer dit script uit en alle svnsync acties worden uitgevoerd.

MacOS X heeft uiteraard ook zoiets als periodieke taken. Het oude [Unix cron](http://en.wikipedia.org/wiki/Cron) is uiteraard nog aanwezig. Apple heeft dit vervangen door **launchd**. Met [launchd](http://developer.apple.com/macosx/launchd.html) kun je ook dit soort shell scripts laten uitvoeren op bepaalde tijden.

Op **YouTube** staat ook een saai [filmpje over launchd](http://www.youtube.com/watch?v=mLwn_TbBntI).
