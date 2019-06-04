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
        // for each week, generate a ScheduledOrder based on subscription
        // if subscription is active, return number of weeks / plan worth of ScheduledOrder
        // var_dump($subscription->getPlan());
        // var_dump($subscription->getStatus());
        if ($subscription->getStatus() === 'Active') {
            // var_dump('$vars...');
            return $this->getScheduledOrders($subscription, $forNumberOfWeeks);
        }
        // var_dump($subscription->plan);
        // $amount = $this->calculateOrders();

        // return $this->getScheduledOrders($amount);
    }

    private function isInterval() {
        return true; // if can't make dynamic, declare as property and set default to true.
    }

    private function getScheduledOrders($subscription, $forNumberOfWeeks) {
        $interval = $this->isInterval();
        $stuff = [];
        $date = $subscription->getNextDeliveryDate();
        // var_dump('out', count($stuff));
        for ($i=0; $i < $forNumberOfWeeks; $i++) {
            // var_dump($date);
            $date->addWeeks(1);
            // var_dump($newDate);
            // $newDate = $subscription->setNextDeliveryDate($date->addWeeks(1));
            // $newDate = $newDate->getNextDeliveryDate();
            $order = new ScheduledOrder($date, $interval);
            // var_dump($order);
            array_push($stuff, $order);
            var_dump($stuff);
            // var_dump('second', count($stuff));
       }
        // foreach ($week as $forNumberOfWeeks) {
        //     var_dump('hi');
        // }
        // var_dump($stuff);
        // $stuff = [new ScheduledOrder($date, $interval, 10), new ScheduledOrder($date, $interval, 10)];
        return $stuff;
    }
}
