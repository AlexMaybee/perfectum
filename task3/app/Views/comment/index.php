<div class="row pt-2 pb-2">

    <div class="col-8 offset-2 bg-dark pt-2 pb-2 mb-5">
        <form class="comment-form">
            <div class="row">

                <?= csrf_field() ?>

                <div class="col-6 mt-2 mb-2">
                    <input name="name" class="form-control" type="text" placeholder="Name">
                </div>
                <div class="col-6 mt-2 mb-2">
                    <input name="email" class="form-control" type="text" placeholder="Email">
                </div>
                <div class="col-12 mt-2 mb-2">
                    <textarea name="comment" class="form-control" placeholder="Comment..."></textarea>
                </div>
                <div class="col-12 mt-2 mb-2 d-flex justify-content-end">
                    <button class="col-2 offset-10 btn btn-primary" type="submit">Sent</button>
                </div>
            </div>

        </form>
    </div>

    <div class="col-8 offset-2 bg-dark pt-2 pb-2">

        <?=$pagination->simpleLinks();?>

        <?php
            if($comments):
        ?>
            <ul class="list-group p-2">
        <?
                foreach ($comments as $comment):
        ?>
            <li class="list-group-item">
                <div class="col-12 d-flex justify-content-between ">
                    <div class="col-3 text-info"><?=(!$comment['user_name']) ? explode('@',$comment['email'])[0].':' : $comment['user_name'].':'?></div>
                    <div class="col-3 text-muted"><?=$comment['date_create'];?></div>
                    <div class="col-3">
                        <div class="btn-group btn-group-sm" role="group">
                            <a class="btn btn btn-outline-secondary" href="/comment/hide/<?=$comment['comment_id'];?>" role="button">hide</a>
                            <a class="btn btn btn-outline-warning" href="/comment/update/<?=$comment['comment_id'];?>" role="button">update</a>
                            <a class="btn btn btn-outline-danger" href="/comment/delete/<?=$comment['comment_id'];?>" role="button">delete</a>
                        </div>
                    </div>
                </div>
                <div class="col-12"><?=$comment['comment'];?></div>
            </li>
        <?php
                endforeach;
        ?>
            </ul>
        <?php
            endif;
        ?>

    </div>
</div>
