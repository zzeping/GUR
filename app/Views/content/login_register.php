

<div class = "row justify-content-end bg-white from-wrapper p-3 mb-5 bg-white rounded">

    <form id = "registerForm" class="" action="<?= base_url() ?>/register" method="post">
        <div id="required"><?= $registerForm['fields-required'] ?></div>
        <div class="row ">
            <div class="col-12 col-sm-6 ">
                <div class="form-group">
                    <label for="name"><?= $registerForm['first-name'] ?></label>
                    <input type="text" class="form-control" name="name" id="name" value="<?= set_value('name') ?>" >
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label for="surname"><?= $registerForm['surname'] ?></label>
                    <input type="text" class="form-control" name="surname" id="surname" value="<?= set_value('surname') ?>">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group mt-2">
                    <label for="email"><?= $registerForm['email'] ?></label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="<?= $registerForm['email-example'] ?>" value="<?= set_value('email') ?>">
                </div>
            </div>
            <div class="col-12 col-sm-6 mt-2">
                <div class="form-group">
                    <label for="password"><?= $registerForm['pw'] ?></label>
                    <input type="password" class="form-control" name="password" id="password" value="">
                </div>
            </div>
            <div class="col-12 col-sm-6 mt-2">
                <div class="form-group">
                    <label for="password_confirm"><?= $registerForm['pw-confirm'] ?></label>
                    <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="">
                </div>
            </div>

            <?php if (isset($validation)): ?>
                <div class="col-12 mt-2">
                    <div class="alert alert-danger mt-2" role="alert">
                        <?= $validation->listErrors() ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="row pt-5 justify-content-end" >
        <div class="col text-end">
            <button type="submit" class="btn btn-primary"><?= $registerForm['register-btn'] ?></button>
        </div>
        </div>

        <div class="row justify-content-end pt-1" >
            <div id="already" class="col text-end " style="font-size: 12px">
                <a href=<?= base_url() ?>/login><?= $registerForm['login'] ?></a>
            </div>
        </div>



    </div>



    </form>
</div>






<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->

<script src="<?= base_url() ?>/js/register.js" ></script>