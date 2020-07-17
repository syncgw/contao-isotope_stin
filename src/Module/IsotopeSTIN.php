<?php

/**
 * sync*gw IsotopeSTIN Bundle
 *
 * @copyright  http://syncgw.com, 2013 - 2020
 * @author     Florian Daeumling, http://syncgw.com
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

namespace syncgw\Isotope_STINBundle\Module;

use Contao\Frontend;
use Contao\Widget;
use Isotope\Isotope;
use Psr\Log\LogLevel;
use Contao\CoreBundle\Monolog\ContaoContext;
use Contao\System;

class IsotopeSTIN extends Frontend {

	/**
	 * Validate STIN
	 */
	public function rgxpStin($strRegexp, $vat, Widget $obj) {

		// are we responsible?
		if ($strRegexp != 'EU_stin')
			return false;

		// no check if vat number string has been left empty
    	if ($vat == '')
    		return true;

    	// checkout processing?
		$st = $obj->Input->post('FORM_SUBMIT');
    	if (!$st || ($st != 'iso_mod_checkout_address' && substr($st, 0, 9) != 'tl_member') &&
    		substr($st, 0, 15) != 'tl_registration' && substr($st, 0, 14) != 'tl_iso_address')
    		return true;

    	// clean vat number string
		$vat = str_replace([ chr(0), chr(9), chr(10), chr(11), chr(13), chr(173) ], null, $vat);

		// known / validated user?
		if (FE_USER_LOGGED_IN) {
			$this->import('FrontendUser', 'User');
			if ($this->User->eu_stin == $vat)
                return true;
        }

		// get country code and vat number of customer
	    $usr_country = strtolower(substr($vat, 0, 2));
	    $usr_vat_no  = substr($vat, 2);

	    // try to load country
	    if (!($c = $obj->Input->post('country'))) {
	    	if (!($c = $obj->Input->post('billing_address_country'))) {
	    		if (!($c = $obj->Input->post('billingaddress_country')))
	    		    $c = $obj->Input->post('BillingAddress_country'); //
	    		$n = 'BillingAddress_';
	    	}
	    } else
			$n = 'billing_address_';

	    if ($usr_country != $c) {
    		$obj->addError(sprintf($GLOBALS['TL_LANG']['IsotopeStin']['country_code'], strtoupper($usr_country)));
    		return false;
	    }

		// country code must be part of the EU tax zone
		$conf = Isotope::getConfig();
		if (!in_array($usr_country, unserialize($conf->eu_stin_countries))) {
    		$obj->addError(sprintf($GLOBALS['TL_LANG']['IsotopeStin']['country_scope'], strtoupper($usr_country)));
    		return false;
    	}

		// get country code and vat number of shop owner
	    if ($conf->eu_stin) {
		 	$own_country = strtolower(substr($conf->eu_stin, 0, 2));
	     	$own_vat_no  = substr($conf->eu_stin, 2);
	    } else
	    	$own_country = $own_vat_no = null;

    	if (($rc = self::_chkEUServer($obj, $usr_country, $usr_vat_no, $own_country, $own_vat_no)) === false) {
	    	// call back in germany available?
    		if ($own_country != 'de')
    			return false;
    		if (($rc = self::_chkDServer($obj, $usr_country, $usr_vat_no, $own_country, $own_vat_no)) === false)
	    		return false;
    	}

		// shop STIN available?
		if (!$own_vat_no)
			return true;

		$k = $v = array();
		$k[] = '##shop_firstname##';
		$v[] = $conf->firstname;
		$k[] = '##shop_lastname##';
		$v[] = $conf->lastname;
		$k[] = '##billing_address_eu_stin##';
		$v[] = $vat;
		$k[] = '##hostname##';
		$v[] = $rc[0];
		$k[] = '##request_date##';
		$v[] = $rc[1];
		$k[] = '##request_id##';
		$v[] = $rc[2];
		$k[] = '##eu_customer_name##';
		$v[] = $rc[3];
		$k[] = '##eu_customer_address##';
		$v[] = $rc[4];
		$k[] = '##eu_customer_street##';
		$v[] = $rc[5];
		$k[] = '##eu_customer_postal##';
		$v[] = $rc[6];
		$k[] = '##eu_customer_city##';
		$v[] = $rc[7];
		$k[] = '##billing_address_company##';
		$k[] = '##billing_address_street##';
		$k[] = '##billing_address_postal##';
		$k[] = '##billing_address_city##';
		// back end call
		if ($obj->Input->post('do') != '') {
			$v[] = $conf->company;
			$v[] = $conf->street_1;
			$v[] = $conf->postal;
			$v[] = $conf->city;
		}
		// user data update
		elseif ($obj->Input->post('company')) {
			$v[] = $obj->Input->post('company');
			$v[] = $obj->Input->post('street');
			$v[] = $obj->Input->post('postal');
			$v[] = $obj->Input->post('city');
		}
		// billing fields
		else {
			$v[] = $obj->Input->post($n.'company');
			$v[] = $obj->Input->post($n.'address_street_1');
			$v[] = $obj->Input->post($n.'address_postal');
			$v[] = $obj->Input->post($n.'address_city');
		}

		// send e-Mail
		$email = new \Contao\Email();
		$email->text = str_replace($k, $v,$GLOBALS['TL_LANG']['IsotopeStin']['mail']);
		$email->subject = sprintf($GLOBALS['TL_LANG']['IsotopeStin']['mail_subj'], $vat);
		$email->sendTo($conf->email);

		return true;
	}

	/**
	 * Decide if an STIN is applied or not
	 *
	 * @param object
	 * @param float
	 * @param array
	 * @return boolean
	 */
	public function applyVat($objRate, $fltPrice, $arrAddresses) {

		// is flag set?
		if (!$objRate->eu_stin_flag)
			return true;

		// get STIN
		$stin = isset($arrAddresses['billing']->eu_stin) ? $arrAddresses['billing']->eu_stin : null;

		// STIN available?
		if (!strlen($stin))
			return true;

		// our own shop country?
		$conf = Isotope::getConfig();
		if (strtolower(substr($stin, 0, 2)) != $conf->country)
    		return false;

		// default
		return true;
	}

	/**
	 * 	Replace tag
	 *
	 *  @param string
	 *  @return mixed
	 */
	public function replaceTag($strTag) {

		$parm = explode('::', $strTag);

		// check general responsibility
		if ($parm[0] != 'eu_stin')
			return false;

		// parameter given?
		if(!isset($parm[1]) || !$parm[1])
			return null;

		// eu_stin available?
		$stin = null;

		$cart = Isotope::getCart();
		if (method_exists($cart, 'getBillingAddress'))
			$stin = $cart->getBillingAddress()->eu_stin;
		elseif (\Input::get('do') == 'iso_orders') {
			$or = \Isotope\Model\ProductCollection\Order::findByPk(\Input::get('id'));
        	$ad = $or->getBillingAddress();
			$stin = $ad->eu_stin;
		}

		// any STIN found?
		if (!$stin)
			return null;

		// our own shop country?
		if (strtolower(substr($stin, 0, 2)) == Isotope::getConfig()->country)
    		return null;

		// we got it!
		return $parm[1];
	}

	/**
	 * Check EU server
	 * http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl
	 *
	 * @param Widget
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return mixed
	 */
	private function _chkEUServer(Widget $obj, $usr_country, $usr_vat_no, $own_country, $own_vat_no) {

		// server name to check
		$host = 'ec.europa.eu';

    	// check host connection
    	if (!is_array(gethostbynamel($host))) {
    		$obj->addError($GLOBALS['TL_LANG']['IsotopeStin']['connect']);
    		return false;
    	}

		// check STIN at EU server
		// http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl
		try {
			$soap = new \SoapClient('http://'.$host.'/taxation_customs/vies/checkVatService.wsdl', array( 'connection_timeout' => 10 ));
    		$result = $soap->checkVatApprox(array(
				'countryCode' 			=> strtoupper($usr_country),
				'vatNumber' 			=> $usr_vat_no,
				'requesterCountryCode'	=> strtoupper($own_country),
				'requesterVatNumber'	=> $own_vat_no,
			));
    	} catch (\Exception $err) {
        	$obj->addError($GLOBALS['TL_LANG']['IsotopeStin']['connect_err']);
			if (isset($err->faultcode))
        		System::getContainer()->get('monolog.logger.contao')->log(LogLevel::INFO,
        			'('.$err->faultcode.') '.$err->faultstring,
      				[ 'contao' => new ContaoContext(__CLASS__.'::'.__FUNCTION__, TL_ERROR ) ] );
			return false;
		}

		// checkVAT() is the xsd:element name
		if (!$result->valid) {
        	$obj->addError(sprintf($GLOBALS['TL_LANG']['IsotopeStin']['invalid'], strtoupper($usr_country.$usr_vat_no)));
			return false;
		}

		return array(
			$host,
			$result->requestDate,
			$result->requestIdentifier,
			isset($result->traderName) ? $result->traderName : null,
			isset($result->traderAddress) ? $result->traderAddress : null,
			isset($result->traderStreet) ? $result->traderStreet : null,
			isset($result->traderPostcode) ? $result->traderPostcode : null,
			isset($result->traderCity) ? $result->traderCity : null,
		);
	}

	/**
	 * Check German server
	 * https://evatr.bff-online.de/eVatR/
	 *
	 * @param Widget
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return mixed
	 */
	private function _chkDServer(Widget $obj, $usr_country, $usr_vat_no, $own_country, $own_vat_no) {

		// server name to check
		$host = 'evatr.bff-online.de';

    	// check host connection
    	if (!is_array(gethostbynamel($host))) {
    		$obj->addError($GLOBALS['TL_LANG']['IsotopeStin']['connect']);
    		return false;
    	}

    	require TL_ROOT.'/vendor/syncgw/contao-isotope_stin/src/Module/IXR_Library.php';

    	$client     = new \IXR_Client('https://'.$host);
		$UstId_1    = strtoupper($own_country.$own_vat_no);
		$UstId_2    = strtoupper($usr_country.$usr_vat_no);
		$Firmenname = null;
		$Ort        = null;
		$PLZ        = null;
		$Strasse    = null;
		$Druck      = 'nein';

		if (!$client->query('evatrRPC', $UstId_1, $UstId_2, $Firmenname, $Ort, $PLZ, $Strasse, $Druck)) {
        	$obj->addError($GLOBALS['TL_LANG']['IsotopeStin']['connect_err']);
        	System::getContainer()->get('monolog.logger.contao')->log(LogLevel::INFO,
        		'('.$client->getErrorCode().') '.$client->getErrorMessage(),
      			[ 'contao' => new ContaoContext(__CLASS__.'::'.__FUNCTION__, TL_ERROR ) ] );
			return false;
		}
		$xml = $client->getResponse();
        $rc = null;

		preg_match('#(?<=ErrorCode</string></value>\n<value><string>).*(?=</string.*)#', $xml, $rc);

		if ($rc[0] != '200') {
        	$obj->addError(sprintf($GLOBALS['TL_LANG']['IsotopeStin']['invalid'], strtoupper($usr_country.$usr_vat_no)));
        	System::getContainer()->get('monolog.logger.contao')->log(LogLevel::INFO,
        		'RC '.$rc[0].' - see https://evatr.bff-online.de/eVatR/xmlrpc/codes',
      			[ 'contao' => new ContaoContext(__CLASS__.'::'.__FUNCTION__, TL_ERROR ) ] );
        	return false;
		}

		preg_match('#(?<=Datum</string></value>\n<value><string>).*(?=</string.*)#', $xml, $rc);

		return array(
			$host,
			$rc[0],
			'No ID available',
			null,
			null,
			null,
			null,
			null,
		);

	}

}

?>