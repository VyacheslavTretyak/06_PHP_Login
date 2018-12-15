<?php

class ConfirmationController{
    public function confirmAction(){

        $token = $_GET ['token'];
        $user = new User();
        $user->select()->where(['id'=>$token])->execute();
        $findEmail = $user->object;
        if ($findEmail) {
            $user->active = 1;
            $user->save();
            if (isset ( $_GET ['id'] )) {
                $sign = new Signature();
                $sign->id_user = $token;
                $sign->id_petition = $_GET ['id'];
                $sign->save();
            }
            else {
                $db = DB::GetInstance();
                $sql = "update petitions
			set active = true
			where id_autor=:token";
                $query = $db->prepare ( $sql, array (
                    PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY
                ) );
                $query->execute ( array (
                    ':token' => $token
                ) );
            }
            header ( "Location: http://localhost/" );
        }
        else {
            header ( "Location: http://localhost/info?info=Email not found!" );
        }
    }
}