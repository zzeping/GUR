let customQuestions = [];
let newlyAddedQuestion = [];
let optionIndex = 0;


let initialLanguage = $('#initial-language').val();
let questions = {};

$(document).ready(function() {
    //console.log('working!');



    console.log(initialLanguage);
    initializeQuestions(initialLanguage);
    //Show question options


    $('#questionType').on("change", function() {
        if ($(this).val() == 'open') {
            console.log('switch to' + $(this).val());
            $('#mc-options').addClass('hidden');
            $('#open-options').removeClass('hidden');
        }
        else if ($(this).val() == 'MC') {
            console.log('switch to' + $(this).val());
            $('#open-options').addClass('hidden');
            $('#mc-options').removeClass('hidden');
        }
        else {
           if (!($('#open-options').hasClass('hidden'))) {
               $('#open-options').addClass('hidden');
           }
           if (!($('#mc-options').hasClass('hidden'))) {
               $('#mc-options').addClass('hidden');
            }
        }
    });

    $('#mc-options').on('mouseover', '.option', function() {
        if ($(this).find('.remove-button').hasClass('hidden')) {
            $(this).find('.remove-button').removeClass('hidden');
            $(this).find('.remove-button').one('click',$(this),function() {
                if($(this).parent().parent().length != 0) {

                    var removedOptionIndex = $(this).parent().find('#basic-addon').text();
                    if (optionIndex == 9) {
                        $(this).parent().parent().parent().find('#add-mc-option').removeClass('disabled');
                        $(this).parent().parent().parent().find('#add-mc-option').val('Enabled');
                        $(this).parent().parent().parent().find('#add-mc-option').attr('title', 'Add a new option');
                        $(this).parent().parent().parent().find('#add-mc-option').prop('disabled', false);
                    }
                    optionIndex--;
                    var options = $(this).parent().siblings();
                    $(this).parent().remove();
                    $(options).each(function(index, option) {
                        var index = ($(option).find('#basic-addon').text());
                        if (index > removedOptionIndex ) {
                            $(option).find('#basic-addon').text(index - 1);
                        }
                    });
                    }
                });
            }
    });

    $('#mc-options').on('mouseleave', '.option', function() {
        $(this).find('.remove-button').addClass('hidden');
    });

    $('#add-mc-option').click(function() {
        $("<div/>",{
            id  :"option" + (optionIndex+1),
            html:" <span class=\"input-group-text\" id=\"basic-addon\">"+(optionIndex+1)+"</span>\n" +
                "            <input type=\"text\" class=\"form-control\" placeholder=\"option\" aria-label=\"Answer\"\n" +
                "                   aria-describedby=\"basic-addon\">" +
                "                <button id = \"remove-button\" class = \"hidden remove-button\"> <i class=\"bi bi-dash-circle\"></i> </button>",
            class: "input-group mb-3 option"
        }).appendTo($('#options'));
        optionIndex++;
        console.log('optionIndex: ' + optionIndex)

        //Max number of
        if (optionIndex == 9) {
            $(this).addClass('disabled')
            $(this).val('Disabled');
            $(this).attr('title', 'Maximum number of options reached!')
            $(this).prop('disabled', true);
        }

    });

    $('#test-button').click(function() {
        //Select all PXI Questions
        $('.PXI').each(function () {
            //console.log($(this).text());
        });

        //Select all custom Multiple choice questions
        $('.MC').each(function () {
            //console.log($(this).text());
        });

        //General settings
        console.log($('#title'));
        console.log($('#description'));
        console.log($('#enjoyment'));
        console.log($('#long'));
        console.log($('#open'));
        console.log($('#close'));
        console.log($('#language'));

        //Add question

        console.log($('question-type'));
        console.log($(''))


        //other (page breaks, end message)




    });

    $('#add-question-btn').click([$('#question-type'), $('#question-description'), $('#question-options')], addQuestion);

    $('#survey-submit').click()

});

