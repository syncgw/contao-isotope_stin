<?php

/**
 * sync*gw Isotope_STIN Bundle
 *
 * @copyright  http://syncgw.com, 2013 - 2018
 * @author     Florian Daeumling, http://syncgw.com
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

$GLOBALS['ISO_HOOKS']['useTaxRate'][] 	  = [ 'syncgw\Isotope_STINBundle\Module\IsotopeStin', 'applyVat' ];

$GLOBALS['TL_HOOKS']['addCustomRegexp'][] = [ 'syncgw\Isotope_STINBundle\Module\IsotopeStin', 'rgxpStin' ];

if (is_array($GLOBALS['TL_HOOKS']['replaceInsertTags']))
	array_unshift($GLOBALS['TL_HOOKS']['replaceInsertTags'], [ 'syncgw\Isotope_STINBundle\Module\IsotopeStin', 'replaceTag' ]);

?>