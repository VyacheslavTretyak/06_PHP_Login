<?php

class AddController
{
    public function showAction()
    {
        $view = new View('add');

        $layout = new View('layout');
        $layout->import('content', $view);
        $layout->display();
    }

    private function sendMail($token)
    {
        $msg = "http://localhost/confirmation?token=$token";
        mail("reg@petition.org", "Confirmation", $msg);
        header("Location: http://localhost/info?info=We send confirmation email on your address!");
    }

    public function saveAction()
    {
        $email = $_POST ['email'];
        $subject = $_POST ['subject'];
        $body = $_POST ['body'];
        $active = 0;
        $user = new User();
        $user->select()->where(['email' => $email])->execute();
        $findEmail = $user->object;
        if (!$findEmail) {
            $token = hash('sha256', $email);
            $user->id = $token;
            $user->email = $email;
            $user->active = 0;
            $user->save();
            $this->sendMail($token);

        } else if (!$findEmail->active) {
            $this->sendMail($findEmail->id);
        } else {
            $active = 1;
        }
        if ($findEmail) {
            $token = $findEmail->id;
        }
        $petition = new Petition();
        $petition->select()->where(['subject'=>$subject])->execute();
        $findPetition = $petition->object;
        if (!$findPetition) {
            $petition->id_autor = $token;
            $petition->subject = $subject;
            $petition->body = $body;
            $petition->active = $active;
            $petition->save();
            header("Location: http://localhost/info?info=The petition is saved!");
        } else {
            header("Location: http://localhost/info?info=The petition with this subject is exists!");
        }
    }
}