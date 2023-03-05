<script> $('input[type="radio"]').mousedown(function() {
        // if it was checked before
        if(this.checked) {
            // bind event to reset state after click is completed
            $(this).mouseup(function() {
                // bind param, because "this" will point somewhere else in setTimeout
                var radio = this;
                // apparently if you do it immediatelly, it will be overriden, hence wait a tiny bit
                setTimeout(function() {
                    radio.checked = false;
                }, 5);
                // don't handle mouseup anymore unless bound again
                $(this).unbind('mouseup');
            });
        }
    });</script>


<div class="row pb-3 pt-3">
            <div class="col-9"></div>
            <div class="col-3 me-auto">
                <div class = "row g-0">
                    <!--Search-->
                    <div class ="col-9 search-box">
                        <form method ="get" type="search" id="search-box">
                            <div class="input-group mb-3">
                                <input type="search" id="s" class="form-control" placeholder=<?= $content['search']?> aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class = "bi bi-search"></i></button>
                            </div>
                        </form>
                    </div>

                    <!--Filter-->
                    <div class ="col text-end" id ="filterbutton">
                        <form method = "post">
                            <div class="btn-group" >
                                <!--Filter button -->
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="true">
                                    <i class = "bi bi-funnel"></i>
                                </button>

                                <!--Filter dropdown -->
                                <ul class="dropdown-menu dropdown-menu-lg-end p-0 m-0">
                                    <li><a class="dropdown-item">
                                            <input type="radio" name="offline" id="offline" value="offline">  <?= $content['show_offline']?>
                                            <br></a></li>
                                    <li><a class="dropdown-item">
                                            <input type="radio" name="online" id="online" value="online">   <?= $content['show_online']?>
                                            <br></a></li>

                                    <hr class="horizontal-divider justify-content-center">

                                    <li><a class="dropdown-item">
                                            <input type="radio" name="az" id="az" value="Sort by name(A-Z)">  <?= $content['sort_AZ']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <i class="bi bi-sort-alpha-down"></i>
                                            <br></a></li>
                                    <li><a class="dropdown-item">
                                            <input type="radio" name="za" id="za" value="Sort by name (Z-A)">  <?= $content['sort_ZA']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <i class="bi bi-sort-alpha-down-alt"></i>
                                            <br></a></li>

                                    <hr class="horizontal-divider justify-content-center">

                                    <li><a class="dropdown-item">
                                            <input type="radio" name="asc" id="asc" value="asc">  <?= $content['sort_opening_date']?>&nbsp;
                                            <i class="bi bi-arrow-down"></i>
                                            <br></a>
                                    </li>
                                    <li><a class="dropdown-item">
                                            <input type="radio" name="desc" id="desc" value="desc">  <?= $content['sort_opening_date']?>&nbsp;
                                            <i class="bi bi-arrow-up"></i>
                                            <br></a></li>

                                    <hr class="horizontal-divider justify-content-center">

                                    <li><a class="dropdown-item">
                                            <input type="radio" name="closedAsc" id="closedAsc" value="closedAsc">  <?= $content['sort_closing_date']?>&nbsp;&nbsp;&nbsp;
                                            <i class="bi bi-arrow-down"></i>
                                            <br></a></li>
                                    <li><a class="dropdown-item">
                                            <input type="radio" name="closedDesc" id="closedDesc" value="closedDesc">  <?= $content['sort_closing_date']?>&nbsp;&nbsp;&nbsp;
                                            <i class="bi bi-arrow-up"></i>
                                            <br></a></li>

                                    <hr class="horizontal-divider justify-content-center">

                                    <li> <a class="dropdown-item">
                                            <button name="btn10" class="btn btn-secondary" style="margin-left:38px">Show results</button>
                                        </a></li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cols-4 ml-auto" id="carddecks" style="justify-content: start; align-content: start; align-items: start; justify-items: start; text-align: start">
            <!--Create new survey card -->
            <div class="col pb-3" style="justify-content: start; align-content: start; align-items: start; justify-items: start; text-align: start">
                <div class="card" style="height: 425px;justify-content: start; align-content: start; align-items: start; justify-items: start; text-align: start">
                    <a href="<?=base_url()?>/create_survey">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="rgba(69, 103, 124, 1)" class="bi bi-plus-circle" viewBox="-8 -8 32 32">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                    </a>
                    <div class="card-body" style="height: 125px">
                        <h5 class="card-title"><?= $content['newsurvey']?></h5>
                        <p class="card-text"><?= $content['newsurvey_text']?></p>
                        <p class="card-text" style="text-align: end"><small class="text-muted"></small></p>
                    </div>
                </div>
            </div>

            <!--Create survey cards-->
            <?php foreach ($surveys as $surveyID => $survey):?>
                <div class ="col pb-3" style="justify-content: start; align-content: start; align-items: start; justify-items: start; text-align: start">
                    <div class="card" id="card" data-string="<?=(string) $survey['title']?>" style="justify-content: start; align-content: start; align-items: start; justify-items: start; text-align: start">
                        <?php if($survey['image'] == null): ?>
                            <img src="<?=base_url()?>/img/content/db_surveys/survey.png" class="card-img-top" style="height:18.75rem;object-fit: cover;" alt="..."/>
                        <?php else: ?>
                            <img src="<?=base_url()?>/getImage/<?=$survey['surveyId'][0]?>"  class="card-img-top" style="height:18.75rem;object-fit: cover;" alt="..."/>
                        <!--$SurveyModel->getImage()-->
                        <?php endif;?>
                        <!--Card image overlay hover action-->
                        <div class="card-img-overlay">

                            <!--Share survey-->
                            <?php $value = $survey['surveyId'][0]?>
                            <span class="btn-lg btn-outline-secondary icon p-0" style="justify-content: end" data-bs-toggle="modal" data-bs-target="#myShareModal" onclick="generateQRCode('https://a21ux04.studev.groept.be/fillin_survey?sID=<?=$value?>')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="32" fill="rgba(69, 103, 124, 1)" class="bi bi-share-fill" viewBox="0 0 16 16">
                                    <path d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5z"/>
                                </svg>
                            </span>

                            <!--Edit survey-->
                            <span class="btn-lg btn-outline-secondary icon p-0" style="justify-content: end">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="32" fill="rgba(69, 103, 124, 1)" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                                </svg>
                            </span>

                            <!--Delete survey-->
                                <!-- Button trigger modal -->
                                <button type="button" class="btn-lg btn-outline-secondary icon p-0" style="align-items: center; align-content: center" data-bs-toggle="modal" data-bs-target="#myModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="32" fill="rgba(69, 103, 124, 1)" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                    </svg>
                                </button>
                            <br><br>

                            <!--Show results-->
                            <h3 class="card-title"><?= $content['show_results']?>
                                <span class="btn-lg btn-outline-secondary icon p-0">
                                    <a href="<?=base_url()?>/results/<?=$survey['surveyId'][0]?>" id="results">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13%" height="13%" fill="rgba(69, 103, 124, 1)" class="bi bi-box-arrow-up-right" viewBox="0 0 22 22">
                                        <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
                                        <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
                                    </svg>
                                    </a>
                                </span>
                                <br><br>

                                <h5 class="card-text"><?=$survey['numberRespondents']?> <?= $content['resp']?></h5>
                                <h5 class="card-text" id="status"><?=$survey['status']?>
                                    <?php if($survey['status'] == 'online'): ?>
                                    <svg id="online" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="rgba(0, 230, 64,1)" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                        <circle cx="8" cy="8" r="8"/>
                                    </svg>
                                    <?php else : ?>
                                    <svg id="offline" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                        <circle cx="8" cy="8" r="8"/>
                                    </svg>
                                    <?php endif; ?>
                                </h5><br><br>

                                <p class="card-text" style="text-align: end">Created on <?=$survey['creation-date']?></p>
                        </div>
                        <article class="card-body" id="bodeh" style="height: 7.813rem">
                            <h5 class="card-title" id="titleSearch"><?=$survey['title']?></h5>
                            <p class="card-text"><?=$survey['description']?></p>
                            <?php for($i=0; $i < count($survey['tags']); $i++ ):?>
                                <span class="badge rounded-pill bg-secondary tag"><?=$survey['tags'][$i]?></span>
                            <?php endfor; ?>
                        </article>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

        <!-- These are the popups(modals) that popup when you click the trash or share icon. Please leave them here -->
        <div class="modal-box">
            <!-- Modal delete -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
                <div class="modal-dialog modal-dialog-centered p-lg-5" role="document">
                    <div class="modal-content" style="text-align: center">
                        <div class="modal-body p-3 pt-5 pb-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="rgba(69, 103, 124, 1)" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                            </svg>
                            <br>
                            <h3 class="title">Are you sure?</h3>
                            <p class="description">Once you delete the survey you can never retrieve it again. Do you still want to delete this survey?</p>
                            <br>
                            <form method = "post">
                                <button class="modal-cancel btn-secondary" onclick="closeModal()">
                                    Cancel
                                </button>
                                <input type="submit" class="subscribe btn-secondary" name="delete" value="Confirm" id="delete"">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal share -->
            <div class="modal fade" id="myShareModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
                <div class="modal-dialog modal-dialog-centered p-lg-5" role="document">
                    <div class="modal-content" style="text-align: center">
                        <div class="modal-body p-3 pt-5 pb-5">

                            <button class="btn-QR" id="qrcode" style="color:#FFFFFF;border-color:transparent;background-color: transparent ;justify-content: center; text-align: center; justify-self: center"></button><br><br>

                            <h3 class="title">Share Survey</h3>

                            <button id="tt" data-toggle="tooltip" data-placement="top" data-bs-original-title="Click to copy" style="width:100%; margin-top:10px;padding-left:75px;text-align: left;" type="button" class="btn-generatedlink btn-lg" value="#" onclick="copyTextToClipboard(value)">
                                <i class="bi bi-link-45deg"></i>  |  Generate a link
                            </button>
                            <a id="mail" href="mailto:?subject=Survey&body=https://www.youtube.com/watch?v=_d-sIDs4zPk&list=RD_d-sIDs4zPk&start_radio=1" target="_blank" onclick="window.open(this.href); return false">
                                <button style="width:100%; margin-top:10px;padding-left:75px;text-align: left" type="button" class="btn-social btn-email btn-lg">
                                    <i class="bi bi-envelope"></i>  |  Share via Mail
                                </button>
                            </a>
                            <!--                        In case you want to open an entire new window when you share something, insert this behind target="blank"
                                                onclick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=250'); return false"-->
                            <a id="linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=https%3A//www.youtube.com/watch?v=_d-sIDs4zPk%26list=RD_d-sIDs4zPk%26start_radio=1&title=&summary=&source=" target="_blank" >
                                <button style="width:100%; margin-top:10px;padding-left:75px;text-align: left" type="button" class="btn-linkedin btn-lg">
                                    <i class="bi bi-linkedin"></i>  |  Share on LinkedIn
                                </button>
                            </a>
                            <a id="twitter" href="https://twitter.com/intent/tweet?text=https://www.youtube.com/watch?v=_d-sIDs4zPk%26list=RD_d-sIDs4zPk%26start_radio=1" target="_blank" >
                                <button style="width:100%; margin-top:10px;padding-left:75px;text-align: left"  type="button" class="btn-twitter btn-lg" >
                                    <i class="bi bi-twitter"></i>  |  Share on Twitter
                                </button>
                            </a>
                            <a id="fb" href="https://www.facebook.com/sharer/sharer.php?u=https%3A//www.youtube.com/watch?v=_d-sIDs4zPk%26list=RD_d-sIDs4zPk%26start_radio=1" target="_blank" >
                                <button style="width:100%; margin-top:10px;padding-left:75px;text-align: left" type="button" class="btn-facebook btn-lg">
                                    <i class="bi bi-facebook"></i>  |  Share on Facebook
                                </button>
                            </a>
                            <a id="messenger" href="https://www.facebook.com/dialog/send?link=https://www.youtube.com/watch?v=_d-sIDs4zPk&list=RD_d-sIDs4zPk&start_radio=1&app_id=291494419107518&redirect_uri=https://www.youtube.com/watch?v=_d-sIDs4zPk&list=RD_d-sIDs4zPk&start_radio=1" target="_blank" >
                                <button style="width:100%; margin-top:10px;padding-left:75px;text-align: left" type="button" class="btn-messenger btn-lg">
                                    <i class="bi bi-chat-dots"></i>  |  Share via Messenger
                                </button>
                            </a>
                            <br><br>
                            <button class="modal-cancel btn-cancel" onclick="closeModal()"><h4>Cancel</h4></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cols-12 justify-content-end pe-0 ps-0">
            <div class="col-10 ">
                <!--Pagination -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1"><?= $content['prev']?></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="<?=base_url()?>/dashboard">1</a></li>
                        <li class="page-item"><a class="page-link" href="<?=base_url()?>/dashboard">2</a></li>
                        <li class="page-item"><a class="page-link" href="<?=base_url()?>/dashboard">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="<?=base_url()?>/dashboard"><?= $content['next']?></a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-1 p-0 m-0">
                <!--Amount of surveys shown-->
                <form method = "post">
                    <input class="btn-secondary btn-page btn-sm mt-1" type="submit" value="3" id="limit" name="limit"/>
                    <input class="btn-secondary btn-page btn-sm mt-1" type="submit" value="10" id="limit" name="limit"/>
                    <input class="btn-secondary btn-page btn-sm mt-1" type="submit" value="20" id="limit" name="limit"/>
                </form>
            </div>
        </div>


