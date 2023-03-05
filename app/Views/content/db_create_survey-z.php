<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>-->
<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">-->

<head>
    <title>create a survey</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="http://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/vue@2.6.2/dist/vue.min.js"></script>
    <script src="https://unpkg.com/bootstrap-vue@2.21.2/dist/bootstrap-vue.min.js"></script>

    <!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<?php $i = 0; ?>
<?php $i_n = 0; ?>
<?php $i_s = 0; ?>
<?php $i_ns = 0; ?>
<main>
    <div id="baseurl" class="d-none" baseurl="<?= base_url()?>"></div>
    <div class="alert alert-success alert-dismissible fade show" id="myAlert" style="display:none;">
        <i class="bi-check-circle-fill"></i>
        <strong>Success!</strong> Your survey has been created successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

        <div class="mt-3 shadow-lg pe-lg-3 container-lg rounded-2 pb-3" style="max-width: 876px; background-color: rgba(76, 123, 94, 0.9)">
            <div class="row ps-2 me-0 pe-2 ">
                <div class="row mt-3 pb-0 m-2 rounded-3 pe-1 container-fluid"  style="background-color: rgba(173,205,185,0.07)">
                    <div class="col container mt-3">
                        <h3 style="color: #FFFFFF">Create a survey</h3>
                    </div>
                </div>
                <div class="row ms-2 mt-0 pt-2 p-1 rounded-3 container-fluid p-0" style="background-color: rgba(173,205,185,0.08)">
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
                                    <div id="collapseOne" class="accordion-collapse collapse show bg-white overflow-auto" style="max-height: 522px" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="ms-1 bi bi-question-diamond" viewBox="0 0 16 16" data-toggle="tooltip"  title="Enjoyment is not a construct of the PXI but it can be added if you are interested in measuring it.">
                                                        <path d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.482 1.482 0 0 1 0-2.098L6.95.435zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z"/>
                                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                                                    </svg>
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="ms-1 bi bi-question-diamond" viewBox="0 0 16 16" data-toggle="tooltip" title="There are 11 questions (including 1 enjoyment question) in short version of the survey as each construct has only one question. For long type of survey, there are 33 questions in total (including 3 enjoyment questions). ">
                                                        <path d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.482 1.482 0 0 1 0-2.098L6.95.435zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z"/>
                                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                                                    </svg>
                                                    <br>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="long" checked>
                                                        <label class="form-check-label" for="flexSwitchCheckChecked">Long</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group top-buffer">
                                                    <label for="enjoyment" class="form-label">Languages</label>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="ms-1 bi bi-question-diamond" viewBox="0 0 16 16" data-toggle="tooltip" title="Only one language can be selected. ">
                                                        <path d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.482 1.482 0 0 1 0-2.098L6.95.435zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z"/>
                                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                                                    </svg>
                                                    <br>
                                                    <select class="form-select" id="language" value="<?= set_value('language') ?>" aria-label="Default select example">
                                                        <option selected>English</option>
                                                        <option value="Dutch">Dutch</option>
                                                    </select>
                                                </div>
                                                <br>
                                                <div>
                                                    <label for="start">Start date:</label>
                                                    <input type="date" id="start" name="start">
                                                </div>
                                                <br>
                                                <div>
                                                    <label for="end">End date:</label>
                                                    <input type="date" id="end" name="end">
                                                </div>
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
                                                        <label for="add_q_type" class="form-label">Question type</label>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="ms-1 bi bi-question-diamond" viewBox="0 0 16 16" data-toggle="tooltip"  title="Here you can add your own questions to the survey. After entering the question and clicking the add button, the question will be automatically added at the bottom of the survey. You can drag all questions to change positions.">
                                                            <path d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.482 1.482 0 0 1 0-2.098L6.95.435zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z"/>
                                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                                                        </svg>
                                                        <select id="add_q_type" class="form-select form-select-sm" aria-label="question_type" >
                                                            <option value="1" selected>Open question</option>
                                                            <option value="2">Multiple choice</option>
                                                        </select>
                                                    </div>
                                                    <br>
                                                    <div class="form-group top-buffer" id="q_box">
                                                        <label for="question_en" class="form-label">Question</label>
                                                        <textarea id=question_en class="form-control" placeholder="The question text..." aria-label="question_en" value="<?= set_value('question_en') ?>"></textarea>
                                                        <br>
                                                    </div>

                                                    <div id="mc_an" style="display: none;">
                                                        <div class="form-inline pb-3">
                                                            <label class="my-1 mr-2" for="ans_nr">Answers number</label>
                                                            <select class="custom-select my-1 mr-sm-2" id="ans_nr">
                                                                <option selected value="2">Two</option>
                                                                <option value="3">Three</option>
                                                                <option value="4">Four</option>
                                                                <option value="5">Five</option>
                                                                <option value="6">Six</option>
                                                                <option value="7">Seven</option>
                                                                <option value="8">Eight</option>
                                                                <option value="9">Nine</option>
                                                            </select>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">1</span>
                                                            <input type="text" id="an_1" class="form-control" placeholder="Answer one" aria-label="Answer one" aria-describedby="basic-addon1">
                                                        </div>
                                                        <div class="input-group mb-3" >
                                                            <span class="input-group-text" id="basic-addon2">2</span>
                                                            <input type="text"id="an_2" class="form-control" placeholder="Answer two" aria-label="Answer two" aria-describedby="basic-addon2">
                                                        </div>
                                                        <div id="in_3" style="display: none;">
                                                            <div class="input-group mb-3" >
                                                                <span class="input-group-text" id="basic-addon3">3</span>
                                                                <input type="text" id="an_3" class="form-control" placeholder="Answer three" aria-label="Answer three" aria-describedby="basic-addon3">
                                                            </div>
                                                        </div>
                                                        <div id="in_4" style="display: none;">
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon4">4</span>
                                                                <input type="text" id="an_4" class="form-control" placeholder="Answer four" aria-label="Answer four" aria-describedby="basic-addon4">
                                                            </div>
                                                        </div>
                                                        <div id="in_5" style="display: none;">
                                                            <div class="input-group mb-3" >
                                                                <span class="input-group-text" id="basic-addon5">5</span>
                                                                <input type="text" id="an_5" class="form-control" placeholder="Answer five" aria-label="Answer five" aria-describedby="basic-addon5">
                                                            </div>
                                                        </div>
                                                        <div id="in_6" style="display: none;">
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon6">6</span>
                                                                <input type="text" id="an_6"  class="form-control" placeholder="Answer six" aria-label="Answer six" aria-describedby="basic-addon6">
                                                            </div>
                                                        </div>
                                                        <div id="in_7" style="display: none;" >
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon7">7</span>
                                                                <input type="text"  id="an_7"class="form-control" placeholder="Answer seven" aria-label="Answer seven" aria-describedby="basic-addon7">
                                                            </div>
                                                        </div>
                                                        <div id="in_8" style="display: none;">
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon8">8</span>
                                                                <input type="text"  id="an_8" class="form-control" placeholder="Answer eight" aria-label="Answer eight" aria-describedby="basic-addon8">
                                                            </div>
                                                        </div>
                                                        <div id="in_9" style="display: none;">
                                                            <div class="input-group mb-3" >
                                                                <span class="input-group-text" id="basic-addon9">9</span>
                                                                <input type="text"  id="an_9"class="form-control" placeholder="Answer nine" aria-label="Answer nine" aria-describedby="basic-addon9">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="op_an" >
                                                        <div class="form-group top-buffer">
                                                            <label for="survey_type" class="form-label">Answer length</label>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="ms-1 bi bi-question-diamond" viewBox="0 0 16 16" data-toggle="tooltip"  title="Here you can choose the size answer area. It can be a text box that contains large input or a small text input area. ">
                                                                <path d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.482 1.482 0 0 1 0-2.098L6.95.435zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z"/>
                                                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                                                            </svg>
                                                            <br>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="long_an" checked>
                                                                <label class="form-check-label" for="flexSwitchCheckChecked">Long</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <btn class="btn-outline-primary btn" id="add_btn" style="display: none;" disabled>Add the question</btn>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<!--                                <div class="accordion-item">-->
