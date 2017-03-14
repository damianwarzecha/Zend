<?php
/**
 * Created by PhpStorm.
 * User: ja
 * Date: 06.03.2017
 * Time: 19:29
 */

namespace Signin\Model;


class Deck{

    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    private $cards1;
    private $cards2;
    private $cards3;
    private $cards4;
    private $cards5;
    private $cards6;
    private $cards7;
    private $cards8;
    private $cards9;
    private $cards10;
    private $cards11;
    private $cards12;

    public function exchangeArray(array $data){

    }

}