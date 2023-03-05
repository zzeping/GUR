<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>-->
<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">-->
<input class = "hidden" id = 'initial-language' value = <?= $_SESSION['language']?>>

<head>
    <title>Create a new survey</title>

</head>

<?php $i = 0; ?>
<?php $i_n = 0; ?>
<?php $i_s = 0; ?>
<?php $i_ns = 0; ?>



    <div id="baseurl" class="d-none" baseurl="<?= base_url()?>"></div>
    <div class="alert alert-success alert-dismissible fade show" id="myAlert" style="display:none;">
        <i class="bi-check-circle-fill"></i>
        <strong>Success!</strong> Your survey has been created successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

            <div class="row ps-2 me-0 pe-2 ">
                <div class="row mt-3 pb-0 m-2 rounded-3 pe-1">
                    <div class="col container mt-3">
                        <h3>Create a survey</h3>
                    </div>
                </div>
                <div class="row ms-2 mt-0 pt-2 p-1 rounded-3 container-fluid p-0">
                     <div class = "col-3 m-0 ps-0 pe-2">
                        <div class="row ms-0" style="height: 700px">
                            <div class="accordion p-0" id="accordionExample"><div class="col container ms-3  pe-0">
                        </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            General settings
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show bg-white overflow-auto" style="max-height: 540px" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body p-3">
                                            <form action="<?= base_url() ?>/public/create_survey" method="post">
                                                <div class="form-group top-buffer">
                                                    <label for="survey_name" class="form-label">Survey name</label>
                                                    <input type="text" class="form-control" name="survey_name" id="survey_name" value="<?= set_value('survey_name') ?>">
                                                </div>
                                                <br>
                                                <div class="form-group top-buffer">
                                                    <label for="survey_descr" class="form-label">Description</label>
                                                    <textarea id=survey_descr class="form-control" aria-label="description" value="<?= set_value('description') ?>"></textarea>
                                                </div>
                                                <br>
                                                <div class="form-group top-buffer">
                                                    <label for="enjoyment" class="form-label">Additional measure</label>
                                                    <i class="bi bi-question-circle"></i>
                                                    <br>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="enjoyment"checked>
                                                        <label class="form-check-label" for="enjoyment">
                                                            Enjoyment
                                                        </label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group top-buffer">
                                                    <label for="survey_type" class="form-label">Survey type</label>
                                                    <i class="bi bi-question-circle"></i>
                                                    <br>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="long" checked>
                                                        <label class="form-check-label" for="flexSwitchCheckChecked">Long</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group top-buffer">
                                                    <label for="enjoyment" class="form-label">Languages</label>
                                                    <i class="bi bi-question-circle"></i>
                                                    <br>
                                                    <select class="form-select" id="language" value="<?= set_value('language') ?>" aria-label="Default select example">
                                                        <option selected>English</option>
                                                        <option value="Dutch">Dutch</option>
                                                    </select>
                                                </div>
                                                <br>
                                                <label for="start">Start date:</label>
                                                <input type="date" id="start" name="start">
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Add question
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse overflow-auto" style="max-height: 487px" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body bg-white p-3">
                                            <div class="row top-buffer">
                                                <div class="col">


                                                    <div class="form-group">
                                                        <label for="questionType" class="form-label">Question Type</label>
                                                        <i class="bi bi-question-circle"></i>
                                                        <select id="questionType" class="form-select form-select-sm" aria-label="question_type" >
                                                            <option id = "" value="" class="hidden"></option>
                                                            <option id = "question-open" value="open">open ended</option>
                                                            <option id = "question-mc" value="MC">multiple choice</option>
                                                        </select>
                                                    </div>
                                                    <br>

                                                    <div class="form-group top-buffer" id="q_box">
                                                        <textarea id=question-description class="form-control" placeholder="your question" aria-label="question-description"></textarea>
                                                    </div>

                                                    <br>

                                                    <div id="mc-options" class="hidden">
                                                        <button id = "add-mc-option"> <i class="bi bi-plus-circle"></i> add option </button>
                                                        <div id= "options"></div>

                                                    </div>
                                                    <br>
                                                    <br>

                                                    <div id="open-options"  class = "hidden" >
                                                        <div class="form-group top-buffer">
                                                            <label for="survey_type" class="form-label">Answer length</label>
                                                            <i class="bi bi-question-circle"></i>
                                                            <br>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="long_an" checked>
                                                                <label class="form-check-label" for="flexSwitchCheckChecked">Long</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>

                                                    <btn class="btn-outline-primary btn" id="add-question-btn" disabled>Add the question</btn>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFoure">
                                            Choose style
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="accordion-body bg-white">
                                            <div class="form-group top-buffer">
                                                <i class="bi bi-question-circle"></i>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="pb">
                                                    <label class="form-check-label" for="pb">
                                                        Add page breaks
                                                    </label>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group top-buffer">
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="thank">
                                                <label class="form-check-label" for="thank">
                                                    Add end message
                                                </label>
                                            </div>
                                            </div>
                                            <br>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class ="col-9 pe-0 m-0">
                    <div class="content p-1 pe-4 bg-body rounded-1 container"style="height: 700px; overflow-y: auto; overflow-x: hidden;">
                        <div id="survey-questions" class= "p-2 pe-1 m-2 bg-white shadow rounded-1 container" >
                            <div class="row container drag_con"  id="conta">
                                <?php foreach ($pxiQuestions as $construct => $questions):?>
                                    <?php foreach ($questions as $question): ?>
                                    <?php $i++; ?>
                                <div class="<?php print($construct) ?> survey-question form-check p-3 m-1 shadow-sm rounded-1 draggable PXI ps-4"id="<?php echo$question[0]?>">
                                    <input class=" form-check-input my-auto pb_box" style="display: none;" type="checkbox" value="">
                                    <h6 class=" my-auto user-select-all"><?=$question[1]?></h6>
