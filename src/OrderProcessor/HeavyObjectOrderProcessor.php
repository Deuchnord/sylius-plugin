<?php

namespace Acme\SyliusExamplePlugin\OrderProcessor;

use Sylius\Component\Order\Factory\AdjustmentFactoryInterface;
use Sylius\Component\Order\Model\OrderInterface;
use Sylius\Component\Order\Processor\OrderProcessorInterface;

final class HeavyObjectOrderProcessor implements OrderProcessorInterface
{
    /** @var AdjustmentFactoryInterface */
    private $adjustmentFactory;

    public function __construct(AdjustmentFactoryInterface $adjustmentFactory)
    {
        $this->adjustmentFactory = $adjustmentFactory;
    }

    /**
     * @param OrderInterface $order
     */
    public function process(OrderInterface $order): void
    {
        $adjustment = $this->adjustmentFactory
            ->createWithData('heavy', 'Additional heavy label', 1000);

        $order->addAdjustment($adjustment);
    }
}
