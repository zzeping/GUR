
document.getElementById('survey_submit').addEventListener('click',submit)
document.getElementById('language').addEventListener('click',change_language)
document.getElementById('long').addEventListener('click',change_version)
document.getElementById('add_q_type').addEventListener('click', choose_type)
document.getElementById('ans_nr').addEventListener('click', choose_nr)
document.getElementById('add_btn').addEventListener('click', add_question)
document.getElementById('question_en').addEventListener('input', btn_state)
document.getElementById('pb').addEventListener('click',page_breaks)
document.getElementById('enjoyment').addEventListener('click',choose_enjoy)
document.getElementById('thank').addEventListener('click',thank_f)

const BASE_URL = $('#baseurl').attr('baseurl');
const pb = document.getElementById('pb')
const boxes = document.querySelectorAll('.pb_box')
const draggables = document.querySelectorAll('.draggable')
const contas = document.querySelectorAll('.drag_con')
const conta = document.getElementById('conta');
const conta_dl = document.getElementById('conta_dl');
const conta_ds = document.getElementById('conta_ds');
const conta_es = document.getElementById('conta_es');
const thank = document.getElementById('thank');
const message = document.getElementById('message')
const long_an = document.getElementById('long_an')
let i = parseInt(document.getElementById('number').textContent);
let person_id = parseInt(document.getElementById('person_id').textContent);
var todayDate = new Date().toISOString().slice(0, 10);
var start = document.getElementById('start');
var end = document.getElementById('end');

$(document).ready(function() {
    $("body").tooltip({ selector: '[data-toggle=tooltip]',placement: 'right'});
});

$(document).ready( function() {
    $('#start').val(todayDate);
    $("#start").attr({"min" : todayDate});
});

$(document).click( function() {
    var start = document.getElementById('start');
    $("#end").attr({"min" : start.value});
});



function closeSnoAlertBox(){
    window.setTimeout(function () {
        $("#myAlert").fadeOut(300)
    }, 3000);
}



boxes.forEach(box=>box.addEventListener('click', event=>{
    for (j=0;j<draggables.length;++j){
        if (boxes[j].checked) {
            draggables[j].setAttribute("style","border-bottom: 0.7rem solid #8DC6A4");
        } else {
            draggables[j].style.removeProperty("border-bottom");
        }
    }
}))

function page_breaks() {
    const boxes = document.querySelectorAll('.pb_box')
    if (pb.checked) {
        boxes.forEach(box=>{
            box.style.display = "block";
        })
    } else {
        boxes.forEach(box => {
            box.style.display = "none";
        })
    }
}




draggables.forEach(draggable=>{
    draggable.addEventListener('dragstart',()=>{
        draggable.classList.add('dragging')
    })
    draggable.addEventListener('dragend',()=>{
        draggable.classList.remove('dragging')
    })
})

contas.forEach(conta=>{
    conta.addEventListener('dragover',e=>{
        e.preventDefault()
        const afterE = getDragAfterE(conta,e.clientY)
        const draggable = document.querySelector('.dragging')
        if(afterE == null){
            conta.appendChild(draggable)
        } else {
            conta.insertBefore(draggable, afterE)
        }
    })
})


function getDragAfterE(conta,y){
    const draggableE = [...conta.querySelectorAll('.draggable:not(.dragging)')]
    return draggableE.reduce((cloest,child)=>{
        const box = child.getBoundingClientRect()
        const offset = y - box.top - box.height/2
        if(offset<0 && offset> cloest.offset){return{offset: offset,element: child}
        }else {
            return cloest
        }
    },{offset: Number.NEGATIVE_INFINITY}).element
}



