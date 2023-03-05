
<div class ="fp_navbar">
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary" aria-label="Ninth navbar example" >
        <div class="container">
            <a class="navbar-brand " href="<?= base_url()?>" title="Home">
                <img src="<?= base_url()?>/img/component/navbar/pxi_controller.svg" alt="...">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07XL" aria-controls="navbarsExample07XL" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExample07XL">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li><a id="navbar_text" href ="<?=$template['navbar']['create']['link']?>" title="<?=$template['navbar']['create']['title']?>" class ="<?=$template['navbar']['create']['class']?> nav-link"><?=$template['navbar']['create']['name']?> </a></li>
                    <li><a id="navbar_text" href ="<?=$template['navbar']['fill-in']['link']?>" title="<?=$template['navbar']['fill-in']['title']?>" class ="<?=$template['navbar']['fill-in']['class']?> nav-link"><?=$template['navbar']['fill-in']['name']?> </a></li>
                    <li>
                        <div class="navbar-nav nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= $template['navbar']['about']['name']?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item <?= $template['navbar']['about-pxi']['class']?>" href="<?= $template['navbar']['about-pxi']['link']?>"><?= $template['navbar']['about-pxi']['name']?></a></li>
                                <li><a id ='AboutTeam4' class="dropdown-item <?= $template['navbar']['about-team4']['class']?>" href="<?= $template['navbar']['about-team4']['link']?>"><?= $template['navbar']['about-team4']['name']?></a></li>
                                <li><a class="dropdown-item <?= $template['navbar']['contact']['class']?>" href="<?= $template['navbar']['contact']['link']?>"><?= $template['navbar']['contact']['name']?></a></li>
                            </ul>
                        </div>
                    </li>
                </ul>

                <a id = "login" class ="<?=$template['navbar']['login']['class']?> btn btn-outline-secondary login" href ="<?=$template['navbar']['login']['link']?>" title="<?=$template['navbar']['login']['title']?>"><?=$template['navbar']['login']['name']?> </a>
                <a id = "register" class ="<?=$template['navbar']['signup']['class']?> btn btn-secondary signup register" href ="<?=$template['navbar']['signup']['link']?>" title="<?=$template['navbar']['signup']['title']?>"><?=$template['navbar']['signup']['name']?> </a>
                <div class="dropdown" data-bs-display="static">
                    <a class="btn btn-primary dropdown-toggle language-menu" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-globe2"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="dropdownMenuLink">
                        <li><h6 class="dropdown-header"><?= $template['navbar']['languages']['menu']['header']?></h6></li>
                        <?php foreach ($template['navbar']['languages']['name'] as $languageID => $language): ?>
                            <li><a class="dropdown-item" href="<?= base_url()?>/setLanguage/<?=$languageID?>"><span class="fi fi-gr"></span><?=$language?></a></li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

</div>

<main class ="fptemplate">
    <div class="container fpcontent">

        <!-- HERO IMG -->
        <div class="row hero-img">
            <div class = "col" style ="background-image: url(<?= $template['hero-image']?>)">
                <!-- TO LOAD A DIFFERENT HERO IMG, USE THE SCSS FILE OF THE PAGE-->
            </div>
        </div>

        <!-- TITLE -->
        <div class="row title ">
            <div class = "col">
                <h1><?= $template['title']?></h1>
                <h3><?= $template['subtitle']?></h3>
            </div>
        </div>
        <div id ='content'>

        </div>
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




