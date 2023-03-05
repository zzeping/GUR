// Horrible search function, still has to be fixed
//function myFunction() {
$('#s').on('input',function(e) {
    var input = $(this).val()
    var filter = input.toLowerCase()
    var  cards, cardContainer, h5, title, i;
    //input = document.getElementById("s");
    //filter = input.value.toLowerCase();
    console.log(filter)
    cardContainer = document.getElementById("carddecks");
    cards = document.getElementsByClassName("card");
    $('#card').each(function () {
        let li = $(this)

        console.log(cards)
        for (i = 0; i < cards.length; i++) {
            title = cards[i].querySelector(".card-body h5.card-title");
            console.log(title.innerText.toLowerCase())
            if (title.innerText.toLowerCase().indexOf(filter) > -1) {
                cards[i].style.display = "";
            } else {
                cards[i].style.display = "none";
                console.log(cards[i])

            }
        }
    })
})


//}


/*$('#s').on('input',function(e){
    let input = $(this).val()
    let filter = input.toUpperCase()
    $('.card-body').each(function() {

            //this refers to the listed item.
            let li = $(this)
            //anchor refers to the DOM elements h2 in the listed item.
            //let anchor = li.getElementById("titleSearch").children('h5')
            //var list = document.getElementById("card").lastChild.innerHTML;
            //let anchor = list.innerHTML;
            //console.log(list)
            let anchor = li.children('article > h5')
            if ((anchor.text().toUpperCase().indexOf(filter) > -1)) {
                //Show the listed item if match of strings
                anchor.removeClass('d-none')
                document.getElementById("card").style.display = "none";
                document.getElementById("card-img-top").style.display = "none";
                document.getElementById("card-img-overlay").style.display = "none";

            } else {
                //Don't show the listed item if no match of strings
                li.addClass('d-none')

            }
        });*/


/*$('#s').on('input',function(e){
    let input = $(this).val()
    let filter = input.toUpperCase()
   // console.log(filter)
        $('.card').each(function () {
            //this refers to the listed item.
            let body = $(this)
            //anchor refers to the DOM elements h2 in the listed item.
            //let anchor = body.querySelectorAll("div.card-body > h5")

            cardContainer = document.getElementById("col");
            cards = cardContainer.getElementsByClassName("card");
            for (i = 0; i < cards.length; i++) {
                title = cards[i].querySelector(".card-body h5.card-title");
                //var anchor = body.children('h5')
                if ((title.innerText.toUpperCase().indexOf(filter) > -1)) {
                    //Show the listed item if match of strings
                    body.removeClass('d-none')

                } else {
                    //Don't show the listed item if no match of strings
                    body.addClass('d-none')
                }
            }
        });
});*/


// Delete survey
let button = document.getElementById("delete");
button.addEventListener("click", deleteSurvey);

function deleteSurvey() {
    location.reload();
}

// Share survey
// QR Code + setting the links
var qrcode = undefined;
function generateQRCode(value) {
    if (qrcode === undefined) {
        qrcode = new QRCode(document.getElementById('qrcode'), {
            text: value,
            width: 128,
            height: 128
        } );
    }
    else {
        qrcode.clear();
        qrcode.makeCode(value);
    }
    document.getElementById("tt").setAttribute("value", value);
    document.getElementById("mail").setAttribute("href", 'mailto:?subject=surveyName&body=' + value);
    document.getElementById("linkedin").setAttribute("href", 'https://www.linkedin.com/shareArticle?mini=true&url=' + value);
    document.getElementById("twitter").setAttribute("href", 'https://twitter.com/intent/tweet?text=' + value);
    document.getElementById("fb").setAttribute("href", 'https://www.facebook.com/sharer/sharer.php?u=' + value);
    document.getElementById("messenger").setAttribute("href", 'https://www.facebook.com/dialog/send?link=' + value);
}

// Copy to clipboard + tooltips
new Clipboard('.try', {
    text: function (trigger) {
        return trigger.getAttribute('href');
    }
});

function fallbackCopyTextToClipboard(text) {
/*    var textArea = document.createElement("textarea");
    textArea.value = text;

    // Avoid scrolling to bottom
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";

    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();*/

    try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
        console.log('Fallback: Copying text command was ' + msg);
    } catch (err) {
        console.error('Fallback: Oops, unable to copy', err);
    }

    //document.body.removeChild(textArea);
}
function copyTextToClipboard(text) {
    if (!navigator.clipboard) {
        fallbackCopyTextToClipboard(text);
        return;
    }
    navigator.clipboard.writeText(text).then(function () {
        console.log('Async: Copying to clipboard was successful!');
    }, function (err) {
        console.error('Async: Could not copy text: ', err);
    });

    document.getElementById('tt').setAttribute('data-bs-original-title', 'Copied to clipboard');
    $("#tt").tooltip("show");
    setTimeout(function () {
        $("#tt").tooltip('hide');
    }, 3000);
    document.getElementById('tt').setAttribute('data-bs-original-title', 'Click to copy');
}

// To enable tooltips
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

// When Cancel button is pushed
function closeModal() {
    $('#myShareModal').modal('hide');
}


/*
$('#s').on('input',function(e){
    let input = $(this).val()
    let filter = input.toUpperCase()
/!*    $('.game').each(function() {
        let game = $(this);*!/
    $('#gamecard').each(function() {
        //this refers to the listed item.
        let li = $(this)
        //anchor refers to the DOM elements h2 in the listed item.
        let anchor = li.children('div > h5')
        if( (anchor.text().toUpperCase().indexOf(filter) > -1)) {
            //Show the listed item if match of strings
            li.removeClass('d-none')
            // game.removeClass('d-none')
        } else {
            //Don't show the listed item if no match of strings
            li.addClass('d-none')
            // game.addClass('d-none')

        }
    }
//}
);
});*/