let language = document.getElementById('language');
let long = document.getElementById('long');
let english_long = document.getElementById('english_long');
let dutch_long = document.getElementById('dutch_long');
let english_short = document.getElementById('english_short');
let dutch_short = document.getElementById('dutch_short');
let conta_e = document.getElementById('conta_e');
let conta_nl_e = document.getElementById('conta_nl_e');
let conta_ds_e = document.getElementById('conta_ds_e');
let conta_es_e = document.getElementById('conta_es_e');
let bool_long = 1;
let add_q_type = document.getElementById('add_q_type');
let mc_ans = document.getElementById('mc_an');
let op_ans = document.getElementById('op_an');
let add_nr = 0;
let en_q = document.getElementById('question_en');
let q_box = document.getElementById('q_box');
let thank_box = document.getElementById('thank_box')
let enjoy = document.getElementById('enjoyment')
let bool_enjoy = 1;
let bool_thank = 0;
let add_btn = document.getElementById('add_btn')
add_btn.disabled = true

//document.getElementsByClassName().length
let ans_nr = document.getElementById('ans_nr')
let ans_1 = document.getElementById('an_1');
let ans_2 = document.getElementById('an_2');
let ans_3 = document.getElementById('an_3');
let ans_4 = document.getElementById('an_4');
let ans_5 = document.getElementById('an_5');
let ans_6 = document.getElementById('an_6');
let ans_7 = document.getElementById('an_7');
let ans_8 = document.getElementById('an_8');
let ans_9 = document.getElementById('an_9');
let in_3 = document.getElementById('in_3');
let in_4 = document.getElementById('in_4');
let in_5 = document.getElementById('in_5');
let in_6 = document.getElementById('in_6');
let in_7 = document.getElementById('in_7');
let in_8 = document.getElementById('in_8');
let in_9 = document.getElementById('in_9');
let added_que = [];
let type = [];
let addedId = [];
let type_value = '';
let options = [];
let every_nr = [];

