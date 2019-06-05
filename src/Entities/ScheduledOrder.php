<?php

namespace App\Entities;

use Carbon\Carbon;

class ScheduledOrder
{
    /**
     * The delivery date of this scheduled order.
     *
     * @var \Carbon\Carbon
     */
    protected $deliveryDate;

    /**
     * Is this delivery marked as a holiday that will be skipped.
     *
     * @var bool
     */
    protected $holiday = false;

    /**
     * Is this scheduled order an opt in order that is not part of the normal subscription's plan cycle.
     *
     * @var bool
     */
    protected $optIn = false;

    /**
     * Is this scheduled order part of the subscriptions normal plan cycle.
     *
     * @var bool
     */
    protected $interval = true;

    /**
     * ScheduledOrder constructor.
     *
     * @param \Carbon\Carbon     $deliveryDate
     * @param \App\Entities\bool $isInterval
     */
    public function __construct(Carbon $deliveryDate, bool $isInterval)
    {
        $this->deliveryDate = $deliveryDate;
        $this->interval     = $isInterval;
    }


    /**
     * Get scheduled order part
     *
     * @return bool|bool
     */
    public function isInterval(){
        return $this->interval;
    }

    /**
     * Set delivery as a holiday
     *
     * @param bool $holiday
     */
    public function setHoliday($holiday){
        $this->holiday = $this->interval ? $holiday : false;
    }

    /**
     * Get delivery as a holiday
     *
     * @return bool
     */
    public function isHoliday(){
        return $this->holiday;
    }

    /**
     * Get the delivery date of this scheduled order
     *
     * @return Carbon
     */
    public function getDeliveryDate(){
        return $this->deliveryDate;
    }

    /**
     * Set the scheduled order opt in order
     *
     * @param $optIn
     */
    public function setOptIn($optIn){
        $this->optIn = $this->interval ? false : $optIn;
    }

    /**
     * Get the scheduled order opt in order
     *
     * @return bool
     */
    public function isOptIn(){
        return $this->optIn;
    }
}