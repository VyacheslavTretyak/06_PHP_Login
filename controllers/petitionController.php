<?php


class PetitionController
{
    public function showAction(){
        $home = new View('petition');
        $content = $this->getContent();
        $home->assign('content', $content);
        $home->assign('id', $_GET['id']);

        $layout = new View('layout');
        $layout->import('content', $home);
        $layout->display();
    }

    private function getContent()
    {
        ob_start();
        $id = $_GET['id'];
        $petition = new Petition();
        $petition->select()
            ->where(['id'=>$id])
            ->group('id')
            ->leftJoin('signatures', "id_petition", "id" )
            ->count('id')
            ->leftJoin('users',"id", "id_autor")
            ->select('email')
            ->execute();
        do{
            $subject = $petition->subject;
            $body = $petition->body;
            $count = $petition->count_id;
            $email = $petition->object->users_email;
            echo "";
        }while($petition->next());
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    private function sendMail($token, $idPetition){
        $msg = "http://localhost/confirmation?token=$token&id=$idPetition";
        mail("reg@petition.org","Confirmation",$msg);
        header ( "Location: http://localhost/info?info=We send confirmation email on your address!" );
    }

    public function getupAction(){
        $email= $_POST['email'];
        $idPetition = $_POST['id_petition'];
        $user = new User();
        $user->select()
            ->where(['email'=>$email])
            ->execute();
        $findEmail = $user->object;
        if(!$findEmail){
            $token = hash('sha256', $email);
            $user->id = $token;
            $user->email = $email;
            $user->save();
            $this->sendMail($token, $idPetition);
        }
        else if(!$findEmail->active){
            $this->sendMail($findEmail->id, $idPetition);
        }else{
            $token = $findEmail->id;
            $sign = new Signature();
            $sign->select()
                ->where(['id_user'=>$token, 'id_petition'=>$idPetition])
                ->execute();
            $findSignatures = $sign->object;
            if($findSignatures){
                header("Location: http://localhost/info?info=You already get up!");
            }else{
                $sign->id_user = $token;
                $sign->id_petition = $idPetition;
                $sign->save();
                header ( "Location: http://localhost/petition?id=$idPetition");
            }

        }
    }
}