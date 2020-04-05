<?php

/**
 * sync*gw IsotopeSTIN Bundle
 *
 * @copyright  http://syncgw.com, 2013 - 2020
 * @author     Florian Daeumling, http://syncgw.com
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

$GLOBALS['TL_DCA']['tl_iso_address']['fields']['eu_stin'] = [
	'label'     => &$GLOBALS['TL_LANG']['tl_iso_address']['eu_stin'],
	'exclude'	=> true,
	'search'	=> true,
	'sorting'	=> true,
	'flag'		=> 1,
	'inputType'	=> 'text',
	'eval'		=> [ 'maxlength' => 20, 'rgxp' => 'EU_stin', 'feEditable' => true, 'feGroup' => 'address', 'tl_class' => 'w50' ],
	'sql'		=> 'varchar(40) NOT NULL default \'\'',
];

?>