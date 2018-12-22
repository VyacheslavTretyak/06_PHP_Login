<?php

class SignupController
{
    public function showAction()
    {
        $view = new View('signup');

        $layout = new View('layout');
        $layout->import('content', $view);
        $layout->display();
    }

    public function saveAction()
    {
        $email= $_POST['email'];
        $password = md5($_POST['password']);
        $user = new User();
        $user->select()
            ->where(['email'=>$email])
            ->execute();
        if($user->object != null){
            header("Location: http://localhost/info?info=Email exists!");
        }else {
            $token = hash('sha256', $email);
            $user->id = $token;
            $user->email = $email;
            $user->password = $password;
            $user->save();
            header("Location: http://localhost/login");
        }
    }
}