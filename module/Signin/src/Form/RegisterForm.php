<?php
/**
 * Created by PhpStorm.
 * User: ja
 * Date: 09.08.2016
 * Time: 19:45
 */

namespace Signin\Form;


use Zend\Form\Element\Checkbox;
use Zend\Form\Form;
use Zend\Form\View\Helper\FormLabel;

class RegisterForm extends Form
{

    public function init()
    {
        $signinForm = new SigninForm();
        $signinForm->init();
        $signinForm->remove('submit');
        $signinForm->setAttribute('name', 'register-form');
        $signinForm->setAttribute('style', 'display: none');
        $signinForm->setAttribute('action', 'registration');
        $signinForm->get('login')->setAttribute('name','reg_login');
//        $signinForm->setAttribute('name', 'register-form');


        $signinForm->add([
            'name' => 'email',
            'attributes' => [
                'type' => 'email',
                'placeholder' => 'Email',
                'class' => 'form-control',
            ],
        ]);
        $signinForm->add([
            'name' => 'regulamin',
            'type' => 'Zend\Form\Element\Checkbox',
            'options' => [
                'checked_value' => true,
                'unchecked_value' => false,
            ],
            'attributes' => [
                'tabindex' => 3,
                'id' => 'regulamin',
            ],
        ]);
//        $checkbox = new Checkbox('regulamin');
//        $checkbox->setAttribute('class' , '');
//        $checkbox->setCheckedValue('yes')
//            ->setUncheckedValue('no');
//        $signinForm->add($checkbox);
        $signinForm->add([
            'name' => 'submit',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Rejestruj',
                'class' => 'form-control btn btn-register'
            ],
        ]);


        return $signinForm;
    }

}