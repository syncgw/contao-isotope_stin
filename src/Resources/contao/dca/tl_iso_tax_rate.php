<?php

/**
 * sync*gw IsotopeSTIN Bundle
 *
 * @copyright  http://syncgw.com, 2013 - 2020 
 * @author     Florian Daeumling, http://syncgw.com
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

$GLOBALS['TL_DCA']['tl_iso_tax_rate']['palettes']['default'] .= ';{eu_stin_legend},eu_stin_flag';

$GLOBALS['TL_DCA']['tl_iso_tax_rate']['fields']['eu_stin_flag'] = [
	'label'   	=> &$GLOBALS['TL_LANG']['tl_iso_tax_rate']['eu_stin_flag'],
	'inputType' => 'checkbox',
	'eval'      => [ 'tl_class' => 'w50' ],
	'sql'		=> 'char(1) NOT NULL default \'\'',
];

?>