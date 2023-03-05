
<div class="container">
    <div class="row" id="doosje">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper shadow-lg p-3 mb-5 bg-white rounded">
            <div class="container">
                <h3>PXI Login</h3>
                <hr>
                <?php if (session()->get('success')): ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->get('success') ?>
                    </div>
                <?php endif; ?>
                <form class="" action=<?= base_url() ?>/login method="post">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email') ?>">
                    </div>
                    <div class="form-group mt-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" value="">
                    </div>
                    <?php if (isset($validation)): ?>
                        <div class="col-12 mt-2">
                            <div class="alert alert-danger align-middle" role="alert" id="loginAlert">
                                <?= $validation->listErrors() ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="mt-2">
                    <a href=<?= base_url() ?>/register>Not registered yet?</a>
                    </div>
                    <div class="mt-2">
                        <a href=<?= base_url() ?>/forgot_password>Forgot password?</a>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-sm-4">
                            <button id="LoginButton" submit" class="btn btn-primary ">Login</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>/js/jquery-3.6.0.min.js" ></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>