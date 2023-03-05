    <!--CONTACT FORM-->
    <div class = "row justify-content-end bg-white from-wrapper p-3 mb-5 bg-white rounded">

            <form id="contact-form" name="contact-form" action="mail.php" method="POST">
                <!-- Subject -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                                            <label for="subject" class=""><?= $formdata['subject']?></label>
                                            <input type="text" id="subject" name="subject" class="form-control">
                        </div>
                    </div>
                </div>

                <!-- Message -->
                <div class="row pt-3">
                    <div class="col-md-12">
                        <div class="md-form">
                            <label for="subject" class=""><?= $formdata['message']?></label>
                            <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Name & E-mail -->
                <div class="row pt-3">
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="name" class=""><?= $formdata['name']?></label>
                            <input type="text" id="name" name="name" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="email" class=""><?= $formdata['email']?></label>
                            <input type="text" id="email" name="email" class="form-control">
                        </div>
                    </div>
                </div>
            </form>

            <!-- submit button -->
            <div class ="row pt-3 justify-content-end">
                <div class=" col text-end">
                    <a class="btn btn-primary" onclick="document.getElementById('contact-form').submit();"><?= $formdata['submit']?></a>
                </div>
            </div>

            <div class="status"></div>
    </div>





