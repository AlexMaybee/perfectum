
<div class="row pt-2 pb-2">

    <?php
//    print_r($old);
//    print_r($errors);
    ?>

    <div class="col-8 offset-2 bg-dark pt-2 pb-2 mb-5">
        <form action="create" method="post">
            <div class="row">

                <?= csrf_field() ?>

                <div class="col-6 mt-2 mb-2">
                    <input name="name" class="form-control <?php if(isset($errors['name'])) echo 'is-invalid'; ?>"
                           type="text" placeholder="Name" value="<?= isset($old['name']) ? $old['name']:''?>">
                    <?php if(isset($errors['name']) && $errors['name']):?>
                        <div class="invalid-feedback">
                            <?=$errors['name'];?>
                        </div>
                    <?php endif;?>
                </div>
                <div class="col-6 mt-2 mb-2">
                    <input name="email" class="form-control <?php if(isset($errors['email'])) echo 'is-invalid'; ?>"
                           type="text" placeholder="Email" value="<?= isset($old['email']) ? $old['email']:''?>" required>
                    <?php if(isset($errors['email']) && $errors['email']):?>
                    <div class="invalid-feedback">
                        <?=$errors['email'];?>
                    </div>
                    <?php endif;?>

                </div>
                <div class="col-12 mt-2 mb-2">
                    <textarea name="comment" class="form-control <?php if(isset($errors['comment'])) echo 'is-invalid'; ?>"
                              placeholder="Comment..." required><?= isset($old['comment']) ? $old['comment']:''?></textarea>
                    <?php if(isset($errors['comment']) && $errors['comment']):?>
                        <div class="invalid-feedback">
                            <?=$errors['comment'];?>
                        </div>
                    <?php endif;?>
                </div>
                <div class="col-12 mt-2 mb-2 d-flex justify-content-end">
                    <button class="col-2 offset-10 btn btn-primary" type="submit">Sent</button>
                </div>
            </div>

        </form>
    </div>

    <div class="col-8 offset-2 bg-dark pt-2 pb-2">

        <?=$pager->links('chat','my_custom_bootstrap');?>

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
                            <a class="btn btn btn-outline-secondary" href="/hide/<?=$comment['comment_id'];?>" role="button">hide</a>
                            <a class="btn btn btn-outline-warning" href="/update/<?=$comment['comment_id'];?>" role="button">update</a>
                            <a class="btn btn btn-outline-danger" href="/delete/<?=$comment['comment_id'];?>" role="button">delete</a>
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

        <?=$pager->links('chat','my_custom_bootstrap');?>
    </div>
</div>
