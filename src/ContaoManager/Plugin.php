<?php

/**
 * sync*gw IsotopeSTIN Bundle
 *
 * @copyright  http://syncgw.com, 2013 - 2020
 * @author     Florian Daeumling, http://syncgw.com
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

namespace syncgw\Isotope_STINBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use syncgw\Isotope_STINBundle\Isotope_STINBundle;

class Plugin implements BundlePluginInterface {
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser) {
        return [
            BundleConfig::create(Isotope_STINBundle::class)
                ->setLoadAfter([ ContaoCoreBundle::class, 'isotope' ]),
        ];
    }

}
