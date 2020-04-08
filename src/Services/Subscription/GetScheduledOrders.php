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
        $date= $subscription->getNextDeliveryDate();
        $plan= $subscription->getPlan();
        $scheduledOrders = array();
        
        if ($subscription->getStatus()==Subscription::STATUSES_ALLOWED[Subscription::STATUS_CANCELLED]){
            return $scheduledOrders;
        }  

        $isInterval = true;
        for ($ii=0; $ii < $forNumberOfWeeks; $ii++) {
            $scheduledOrders[] = new ScheduledOrder($date->copy(),$isInterval);
            $isInterval = ($plan=='Fortnightly' ? !$isInterval : true);
            $date->addWeek();
        }
        return $scheduledOrders;
    }
}