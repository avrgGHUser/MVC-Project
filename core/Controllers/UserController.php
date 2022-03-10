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
        if($_POST['passsword'] != $_POST['passsword_confirmed'])
            return header('Location: ?error_password');
        unset($_POST['passsword_confirmed']);
        $user = new User();
        return $user->get();
        $findUser = $user->create($_POST);
        return var_dump($findUser);
    }
}