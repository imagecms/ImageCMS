function unlinkSocial(social) {
    $.ajax({
        type: 'POST',
        url: '/socauth/unlink/' + social,
        success: function(data) {
            obj = JSON.parse(data);
            if (obj.answer === 'sucesfull')
                document.location.href = '/shop/profile';
        }
    });
}