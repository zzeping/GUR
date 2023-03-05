
<div id="page-amount" class="d-none" maxpages="<?=$number_of_pages?>"></div>
<div id="question-amount" class="d-none" questions="<?=$number_of_questions?>"></div>
<div class="progress progress-container">
    <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%;"></div>
</div>
<img src="https://i.imgur.com/1FGuBYE.png"  alt="jump"  id="img">
<img src="https://i.imgur.com/UpNEgEy.gif"  alt="jump2" id="gif" style="display: none">

            <form id ="fill_in_form" action="<?= base_url()?>/handleFill/<?=$surveyID?>" method ="post">
                <?php $count = 0; ?>
                <?php foreach ($questions as $question) :?>
                    <?php $count++; ?>
                    <div class="<?php if($question->page != 0):echo "d-none"; endif?> <?=$question->type?> question-div <?php if($count == 1): echo "active"; endif?>" pagenr="<?=$question->page?>">
                        <div class = " row q">
                            <div class = "col qtitle mx-0">
                                <h5 id="<?=$question->questionId?>" qtype = "<?=$question->type?>"><?=$question->description?></h5>
                            </div>
                        </div>

                        <div class = "row answer-options">
                            <?php if(substr_compare($question->type,"PXI", 0,3) == 0): ?>
                                <div class="col-sm-2 mt-1 text-center">
                                    <p class="disagree">Strongly<br>Disagree</p>
                                </div>
                                <div class="col-sm-8 text-center gx-0">

                                    <input class="question-answer d-none" value="" name="answer-value-<?= $question->questionId?>" pagenr="<?=$question->page?>">

                                    <input class="btn-check" type="radio" id="q<?= $question->questionId?>-3" name="<?= $question->questionId?>" value="-3" />
                                    <label for="q<?= $question->questionId?>-3" class="pxi-option choice btn btn-outline-secondary" style = "margin-left: 0">-3<br /></label>

                                    <input class="btn-check " type="radio" id="q<?= $question->questionId?>-2" name="<?= $question->questionId?>" value="-2" />
                                    <label for="q<?= $question->questionId?>-2" class="pxi-option choice btn btn-outline-secondary">-2<br /></label>

                                    <input class="btn-check" type="radio" id="q<?= $question->questionId?>-1" name="<?= $question->questionId?>" value="-1" />
                                    <label for="q<?= $question->questionId?>-1" class="pxi-option choice btn btn-outline-secondary">-1<br /></label>

                                    <input class="btn-check" type="radio" id="q<?= $question->questionId?>0" name="<?= $question->questionId?>" value="0" />
                                    <label for="q<?= $question->questionId?>0" class="pxi-option choice btn btn-outline-secondary">0<br /></label>

                                    <input class="btn-check" type="radio" id="q<?= $question->questionId?>1" name="<?= $question->questionId?>" value="1" />
                                    <label for="q<?= $question->questionId?>1" class="pxi-option choice btn btn-outline-secondary">1<br /></label>

                                    <input class="btn-check" type="radio" id="q<?= $question->questionId?>2" name="<?= $question->questionId?>" value="2" />
                                    <label for="q<?= $question->questionId?>2" class="pxi-option choice btn btn-outline-secondary">2<br /></label>

                                    <input class="btn-check" type="radio" id="q<?= $question->questionId?>3" name="<?= $question->questionId?>" value="3" />
                                    <label for="q<?= $question->questionId?>3" class="pxi-option choice btn btn-outline-secondary" style = "margin-right: 0">3<br /></label>

                                </div>
                                <div class="col-sm-2 mt-1 text-center">
                                    <p class="agree">Strongly<br>Agree</p>
                                </div>
                            <?php endif; ?>
                            <?php if($question->type == "MC"): ?>
                            <div class="" style="text-align: center">
                                <input class="question-answer d-none" value="" name="answer-value-<?= $question->questionId?>" pagenr="<?=$question->page?>">
                                <?php foreach ($questionsandoptions as $option): ?>
                                    <?php if($question->description == $option->questiondescription): ?>
                                        <input class="btn-check  " type="radio" id="q<?= $question->questionId.$option->description?>" name="<?= $question->questionId?>" value="<?php $option->description ?>" />
                                        <label for="q<?= $question->questionId.$option->description?>" class="pxi-option2 choice btn btn-outline-secondary "><?= (string)$option->description ?><br /></label>

                                    <?php endif; ?>
                                <?php endforeach ;?>
                            </div>
                            <?php endif; ?>

                            <?php if($question->type == "Datepicker"): ?>

                                <label for='datepicker'></label>
                                <input id = 'datepicker' name="<?= $question->questionId?>" type ="date">
                            <?php endif; ?>

                            <?php if($question->type == "text-long"): ?>

                            <?php endif; ?>

                            <?php if($question->type == "text-short"): ?>
                                <label for='text-short'></label>
                                <input id = 'text-short' name="<?= $question->questionId?>" type ="date">
                            <?php endif; ?>

                            <div class="fill-alert d-flex justify-content-center d-none">
                                <p class="fill-alert-p text-center mt-2 rounded-2 " >Please fill in this question</p>
                            </div>


                    </div>


                    </div>

                <?php endforeach ;?>
            </form>


        <div class = "row">
            <div class="col">
                <button type="submit" class="btn btn-secondary " id="survey_prev"  >Previous page</button>
            </div>

            <div class="col text-end">
                <button type="submit" class="btn btn-secondary float-end" id="survey_next"  >Next Page</button>
                <button type="submit" class="btn btn-secondary float-end d-none" id="survey_submit">Submit Answers</button>
        </div>




