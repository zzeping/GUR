$('#s').on('input',function(e){
    let input = $(this).val()
    let filter = input.toUpperCase()
    $('.list-group-item').each(function() {
        //this refers to the listed item.
        let li = $(this)
        //anchor refers to the DOM elements h2 in the listed item.
        let anchor = li.children('a > h2')
        let divider = li.next();
        if( (anchor.text().toUpperCase().indexOf(filter) > -1)) {
            //Show the listed item if match of strings
            li.removeClass('d-none')
            divider.removeClass('d-none')
        } else {
            //Don't show the listed item if no match of strings
            li.addClass('d-none')
            divider.addClass('d-none')
        }
    });
});