<!--                                    <button class=" float-end btn btn-xs delete btn-outline-danger px-2 py-0" style="font-size:0.6rem">X</button>-->
                                </div>
                                    <?php endforeach ;?>
                                <?php endforeach ;?>

                            </div>
                        </div>


                        <div id="thank_box" class= "ps-3 p-4 pe-1 m-2 bg-white shadow rounded-1 container" style="display: none">
                        <div class="row container">
                                        <input type="text" class="form-control my-auto" placeholder="Thank you for your participation!">
                            </div>
                        </div>


                    </div>




                </div>
<!--                <div class="col p-1 me-2">-->
<!--                    <button class="btn btn-warning m-1 float-end me-2 " id="survey_submit" >Create</button>-->
<!--                    <button class="btn btn-outline-warning m-1 float-end me-2 " id="survey_preview" >Preview</button>-->
<!--                </div>-->
            </div>
                <div class="col container m-1 pe-0">
                    <button class="btn ms-2 btn-secondary float-end shadow-sm" id="survey_submit" style="width: 5rem; height: 2.3rem">Create</button>
                    <!--                        <button class="btn btn-outline-secondary float-end me-2 shadow-sm" id="survey_preview" style="border-color: rgba(255,255,255,0.7);color: rgba(255,255,255,1); width: 5rem; height: 2.28rem">Preview</button>-->
                </div>

                <div class="col container m-1 pe-0">
                    <button class="btn ms-2 btn-secondary float-end shadow-sm" id="test-button" style="width: 5rem; height: 2.3rem">Test button</button>
                    <!--                        <button class="btn btn-outline-secondary float-end me-2 shadow-sm" id="survey_preview" style="border-color: rgba(255,255,255,0.7);color: rgba(255,255,255,1); width: 5rem; height: 2.28rem">Preview</button>-->
                </div>







<div id="number" style="display: none"><?php echo htmlspecialchars($i); ?></div>
<div id="person_id" style="display: none"><?php echo htmlspecialchars($person_id); ?></div>