function add_question() {
    if (add_btn.disabled) {
        console.log('disable');
    }
    else {
        var v = $(".draggable:visible").length +1;
        add_nr++;
        const div = document.createElement("div");
        div.setAttribute("class","pb-2 form-check pb-1 p-3 m-1 shadow-sm rounded-1 draggable added_q ps-4");
        div.setAttribute("id","div"+v)
        const h6 = document.createElement("h6");
        h6.setAttribute("class","my-auto user-select-all add_question");
        const input = document.createElement("input");
        input.setAttribute("class","form-check-input pb_box");
        input.setAttribute("style","display: none;");
        input.setAttribute("type", "checkbox");
        const btn = document.createElement("button");
        btn.setAttribute("class","float-end btn btn-xs delete btn-outline-danger px-2 py-0");
        btn.setAttribute("style","font-size:0.6rem");
        btn.setAttribute("id","btn"+v);
        // console.log(btn.getAttribute("id"));
        const de = document.createTextNode("X");
        btn.appendChild(de);
        i++;
        const que = document.createTextNode(v+'. '+en_q.value);
        //const que = document.createTextNode(en_q.value);
        h6.appendChild(que);
        div.appendChild(input);
        div.appendChild(btn);
        div.appendChild(h6);
        let this_op=[];
        if(long_an.checked && add_q_type.value==='1')
        {
            type_value = 'LongOpen';
            let l=document.createElement("textarea")
            l.setAttribute("class","form-control")
            div.appendChild(l)
            every_nr.push(0)
        }
        else if( !long_an.checked && add_q_type.value==='1')
        {
            type_value = 'ShortOpen';
            let l=document.createElement("input")
            l.setAttribute("class","form-control")
            div.appendChild(l)
            every_nr.push(0)
        }
        else
        {
            type_value ='MC';
            options.push(ans_nr.value)
            every_nr.push(parseInt(ans_nr.value))
            options.push(ans_1.value)
            this_op.push(ans_1.value)
            ans_1.value=''
            options.push(ans_2.value)
            this_op.push(ans_2.value)
            ans_2.value=''
            if(ans_nr.value > 2){
                options.push(ans_3.value)
                this_op.push(ans_3.value)
                ans_3.value=''
                if(ans_nr.value > 3){
                    options.push(ans_4.value)
                    this_op.push(ans_4.value)
                    ans_4.value=''
                    if(ans_nr.value > 4){
                        options.push(ans_5.value)
                        this_op.push(ans_5.value)
                        ans_5.value=''
                        if(ans_nr.value > 5){
                            options.push(ans_6.value)
                            this_op.push(ans_6.value)
                            ans_6.value=''
                            if(ans_nr.value > 6){
                                options.push(ans_7.value)
                                this_op.push(ans_7.value)
                                ans_7.value=''
                                if(ans_nr.value > 7){
                                    options.push(ans_8.value)
                                    this_op.push(ans_8.value)
                                    ans_8.value=''
                                    if(ans_nr.value === 9){
                                        options.push(ans_9.value)
                                        this_op.push(ans_9.value)
                                        ans_9.value=''
                                    }
                                }
                            }
                        }
                    }
                }
            }


            for(let j=0;j<ans_nr.value;j++)
            {
                let div_o = document.createElement("div");
                div_o.setAttribute("class","form-check form-check-inline");
                let input = document.createElement("input")
                input.setAttribute("class","form-check-input")
                input.setAttribute("type","radio")
                let label = document.createElement("label")
                label.setAttribute("class","form-check-label")
                input.setAttribute("name","options"+v)
                input.setAttribute("id","MC1option1")
                label.setAttribute("for","MC1option1")
                let op = document.createTextNode(this_op.shift());
                label.appendChild(op)
                div_o.appendChild(input)
                div_o.appendChild(label)
                div.appendChild(div_o)
            }
        }

        added_que.push(en_q.value)
        type.push(type_value)
        console.log(type)
        console.log(options)
        console.log('every '+every_nr)

        if(language.value === 'English' && bool_long === 1){ conta.appendChild(div); }
        if(language.value === 'Dutch' && bool_long === 1){ conta_dl.appendChild(div); }
        if(language.value === 'English' && bool_long === 0){ conta_es.appendChild(div); }
        if(language.value === 'Dutch' && bool_long === 0){ conta_ds.appendChild(div); }
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
        en_q.value = '';
        let de_b = document.getElementById('btn'+v)
        de_b.addEventListener('click',()=>{
            let id =  (de_b.getAttribute("id")).replace("btn","");
            let it = id-1-$(".PXI:visible").length
            let sum = 0
            if(type[it]==='MC')
            {
                for(let r=0;r<it;r++)
                {
                    if(type[r]==='MC')
                    {
                        sum = sum+every_nr[r]+1
                    }
                }
                options.splice(sum,every_nr[it]+1)
            }
            added_que.splice(it,1)
            type.splice(it,1)
            // console.log('sum '+sum)
            // console.log('it '+it)
            // console.log('every_nr '+every_nr)
            every_nr.splice(it,1)
            let added = document.getElementById("div"+id);
            let parent = added.parentNode
            parent.removeChild(added);
            // console.log(id)
            console.log(added_que)
            console.log(type)
            console.log('options: '+options)
            update_nr($(".PXI:visible").length);
        })




    }


}

function update_nr(v) {
    let added_qs=document.querySelectorAll('.added_q')
    let k=v+1
    added_qs.forEach(added=>{
        added.setAttribute("id","div"+k)
        k++
    })
    let del_btns=document.querySelectorAll('.delete')
    let q=v+1
    del_btns.forEach(btn=>{
        btn.setAttribute("id","btn"+q)
        q++
    })
    let add_questions=document.querySelectorAll('.add_question')
    let m=0
    let n=v+1
    add_questions.forEach(add_question=>{
        const que = document.createTextNode(n+'. '+added_que[m]);
        add_question.removeChild(add_question.childNodes[0])
        add_question.appendChild(que)
        n++
        m++
    })

}

function btn_state() {
    if (en_q.value === '') {
        add_btn.disabled = true;
        add_btn.style.display = "none"
    } else {
        add_btn.disabled = false;
        add_btn.style.display = "block"
    }
}


