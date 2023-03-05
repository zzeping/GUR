
    <div class="row mt-5" id="doosje2">
        <div class="col-12 col-sm8- offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper shadow-lg p-3 mb-5 bg-white rounded">
            <div class="container">
                <h3><?= $user['name'].' '.$user['surname'] ?></h3>
                <hr>
                <?php if (session()->get('success')): ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->get('success') ?>
                    </div>
                <?php endif; ?>
                <form class="" action=<?= base_url() ?>/settings method="post">
                    <div class="row">
                        <div class="col-12 col-sm-6 top-buffer3">
                            <div class="form-group">
                                <label for="name"><?=$settingsForm['first-name']?></label>
                                <input type="text" class="form-control" name="name" id="name" value="<?= set_value('name', $user['name']) ?>">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 top-buffer3">
                            <div class="form-group">
                                <label for="surname"><?=$settingsForm['surname']?></label>
                                <input type="text" class="form-control" name="surname" id="surname" value="<?= set_value('surname', $user['surname']) ?>">
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <label for="email"><?=$settingsForm['email']?></label>
                                <input type="text" class="form-control" readonly id="email" value="<?= $user['email'] ?>">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mt-3">
                            <div class="form-group">
                                <label for="password"><?=$settingsForm['pw']?></label>
                                <input type="password" class="form-control" name="password" id="password" value="">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mt-3">
                            <div class="form-group">
                                <label for="password_confirm"><?=$settingsForm['confirm-pw']?></label>
                                <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="">
                            </div>
                        </div>
                        <?php if (isset($validation)): ?>
                            <div class="col-12 mt-2">
                                <div class="alert alert-danger" role="alert">
                                    <?= $validation->listErrors() ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-4 mt-3">
                            <button type="submit" class="btn btn-primary" id="updateButton"><?=$settingsForm['confirm-btn']?></button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
