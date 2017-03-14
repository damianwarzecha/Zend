<?php

namespace Signin\Controller;

use Signin\Form\RegisterForm;
use Signin\Form\SigninForm;
use Signin\Model\User;
use Signin\Model\UserTable;
use Zend\Authentication\AuthenticationService;
use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Config\SessionConfig;
use Zend\Session\Container;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;


class SigninController extends AbstractActionController
{
    private $table;
    private $smtp;
    public function __construct(UserTable $table, Smtp $smtp)
    {
        $this->table = $table;
        $this->smtp = $smtp;
    }

    /**
     * Kontroler logowania
     */
    public function signinAction()
    {
        /**
         * Tworze formularz logowania
         */
        $form = new SigninForm();
        $register_form = new RegisterForm();
        /**
         * Tworzony nowy kontener sesji
         */
        $conf = new SessionConfig();
        $conf->setGcMaxlifetime(50);
        $conf->setRememberMeSeconds(50);
        $conf->setGcDivisor(1);
        $session = new Container('user_ses');
        $session->getManager()->setConfig($conf);
        /**
         * Sprawdzenie czy użytkownik jest zalogowany
         */
        $this->checkSession();
        /**
         * Jeśli formularz został wysłany sprawdzamy parametry
         */
        if($this->getRequest()->isPost())
        {

            $authAdapter = new AuthAdapter($this->getRequest()->getPost('login'), $this->getRequest()->getPost('pass'), $this->table);
            $auth = new AuthenticationService();
            $result=$auth->authenticate($authAdapter);
//            $result->isValid();
//            throw new \Exception(
//                printf($result[0])
//            );
            if($result->isValid())
            {
                $session->logged = true;
                $session->username = $this->getRequest()->getPost('login');
                $this->table->setLogin($session->username, true);
                $this->table->setSes($session->username,$session->getManager()->getId());
                $this->redirect()->toRoute('thousend');
            }
        }
        return [
            'form' => $form->init(),
            'register_form' => $register_form->init(),
            'logged' => $session->logged
        ];
    }

//    public function indexAction()
//    {
//        $session = new Container('user_ses');
//        if ($session->logged)
//        {
//            return ['login' => $session->username];
//        }
//        else
//        {
//            return $this->redirect()->toRoute('signin');
//        }
//        return [];
//    }

    public function logoutAction()
    {
        $session = new Container('user_ses');
        $this->table->setLogout($session->username,false);
        $session->getManager()->destroy();
        return $this->redirect()->toRoute('signin');
    }


    public function registrationAction()
    {

//        $email = $this->params()->fromPost('email');
//        $username = $this->params()->fromPost('login');
//        $pass = $this->params()->fromPost('pass');

        $user = new User();
        $user->setEmail($this->params()->fromPost('email'));
        $user->setUsername($this->params()->fromPost('reg_login'));
        $user->setPassword($this->params()->fromPost('pass'));
        $user->setUserId(0);



        if ( ($this->table->getUserByEmail($user->getEmail()) == null) && ($this->table->getUser($user->getUsername()) == null) )
        {
            $uniqid = $this->unigId();
            $user->setActive($uniqid);
            $this->table->saveUser($user);
            $message = new Message();
            $message->addTo($user->getEmail())
                ->addFrom('damianw12345@o2.pl')
                ->setSubject('Aktywacja konta')
                ->setBody('Link aktywacyjny: damren.pl:5422/active?id=' . $uniqid);

            $this->smtp->send($message);
        }
        return new ViewModel([
            'email' => $user->getActive()
        ]);
    }

    public function activeAction()
    {
        $user = $this->table->getUserByActive(
            $this->params()->fromQuery('id')
        );
        $user->setActive(true);
        $this->table->saveUser($user);


        return $this->redirect()->toRoute('signin');

//        return ['id' => $this->params()->fromQuery('id')];
    }

    public function ajaxAction()
    {
//        $input = $this->params()->fromPost('input_data');
//        $inputType = $this->params()->fromPost('input_type');
//        $data = $this->request->getPost();
        $inputType = $this->params()->fromPost('input_type');
        $inputData = $this->params()->fromPost('input_data');



        if ($inputType == 'login')
        {
            if(($this->table->getUser($inputData) == null))
            {
                return new JsonModel();
            }
        }
        elseif ($inputType == 'email')
        {

            if ($this->table->getUserByEmail($inputData) == null)
            {
                return new JsonModel();
            }
        }

//        $this->getResponse()->setStatusCode(Response::STATUS_CODE_404);
        return new JsonModel([
            'user' => false
        ]);
    }

    /**
     * Sprawdzenie czy user jest zalogowany
     */
    public function checkSession()
    {
        $session = new Container('user_ses');
        if ($session->logged)
        {
            return $this->redirect()->toRoute('index');
        }
    }

    public function unigId()
    {
        $uniqid='';
        for ($i=0;$i<57;$i++)
        {
            $uniqid = $uniqid . mt_rand(0,9);
        }
        return $uniqid;
    }

    public function zagrajAction(){
        $gracz = $this->params()->fromPost('name');

        return new JsonModel();
    }
}

