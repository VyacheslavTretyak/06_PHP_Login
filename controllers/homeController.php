<?php

class HomeController{
    public function showAction(){
        $home = new View('home');
        $content = $this->getContent();
        $home->assign('content', $content);

        $layout = new View('layout');
        $layout->import('content', $home);
        $layout->display();
    }
    private function getContent(){
        ob_start();
        if (! isset ( $_GET ['page'] )) {
            $page = 1;
        }
        else {
            $page = $_GET ['page'];
        }
        $entity = new Entity('petitions');
        $entity->select()
            ->group('id')
            ->where(['active'=>1])
            ->leftJoin('signatures',  'id_petition', 'id')
            ->count('id')
            ->leftJoin('users', 'id', 'id_autor')
            ->select('email')
            ->execute();

        $countOnPage = 3;
        $allPetitions = $entity->getListObjects();
        $countPetition = count($allPetitions);
        $pages = ceil ( $countPetition / $countOnPage );
        $start = $countOnPage * ($page - 1);
        for($i = 0; $i < 3; $i ++) {
            $petition = $allPetitions [$i + $start];
            $subject = $petition ['subject'];
            $body = $petition ['body'];
            $count = $petition ['qty'];
            $email = $petition['users_email'];
            if ($i + $start < $countPetition) {
                echo "<div class='card'>
                <div class='card-header'>
                    <div class='row'>
                      <div class='col-auto mr-auto'>$subject</div>
                    <div class='col-auto'>[$email]</div>
                      <div class='col-auto'>Count: $count</div>
                    </div>
                </div>
                    <div class='card-body'>
                        <p class='card-text'>$body</p>
                        <a href='petition?id=" . $petition ['id'] . "' class='btn btn-info'>Get Up</a>
                    </div>
                </div>";
            }
        }

        $prevPage = $page > 1 ? $page - 1 : 1;
        $nextPage = $page < pages ? $page + 1 : $pages;
        $prevDisabled = $page > 1 ? '' : 'disabled';
        $nextDisabled = $page < $pages ? '' : 'disabled';
        echo "<nav aria-label='Page navigation'>
        <ul class='pagination justify-content-center'>
            <li class='page-item $prevDisabled'>
            <a class='page-link' href='/?page=$prevPage'>Previous</a></li>";

        for($i = 1; $i <= $pages; $i ++) {
            $current =$i == $page?"current":"";
            echo "<li class='page-item'>
        <a class='page-link $current' href='/?page=$i'>$i</a></li>";
        }
        echo "<li class='page-item $nextDisabled'>
            <a class='page-link' href='/?page=$nextPage'>Next</a></li>
        </ul>
    </nav>";
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}
