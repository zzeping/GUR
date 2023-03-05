        <!-- FEATURES -->
        <div class = "row features">
            <!-- Research -->
            <div class = "row featurette align-items-center">
                <div class="col-md-7">
                        <h2 class="featurette-heading" ><?= $features['research']['buzzword'] ?><span class="text-muted"><?= $features['research']['highlighted']?></span></h2>
                        <p class="lead"><?= $features['research']['text']?>
                    <p>
                            <a class="btn btn-outline-secondary" href="<?=$features['research']['buttonlink']?>"><?= $features['research']['buttontext']?>&raquo;</a>
                    </p>
                </div>
                <div class="col-md-5 featurette-img">
                    <img src="<?=$features['research']['image']?>" class="img-fluid" alt="..." style="max-height: 80%">
                </div>
            </div>

            <hr class="featurette-divider align-items-center">

            <!-- Analyse -->
            <div class="row featurette justify-content-center"  >
                <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading" ><?= $features['analyse']['buzzword'] ?><span class="text-muted"><?= $features['analyse']['highlighted']?></span></h2>
                    <p class="lead"><?= $features['analyse']['text']?>
                    </p>
                    <br>
                    <p>
                        <a class="btn btn-outline-secondary" href="<?=$features['research']['buttonlink']?>"><?= $features['analyse']['buttontext']?>&raquo;</a>

                    </p>
                </div>
                <div class="col-md-5 order-md-1 featurette-img">
                    <img src="<?= base_url()?>/img/content/fp_home/analyse.svg" class="img-fluid" alt="..." style="max-height: 80%">

                </div>
            </div>
            <hr class="featurette-divider justify-content-center">

            <!-- Share -->
            <div class="row featurette ">
                <div class="col-md-7">
                    <h2 class="featurette-heading"><?=$features['share']['buzzword']?><span class="text-muted"><?=$features['share']['highlighted']?></span></h2>
                    <p class="lead"><?=$features['share']['text']?></p>
                    <p>
                        <a class="btn btn-outline-secondary" href="<?= base_url()?>/register"><?=$features['share']['buttontext']?> &raquo;</a>
                    </p>
                </div>
                <div class="col-md-5 featurette-img">
                    <img src="<?= base_url()?>/img/content/fp_home/share.svg" class="img-fluid" alt="..." style="max-height: 80%">

                </div>
            </div>
        </div>
            <!-- END THE FEATURETTES -->

        <br>

       <div class="row title">
            <div class = "col">
                <h1><?=$features['const']['title']?></h1>
                <a id="gamers"><h3><?=$features['const']['subtitle']?></h3></a>
            </div>
        </div>
        <div class = "row features">
        <div class = "row featurette features">
            <div class="col-md-7">
                <h2 class="featurette-heading"><?=$features['const']['buzzword']?><span class="text-muted"><?=$features['const']['highlighted']?></span></h2>
                <p class="lead"><?=$features['const']['text']?></p>
                <p>
                    <a class="btn btn-outline-secondary" href="<?= base_url()?>/browse"><?=$features['const']['buttontext']?> &raquo;</a>
                </p>
            </div>
            <div class="col-md-5 featurette-img">
                <img src="<?= base_url()?>/img/content/fp_home/contribute.svg" class="img-fluid" alt="..." style="max-height: 80%">
            </div>
        </div>
        </div>

    </div>
    </div>


