<?php
/**
 * Created by PhpStorm.
 * User: damian.warzecha
 * Date: 2016-08-03
 * Time: 10:34
 */

namespace Signin\Model;


class User
{
    private $user_id = 0;
    private $username;
    private $email;
    private $password;
    private $active;
    private $log_in_now;
    private $gracz;
    private $karty;
    private $ses_id;

    /**
     * @return mixed
     */
    public function getSesId()
    {
        return $this->ses_id;
    }

    /**
     * @param mixed $ses_id
     */
    public function setSesId($ses_id)
    {
        $this->ses_id = $ses_id;
    }

    /**
     * @return mixed
     */
    public function getKarty()
    {
        return $this->karty;
    }

    /**
     * @param mixed $karty
     */
    public function setKarty($karty)
    {
        $this->karty = $karty;
    }

    /**
     * @return mixed
     */
    public function getGracz()
    {
        return $this->gracz;
    }

    /**
     * @param mixed $gracz
     */
    public function setGracz($gracz)
    {
        $this->gracz = $gracz;
    }

    /**
     * @return mixed
     */
    public function getLogInNow()
    {
        return $this->log_in_now;
    }

    /**
     * @param mixed $log_in_now
     */
    public function setLogInNow($log_in_now)
    {
        $this->log_in_now = $log_in_now;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    public function exchangeArray(array $data)
    {
        $this->setUserId(!empty($data['user_id']) ? $data['user_id'] : null);
        $this->setUsername(!empty($data['username']) ? $data['username'] : null);
        $this->setEmail(!empty($data['email']) ? $data['email'] : null);
        $this->setPassword(!empty($data['password']) ? $data['password'] : null);
        $this->setLogInNow(!empty($data['log_in_now']) ? $data['log_in_now'] : null);
        $this->setGracz(!empty($data['gracz']) ? $data['gracz'] : null);
        $this->setKarty(!empty($data['cards']) ? $data['cards'] : null);
        $this->setSesId(!empty($data['ses_id']) ? $data['ses_id'] : null);
        $this->setActive(!empty($data['active']) ? $data['active'] : null);
    }


    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }



}