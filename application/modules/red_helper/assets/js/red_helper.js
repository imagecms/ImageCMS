//$(document).ready(function() {
//    $('#go').click(function() {
//        $("#result").text("please wait...");
//        $.ajax({
//            url: 'http://redhelper.ru/my/register',
//            data: {
//                login: $("#login").val(),
//                password: $("#pass").val(),
//                email: $("#email").val(),
//                contactfio: $("#name").val(),
//                contactphone: $("#phone").val(), 
//                locale: 'en',
//                ref: 1 // partner id
//            },
//            xhrFields: {
//                withCredentials: true
//            },
//            crossDomain: true
//        })
//                .done(function(a) {
//                    $("#result").text(a);
//                });
//    });
//})