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

        for ($i = 0; $i < $forNumberOfWeeks; $i++) {
            $deliveryDate = ($i > 0 ? $scheduledOrders[$i - 1]->getDeliveryDate()->addWeeks(1) : $subscription->getNextDeliveryDate());
            $isInterval = ($subscription->getPlan() == Subscription::PLAN_WEEKLY ? true : ($i % 2 == 0));
            array_push($scheduledOrders, new ScheduledOrder($deliveryDate, $isInterval));
        }

        return $scheduledOrders;
    }
}