$(document).ready(function() {
    let page = 0;
    let answered = 0;
    let ans_ed = []
    var $target;
    $('.choice').click(function () {
        gif.src = gif.src.replace(/\?.*$/,"")+"?x="+Math.random();
        gif.setAttribute('style','display: block')
        img.setAttribute('style','display: none')
        setTimeout(display, 500);

        //assign answer to value
        $(this).parent().children('.question-answer').val($(this).text());
        console.log($(this).parent().children('.question-answer').val())

        //check if there is a next question to go to
        if($(this).parent().parent().closest('.question-div').next().length !== 0) {
            $target = $(this).parent().parent().closest('.question-div').next();
        }

        //scroll to the next question
        if(!$target.hasClass('d-none')) {
            $('html, body').animate({
                scrollTop: $target.offset().top - 58
            }, 20);
        }

        if(jQuery.inArray($(this).parent().parent().parent().children('.q').children('.col').children().attr('id'), ans_ed) === -1) {answered++;}
        console.log(jQuery.inArray($(this).parent().parent().parent().children('.q').children('.col').children().attr('id'), ans_ed))
        ans_ed.push($(this).parent().parent().parent().children('.q').children('.col').children().attr('id'))

        $('.progress-bar').attr('style','width:'+ 100*answered/questions_nr+"%")
    });


    let gif = document.getElementById('gif')
    let img = document.getElementById('img')
    let maxpages = $('#page-amount').attr('maxpages');
    let questions_nr = $('#question-amount').attr('questions');
    function display() {
        gif.setAttribute('style','display: none')
        img.setAttribute('style','display: block')
    }



    $('#survey_prev').toggleClass('d-none');
    if(maxpages == 0) {
        $('#survey_next').addClass('d-none');
        $('#survey_submit').removeClass('d-none');
    }

    $('#survey_next').click(function () {

        if(checkquestions()){
        $('html, body').animate({
            scrollTop: 0
        }, 20);

        if ($('#survey_prev').hasClass('d-none')) {
            $('#survey_prev').removeClass('d-none')
        }

        if ($('#page-amount').attr("maxpages") == (page + 1)) {
            $(this).addClass('d-none');
            $(this).next().removeClass('d-none');
        }

        page++;

        $('.question-div').each(function (i, obj) {
            if ($(this).attr("pagenr") == page) {
                $(this).removeClass('d-none');
            } else {
                $(this).addClass('d-none');
            }
        })
        }

    });
    $('#survey_prev').click(function () {

        $('html, body').animate({
            scrollTop: 0
        }, 20);

        if ($('#survey_next').hasClass('d-none')) {
            $('#survey_next').removeClass('d-none')
            $('#survey_submit').addClass('d-none')
        }
        if ((page - 1) == 0) {
            $('#survey_prev').toggleClass('d-none');
        }

            page--;
            console.log(page);
            $('.question-div').each(function (i, obj) {
                if ($(this).attr("pagenr") == page) {
                    $(this).removeClass('d-none');
                } else {
                    $(this).addClass('d-none');
                }
            })

    });
    $('#survey_submit').click(function () {
        if(checkquestions()){
            document.getElementById("fill_in_form").submit();
        }
    })
    function checkquestions(){
        var $unanswered = 0;
        $('.question-answer').each(function (i,obj) {
            if($(this).attr("pagenr") == page){
                if($(this).val() == ""){

                    $target= $(this).parent().parent().parent();
                    $('html, body').animate({
                        scrollTop: $target.offset().top - 58
                    }, 20);
                    var $question = $(this).parent().parent().children('.fill-alert')
                    $question.removeClass('d-none').delay(1000);
                    $question.fadeOut(800, function () {
                        $($question.addClass('d-none'));
                    });
                    $unanswered = 1;
                    return false;

                }
            }
        })
        if($unanswered == 1){
            return false;
        }
        return true;
    }

});






