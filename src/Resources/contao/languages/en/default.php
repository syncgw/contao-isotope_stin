<?php

/**
 * sync*gw IsotopeSTIN Bundle
 *
 * @copyright  http://syncgw.com, 2013 - 2020 
 * @author     Florian Daeumling, http://syncgw.com
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

$GLOBALS['TL_LANG']['IsotopeStin']['country_code']	= 'Country code "%s" does not match select country!';
$GLOBALS['TL_LANG']['IsotopeStin']['country_scope']	= 'Country code "%s" is not part of EU countries!';
$GLOBALS['TL_LANG']['IsotopeStin']['invalid'] 		= '"%s" is not a valid EU sales tax ID number!';
$GLOBALS['TL_LANG']['IsotopeStin']['connect'] 		= 'Cannot connect to EU server - please retry later!';
$GLOBALS['TL_LANG']['IsotopeStin']['connect_err'] 	= 'Connection error to EU server - please retry later!';
$GLOBALS['TL_LANG']['IsotopeStin']['mail_subj']		= 'Check EU sales tax ID number %s';
$GLOBALS['TL_LANG']['IsotopeStin']['mail']			= 'Dear ##shop_firstname## ##shop_lastname##,

"EU sales tax ID number" ##billing_address_eu_stin## was checked successfully at ##request_date## on server http://##hostname##/.

The unique identifier request token returned is "##request_id##".

If a ID is available, you may use this mail as evidence for your revenue office.

Contao data:

Company: ##billing_address_company##
Street:  ##billing_address_street##
Postal:  ##billing_address_postal##
City:    ##billing_address_city##

Data returned by server (content depends on country specific regulations and may be empty):

Company: ##eu_customer_name##
Address: ##eu_customer_address##
Street:  ##eu_customer_street##
Postal:  ##eu_customer_postal##
City:    ##eu_customer_city##

Sincerely
Your sync*gw team
(c) http://syncgw.com, 2012 - 2018
';

?>