<script src="https://cdn.anychart.com/releases/8.0.0/js/anychart-base.min.js"></script>
<script src="http://localhost/IdeaProjects/XMASHolidays/public/js/compare_chart.js"></script>





<div class="row" id="first_row">


    <div class = "col-12 title">



        <h2 style="padding-top: 5px"> <span class="text2">Survey 1: </span> <span class="text-white"> <?php if($surveyTrue == true):
                   print $survey[0]->title;
                endif;?> </span></h2>


        <h2> <span class="text2">Survey 2: </span> <span class="text-white"> <?php if($surveyTrue2 == true):
                    print $survey2[0]->title;
                endif;?> </span></h2>

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

            <div class="col-4 shadow-sm bg-body " id ="description" style="height: 40rem">
                <!--<h2 id ="leftTitle" class="text-muted ">Filter Constructs</h2>-->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Choose Surveys
                        </button>
                    </h2>
                <div id="collapseOne" class="accordion-collapse collapse show bg-white overflow-auto" style="max-height: 540px" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body p-3">
                        <form method="post">
                            <div class="form-group top-buffer">

                                <select class="form-select" id="compare1" name="compare1" aria-label="Default select example">
                                    <option value=""> Select Survey </option>
                                    <?php
                                    foreach($all as $row){
                                        echo '<option value="'.$row['title'].'">'.$row['title'].'</option>';
                                    }
                                    ?>
                                </select>
                                <br>
                                <select class="form-select" id="compare2" name="compare2" aria-label="Default select example">
                                    <option value=""> Select Survey </option>
                                    <?php
                                    foreach($all as $row){
                                        echo '<option value="'.$row['title'].'">'.$row['title'].'</option>';
                                    }
                                    ?>
                                </select>
                                <br>
                                <button name = "comp1" class="form-select" style="padding-bottom: 4px; padding-top: 5px; margin-left:5px">Compare</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Filter Constructs
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show bg-white overflow-auto" style="max-height: 540px" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body p-3">
                            <form method="post">
                                <div class="form-group top-buffer">
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-8 shadow-sm bg-body " id="questions" style="height: 40rem">

                <h3 class="text-muted ">Questions and answers</h3>
                <div class="content">
                    <?php foreach($questions as $i => $value): ?>
                        <?php
                        $counter_3 = 0; $counter_2 = 0; $counter_1 = 0; $counter0 = 0; $counter1 = 0; $counter2 = 0; $counter3 = 0;
                        foreach ($answers as $i => $answer):
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

                        <?php
                        $counter4 = 0; $counter5 = 0; $counter6 = 0; $counter7 = 0; $counter8 = 0; $counter9 = 0; $counter10 = 0;

                        foreach ($answers2 as $i => $answer2):
                            if ($answer2->questiondescription == $value->questiondescription and $answer2->optiondescription  == "-3"):
                                $counter4 = (int)$answer2->numberOfAnswers;
                            endif;
                            if ($answer2->questiondescription == $value->questiondescription and $answer2->optiondescription  == "-2"):
                                $counter5 = (int)$answer2->numberOfAnswers;
                            endif;
                            if ($answer2->questiondescription == $value->questiondescription and $answer2->optiondescription  == "-1"):
                                $counter6 = (int)$answer2->numberOfAnswers;
                            endif;
                            if ($answer2->questiondescription == $value->questiondescription and $answer2->optiondescription  == "0"):
                                $counter7 = (int)$answer2->numberOfAnswers;
                            endif;
                            if ($answer2->questiondescription == $value->questiondescription and $answer2->optiondescription  == "1"):
                                $counter8 = (int)$answer2->numberOfAnswers;
                            endif;
                            if ($answer2->questiondescription == $value->questiondescription and $answer2->optiondescription  == "2"):
                                $counter9 = (int)$answer2->numberOfAnswers;
                            endif;
                            if ($answer2->questiondescription == $value->questiondescription  and $answer2->optiondescription  == "3"):
                                $counter10 = (int)$answer2->numberOfAnswers;
                            endif;
                        endforeach; ?>
                        <div id="barchart<?=$value->idQuestion?>" survey1="<?=$survey[0]->title?>" survey2="<?=$survey2[0]->title?>" data-title="<?= $value->questiondescription?>" counter-3="<?=$counter_3?>" counter-2="<?=$counter_2?>" counter-1="<?=$counter_1?>" counter0="<?=$counter0?>" counter1="<?=$counter1?>" counter2="<?=$counter2?>" counter3="<?=$counter3?>" counter4="<?=$counter4?>" counter5="<?=$counter5?>" counter6="<?=$counter6?>" counter7="<?=$counter7?>" counter8="<?=$counter8?>" counter9="<?=$counter9?>" counter10="<?=$counter10?>"class="question_chart <?=$value->construct?>" style="height: 66%">

                        </div>

                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</div>

