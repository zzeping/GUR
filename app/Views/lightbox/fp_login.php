
<!--A 'name' attribute is required for all input elements needing validation
    'name' attribute must also be unique to the form
    However, each group of radio or checkbox elements will share the same 'name' since
    the value of this grouping represents a single piece of the form data.
    Optionally: Each input can have a label associated with it, where the 'for' attribute of
    the label refers to the 'id' attribute of the input.
    It's also a common practice to have 'id' and 'name' attributes with the same value,
    although keep in mind that since this plugin does not use the 'id' attribute, this is not mandatory.

     There are four ways to provide error messages.
        Via the title attribute of the input element to validate,
        via data attributes,
        via error labels
        via plugin settings (option messages).

        The priorities are as follows:
            A custom message (passed by plugin options),
            the element's title,
            the default message.

            By default, forms are validated:
                on submit,
                triggered by the user clicking the submit button or
                pressing enter when a form input is focused (option onsubmit).
            In addition, once a field was highlighted as being invalid, it is validated whenever
                the user types something in the field (option onkeyup).
            When the user enters something invalid into a valid field, it is
                also validated when the field loses focus (option onfocusout).
-->
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">PXI Login</h5>
            </div>
            <?php if (session()->get('success')): ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->get('success') ?>
                </div>
            <?php endif; ?>
            <div class="modal-body">
                <form id="login-credentials" class="" action="login" method="post">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= set_value('email') ?>">
                    </div>
                    <div class="form-group mt-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" value="">
                    </div>
                    <?php if (isset($validation)): ?>
                        <div class="col-12 mt-3">
                            <div class="alert alert-danger align-middle" role="alert" id="loginAlert">
                                <?= $validation->listErrors() ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row mt-3">
                        <div class="col-12 col-sm-4">
                            <input id="submit" type ="submit" class="btn btn-primary " value = "Login">
                        </div>
                        <div class="mt-3">
                            <a href=<?= base_url() ?>/register>Not registered yet?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

