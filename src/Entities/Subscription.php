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
     * @var \Carbon\Carbon|null
     */
    protected $nextDeliveryDate;

    /**
     * Set subscription status
     *
     * @param $status
     */
    public function setStatus($status){
        $this->status = $status;
    }

    /**
     * Get subscription status
     *
     * @return int
     */
    public function getStatus(){
        return $this->status;
    }

    /**
     * Set subscription plan
     *
     * @param $plan
     */
    public function setPlan($plan){
        $this->plan = $plan;
    }

    /**
     * Get subscription plan
     *
     * @return int
     */
    public function getPlan(){
        return $this->plan;
    }

    /**
     * Set next delivery date for this subscription
     *
     * @param Carbon $nextDeliveryDate
     */
    public function setNextDeliveryDate(Carbon $nextDeliveryDate){
        $this->nextDeliveryDate = $nextDeliveryDate;
    }

    /**
     * Get next delivery date for this subscription
     *
     * @return Carbon|null
     */
    public function getNextDeliveryDate(){
        return $this->nextDeliveryDate;
    }
}