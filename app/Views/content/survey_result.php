    <script src="https://cdn.anychart.com/releases/8.0.0/js/anychart-base.min.js"></script>






        <div class="row" id="first_row">

            <div class = "col-12 title">

                <h1> <span class="text2">Results for survey: </span> <span class="text-white"> <?= $title[0]->title?> </span></h1>

            </div>
        </div>
        <div class="row mb-5">
            <div class="main-content">
                <!--<div class="row">
                <div class="upperLeft mx-auto shadow-sm bg-body ">
                    <h2 class="upperLeft"> <span class="text-muted"> Number of respondents: </span> 100 </h2>
                </div>
                </div>-->

                <div class="row mt-2">

                    <div class="col-4 shadow-sm bg-body mb-2" id ="description" style="height: 40rem">
                        <!--<h2 id ="leftTitle" class="text-muted ">Filter Constructs</h2>-->

                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span class ="text-muted">Filter Constructs</span>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Ease of Control &nbsp <input class="form-check-input construct" type="checkbox" id="Construct1" value="ease-of-control"><br>
                                        Goals and rules &nbsp <input class="form-check-input construct" type="checkbox" id="Construct2" value="goals-and-rules"><br>
                                        Challenge &nbsp<input class="form-check-input construct" type="checkbox" id="Construct3" value="challenge"><br>
                                        Progress Feedback &nbsp<input class="form-check-input construct" type="checkbox" id="Construct4" value="progress-feedback"><br>
                                        Audiovisual appeal &nbsp<input class="form-check-input construct" type="checkbox" id="Construct5" value="audiovisual-appeal"><br>
                                        Meaning &nbsp<input class="form-check-input construct" type="checkbox" id="Construct6" value="meaning"><br>
                                        Curiosity &nbsp<input class="form-check-input construct" type="checkbox" id="Construct7" value="curiosity"><br>
                                        Mastery &nbsp<input class="form-check-input construct" type="checkbox" id="Construct8" value="mastery"><br>
                                        Immersion &nbsp<input class="form-check-input construct" type="checkbox" id="Construct9" value="immersion"><br>
                                        Autonomy appeal &nbsp<input class="form-check-input construct" type="checkbox" id="Construct10" value="autonomy"><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8 shadow-sm bg-body mb-2 " id="questions" style="height: 40rem">

                        <h3 class="text-muted ">Questions and answers</h3>
                        <div class="content">
                        <?php foreach($questions as $i => $value): ?>
                            <?php
                            $counter_3 = 0; $counter_2 = 0; $counter_1 = 0; $counter0 = 0; $counter1 = 0; $counter2 = 0; $counter3 = 0;
                            foreach ($questionAnswers as $i => $answer):
                                    if ($answer->questiondescription == $value->questiondescription and $answer->optiondescription == "-3"):
                                    $counter_3 = (int)$answer->numberOfAnswers;
                                endif;
                                if ($answer->questiondescription == $value->questiondescription and $answer->optiondescription == "-2"):
                                    $counter_2 = (int)$answer->numberOfAnswers;
                                endif;
                                if ($answer->questiondescription == $value->questiondescription and $answer->optiondescription == "-1"):
                                    $counter_1 = (int)$answer->numberOfAnswers;
                                endif;
                                if ($answer->questiondescription == $value->questiondescription and $answer->optiondescription == "0"):
                                    $counter0 = (int)$answer->numberOfAnswers;
                                endif;
                                if ($answer->questiondescription == $value->questiondescription and $answer->optiondescription == "1"):
                                    $counter1 = (int)$answer->numberOfAnswers;
                                endif;
                                if ($answer->questiondescription == $value->questiondescription and $answer->optiondescription == "2"):
                                    $counter2 = (int)$answer->numberOfAnswers;
                                endif;
                                if ($answer->questiondescription == $value->questiondescription and $answer->optiondescription == "3"):

                                    $counter3 = (int)$answer->numberOfAnswers;
                                endif;
                            endforeach; ?>

                         
                                <div id="barchart<?=$value->idQuestion?>" data-title="<?= $value->questiondescription?>" counter-3="<?=$counter_3?>" counter-2="<?=$counter_2?>" counter-1="<?=$counter_1?>" counter0="<?=$counter0?>" counter1="<?=$counter1?>" counter2="<?=$counter2?>" counter3="<?=$counter3?>" class="question_chart <?=$value->construct?>" style="height: 33%">
                                </div>
                                <div class="text-center question-chart">
                                    <p> Average: <span class="text-muted"><?php echo round(($counter1+$counter2*2+$counter3*3-$counter_1-$counter_2*2-$counter_3*3)/($counter0+$counter1+$counter2+$counter3+$counter_1+$counter_2+$counter_3),2)?></span></p>
                                </div>


                        <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

