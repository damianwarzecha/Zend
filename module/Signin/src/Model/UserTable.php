<?php
/**
 * Created by PhpStorm.
 * User: damian.warzecha
 * Date: 2016-08-03
 * Time: 10:34
 */

namespace Signin\Model;

use Zend\Db\TableGateway\Exception\RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class UserTable
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

    public function getUser($username)
    {
        $username = (string) $username;
        $rowset = $this->tableGateway->select(['username' => $username]);
        $row = $rowset->current();
        if (!$row)
        {
            $row=null;
//            throw new RuntimeException(
//                sprintf('Nie można znaleść wiersza z tą nazwą użytkownika %s', $username)
//            );
        }
        return $row;
    }

    public function getUserByEmail($email)
    {
        $email = (string) $email;
        $rowset = $this->tableGateway->select(['email' => $email]);
        $row = $rowset->current();
        if (!$row)
        {
            $row=null;
//            throw new RuntimeException(
//                sprintf('Nie można znaleść wiersza z tym adresem email %s', $email)
//            );
        }
        return $row;
    }

    public function getUserByActive($id)
    {
        $id = (string) $id;
        $rowset = $this->tableGateway->select(['active' => $id]);
        $row = $rowset->current();
        if (!$row)
        {
            $row=null;
//            throw new RuntimeException(
//                sprintf('Nie można znaleść wiersza z tym adresem email %s', $email)
//            );
        }
        return $row;
    }
    
    public function saveUser(User $user)
    {
        $data = [
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'active' => $user->getActive(),
        ];

        if ($user->getUserId() === 0)
        {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getUser($user->getUsername()))
        {
            throw new RuntimeException(
                sprintf('Nie można zaktualizować %s, nie ma takiego użytkownika', $user->getUsername())
            );
        }
        $this->tableGateway->update($data, ['user_id' => $user->getUserId()]);
    }

    public function deleteUser($user_id)
    {
        $this->tableGateway->delete(['user_id' => $user_id]);
    }

    public function deleteUserByName($userName)
    {
        $this->tableGateway->delete(['username' => $userName]);
    }

    public function checkLoginAll()
    {
        $this->tableGateway->select(['log_in_now' => true]);
    }

    public function setLogin($user,$log)
    {
        $this->tableGateway->update(['log_in_now' => $log],['username' => $user]);
    }

    public function setGracz($user,$gracz){
        $this->tableGateway->update(['gracz' => $gracz],['username' => $user]);
    }

    public function setLogout($user,$log){
        $this->tableGateway->update(['log_in_now' => $log],['username' => $user]);
    }

    public function setSes($user,$sesId){
        $this->tableGateway->update(['ses_id' => $sesId],['username' => $user]);
    }

}