<?php

namespace spec\Acme\SyliusExamplePlugin\OrderProcessor;

use Acme\SyliusExamplePlugin\OrderProcessor\HeavyObjectOrderProcessor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Component\Core\Model\AdjustmentInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Order\Factory\AdjustmentFactoryInterface;
use Sylius\Component\Order\Processor\OrderProcessorInterface;

final class HeavyObjectOrderProcessorSpec extends ObjectBehavior
{
    function let(AdjustmentFactoryInterface $adjustmentFactory)
    {
        $this->beConstructedWith($adjustmentFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(HeavyObjectOrderProcessor::class);
    }

    function it_is_order_processor()
    {
        $this->shouldImplement(OrderProcessorInterface::class);
    }

    function it_adds_fee_to_order(OrderInterface $order,
                                  AdjustmentInterface $adjustment,
                                  AdjustmentFactoryInterface $adjustmentFactory)
    {
        $adjustmentFactory->createWithData('heavy', 'Additional heavy label', 1000)
                          ->willReturn($adjustment);

        $this->process($order);
        $order->addAdjustment($adjustment)->shouldBeCalled();
    }
}
