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
     * Checks interval status.
     * 
     * @return bool
     */
    public function isInterval(){
        return $this->interval;
    }

    /**
     * Sets Holiday state
     *
     * @param bool  $holiday
     */
    public function setHoliday(bool $holiday){
        if ($this->interval) $this->holiday = $holiday;
    }

    /**
     * Returns holiday state
     *
     * @return bool
     */
    public function isHoliday(){
        return $this->holiday;
    }

    /**
     * returns the delivery date
     *
     * return \Carbon\Carbon
     */
    public function getDeliveryDate(){
        return $this->deliveryDate;
    }

    /**
     * Sets the OptIn.
     *
     * @param bool     $optIn
     */
    public function setOptIn($optIn){
        if (!$this->interval) $this->optIn = $optIn;
    }

    /**
     * Returns Optin Status.
     *
     * @return bool
     */

    public function isOptIn(){
        return $this->optIn;
        
    }



}