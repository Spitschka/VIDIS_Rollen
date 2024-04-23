# Rollenbestätigung POC für VIDIS
POC, der zeigen soll, wie eine Rollenbestätigung in Zusammenarbeit mit VIDIS erfolgen kann.

# Wie sieht der Nachweis konkret aus?
Der Nachweis ist eine PDF-Datei. Die PDF-Datei enthält:
- Die die nachzuweisenden Daten für den Menschen lesbar
- Einen QR Code angebracht, der zu einer Verifizierungsseite (_{APPURL}/qr-code-verify_) führt, um schnell die Echtheit des Nachweises prüfen zu können
- Eine eingebettete XML-Datei, die alle Informationen enthält, um offline die Echtheit prüfen zu können


# Funktionen
## System ist zustandslos
Das System speichert keine Daten auf dem Server.
## Ausstellen von Berechtigungen
Unter _{APPURL}/issue_ können Nachweise für beliebige Daten ausgestellt werden.

## Prüfen von Berechtigungen via QR Code
Der gescannte QR Code (oder die angegebene URL auf dem Nachweis) führen zu einer Seite, die alle Daten nochmals darstellt.

## Prüfen der Berechtigung via Upload
Hier kann eine Berechtigungsdatei hochgeladen werden, um zu prüfen, ob der Nachweis echt ist. Außerdem werden die Daten angezeigt.
