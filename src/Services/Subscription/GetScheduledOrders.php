<?php

namespace App\Services\Subscription;

use App\Entities\Subscription;
use App\Entities\ScheduledOrder;

class GetScheduledOrders
{
    /**
     * Handle generating the array of scheduled orders for the given number of weeks and subscription.
     *
     * @param \App\Entities\Subscription $subscription
     * @param int                        $forNumberOfWeeks
     *
     * @return array
     */
    public function handle(Subscription $subscription, $forNumberOfWeeks = 6)
    {
        $this->plan = $subscription->getPlan();
        if ($subscription->getStatus() === 'Active') {
            return $this->getScheduledOrders($subscription, $forNumberOfWeeks);
        }
    }

    private function isFortnightly()
    {
        return $this->plan === 'Fortnightly';
    }

    private function getScheduledOrders($subscription, $forNumberOfWeeks)
    {
        $scheduledOrders = [];
        $date = $subscription->getNextDeliveryDate();
        $fortnightly = $this->isFortnightly();

        $interval = true;
        for ($i=0; $i < ($forNumberOfWeeks); $i++) {
            $scheduledOrders[] = new ScheduledOrder($date->copy(), $interval);
            $date->addWeeks(1);
            if ($fortnightly) {
                $interval = !$interval;
            }
        }
        return $scheduledOrders;
    }
}
