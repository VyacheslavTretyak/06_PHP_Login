<?php

class HomeController{
    public function showAction(){
        $session = new Session();
        if(isset($_COOKIE['session'])){
            $session->select()
                ->where(['id'=>$_COOKIE['session'], 'hash'=>$_COOKIE['hash']])
                ->execute();
        }
        $sigin = $session->object != null;

        $home = new View('home');
        $home->assign('sigin', $sigin);
        if (! isset ( $_GET ['page'] )) {
            $page = 1;
        }
        else {
            $page = $_GET ['page'];
        }

        $entity = new Petition();
        $entity->select()
            ->group('id')
            ->where(['active'=>1])
            ->leftJoin('signatures',  'id_petition', 'id')
            ->count('id')
            ->leftJoin('users', 'id', 'id_autor')
            ->select('email')
            ->execute();

        $countOnPage = 3;
        $allPetitions = $entity->objects;
        $countPetition = count($allPetitions);
        $pages = ceil ( $countPetition / $countOnPage );
        $start = $countOnPage * ($page - 1);
        $arr = [];
        for($i = 0; $i < 3; $i ++) {
            $petition = $allPetitions [$i + $start];
            $obj = new stdClass();
            $obj->subject = $petition ['subject'];
            $obj->body = $petition ['body'];
            $obj->count = $petition ['count_id'];
            $obj->email = $petition['users_email'];
            $obj->id = $petition['id'];
            if ($i + $start < $countPetition) {
                $arr[] = $obj;
            }
        }

        $home->assign('petitions', $arr);


        $prevPage = $page > 1 ? $page - 1 : 1;
        $nextPage = $page < pages ? $page + 1 : $pages;
        $prevDisabled = $page > 1 ? '' : 'disabled';
        $nextDisabled = $page < $pages ? '' : 'disabled';
        $home->assign('prevDisabled', $prevDisabled);
        $home->assign('nextDisabled', $nextDisabled);
        $home->assign('prevPage', $prevPage);
        $home->assign('nextPage', $nextPage);
        $home->assign('page', $page);
        $home->assign('pages', $pages);
        $layout = new View('layout');
        $layout->import('content', $home);
        $layout->display();
    }
}
