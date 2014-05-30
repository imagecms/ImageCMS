$(document).ready(function() {
    $('#go').click(function() {
        $("#result").text("please wait...");
        $.ajax({
            url: '/red_helper/validate',
            type: 'post',
            data: $('.redHelpForm').serialize(),
            xhrFields: {
                withCredentials: true
            },
            crossDomain: true
        })
                .done(function(a) {
                    $("#result").text(a);
                       if ($("#result").html() == '')
                       {
                     $("#result").text("please wait...");
                            $.ajax({
                                url: 'http://redhelper.ru/my/register',
                                data: {
                                    login: $("#login1").val(),
                                    password: $("#pass").val(),
                                    email: $("#email").val(),
                                    contactfio: $("#name").val(),
                                    contactphone: $("#phone").val(), 
                                    locale: 'ru',
                                    ref: 1 // partner id
                                },
                                xhrFields: {
                                    withCredentials: true
                                },
                                crossDomain: true
                            })
                            .done(function(a) {
                                $("#result").text(a);
                                if ($("#result").html() === 'email incorrect'){$("#result").text('Указанной Вами почты не существует. Исправьте адрес электронной почты и попробуйте еще раз.');}
                                if ($("#result").html() === 'exist'){$("#result").text('Внимание! Выбранный Вами логин уже занят. Подберите другое имя.');}
                                if ($("#result").html() === 'success'){$("#result").text('Регистрация прошла успешно! Введите свой логин в Параметры');}
                            });
                       }
                });
    });
    
})



