<?php

/**
 * sync*gw IsotopeSTIN Bundle
 *
 * @copyright  http://syncgw.com, 2013 - 2018
 * @author     Florian Daeumling, http://syncgw.com
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

$GLOBALS['TL_LANG']['IsotopeStin']['country_code'] 	= 'Das L&auml;nderk&uuml;rzel "%s" entspricht nicht dem gew&auml;hlten Land!';
$GLOBALS['TL_LANG']['IsotopeStin']['country_scope']	= 'Das L&auml;nderk&uuml;rzel "%s" ist kein EU Land!';
$GLOBALS['TL_LANG']['IsotopeStin']['invalid'] 		= '"%s" is keine g&uuml;ltige EU Umsatzsteuer-ID-Nummer!';
$GLOBALS['TL_LANG']['IsotopeStin']['connect'] 		= 'EU Server nicht erreichbar - bitte versuchen Sie es sp&auml;ter noch einmal!';
$GLOBALS['TL_LANG']['IsotopeStin']['connect_err'] 	= 'Verbindungsfehler mit EU Server - bitte versuchen Sie es sp&auml;ter noch einmal!';
$GLOBALS['TL_LANG']['IsotopeStin']['mail_subj']		= 'Pruefung der EU Umsatzsteuer-ID-Nummer %s';
$GLOBALS['TL_LANG']['IsotopeStin']['mail']			= 'Sehr geehrte(r) ##shop_firstname## ##shop_lastname##,

die "EU Umsatzsteuer-ID-Nummer" ##billing_address_eu_stin## wurde erfolgreich am ##request_date## auf dem Server http://##hostname##/ geprueft.

Die eindeutige Abfragenummer lautet "##request_id##".

Wenn eine ID verfuegbar ist, dann koennen Sie diese Mail als Nachweis fuer das Finanzamt verwenden.

Daten aus Contao:

Firma:        ##billing_address_company##
Strasse:      ##billing_address_street##
Postleitzahl: ##billing_address_postal##
Stadt:        ##billing_address_city##

Vom Server zurueck gelieferte Daten (der Inhalt haengt von den Laenderspezifischen Regelungen ab und kann auch leer sein):

Firma:        ##eu_customer_name##
Adresse:      ##eu_customer_address##
Strasse:      ##eu_customer_street##
Postleitzahl: ##eu_customer_postal##
Stadt:        ##eu_customer_city##

Mit freundlichen Gruessen
Ihr sync*gw team
(c) http://syncgw.com, 2012 - 2018
';

?>