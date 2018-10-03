<?php

declare(strict_types=1);

namespace Tests\Acme\SyliusExamplePlugin\Behat\Context\Setup;

use Behat\Behat\Context\Context;
use Doctrine\Common\Persistence\ObjectManager;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\ProductVariantInterface;

class ProductContext implements Context
{
    /** @var ObjectManager */
    private $productManager;

    public function __construct(ObjectManager $productManager)
    {
        $this->productManager = $productManager;
    }

    /**
     * @Given the :product product is heavy
     *
     * @param ProductInterface $product
     */
    public function theProductIsHeavy(ProductInterface $product)
    {
        /** @var ProductVariantInterface $variant */
        $variant = $product->getVariants()[0];
        $variant->setWeight((float) 100000);

        $this->productManager->persist($variant);
        $this->productManager->flush();
    }
}