function initializeQuestions(language){
    var lang = language;
    questions = {}
    questions[lang] = [];


    var tempQuestion = {};
    console.log($('.PXI'));

    $.each($('.PXI'), function(index, question){
        console.log(question)
        $.extend(tempQuestion, {
            description: $(question).text().trim(),
            language: (language),
            type:  ('PXI'),
            options: (['-3', '-2', '-1', '0', '1', '2', '3']),
            sequenceNumber: (question.id)
        });
        if($(question).hasClass('pageBreak')) {
            $.extend(tempQuestion, {
                pageBreak: 1});
        }
        else {
            $.extend(tempQuestion, {
                pageBreak: 0});
        }

        questions[lang].push(tempQuestion);
        tempQuestion = {};
    });

    console.log(questions[lang]);
    for (const question in questions[lang]) {
        //console.log(questions[lang][question].description);
    }
}



function addQuestion(type, description, answerOptions) {

    console.log('workingdf<df!')
    console.log($('#question-type').val());             //'MC' or 'open'
    console.log($('#question-description').val());      //text description
    console.log($('#question-options'));

}

function add_question() {

        //add_nr++;
        const div = document.createElement("div");
        div.setAttribute("class","pb-3 form-check p-3 m-1 shadow-sm rounded-1 draggable added_q ps-4");
        //div.setAttribute("id",add_nr++);
        //div.setAttribute("id","div"+add_nr)
        const h6 = document.createElement("h6");
        h6.setAttribute("class","my-auto user-select-all");
        const input = document.createElement("input");
        input.setAttribute("class","form-check-input my-auto pb_box");
        input.setAttribute("style","display: none;");
        input.setAttribute("type", "checkbox");
        const btn = document.createElement("button");
        btn.setAttribute("class","float-end btn btn-xs delete btn-outline-danger px-2 py-0");
        btn.setAttribute("style","font-size:0.6rem");
        //btn.setAttribute("id","btn"+add_nr);
        // console.log(btn.getAttribute("id"));
        const de = document.createTextNode("X");
        btn.appendChild(de);

        //i++;

        var v = $(".draggable:visible").length +1;
        // const que = document.createTextNode(v+'. '+en_q.value);
        //const que = document.createTextNode(en_q.value);
        //h6.appendChild(que);
        div.appendChild(input);
        div.appendChild(btn);
        div.appendChild(h6);



        //if(language.value === 'English' && bool_long === 1){ conta.appendChild(div); }
        //if(language.value === 'Dutch' && bool_long === 1){ conta_dl.appendChild(div); }
        //if(language.value === 'English' && bool_long === 0){ conta_es.appendChild(div); }
        //if(language.value === 'Dutch' && bool_long === 0){ conta_ds.appendChild(div); }
        let draggables = document.querySelectorAll('.draggable');

        draggables.forEach(draggable=>{
            draggable.addEventListener('dragstart',()=>{
                draggable.classList.add('dragging')
            })
            draggable.addEventListener('dragend',()=>{
                draggable.classList.remove('dragging')
            })
        })
        const boxes = document.querySelectorAll('.pb_box');
        boxes.forEach(box=>box.addEventListener('click', event=>{
            for (j=0;j<draggables.length;++j){
                if (boxes[j].checked) {
                    draggables[j].setAttribute("style","border-bottom: 0.7rem solid #8DC6A4");
                } else {
                    draggables[j].style.removeProperty("border-bottom");
                }
            }
        }))
        //console.log(add_nr);
        //en_q.value = '';
        const de_btns = document.querySelectorAll('.delete')
        de_btns.forEach(de_b=>de_b.addEventListener('click',event=>{
            let id =  (de_b.getAttribute("id")).replace("btn","");
            let added = document.getElementById("div"+id);
            if(added.parentNode)
            {added.parentNode.removeChild(added);}

        }))

    }

function getPXIQuestions() {

}