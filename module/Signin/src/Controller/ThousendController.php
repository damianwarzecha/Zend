<?php
/**
 * Created by PhpStorm.
 * User: ja
 * Date: 13.09.2016
 * Time: 19:25
 */

namespace Signin\Controller;


use Signin\Model\UserTable;
use Zend\Authentication\Adapter\DbTable\Exception\RuntimeException;
use Zend\I18n\Exception\RangeException;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class ThousendController extends AbstractActionController
{

    private $table;

    public function __construct(UserTable $table)
    {
        $this->table = $table;
    }

    public function thousendAction()
    {

        $session = new Container('user_ses');

        if($session->logged){
            return new ViewModel();
        }else{
            $this->redirect()->toRoute('signin');
        }
    }

    public function rozdajAction()
    {

        $ses = new Container('user_ses');
        $buttonTyp = $this->params()->fromPost('button_type');

        if($buttonTyp == 'user'){
            $gracz = $this->table->getUser($this->params()->fromPost('user'));
            $gracz2 = $ses->username;

            $this->table->setGracz($gracz->getUsername(),$this->table->getUser($gracz2)->getUserId() );


            return new JsonModel(
                ["gracz1" => $gracz->getUsername(),
               "gracz2" => $gracz2]
            );
        }


        $cards = array( 'A_cz' => 'A_cz.jpg',
                        'A_wi' => 'A_wi.jpg',
                        'A_rz' => 'A_rz.jpg',
                        'A_dz' => 'A_dz.jpg',
                        'KR_cz' => 'KR_cz.jpg',
                        'KR_wi' => 'KR_wi.jpg',
                        'KR_rz' => 'KR_rz.jpg',
                        'KR_dz' => 'KR_dz.jpg',
                        'D_cz' => 'D_cz.jpg',
                        'D_wi' => 'D_wi.jpg',
                        'D_rz' => 'D_rz.jpg',
                        'D_dz' => 'D_dz.jpg',
                        'W_cz' => 'W_cz.jpg',
                        'W_wi' => 'W_wi.jpg',
                        'W_rz' => 'W_rz.jpg',
                        'W_dz' => 'W_dz.jpg',
                        '10_cz' => '10_cz.jpg',
                        '10_wi' => '10_wi.jpg',
                        '10_rz' => '10_rz.jpg',
                        '10_dz' => '10_dz.jpg',
                        '9_cz' => '9_cz.jpg',
                        '9_wi' => '9_wi.jpg',
                        '9_rz' => '9_rz.jpg',
                        '9_dz' => '9_dz.jpg',);

        $cards_user1 = array();
        $cards_user2 = array();
        for($i=0;$i<12;$i++)
        {
            $array_cards = array_rand($cards);
            array_push($cards_user1, $cards[$array_cards]);
            unset($cards[$array_cards]);
            $array_cards = array_rand($cards);
            array_push($cards_user2, $cards[$array_cards]);
            unset($cards[$array_cards]);
        }
        return new JsonModel([
            'card' => $cards_user1,
            'card2' => $cards_user2,
        ]);
    }

    public function checkPlayer(){
        $ses = new Container('user_ses');



    }
}