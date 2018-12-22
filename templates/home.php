<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Petition</h1>
            <?php if($sigin){?>
                <form action="add">
                    <input class="btn btn-primary" type="submit" value="Add petition">
                    <a href='login/logout' class='btn btn-info'>Log Out</a>
                </form>
            <?php } else {?>
                <form action="login">
                    <input class="btn btn-primary" type="submit" value="Login">
                </form>
            <?php } ?>
            <?php foreach ($petitions as $val){?>
                    <div class='card'>
					<div class='card-header'>
						<div class='row'>
						  <div class='col-auto mr-auto'><?=$val->subject?></div>
							<div class='col-auto'>[<?=$val->email?>]</div>
						  <div class='col-auto'>Count: <?=$val->count?></div>
						</div>
					</div>
						<div class='card-body'>
							<p class='card-text'><?=$val->body?></p>
                            <?php if($sigin){?>
                                <a href='petition?id=<?=$val->id?>' class='btn btn-info'>Get Up</a>
                            <?php } ?>
                        </div>
					</div>
            <?php } ?>
            <nav aria-label='Page navigation'>
                <ul class='pagination justify-content-center'>
                    <li class='page-item <?=$prevDisabled?>'>
                        <a class='page-link' href='/?page=<?=$prevPage?>'>Previous</a></li>

                    <?php for($i = 1; $i <= $pages; $i ++) {
                        $current = $i == $page?"current":"";?>
                    <li class='page-item'><a class='page-link <?=$current?>' href='/?page=<?=$i?>'><?=$i?></a></li>
                   <?php } ?>
                    <li class='page-item <?=$nextDisabled?>'>
                        <a class='page-link' href='/?page=<?=$nextPage?>'>Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>