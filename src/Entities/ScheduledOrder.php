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

    public function isInterval(){
        if($this->interval)
            return true;
        return false;
    }

    public function setHoliday(bool $isHoliday){
        if($this->interval)
            $this->holiday = $isHoliday;
    }

    public function isHoliday(){
        if($this->holiday)
            return true;
        return false;
    }

    public function getDeliveryDate(){
        return $this->deliveryDate;
    }

    public function setOptIn(bool $isOptIn){
        if(!$this->interval)
            $this->optIn = $isOptIn;
    }

    public function isOptIn(){
        if($this->optIn)
            return true;
        return false;
    }

}