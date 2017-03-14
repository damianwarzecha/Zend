<?php
/**
 * Created by PhpStorm.
 * User: ja
 * Date: 06.03.2017
 * Time: 19:33
 */

namespace Signin\Model;


use Zend\Db\TableGateway\TableGatewayInterface;

class DeckTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

}