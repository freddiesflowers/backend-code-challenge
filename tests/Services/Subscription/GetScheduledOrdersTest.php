<?php

namespace Tests\Services\Subscription;

use App\Entities\Subscription;
use App\Services\Subscription\GetScheduledOrders;

class GetScheduledOrdersTest extends \PHPUnit\Framework\TestCase
{
    public function testItGeneratesForWeeklySubscription()
    {
        $date         = (new \Carbon\Carbon('2019-01-01'))->startOfDay();
        $weeks        = 6;
        $subscription = (new Subscription())
            ->setNextDeliveryDate($date->copy())
            ->setStatus(Subscription::STATUS_ACTIVE)
            ->setPlan(Subscription::PLAN_WEEKLY);

        $getScheduledOrdersService = new GetScheduledOrders();
        $scheduledOrders           = $getScheduledOrdersService->handle($subscription, $weeks);

        $this->assertCount($weeks, $scheduledOrders);

        for ($i = 0; $i < $weeks; $i++) {
            $scheduledOrder = $scheduledOrders[$i];
            $this->assertTrue($scheduledOrder->isInterval());
            $this->assertFalse($scheduledOrder->isHoliday());
            $this->assertEquals($date->toDateString(), $scheduledOrder->getDeliveryDate()->toDateString());
            $date->addWeek();
        }
    }

    public function testItGeneratesForFortnightlySubscription()
    {
        $date         = (new \Carbon\Carbon('2019-08-01'))->startOfDay();
        $weeks        = 6;
        $subscription = (new Subscription())
            ->setNextDeliveryDate($date->copy())
            ->setStatus(Subscription::STATUS_ACTIVE)
            ->setPlan(Subscription::PLAN_FORTNIGHTLY);

        $getScheduledOrdersService = new GetScheduledOrders();
        $scheduledOrders           = $getScheduledOrdersService->handle($subscription, $weeks);

        $this->assertCount($weeks, $scheduledOrders);

        $shouldBeInterval = true;

        for ($i = 0; $i < $weeks; $i++) {
            $scheduledOrder = $scheduledOrders[$i];
            $this->assertEquals($shouldBeInterval, $scheduledOrder->isInterval());
            $this->assertFalse($scheduledOrder->isHoliday());
            $this->assertEquals($date->toDateString(), $scheduledOrder->getDeliveryDate()->toDateString());
            $date->addWeek();
            $shouldBeInterval = !$shouldBeInterval;
        }
    }

    public function testItGeneratesNumberOfWeeksDynamically()
    {
        $date         = (new \Carbon\Carbon('2019-08-01'))->startOfDay();
        $subscription = (new Subscription())
            ->setNextDeliveryDate($date->copy())
            ->setStatus(Subscription::STATUS_ACTIVE)
            ->setPlan(Subscription::PLAN_FORTNIGHTLY);

        // Test it is able to generate all the way upto a whole year
        for ($weeks = 1; $weeks <= 52; $weeks++) {
            $getScheduledOrdersService = new GetScheduledOrders();
            $scheduledOrders           = $getScheduledOrdersService->handle($subscription, $weeks);

            $this->assertCount($weeks, $scheduledOrders);
        }
    }

    public function testItDoesntGenerateForCancelledSubscription()
    {
        $subscription = (new Subscription())
            ->setStatus(Subscription::STATUS_CANCELLED)
            ->setPlan(Subscription::PLAN_FORTNIGHTLY);

        $getScheduledOrdersService = new GetScheduledOrders();
        $scheduledOrders           = $getScheduledOrdersService->handle($subscription);

        $this->assertEmpty($scheduledOrders);
    }
}