function choose_nr() {
    let ans_nr = document.getElementById('ans_nr');
    let number = parseInt(ans_nr.value);
    in_3.style.display = "none";
    in_4.style.display = "none";
    in_5.style.display = "none";
    in_6.style.display = "none";
    in_7.style.display = "none";
    in_8.style.display = "none";
    in_9.style.display = "none";
    if(number > 2){
        in_3.style.display = "block";
        if(number > 3){
            in_4.style.display = "block";
            if(number > 4){
                in_5.style.display = "block";
                if(number > 5){
                    in_6.style.display = "block";
                    if(number > 6){
                        in_7.style.display = "block";
                        if(number > 7){
                            in_8.style.display = "block";
                            if(number === 9){
                                in_9.style.display = "block";
                            }
                        }
                    }
                }
            }
        }
    }
}


function choose_type() {
    
    if(add_q_type.value === '1'){
        op_ans.style.display = "block";
        mc_ans.style.display = "none";
    }
    if(add_q_type.value === '2')
    {
        op_ans.style.display = "none";
        mc_ans.style.display = "block";
    }

}

function submit(){

    window.scrollTo({ top: 0, behavior: 'smooth' });
    $("#myAlert").fadeIn();
    closeSnoAlertBox();

    let input_user = document.getElementById('survey_name');
    let survay_descr = document.getElementById('survey_descr');
    let bool_long = 0;
    let bool_enjoy = 0;
    let switchlong = document.getElementById('long');
    let checkboxenjoy = document.getElementById('enjoyment');
    let language = document.getElementById('language');

    if(switchlong.checked){
        bool_long = 1
    }
    if(checkboxenjoy.checked){
        bool_enjoy = 1
    }
    if(!(thank.checked)){
        message.value=''
        console.log('thank unchecked')
    }

    $.ajax({
        url: BASE_URL + '/addQuestionnaire',
        //url: 'http://localhost/10/public/create_survey/addQuestionnaire',
        method: "post",
        data:{
            'surveyName': input_user.value,
            'description': survay_descr.value,
            'longShortBoolean': bool_long,
            'enjoymentBoolean': bool_enjoy,
            'language': language.value,
            'start': start.value,
            'end': end.value,
            'endingMessage' : message.value
        },
        success:function(response) {
            console.log('*INSERTED name= ' + input_user.value)
            console.log('*INSERTED start= ' + start.value)
            console.log('*INSERTED end= ' + end.value)
            console.log('*INSERTED endingMessage= ' + message.value)

        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });

    let surveyId=0;
    $.ajax({
        url: BASE_URL + '/get_surveyId',
        //url: 'http://localhost/10/public/create_survey/get_surveyId',
        method: "get",
        async: false,
        success: function (id) {
            surveyId = id;
            console.log('sucessed get id :'+ surveyId)
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }

    });

    insert_added();
    insert_person(surveyId);
    insert_questions(surveyId);




}

function insert_added() {
    var v = added_que.length
    console.log('insert addeds: '+added_que)
    for(let k=0; k<v; k++) {
        $.ajax(
            {
                url: BASE_URL + '/addNewQuestions',
                //url: 'http://localhost/10/public/create_survey/addNewQuestions',
                method: "post",
                data: {
                    'question': added_que[k],
                    'type' : type[k],
                    'language': language.value
                },
                success: function (response) {
                    console.log('@inserted question ' + added_que[k])
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        let current_id=0;
        var n = $(".PXI:visible").length +1+k
        let div = document.getElementById("div"+n)
        $.ajax({
            url: BASE_URL + '/get_addedId',
            //url: 'http://localhost/10/public/create_survey/get_addedId',
            method: "get",
            async: false,
            success: function (id) {
                current_id = id,
                addedId.push(id),
                console.log('sucessed get id :'+ addedId)
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
        console.log("current_id: "+current_id)
        div.setAttribute("id",current_id)
        
        if(type[k]==='MC')
        {
            //console.log('before: '+options)
            let number = options.shift()
            //console.log('remove number: '+options)
            for(let b=0;b<number;b++)
            {
                let option = options.shift()
                $.ajax(
                    {
                        url: BASE_URL + '/insertOptions',
                        //url: 'http://localhost/10/public/create_survey/insertOptions',
                        method: "post",
                        data: {
                            'questionId': current_id,
                            'totalOptions': number,
                            'optionNr' : b+1,
                            'description' : option
                        },
                        success: function (response) {
                            console.log('>_<Inserted option: ' + option)
                        },
                        error: function (xhr) {
                            console.log(xhr.responseText);
                        }
                    });
            }

        }

    }
    addedId = [];


}



function insert_person(surveyId) {
    $.ajax({
        url: BASE_URL + '/addPersonId',
        //url: 'http://localhost/10/public/create_survey/addPersonId',
        method: "post",
        data: {
            'person_id' : person_id,
            'surveyId': surveyId
        },
        success:function(response) {
            console.log('^_^Inserted person_id= ' + person_id)
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
}

function insert_questions(surveyId) {
    const boxes = document.querySelectorAll('.pb_box');
    let page_break=[]
    let m =  $(".draggable:visible").length
    for (j = 0; j < m; ++j)
    {
        if (boxes[j].checked) {
            page_break.push(1)
        } else {
            page_break.push(0)
        }

    }
    console.log(page_break)
    var Draggables = $(".draggable:visible")
    var v = $(".draggable:visible").length
    for(let k=0; k<v; k++) {
        let pageBreak = page_break.shift()
        $.ajax(
            {
                url: BASE_URL + '/addQuestions',
                //url: 'http://localhost/10/public/create_survey/addQuestions',
                method: "post",
                data: {
                    'questionId': Draggables[k].getAttribute('id'),
                    'surveyId': surveyId,
                    'SequenceNumber': k,
                    'Pagebreak': pageBreak
                },
                success: function (response) {
                    console.log('~inserted question_id ' + Draggables[k].getAttribute('id'))
                    console.log('~~question pagebreak: ' + pageBreak)
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
    }
}



function change_language() {

    if (language.value === 'English' && bool_long === 1 ){
        if (bool_enjoy === 1){
            conta_e.style.display = "block";
        } else {
            conta_e.style.display = "none"
        }
        english_long.style.display = "block";
        dutch_long.style.display = "none";
        dutch_short.style.display = "none";
        english_short.style.display = "none";
    }

    if (language.value === 'Dutch' && bool_long === 1 && bool_enjoy ===1){
        english_long.style.display = "none";
        dutch_long.style.display = "block";
        conta_nl_e.style.display = "block";
        dutch_short.style.display = "none";
        english_short.style.display = "none";
    }
    if (language.value === 'Dutch' && bool_long === 1 && bool_enjoy ===0){
        english_long.style.display = "none";
        dutch_long.style.display = "block";
        conta_nl_e.style.display = "none";
        dutch_short.style.display = "none";
        english_short.style.display = "none";
    }
    if (language.value === 'English' && bool_long === 0 && bool_enjoy ===1){
        english_long.style.display = "none";
        dutch_long.style.display = "none";
        dutch_short.style.display = "none";
        conta_es_e.style.display = "block";
        english_short.style.display = "block";
    }
    if (language.value === 'English' && bool_long === 0 && bool_enjoy ===0){
        english_long.style.display = "none";
        dutch_long.style.display = "none";
        dutch_short.style.display = "none";
        conta_es_e.style.display = "none";
        english_short.style.display = "block";
    }
    if (language.value === 'Dutch' && bool_long === 0  && bool_enjoy ===1){
        english_long.style.display = "none";
        dutch_long.style.display = "none";
        dutch_short.style.display = "block";
        conta_ds_e.style.display = "block";
        english_short.style.display = "none";
    }
    if (language.value === 'Dutch' && bool_long === 0  && bool_enjoy ===0){
        english_long.style.display = "none";
        dutch_long.style.display = "none";
        dutch_short.style.display = "block";
        conta_ds_e.style.display = "none";
        english_short.style.display = "none";
    }

}

    function change_version() {

        if (long.checked) {
            bool_long = 1;
        } else {
            bool_long = 0;
        }
        change_language();

}

    function choose_enjoy() {
        if (enjoy.checked) {
            bool_enjoy = 1;
        } else {
            bool_enjoy = 0;
        }
        change_language();



    }

    function thank_f() {
        if (thank.checked) {
            thank_box.style.display="block";
        } else {
            thank_box.style.display="none";
        }
    }
