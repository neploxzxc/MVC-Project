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
        $errors = [];
        if(!isset($_POST['name'])) $errors['name'][] = 'Нет поля name';
        if(!isset($_POST['login'])) $errors['login'][] = 'Нет поля login';
        if(!isset($_POST['password'])) $errors['password'][] = 'Нет поля password';
        if(!isset($_POST['password_confirmed'])) $errors['password_confirmed'][] = 'Нет поля password_confirmed';

        if(empty($_POST['name'])) $errors['name'][] = 'Поле name не заполнено!';
        if(empty($_POST['login'])) $errors['login'][] = 'Поле login не заполнено!';
        if(empty($_POST['password'])) $errors['password'][] = 'Поле password не заполнено!';
        if(empty($_POST['password_confirmed'])) $errors['password_confirmed'][] = 'Поле password_confirmed не заполнено!';

        if($_POST['password'] != $_POST['password_confirmed']) $errors['password'][] = 'Пароли не совпали!';

        if($errors != [])
            return view('register', compact('errors'));

        unset($_POST['password_confirmed']);
        # Шифруем пароль в SHA1
        $_POST['password'] = sha1($_POST['password']);
        $user = new User();

        # Проверка что логин уникальный
        if($user->isNotUniqueColumn('login', $_POST['login']))
            $errors['login'] [] ='Логин не является уникальным';
        return view('register', compact('errors'));

        $user = $user->create($_POST);
        return view('users/successRegister', compact('user'));
    }
}

class  UserController extands BaseController
{
    public function register()
{

    return view('register');


}
    public function loginPost()
{

    if(!isset($_POST['login'])) $errors['login'][] = 'Нет поля login';
    if(!isset($_POST['password'])) $errors['password'][] = 'Нет поля password';



    if(empty($_POST['login'])) $errors['login'][] = 'Поле login не заполнено!';
    if(empty($_POST['password'])) $errors['password'][] = 'Поле password не заполнено!';


    if ($errors !=[])
        return view('user/login',compact('errors'));
$user = new User();
$fUser = $user->where(
    [
        ['login','=',$_POST['login']]
        ['password','=',$_POST['password']]

    ]
);
  $fUser(count($fUser)==0)
}


}

