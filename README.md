# Istope STIN

1. [Deutsch](#1)
2. [English](#2)

## <a name="1"></a>1. Deutsch

Diese Erweiterung verwaltet die EU-STIN (European Union Sales Tax Identification Number) auch bekannt als "EU Ust-ID", "EU VAT ID" or "EU MwSt-ID").

**Installation**

* Installieren der Erweiterung.
* Im Back-End rufen sie bitte unter "Isotope eCommerce" den Menüpunkt "Shop-Konfiguration" auf.
* Unter der Überschrift "Allgemeine Einstellungen" öffnen sie die "Konfigurationen".
* Wählen sie ihren Shop aus und öffnen diesen zur Bearbeitung.
* Unter der Überschrift "Adresse" geben sie bitte das Land an in dem der Shop beheimatet ist (z.B. "Deutschland").
* Wenn sie eine qualifizierte Benachrichtigung (als Nachweis für das Finanzamt) der Prüfung der EU Umsatzsteuer-ID-Nummer erhalten möchten, dann geben sie bitte Ihre EU Umsatzsteuer-ID-Nummer an (siehe auch unten).
* Aktivieren sie das Feld "EU Umsatzsteuer-ID-Nummer" bei den "Rechnungs-Adressfelder".
* Öffnen sie den Bereich "EU Länder Konfiguration".
* Prüfen / wählen sie die EU Länder aus (eine Mehrfachauswahl durch anklicken bei gleichzeitigem Drücken der Strg-Taste ist möglich).
* Schließen sie die Shop-Konfiguration.

* Unter der Überschrift "Bestellablauf" öffnen sie "Steuersätze".
* Legen sie für jedes EU Land einen Steuersatz mit 19% an (wenn ihr Shop in Deutschland beheimatet ist; ansonsten geben sie den im Heimatland gültigen MwSt.-Satz an).
* Bitte nicht vergessen: Im Bereich "Konfiguration EU Umsatzsteuer-ID-Nummer" muss die Check-Box "Ist eine MwSt." aktiviert sein.

* Unter der Überschrift "Bestellablauf" öffnen sie bitte "Steuerklassen".
* Erstellen sie eine neue Steuerklasse (z.B. "EU-Steuer") und fügen aller europäischen Steuersätze im Bereich "Steuersätze" hinzu.
* Bei der Definition der Produkte vergessen sie bitte nicht die neue Steuerklasse "EU-Steuer" auszuwählen.

**Benutzung**

* Bei der Bestellung wird ab sofort das Feld "EU Umsatzsteuer-ID-Nummer" mit angezeigt.
* Bei der Eingabe in dem Feld wird die EU Umsatzsteuer-ID-Nummer online abgeprüft.
* Sollte bei der Prüfung ein Fehler auftreten, so wird eine entsprechende Meldung ausgegeben.
* Ist die EU Umsatzsteuer-ID-Nummer gültig, so wird die Steuer nicht berechnet. **Achtung**: Wenn in der Shop-Konfiguration als Land des Shop z.B. Deutschland ausgewählt wurde und die bei der Bestellung eingegebene EU Umsatzsteuer-ID-Nummer aus dem gleichen Land stammt, so wird die MwSt. berechnet.
* Haben sie bei der Konfiguration des Shops ihre EU Umsatzsteuer-ID-Nummerangegeben, so wird an die e-Mail Adresse des Shops eine Nachricht geschickt, die sie bei Rückfragen durch das Finanzamt als Nachweis vorlegen können. Die e-Mail beinhaltet den Tag der Abfrage und eine vom EU Server zurück gelieferte eindeutige Kennung. Gleichzeitig enthält die Mail die in Contao eingegebenen Kundendaten sowie (soweit vorhanden) die vom EU Server zurück gelieferten Kundendaten. Sie können diese Daten zu einem manuellen Abgleich der Kunden verwenden - eine automatischer Abgleich ist nicht möglich, da verschiedene Länder die Auslieferung dieser Daten nicht zulässt und somit die Felder leer sind.
* In verschiedenen Formularen kann der Insert-Tag `{{eu_stin::TEXT}}` verwendet werden. Sollte aufgrund der gültigen STIN keine Steuer berechnet werden, so wird der Text angezeigt (ansonsten wird der Text weg gelassen) - der Tag kann zum Einblenden eines Textes wie z.B. "Steuerschuld verlagert" verwendet werden.
* In verschiedenen Formularen kann der Insert-Tag `{{eu_stin_no::TEXT}}` verwendet werden. Der Text wird immer dann angezeigt, wenn die Steuer berechnet wird (ansonsten wird der Text weg gelassen).

**Test**

* Wählen sie in ihrem Shop das Produkt aus und (**wichtig!**) klicken sie bis zum "Bestellübersicht" durch. Erst hier wird von Isotope die Steuer berechnet und sie können prüfen, ob die MwSt. berechnet wurde (oder eben auch nicht).

**Besonderheiten**

* Diese Erweiterung stellt das Feld "EU Umsatzsteuer-ID-Nummer" auch für alle Contao "Mitglieder" zur Verfügung (siehe "Benutzerverwaltung -[>] Mitglieder" im Bereich "Adressdaten") - sie können das Feld also auch im Modul "Registrierung" und "Persönliche Daten" verwenden.
* Die Online-Prüfung des Feldes wird nur bei Änderungen am Feldinhalt durchgeführt.
* Wenn Sie in der Shop-Konfiguration eine Deutsche STIN angegeben haben und der EU Server nicht erreichbar ist, so wird auf den Seiten des zentralen Bundesamtes für Steuerneine Kurzabfrage durchgeführt.

Viel Spaß bei der Benutzung!

<a href="https://www.paypal.com/donate?hosted_button_id=RQMP8CWD2Y2XC" target="_blank">
  <img src="https://www.paypalobjects.com/de_DE/DE/i/btn/btn_donateCC_LG.gif" alt="Spenden mit PayPal"/>
</a>
<a href="https://community.contao.org/de/showthread.php?34238-isotope_stin" target="_blank">
  <img src="https://community.contao.org/de/images/layout/contao_community.svg" alt="Unterstützung" width="100" height="50"/>
</a>

## <a name="2"></a>2. English

This extension handles EU-STIN (European Union Sales Tax Identification Number) also known as "EU Ust-ID", "EU VAT ID" or "EU MwSt-ID").

