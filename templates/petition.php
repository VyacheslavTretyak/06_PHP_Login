<div class="container">
    <div class = "row">
        <div class = "col-12">
            <div class='card'>
                <div class='card-header'>
                    <div class='row'>
                        <div class='col-auto mr-auto'><?=$petition->subject?></div>
                        <div class='col-auto'>[<?=$petition->users_email?>]</div>
                        <div class='col-auto'>Count: <?=$petition->count_id?></div>
                    </div>
                </div>
                <div class='card-body'>
                    <p class='card-text'><?=$petition->body?></p>
                </div>
            </div>
            <form action="petition/getup" method="post">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" placeholder="name@example.com"  name="email" id="email" required>
                </div>
                <a class="btn btn-secondary" href="index">Back</a>
                <input class="btn btn-primary" type="submit" value="GetUp">
                <input type="hidden" value="<?= $id?>" name="id_petition" />
            </form>
        </div>
    </div>
</div>