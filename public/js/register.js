$(document).ready(function () {

$("#registerForm").validate({rules:{
        name: {
            required: true,
            minlength: 3,
            maxlength: 20
        },
        surname: {
            required: true,
            minlength: 3,
            maxlength: 20
        },
        email: {
            required: true,
            email: true,

        },
        password: {
            required: true,
            minlength: 8,
            maxlength: 255
        },
        password_confirm: {
            required: true,
            equalTo: '#password'
        }
}, messages: {
    name: { required: "Name is required"}
    }})});
