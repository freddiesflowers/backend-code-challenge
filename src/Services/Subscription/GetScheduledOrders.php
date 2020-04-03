<?php

namespace App\Services\Subscription;

use App\Entities\ScheduledOrder;
use App\Entities\Subscription;

class GetScheduledOrders
{
    /**
     * Handle generating the array of scheduled orders for the given number of weeks and subscription.
     *
     * @param Subscription $subscription
     * @param int          $forNumberOfWeeks
     *
     * @return array
     */
    public function handle(Subscription $subscription, $forNumberOfWeeks = 6)
    {
        if ($subscription->getStatus() == Subscription::STATUSES_ALLOWED[Subscription::STATUS_CANCELLED]) {
            return [];
        }

        $scheduledOrders = [];
        $deliveryDate = $subscription->getNextDeliveryDate();

        for ($i = 0; $i < $forNumberOfWeeks; $i++) {
            $isInterval = ($subscription->getPlan() == Subscription::PLANS_ALLOWED[Subscription::PLAN_WEEKLY] ? true : ($i % 2 == 0));
            $scheduledOrders[$i] = new ScheduledOrder($deliveryDate->copy(), $isInterval);
            $deliveryDate = $deliveryDate->addWeek();
        }

        return $scheduledOrders;
    }
}