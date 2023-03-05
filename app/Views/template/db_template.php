<header class ="dbnavbar">
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary" aria-label="Ninth navbar example">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url()?>/dashboard" title="Dashboard">
                <img src="<?= base_url()?>/img/component/navbar/pxi_controller.svg" alt="...">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07XL" aria-controls="navbarsExample07XL" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarsExample07XL">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li><a href ="<?=$template['navbar']['my-surveys']['link']?>" title="<?=$template['navbar']['my-surveys']['title']?>" class ="<?=$template['navbar']['my-surveys']['class']?> nav-link"><?=$template['navbar']['my-surveys']['name']?> </a></li>
                    <li><a href ="<?=$template['navbar']['compare']['link']?>" title="<?=$template['navbar']['compare']['title']?>" class ="<?=$template['navbar']['compare']['class']?> nav-link"><?=$template['navbar']['compare']['name']?> </a></li>
                    <li><a href ="<?=$template['navbar']['analyse']['link']?>" title="<?=$template['navbar']['analyse']['title']?>" class ="<?=$template['navbar']['analyse']['class']?> nav-link"><?=$template['navbar']['analyse']['name']?> </a></li>
                    <li></li>
                </ul>
                <span class = "welcome-msg">
                <?=$template['navbar']['welcome']?>
                </span>
                <div class="btn-group">
                    <a class="btn btn-primary account-btn" type="button" href="<?=$template['navbar']['account-settings']['link']?>">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                    </button>
                        <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="dropdownMenuLink">
                            <li><a href ="<?=$template['navbar']['account-settings']['link']?>" title="<?=$template['navbar']['account-settings']['title']?>" class ="dropdown-item <?=$template['navbar']['account-settings']['class']?>"><?=$template['navbar']['account-settings']['name']?> </a></li>
                            <li><a href ="<?=$template['navbar']['logout']['link']?>" title="<?=$template['navbar']['logout']['title']?>" class ="dropdown-item <?=$template['navbar']['logout']['class']?>"><?=$template['navbar']['logout']['name']?> </a></li>
                        </ul>
                </div>

            </div>
    </nav>
</header>

<!--Any bootstrap lightboxes are loaded in this div using db_template.js-->
<div id ="lightBox"></div>

<main class ="dbtemplate">
    <div class="container dbcontent">

        <?= $content?>
    </div>
    <div class ='row footer'>
        <p class="text-center text-muted"><?=$template['footer']['text']['copyright']?><a href="<?=$template['footer']['links']['privacy']?>"><?= $template['footer']['text']['privacy'] ?></a>
            &nbsp;|&nbsp;
            <a href="<?=$template['footer']['links']['terms-of-use']?>">
                <?=$template['footer']['text']['terms-of-use']?>
            </a>
        </p>

        <p class="text-center text-muted languages">
            | <?php foreach ($template['footer']['text']['lang-codes'] as $languageId => $code): ?>
                <a href="<?= base_url()?>/setLanguage/<?=$languageId?>"><?= $template['footer']['text']['lang'][$code]?> (<?= $code?>)</a> |
            <?php endforeach; ?>
        </p>

    </div>
</main>


