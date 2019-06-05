<?php

namespace Tests\Entities;

use Carbon\Carbon;
use App\Entities\Subscription;

class SubscriptionTest extends \PHPUnit\Framework\TestCase
{
    public function testItSetsAndGetsStatus()
    {
        $subscription = new Subscription();

        $subscription->setStatus(Subscription::STATUSES_ALLOWED[Subscription::STATUS_ACTIVE]);

        $this->assertEquals('Active', $subscription->getStatus());
    }

    public function testItSetsAndGetsPlan()
    {
        $subscription = new Subscription();

        $subscription->setPlan( Subscription::PLANS_ALLOWED[Subscription::PLAN_WEEKLY]);

        $this->assertEquals('Weekly', $subscription->getPlan());
    }

    public function testItSetsAndGetsDeliveryDate()
    {
        $subscription = new Subscription();
        $date         = (new Carbon('Next Thursday'))->startOfDay();

        $subscription->setNextDeliveryDate($date);

        $this->assertEquals($date, $subscription->getNextDeliveryDate());
    }
}