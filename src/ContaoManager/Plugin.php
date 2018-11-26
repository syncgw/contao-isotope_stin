<?php

namespace syncgw\Isotope_STINBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use syncgw\Isotope_STINBundle\Isotope_STINBundle;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(Isotope_STINBundle::class)
                ->setLoadAfter([ ContaoCoreBundle::class, 'isotope' ]),
        ];
    }
}
