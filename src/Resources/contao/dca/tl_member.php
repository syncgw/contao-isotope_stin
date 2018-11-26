<?php

/**
 * sync*gw Isotope_STIN Bundle
 *
 * @copyright  http://syncgw.com, 2013 - 2018
 * @author     Florian Daeumling, http://syncgw.com
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] = str_replace(',country',',country,eu_stin',$GLOBALS['TL_DCA']['tl_member']['palettes']['default']);

$GLOBALS['TL_DCA']['tl_member']['fields']['eu_stin'] = [
	'label'    	=> &$GLOBALS['TL_LANG']['tl_member']['eu_stin'],
	'exclude'   => true,
	'inputType' => 'text',
	'eval'      => [ 'feEditable' => true, 'rgxp' => 'EU_stin', 'feViewable' => true, 'feGroup' => 'address' ],
	'sql'		=> 'varchar(40) NOT NULL default \'\'',
];

?>