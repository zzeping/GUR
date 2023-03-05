<!-- Navbar view -->
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
                    <li><a id="navbar_text" href ="<?=$navbar_items[0]['link']?>" title="<?=$navbar_items[0]['title']?>" class ="<?=$navbar_items[0]['class']?> nav-link"><?=$navbar_items[0]['name']?> </a></li>
                    <li><a id="navbar_text" href ="<?=$navbar_items[1]['link']?>" title="<?=$navbar_items[1]['title']?>" class ="<?=$navbar_items[1]['class']?> nav-link"><?=$navbar_items[1]['name']?> </a></li>
                    <li>
                        <div class="navbar-nav nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= $navbar_items[2]['name']?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item <?= $navbar_items[3]['class']?>" href="<?= $navbar_items[3]['link']?>"><?= $navbar_items[3]['name']?></a></li>
                                <li><a class="dropdown-item <?= $navbar_items[4]['class']?>" href="<?= $navbar_items[4]['link']?>"><?= $navbar_items[4]['name']?></a></li>
                                <li><a class="dropdown-item <?= $navbar_items[5]['class']?>" href="<?= $navbar_items[5]['link']?>"><?= $navbar_items[5]['name']?></a></li>
                            </ul>
                        </div>
                    </li>
                </ul>



                    <a id = "login"    class ="<?=$navbar_items[6]['class']?> btn btn-outline-secondary login" href ="<?=$navbar_items[6]['link']?>" title="<?=$navbar_items[6]['title']?>"><?=$navbar_items[6]['name']?> </a>
                    <a id = "register" class ="<?=$navbar_items[7]['class']?> btn btn-secondary signup register" href ="<?=$navbar_items[7]['link']?>" title="<?=$navbar_items[7]['title']?>"><?=$navbar_items[7]['name']?> </a>
            </div>
            </div>
</nav>


