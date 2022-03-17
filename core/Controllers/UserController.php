<?php

namespace Controllers;

use Models\User;

class UserController extends BaseController
{
    public function register()
    {
        return view('register');
    }

    public function registerPost()
    {
        $errors=[];
        if(!isset($_POST['name'])) $errors['name']=['Нет поля nme'];
        if(!isset($_POST['login'])) $errors['login']=['Нет поля nme'];
        if(!isset($_POST['password'])) $errors['password']=['Нет поля nme'];
        if(!isset($_POST['password_confirmed'])) $errors['password_confirmed']=['Нет поля nme'];


        if(empty($_POST['name'])) $errors['name'][] ='Поле не заполнено';
        if(empty($_POST['login'])) $errors['login'][] ='Поле не заполнено';
        if(empty($_POST['password'])) $errors['password'][] ='Поле не заполнено';
        if(empty($_POST['password_confirmed'])) $errors['password_confirmed'][] ='Поле не заполнено';



        if($_POST['password'] != $_POST['password_confirmed']) $errors['password'][]='Пароли не совпали!';


        if($errors !=[])
            return view('register',$errors);
        unset($_POST['password_confirmed']);
        $user = new User();
        return $user->get();
        $findUser = $user->create($_POST);
        return var_dump($findUser);
    }
}