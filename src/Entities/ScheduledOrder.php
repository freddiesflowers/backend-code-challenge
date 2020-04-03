<?php

namespace App\Entities;

use Carbon\Carbon;

class ScheduledOrder
{
    /**
     * The delivery date of this scheduled order.
     *
     * @var Carbon
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
     * @param Carbon $deliveryDate
     * @param bool   $isInterval
     */
    public function __construct(Carbon $deliveryDate, bool $isInterval)
    {
        $this->deliveryDate = $deliveryDate;
        $this->interval = $isInterval;
    }

    /**
     * Returns whether the scheduled order delivery date is part of the normal plan cycle
     *
     * @return bool|bool
     */
    public function isInterval() { return $this->interval; }

    /**
     * Sets a holiday if the date is part of the normal plan cycle
     *
     * @param bool $holiday
     */
    public function setHoliday(bool $holiday)
    {
        $this->holiday = ($this->interval ? $holiday : false);
    }

    /**
     * Returns whether the delivery date is a holiday or not
     *
     *     * @return bool
     */
    public function isHoliday() { return $this->holiday; }

    /**
     * Returns the next delivery date
     *
     * @return Carbon
     */
    public function getDeliveryDate() { return $this->deliveryDate; }

    /**
     * Opts in the next delivery date if not part of the normal plan cycle
     *
     * @param bool $optIn
     */
    public function setOptIn(bool $optIn)
    {
        $this->optIn = (!$this->interval ? $optIn : false);
    }

    /**
     * Returns whether the delivery date is an optIn that is ot part of the normal plan
     *
     * @return bool
     */
    public function isOptIn() { return $this->optIn; }
}