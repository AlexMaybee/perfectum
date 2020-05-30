

<div class="row pt-2 pb-2">

    <div class="col-8 offset-2 bg-dark pt-2 pb-2 mb-5">
        <form action="/update/<?=$message['comment_id']?>" method="post">
            <div class="row">

                <?= csrf_field() ?>

                <div class="col-6 mt-2 mb-2">
                    <input name="name" class="form-control <?php if(isset($errors['name'])) echo 'is-invalid'; ?>"
                           type="text" placeholder="Name" value="<?= isset($old['name']) ? $old['name']: $message['user_name'];?>">
                    <?php if(isset($errors['name']) && $errors['name']):?>
                        <div class="invalid-feedback">
                            <?=$errors['name'];?>
                        </div>
                    <?php endif;?>
                </div>
                <div class="col-6 mt-2 mb-2">
                    <input name="email" class="form-control <?php if(isset($errors['email'])) echo 'is-invalid'; ?>"
                           type="text" placeholder="Email" value="<?= isset($old['email']) ? $old['email']:$message['email'];?>" required>
                    <?php if(isset($errors['email']) && $errors['email']):?>
                        <div class="invalid-feedback">
                            <?=$errors['email'];?>
                        </div>
                    <?php endif;?>

                </div>
                <div class="col-12 mt-2 mb-2">
                    <textarea name="comment" class="form-control <?php if(isset($errors['comment'])) echo 'is-invalid'; ?>"
                              placeholder="Comment..." required><?= isset($old['comment']) ? $old['comment']:$message['comment']?></textarea>
                    <?php if(isset($errors['comment']) && $errors['comment']):?>
                        <div class="invalid-feedback">
                            <?=$errors['comment'];?>
                        </div>
                    <?php endif;?>
                </div>
                <div class="col-12 mt-2 mb-2 d-flex justify-content-end">
                    <button class="col-2 offset-10 btn btn-warning" type="submit">Save</button>
                </div>
            </div>

        </form>
    </div>

</div>