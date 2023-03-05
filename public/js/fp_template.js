$(document).ready(function() {
    //Setup default ajax request settings
    $.ajaxSetup({
        headers: {'X-Requested-With': 'XMLHttpRequest'},
        error: function (xhr, status, errorThrown) {
            alert("Sorry, there was a problem in an Ajax request in fp_template.js.");
                console.log("Error: " + errorThrown);
                console.log("Status: " + status);
                console.dir(xhr)
            }
        });

    $("#login").click(function(){
            $.ajax({
                url: "http://localhost/IdeaProjects/Sprint10/public/loginbox",
                success: function (data) {
                    $('#lightBox').html(data)
                },
                complete: function () {
                    $("#myModal").modal('show');
                }
            });
    });

    $("#submitlogin").on('submit', function(){
        console.log("Submitted login request");
        $.load('http://localhost/IdeaProjects/Sprint10/public/login')
    })

    $("#signup").click(function(){
        $.ajax({
            url: "http://localhost/IdeaProjects/Sprint10/public/register",
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            success: function(data) {
                $('#lightBox').html(data)
            },

            error: function( xhr, status, errorThrown ) {
                alert( "Sorry, there was a problem in the register Ajax request. Ask Pieter for help :)" );
                console.log( "Error: " + errorThrown );
                console.log( "Status: " + status );
                console.dir( xhr )
            },
            complete: function() {
                $("#myModal").modal('show');
            }
        });
    });

    $('#AboutTeam4').click(function() {
        console.log('activate function')
        $.ajax({
            url: "http://localhost/IdeaProjects/Sprint10/public/about",
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            success: function(data) {
                $('#content').html(data)
                console.alert('success loading about page');
            },
            error: function( xhr, status, errorThrown ) {
                alert( "Sorry, there was a problem in the register Ajax request. Ask Pieter for help :)" );
                console.log( "Error: " + errorThrown );
                console.log( "Status: " + status );
                console.dir( xhr )
            },

        });
    });


});

//Request form validation rules
