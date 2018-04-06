<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Chutro extends Model
{
    var $title;
    var $user;
    var $email;
    var $address;
    var $phone;

    /**
     * Chutro constructor.
     * @param $title
     * @param $user
     * @param $email
     * @param $address
     * @param $phone
     */
    public function __construct($title, $user, $email, $address, $phone)
    {
        $this->title = $title;
        $this->user = $user;
        $this->email = $email;
        $this->address = $address;
        $this->phone = $phone;
    }


    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }


}
