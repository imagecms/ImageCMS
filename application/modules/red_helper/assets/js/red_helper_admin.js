$(document).ready(function() {
    $('#go').click(function() {
        $("#result").text("please wait...");
        $.ajax({
            url: 'http://redhelper.ru/my/register',
            data: {
                login: $("#login").val(),
                password: $("#pass").val(),
                email: $("#email").val(),
                contactfio: 'qweew',
                contactphone: '879465465',
                locale: 'en',
                ref: 1 // partner id
            },
            xhrFields: {
                withCredentials: true
            },
            crossDomain: true
        })
                .done(function(a) {
                    $("#result").text(a);
                });
    });
})