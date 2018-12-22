<?php

class LoginController
{
    public function showAction()
    {
        $view = new View('login');

        $layout = new View('layout');
        $layout->import('content', $view);
        $layout->display();
    }

    public function loginAction()
    {
        $email= $_POST['email'];
        $password = md5($_POST['password']);
        $user = new User();
        $user->select()
            ->where(['email'=>$email, 'password'=>$password])
            ->execute();
        if($user->object == null){
            header ( "Location: http://localhost/login" );
        }else {
            $session = new Session();
            $session->hash = md5(time());
            $session->save();
            $session->select()
                ->where(['hash' => $session->hash])
                ->execute();
            $time = time()+3600 * 24;
            setcookie('session', $session->object->id, $time, "/");
            setcookie('hash', $session->object->hash, $time, "/");
            header("Location: http://localhost/");
        }
    }
    public function logoutAction()
    {
        $time = time()-3600 * 24;
        setcookie('session', $_SESSION['session'], $time, "/");
        setcookie('hash', $_SESSION['hash'], $time, "/");
        header("Location: http://localhost/");
    }
}