<!--                                    <h2 class="accordion-header" id="headingThree">-->
<!--                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">-->
<!--                                            Add page breaks-->
<!--                                        </button>-->
<!--                                    </h2>-->
<!--                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">-->
<!--                                        <div class="accordion-body">-->
<!---->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFoure">
                                            Choose style
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="accordion-body bg-white">
                                            <div class="form-group top-buffer">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="me-1 mt-2 bi bi-question-diamond float-end" viewBox="0 0 16 16" data-toggle="tooltip" title="Here you can add page breaks after any questions. It will decide when to end the current page and begin the next page. ">
                                                    <path d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.482 1.482 0 0 1 0-2.098L6.95.435zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z"/>
                                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                                                </svg>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label" for="pb">
                                                        Add page breaks
                                                    </label>
                                                    <input class="form-check-input" type="checkbox" id="pb">
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
                        <div id="english_long" class= "p-2 pe-1 m-2 bg-white shadow rounded-1 container" >
                            <div class="row container drag_con"  id="conta">
                                <?php foreach ($questions_en_long as $qu):?>
                                    <?php $i++; ?>
                                <div class=" form-check p-3 m-1 shadow-sm rounded-1 draggable PXI ps-4"id="<?php echo$qu[0]?>">
                                    <input class=" form-check-input my-auto pb_box" style="display: none;" type="checkbox" value="">
                                    <h6 class=" my-auto user-select-all"><?php echo $i ?>. (PXI) <?=$qu[1]?></h6>
