        <div class = "row about">
            <div class ="col-12">
                <p class = "lead">
                <?= $pageDescription?>
                </p>
            </div>
        </div>

        <div class = "row personalia">
            <?php foreach ($persons as $namekey => $data): ?>
                <div class="card mb-3">
                    <div class = "row">
                        <div class="col-md-4 g-0">
                    <img src="<?=$data['image']?>" class="img-fluid rounded-start filtered">
                        </div>
                        <div class = "col-md-8">
                            <div class="card-body">
                        <h5 class="card-title"> <?=$data['name']?></h5>
                        <p class="card-text"><?=$descriptions[$namekey]?></p>
                    </div>
                    </div>
                    </div>
                </div>
            <?php endforeach ?>
            </div>
        </div>




