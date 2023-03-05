        <!-- FEATURES -->
        <div class = "row features valued" >
            <!-- Contribute -->
            <div class="col-12 featurette contribute">
                <div class = "col-10">
                        <p class="lead">Your game experience as a player is valued. Take your time to share the strengths and weaknesses of
                                    your favourite game in a published survey of your choice.
                        </p>

                </div>

            <div class ="row justify-content-end">

                <div class = "col-4 search-box">
                    <form method ="get" type="search" id="search-box">
                        <div class="input-group mb-3">
                            <input type="search" id="s" class="form-control" placeholder="Search surveys" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
                        </div>
                    </form>

                </div>

            </div>
            </div>
        </div>
        <!-- Published surveys -->
        <hr class="featurette-divider contribute">
        <div class = "row featurette surveys align-items-center">
            <?php foreach($surveys as $i => $value): ?>
                <a class="list-group-item  list-group-item-action " >
                    <!-- <img src="<?=base_url()?>/public/img/browse_public_surveys/SurveyImage.svg" class="float-start"> -->
                    <h2><?= $value['title'] ?></h2>
                    <h3><?= $value['description']?></h3>
                    <button type="button" onclick="location.href='<?= base_url()?>/fillin_survey/?sID=<?=$value['surveyId'][0]?>'" class="btn btn-primary float-end" id="FillIn">Fill In</button>
                    <?php if($value['creation-date'] == null): ?>
                        <p class ="text-muted mt-3"> This survey has not been opened yet!</p>
                    <?php else : ?>
                        <p class ="text-muted mt-3">  open since: <?= $value['creation-date'] ?></p>
                    <?php endif; ?>

                </a>
                <hr class="featurette-divider">
            <?php endforeach; ?>
        </div>
