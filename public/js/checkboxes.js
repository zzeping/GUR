//You might have noticed that all jQuery methodsare inside a document ready event.
//This is to prevent any jQuery code from running before the document is finished loading (is ready).

/*  $(document).ready(function(){

        // jQuery methods go here...

    });*/

//The jQuery team has also created an even shorter method for the document ready event:

/*  $(function(){

        // jQuery methods go here...

    });*/



$(function() {
    $("#az").click(enable_checkboxnameaz);
    $("#za").click(enable_checkboxnameza);
    $("#asc").click(enable_checkboxopeningdateasc);
    $("#desc").click(enable_checkboxopeningdatedesc);
    $("#closedAsc").click(enable_checkboxclosingdateasc);
    $("#closedDesc").click(enable_checkboxclosingdatedesc);
    $("#short").click(enable_checkboxshort);
});

function enable_checkboxnameaz() {
    if (this.checked) {
        $("#az").prop("disabled", false);
    }
    else {
        $("#za").prop("disabled", true);
    }
}

function enable_checkboxnameza() {
    if (this.checked) {
        $("#za").prop("disabled", false);
    }
    else {
        $("#az").prop("disabled", true);
    }
}

function enable_checkboxopeningdateasc() {
    if (this.checked) {
        $("#asc").prop("disabled", false);
    }
    else {
        $("#desc").prop("disabled", true);
    }
}

function enable_checkboxopeningdatedesc() {
    if (this.checked) {
        $("#desc").prop("disabled", false);
    }
    else {
        $("#asc").prop("disabled", true);
    }
}

function enable_checkboxclosingdateasc() {
    if (this.checked) {
        $("#closedAsc").prop("disabled", false);
    }
    else {
        $("#closedDesc").prop("disabled", true);
    }
}

function enable_checkboxclosingdatedesc() {
    if (this.checked) {
        $("#closedDesc").prop("disabled", false);
    }
    else {
        $("#closedAsc").prop("disabled", true);
    }
}

function enable_checkboxshort() {
    if (this.checked) {
        $("#short").prop("disabled", false);
    }
    else {
        $("#long").prop("disabled", true);
    }
}