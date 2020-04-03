<?php

namespace App\Entities;

use Carbon\Carbon;

class Subscription
{
    /**
     * The statuses a subscription can have.
     *
     * @var int
     */
    const STATUS_ACTIVE    = 1;
    const STATUS_CANCELLED = 2;

    /**
     * The allowed statuses.
     *
     * @var array
     */
    const STATUSES_ALLOWED = [
        self::STATUS_ACTIVE    => 'Active',
        self::STATUS_CANCELLED => 'Cancelled',
    ];

    /**
     * The plans a subscription can have.
     *
     * @var int
     */
    const PLAN_WEEKLY      = 1;
    const PLAN_FORTNIGHTLY = 2;

    /**
     * The allowed plans.
     *
     * @var array
     */
    const PLANS_ALLOWED = [
        self::PLAN_WEEKLY      => 'Weekly',
        self::PLAN_FORTNIGHTLY => 'Fortnightly',
    ];

    /**
     * The subscription status.
     *
     * @var int
     */
    protected $status;

    /**
     * The subscription plan.
     *
     * @var int
     */
    protected $plan;

    /**
     * The next delivery date for this subscription.
     *
     * @var Carbon|null
     */
    protected $nextDeliveryDate;

    /**
     * Sets the subscription status
     *
     * @param int $status
     *
     * @return $this|bool
     */
    public function setStatus(int $status)
    {
        if (!array_key_exists($status, self::STATUSES_ALLOWED)) {
            return false;
        }

        $this->status = $status;
        return $this;
    }

    /**
     * Returne the human readable status of the subscription
     *
     * @return mixed
     */
    public function getStatus()
    {
        return self::STATUSES_ALLOWED[$this->status];
    }

    /**
     * Sets the subscription plan
     *
     * @param int $plan
     *
     * @return $this|bool
     */
    public function setPlan(int $plan)
    {
        if (!array_key_exists($plan, self::PLANS_ALLOWED)) {
            return false;
        }

        $this->plan = $plan;
        return $this;
    }

    /**
     * Returns the human readable subscription plan
     *
     * @return mixed
     */
    public function getPlan()
    {
        return self::PLANS_ALLOWED[$this->plan];
    }

    /**
     * Sets the next delivery date of the subscription
     *
     * @param Carbon $date
     *
     * @return $this
     */
    public function setNextDeliveryDate(Carbon $date)
    {
        $this->nextDeliveryDate = $date;
        return $this;
    }

    /**
     * Returns the next delivery date of the subscription
     *
     * @return Carbon|null
     */
    public function getNextDeliveryDate() { return $this->nextDeliveryDate; }
}