

<div class = "row justify-content-end bg-white from-wrapper p-3 mb-5 bg-white rounded">

<form class="" action=<?= base_url() ?>/login method="post">

    <div class="row mt-3 just">

        <?php if (session()->get('success')): ?>
            <div class="alert alert-success"  role="alert">
                <?= session()->get('success') ?>
            </div>
        <?php endif; ?>
    <div class ="col">
            <div class="form-group">
                <label for="email"><?= $loginForm['email'] ?></label>
                <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email') ?>">
            </div>
            <div class="form-group mt-3">
                <label for="password"><?= $loginForm['pw'] ?></label>
                <input type="password" class="form-control" name="password" id="password" value="">
            </div>
        </div>

    </div>

    <?php if (isset($validation)): ?>
        <div class="col-12 mt-3">
            <div class="alert alert-danger align-middle" role="alert" id="loginAlert">
                <?= $validation->listErrors() ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="row pt-3 justify-content-end">
        <div class="col text-end">
            <button class="btn btn-primary "><?= $loginForm['login-btn']?></button>
        </div>
        <div class="mt-3">

        </div>
    </div>

    <div class="row justify-content-end pt-1" >
        <div class="col text-end " style="font-size: 12px">
            <a href=<?= base_url() ?>/register><?= $loginForm['register']?></a>
        </div>
    </div>

</form>

</div>



<!--!--<div id="myModal"> class="modal fade" >
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">PXI Login</h5>
        </div>
        <?php /*if (session()->get('success')): */?>
            <div class="alert alert-success" role="alert">
                <?/*= session()->get('success') */?>
            </div>
        <?php /*endif; */?>
        <div class="modal-body">
            <form class="" action=<?/*= base_url() */?>/login method="post">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="text" class="form-control" name="email" id="email" value="<?/*= set_value('email') */?>">
                </div>
                <div class="form-group mt-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" value="">
                </div>
                <?php /*if (isset($validation)): */?>
                    <div class="col-12 mt-3">
                        <div class="alert alert-danger align-middle" role="alert" id="loginAlert">
                            <?/*= $validation->listErrors() */?>
                        </div>
                    </div>
                <?php /*endif; */?>
                <div class="row mt-3">
                    <div class="col-12 col-sm-4">
                        <button id="LoginButton" submit" class="btn btn-primary ">Login</button>
                    </div>
                    <div class="mt-3">
                        <a href=<?/*= base_url() */?>/register>Not registered yet?</a>
                    </div>
                </div>
        </div>
    </div>
</div>
</div>-->