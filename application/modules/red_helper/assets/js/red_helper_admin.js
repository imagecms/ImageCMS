$(document).ready(function() {
    
    function dump(obj) {
        var out = "";
        if(obj && typeof(obj) == "object"){
            for (var i in obj) {
                out += i + ": " + obj[i] + "\n";
            }
        } else {
            out = obj;
        }
        alert(out);
    }
    
    $('#go').click(function() {
        $("#result").text("please wait...");
        $("#phoneResult").text("");
        $.ajax({
            url: '/red_helper/validate',
            type: 'post',
            dataType: "json",
            data: $('.redHelpForm').serialize(),
            xhrFields: {
                withCredentials: true
            },
            crossDomain: true
        })
                .done(function(a) {
                    var flag = true;
                    if(a[0] !== ""){
                        $("#loginResult").text($(a[0]).text());
                        flag = false;
                    } else {
                        $("#loginResult").text("");
                    }
                    if(a[1] !== ""){
                        $("#passwordResult").text($(a[1]).text());
                        flag = false;
                    } else {
                        $("#passwordResult").text("");
                    }
                    if(a[2] !== ""){
                        $("#emailResult").text($(a[2]).text());
                        flag = false;
                    } else {
                        $("#emailResult").text("");
                    }
                    if(a[3] !== ""){
                        $("#phoneResult").text($(a[3]).text());
                        flag = false;
                    } else {
                        $("#phoneResult").text("");
                    }
                    //$("#result").text(a);
                       //if ($("#result").html() == '') {
                       if(flag == true) {
                            $("#result").css('color','#00ff00').text("please wait...");
                            $.ajax({
                                url: 'http://redhelper.ru/my/register',
                                data: {
                                    login: $("#login1").val(),
                                    password: $("#pass").val(),
                                    email: $("#email").val(),
                                    contactfio: $("#name").val(),
                                    contactphone: $("#phone").val(), 
                                    locale: 'ru',
                                    ref: 2003624          // partner id
                                },
                                xhrFields: {
                                    withCredentials: true
                                },
                                crossDomain: true
                            })
                            .done(function(a) {
                                $("#result").text(a);
//                                if ($("result").html() === "login incorrect"){$("#loginResult").text('Внимание! Выбранный Вами логин уже занят. Подберите другое имя.');}
//                                if ($("#result").html() === "email incorrect"){$("#emailResult").text('Указанной Вами почты не существует. Исправьте адрес электронной почты и попробуйте еще раз.');}
//                                if ($("#result").html() === 'success'){$("#result").text('Регистрация прошла успешно! Введите свой логин в Параметры');}
                                if (a === "login incorrect" || a === "exist"){$("#loginResult").text('Внимание! Выбранный Вами логин уже занят. Подберите другое имя.');}
                                if (a === "email incorrect"){$("#emailResult").text('Указанной Вами почты не существует. Исправьте адрес электронной почты и попробуйте еще раз.');}
                                if (a === 'success') {
                                    $("#result").text('Регистрация прошла успешно! Введите свой логин в Параметры');
                                    $("#registerModal").hide();
                                    $(".modal-backdrop").hide();
                                    showMessage(lang('Message'),lang('Регистрация прошла успешно! Введите свой логин в Параметры'));
                                }
                            });
                       }
                });
    });
    
})



