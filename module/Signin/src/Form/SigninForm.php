<?php

namespace Signin\Form;


use Zend\Form\Form;

class SigninForm extends Form
{
    public function init()
    {
        parent::__construct('login-form');
        $this->setAttribute('role', 'form');

        $this->setAttribute('style', 'display: block');

//        $this->setAttribute('action', 'thousend');

        $this->add([
            'name' => 'login',
            'attributes' => [
                'type' => 'text',
                'placeholder' => 'Login',
                'class' => 'form-control',
            ],
        ]);
        $this->add([
            'name' => 'pass',
            'attributes' => [
                'type' => 'password',
                'placeholder' => 'Hasło',
                'class' => 'form-control',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Zaloguj',
                'class' => 'form-control btn btn-login',
            ],
        ]);

        return $this;
    }
}