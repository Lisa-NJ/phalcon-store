<?php

use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;

class User extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $username;

    /**
     *
     * @var string
     */
    public $slug;

    /**
     *
     * @var string
     */
    public $password_hash;

    /**
     *
     * @var string
     */
    public $reauthentication_token;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var integer
     */
    public $email_verified;

    /**
     *
     * @var string
     */
    public $email_token;

    /**
     *
     * @var string
     */
    public $email_token_expires;

    /**
     *
     * @var integer
     */
    public $login_attempts;

    /**
     *
     * @var string
     */
    public $lockout;

    /**
     *
     * @var string
     */
    public $last_login;

    /**
     *
     * @var string
     */
    public $last_action;

    /**
     *
     * @var integer
     */
    public $is_admin;

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
     *
     * @var string
     */
    public $language;

    /**
     *
     * @var integer
     */
    public $application_id;

    /**
     *
     * @var string
     */
    public $stripe_id;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'email',
            new EmailValidator(
                [
                    'model'   => $this,
                    'message' => 'Please enter a correct email address',
                ]
            )
        );

        return $this->validate($validator);
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("owl");
        $this->setSource("user");
        $this->hasMany('id', 'Invoice', 'created_by_id', ['alias' => 'Invoice']);
        $this->hasMany('id', 'Logs', 'user_id', ['alias' => 'Logs']);
        $this->hasMany('id', 'TeamHasUser', 'user_id', ['alias' => 'TeamHasUser']);
        $this->hasMany('id', 'Trusted', 'user_id', ['alias' => 'Trusted']);
        $this->hasMany('id', 'UserToken', 'user_id', ['alias' => 'UserToken']);
        $this->belongsTo('application_id', '\Application', 'id', ['alias' => 'Application']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return User[]|User|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return User|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
