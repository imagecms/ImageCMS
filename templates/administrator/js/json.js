function json()
{
    var comment; // Переменная для хранения строки,
    var plus;
    var minus;
    var action = 'newPost';

    $('#comment').each(function() { // Получаем строку для шифрования
        comment = this.value
    });

    $('#plus').each(function() { // Получаем строку для шифрования
        plus = this.value
    });

    $('#minus').each(function() { // Получаем строку для шифрования
        minus = this.value
    });

    if (comment == '') { //Проверка заполнил ли пользователь поле для ввода текста
        $('#notice').html(langs.needToEnterName + '!'); // Если нет то выводим предупреждение
    }
    else {
        $('#notice').empty();

        // Отправляем json запрос

        $.getJSON('json.php', {comment: comment, plus: plus, minus: minus, action: 'newPost'}, function(obj) {
//                        $('#m').attr('value', obj.orig + '|' + obj.md5);
        });


    }

}