**Installation**

* Install extension.
* In back end open "Store configuration" in "Isotope eCommerce" section.
* Under head line "General settings" please open "Store configurations".
* Select your shop and open for editing.
* In section "Address configuration" please enter the country where your shop is located (e.g. "Germany").
* If you want to receive a qualified notification (as evidence for your tax office) for validation of STIN, please enter your own STIN (for more information see below).
* Activate for field "EU sales tax ID number" in "Billing address fields".
* Open section "EU country configuration".
* Check / select all EU countries (you may select multiple countries by holding down the Strg key during selection).
* Close shop configuration.

* Under head line "Checkout Flow" please open "Tax rates".
* Create a tax rate with 19% for each European country (if your shop is located in Germany; else use the specific sales tax rate of the home country of your shop).
* Please don't forget: You need to active "The tax rate is an EU VAT" in section "EU tax id configuration".

* Under head line "Checkout Flow" please open "Tax classes".
* Create a new tax class (e.g. "EU-Tax") and apply all European tax rates previously defined in section "Tax rates".
* Don't forget to use tax class "EU-Tax" during product definition.

**Usage**

* During customer ordering a new field "EU sales tax ID number" is now available.
* During processing of input address data, STIN is checked online.
* If any error occurs during check, a message will be displayed.
* If STIN is validated, no tax will be applied. **Warning:** If you've specified e.g. Germany as your location of shop and a STIN from this country is entered, then tax is still applied.
* If you've entered a STIN in shop configuration, then a e-mail will automatically be send to "Shipping E-mail address". This mail can be used as qualified evidence for a STIN check for your tax office. The e-mail contains a unique identifier and all address data entered by customer and (if available) all data related to STIN returned by EU server. You can use this e-mail to verify customer. A automatic verification of address data is not possible since each country has different restriction which data is made available through by EU server (in some countries no data is returned at all).
* In multiple forms you may use the Insert Tag `{{eu_stin::TEXT}}`. As soon as customer entered a valid STIN and no tax apply, then "TEXT" will be inserted into form (else text is dropped). You can use this for inserting something like "VAT reversed".
* In multiple forms you may use the Insert Tag `{{eu_stin_no::TEXT}}`. If tax applies then "TEXT" will be inserted into form (else text is dropped).

**Test**

* Select a product in your shop and (**important!**) click until you reach the "Order Review" page. This is important, because Isotope does apply only here.

**Specifics**

* This extension makes the "EU sales tax ID number" field also available to all Contao "Member" (see "Account Manager-[>]Members" section "Address details") - you may use this field in "Registration" and "Personal Data" module.
* The online check is only performed during updates to field content.
* If you've specified a German STIN in shop configuration and EU server is down a fallback call to "Zentrales Bundesamtes für Steuern" will be performed.

Please enjoy!

<a href="https://www.paypal.com/donate?hosted_button_id=RQMP8CWD2Y2XC" target="_blank">
  <img src="https://www.paypalobjects.com/en_US/DK/i/btn/btn_donateCC_LG.gif" alt="Donate with PayPal"/>
</a>
<a href="https://community.contao.org/de/showthread.php?34238-isotope_stin" target="_blank">
  <img src="https://community.contao.org/de/images/layout/contao_community.svg" alt="Support" width="100" height="50"/>
</a>
