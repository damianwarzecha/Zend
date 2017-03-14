<?php
/**
 * Created by PhpStorm.
 * User: ja
 * Date: 08.08.2016
 * Time: 20:54
 */

namespace Signin\Controller;


use Signin\Model\UserTable;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\JsonModel;


class IndexController extends AbstractActionController
{

    private $table;

    public function __construct(UserTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
        $session = new Container('user_ses');
        if ($session->logged)
        {
            return ['login' => $session->username];


//            $viewmodel = new ViewModel();
//
//            throw new RuntimeException(
//                sprintf($viewmodel->getTemplate())
//            );
//
//            return new JsonModel([
//                'success' => false,
//                'html' => '<label id="tesst">'.$login.''.'</label>',
//            ]);
        }
        else
        {
            return $this->redirect()->toRoute('signin');
        }
        return [];
    }

    public function ajaxIndexAction()
    {

        $session = new Container('user_ses');

        if ($session->logged)
        {

            $buttonType = $this->params()->fromPost('button_type');
//        requestType = $this->request->

            if ($buttonType == 'user'){
                if ($this->getRequest()->isPost())
//                getMethod() == 'POST')
                {
                    $users = $this->table->fetchAll();
                    $tab = array();
                    foreach ($users as $user)
                    {
                        $tab_session = scandir(session_save_path());
                        $ses = "sess_".$user->getSesId();

                        if(in_array($ses, $tab_session)){
                            if($user->getUsername()==$session->username){
                                continue;
                            }
                            array_push($tab, [$user->getUsername(),1,$ses]);
                        }else{
                            array_push($tab, [$user->getUsername(),0]);
                        }
//                        array_push($tab, [$user->getUsername(),$user->getLogInNow()]);
                    }
                    return new JsonModel([
                        'users' => $tab
                    ]);
                }

                if ($this->getRequest()->isDelete())
                {
                    $this->table->deleteUserByName($this->params()->fromQuery('name'));
                    return new JsonModel();
                }
            }
        }
        else
        {
            return $this->redirect()->toRoute('signin');
        }
    }

}