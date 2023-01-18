<?php

class Display extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $team_id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $description;

    /**
     *
     * @var string
     */
    public $type;

    /**
     *
     * @var integer
     */
    public $pixel_width;

    /**
     *
     * @var integer
     */
    public $pixel_height;

    /**
     *
     * @var integer
     */
    public $physical_width;

    /**
     *
     * @var integer
     */
    public $physical_height;

    /**
     *
     * @var integer
     */
    public $rotate;

    /**
     *
     * @var string
     */
    public $acid;

    /**
     *
     * @var string
     */
    public $hardware_id;

    /**
     *
     * @var string
     */
    public $timezone;

    /**
     *
     * @var integer
     */
    public $private;

    /**
     *
     * @var integer
     */
    public $demo_mode;

    /**
     *
     * @var integer
     */
    public $block_time;

    /**
     *
     * @var integer
     */
    public $max_time_purchasable;

    /**
     *
     * @var string
     */
    public $brightness_control;

    /**
     *
     * @var string
     */
    public $brightness_curve;

    /**
     *
     * @var string
     */
    public $approval;

    /**
     *
     * @var integer
     */
    public $mobile;

    /**
     *
     * @var double
     */
    public $longitude;

    /**
     *
     * @var double
     */
    public $latitude;

    /**
     *
     * @var string
     */
    public $currency;

    /**
     *
     * @var integer
     */
    public $application_id;

    /**
     *
     * @var string
     */
    public $last_connected;

    /**
     *
     * @var string
     */
    public $slug;

    /**
     *
     * @var string
     */
    public $created;

    /**
     *
     * @var string
     */
    public $modified;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("owl");
        $this->setSource("display");
        $this->hasMany('id', 'Booking', 'display_id', ['alias' => 'Booking']);
        $this->hasMany('id', 'CouponCode', 'display_id', ['alias' => 'CouponCode']);
        $this->hasMany('id', 'DisplayHasTag', 'display_id', ['alias' => 'DisplayHasTag']);
        $this->hasMany('id', 'DisplayToken', 'display_id', ['alias' => 'DisplayToken']);
        $this->hasMany('id', 'E2vBooking', 'display_id', ['alias' => 'E2vBooking']);
        $this->hasMany('id', 'PricingSchedule', 'display_id', ['alias' => 'PricingSchedule']);
        $this->hasMany('id', 'Trusted', 'display_id', ['alias' => 'Trusted']);
        $this->belongsTo('team_id', '\Team', 'id', ['alias' => 'Team']);
        $this->belongsTo('application_id', '\Application', 'id', ['alias' => 'Application']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Display[]|Display|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Display|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