<!--                                    <div class="form-check form-check-inline">-->
<!--                                        <input class="form-check-input" type="radio" name="Options" id="MC1option1">-->
<!--                                        <label class="form-check-label" for="MC1option1">1</label>-->
<!--                                    </div>-->
<!--                                    <div class="form-check form-check-inline">-->
<!--                                        <input class="form-check-input" type="radio" name="Options" id="MC1option2" value="option2">-->
<!--                                        <label class="form-check-label" for="MC1option2">2</label>-->
<!--                                    </div>-->
                                </div>
                                <?php endforeach ;?>
                                <div class="row drag_con p-0 m-0" id="conta_e">
                                    <?php foreach ($questions_en_enjoy_long as $qu):?>
                                        <?php $i++; ?>
                                        <div class=" form-check p-3 m-1 shadow-sm rounded-1 PXI draggable ps-4"id="<?php echo $qu[0]?>">
                                            <input class=" form-check-input my-auto pb_box" style="display: none;" type="checkbox" value="">
                                            <h6 class=" my-auto user-select-all"><?php echo $i ?>. (PXI) <?=$qu[1]?></h6>
                                            <!--                                    <button class=" float-end btn btn-xs delete btn-outline-danger px-2 py-0" style="font-size:0.6rem">X</button>-->
                                        </div>
                                    <?php endforeach ;?>
                                </div>
                            </div>
                        </div>

                        <div id="english_short" class= "p-2 pe-1 m-2 bg-white shadow rounded-1 container" style="display: none;">
                            <div class="row container drag_con" id="conta_es">
                                <?php foreach ($questions_en_short as $qu):?>
                                    <?php $i_s++; ?>
                                    <div class=" form-check p-3 m-1 shadow-sm rounded-1 draggable PXI ps-4"id="<?php echo$qu[0]?>">
                                        <input class=" form-check-input my-auto pb_box" style="display: none;" type="checkbox" value="">
                                        <h6 class=" my-auto user-select-all"><?php echo $i_s ?>. (PXI) <?=$qu[1]?></h6>
                                        <!--                                    <button class=" float-end btn btn-xs delete btn-outline-danger px-2 py-0" style="font-size:0.6rem">X</button>-->
                                    </div>
                                <?php endforeach ;?>
                                <div class="row drag_con p-0 m-0" id="conta_es_e">
                                    <?php foreach ($questions_en_enjoy_short as $qu):?>
                                        <?php $i_s++; ?>
                                        <div class=" form-check p-3 m-1 shadow-sm rounded-1 PXI draggable ps-4"id="<?php echo$qu[0]?>">
                                            <input class=" form-check-input my-auto pb_box" style="display: none;" type="checkbox" value="">
                                            <h6 class=" my-auto user-select-all"><?php echo $i_s ?>. (PXI) <?=$qu[1]?></h6>
                                            <!--                                    <button class=" float-end btn btn-xs delete btn-outline-danger px-2 py-0" style="font-size:0.6rem">X</button>-->
                                        </div>
                                    <?php endforeach ;?>
                                </div>
                            </div>
                        </div>

                        <div id="dutch_long" class= "p-2 pe-1 m-2 bg-white shadow rounded-1 container" style="display: none;">
                            <div class="row container drag_con" id="conta_dl">
                                <?php foreach ($questions_nl_long as $qu):?>
                                    <?php $i_n++; ?>
                                    <div class=" form-check p-3 m-1 shadow-sm rounded-1 draggable PXI ps-4"id="<?php echo$qu[0]?>">
                                        <input class=" form-check-input my-auto pb_box" style="display: none;" type="checkbox" value="">
                                        <h6 class=" my-auto user-select-all"><?php echo $i_n ?>. (PXI) <?=$qu[1]?></h6>
                                        <!--                                    <button class=" float-end btn btn-xs delete btn-outline-danger px-2 py-0" style="font-size:0.6rem">X</button>-->
                                    </div>
                                <?php endforeach ;?>
                                <div class="row drag_con p-0 m-0" id="conta_nl_e">
                                    <?php foreach ($questions_nl_enjoy_long as $qu):?>
                                        <?php $i_n++; ?>
                                        <div class=" form-check p-3 m-1 shadow-sm rounded-1 draggable PXI ps-4"id="<?php echo$qu[0]?>">
                                            <input class=" form-check-input my-auto pb_box" style="display: none;" type="checkbox" value="">
                                            <h6 class=" my-auto user-select-all"><?php echo $i_n ?>. (PXI) <?=$qu[1]?></h6>
                                            <!--                                    <button class=" float-end btn btn-xs delete btn-outline-danger px-2 py-0" style="font-size:0.6rem">X</button>-->
                                        </div>
                                    <?php endforeach ;?>
                                </div>
                            </div>
                        </div>

                        <div id="dutch_short" class= "p-2 pe-1 m-2 bg-white shadow rounded-1 container" style="display: none;">
                            <div class="row container drag_con" id="conta_ds">
                                <?php foreach ($questions_nl_short as $qu):?>
                                    <?php $i_ns++; ?>
                                    <div class=" form-check p-3 m-1 shadow-sm rounded-1 draggable PXI ps-4"id="<?php echo$qu[0]?>">
                                        <input class=" form-check-input my-auto pb_box" style="display: none;" type="checkbox" value="">
                                        <h6 class=" my-auto user-select-all"><?php echo $i_ns ?>. (PXI) <?=$qu[1]?></h6>
                                        <!--                                    <button class=" float-end btn btn-xs delete btn-outline-danger px-2 py-0" style="font-size:0.6rem">X</button>-->
                                    </div>
                                <?php endforeach ;?>
                            </div>
                            <div class="row drag_con p-0 m-0" id="conta_ds_e">
                                <?php foreach ($questions_nl_enjoy_short as $qu):?>
                                <?php $i_ns++; ?>
                                <div class=" form-check p-3 m-1 shadow-sm rounded-1 draggable PXI ps-4"id="<?php echo$qu[0]?>">
                                    <input class=" form-check-input my-auto pb_box" style="display: none;" type="checkbox" value="">
                                    <h6 class=" my-auto user-select-all"><?php echo $i_ns ?>. (PXI) <?=$qu[1]?></h6>
                                    <!--                                    <button class=" float-end btn btn-xs delete btn-outline-danger px-2 py-0" style="font-size:0.6rem">X</button>-->
                                </div>
                            </div>
                            <?php endforeach ;?>
                        </div>


<!--                        <p class="ms-2" id="total_nr">Total number of questions: 26</p>-->
                        <div id="thank_box" class= "ps-3 p-4 pe-1 m-2 bg-white shadow rounded-1 container" style="display: none">
                        <div class="row container">
                                        <input id="message" type="text" class="form-control my-auto" placeholder="Thank you for your participation!">
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


        </div>



</main>

<div id="number" style="display: none"><?php echo htmlspecialchars($i); ?></div>
<div id="person_id" style="display: none"><?php echo htmlspecialchars($person_id); ?></div>
