setTimeout(function () {
    $('.t_notice_on_load').fadeOut();
}, 3000);

// Scroll to and animate show of downloaded template holder
var downloadTplName = getCookie('DownloadedTemplateName');
if (downloadTplName && $('.download_' + downloadTplName.toLowerCase()).length) {
    var scrollTop = $('html').offset().top,
            elementOffset = $('.download_' + downloadTplName.toLowerCase()).offset().top,
            distance = (elementOffset - scrollTop);

    distance = distance ? distance : 0;
    $('html').animate({
        scrollTop: distance - 50
    }, 1000);

    $('.download_' + downloadTplName.toLowerCase()).fadeOut(1000).fadeIn(1500);
}
$('[rel*="group"]').fancybox();

// prewiew local image
$('#logofav input[type="file"]').off('change').on('change', function (e) {
    // checking if file is image
    var allowedFileExtentions = ['jpg', 'jpeg', 'png', 'ico', 'gif'];
    var ext = $(this).val().split('.').pop();
    var extentionIsAllowed = false;
    for (var i = 0; i < allowedFileExtentions.length; i++) {
        if (allowedFileExtentions[i] == ext) {
            extentionIsAllowed = true;
            break;
        }
    }
    if (extentionIsAllowed == false) {
        $(this).removeAttr("value");
        showMessage(lang('Error'), lang('Only image can be loaded'), "error");
        return;
    }

    // creating image preview
    var file = this.files[0];
    var img = document.createElement("img");
    var reader = new FileReader();
    var imageContainer = $('.siteinfo_image_container');

    reader.onloadend = function () {
        img.src = reader.result;
    };

    reader.readAsDataURL(file);
    $(img).addClass('img-polaroid');
    $(this).closest('.control-group').find('.controls').html(img);

    imageContainer.each(function(){
        var imageEmpty = $(this).find('.siteinfo_is_empty').size();

        if(imageEmpty == 0){
            $(this).append('<button type="button" class="btn btn-small remove_btn"><i class="icon-trash"></i></button>');
        }
    });

});


function installTempalate(data) {
    if (data.accept_license_agreement == null) {
        showMessage(langs.error, templateManagerData.acceptLicenseError, 'error');
        return;
    }
    var url = templateManagerData.moduleAdminUrl + '/install';
    $('#loading').fadeIn(100);
    $.post(url, data, function (response) {
        $('#loading').fadeOut(100);
        var resp = document.createElement('div');
        resp.innerHTML = response;
        $(resp).find('p').remove();
        $('.notifications').append(resp);

        setTimeout(function () {
            location.reload();
        }, 2000);
    });
}

// getting license agreement text
$('.show_template_agreement').off('click').on('click', function () {
    $('#accept_license_agreement').removeAttr('checked');
    var templateName = $(this).data('template_name');
    $('.accept_license_install_template').attr('data-template_name', templateName);
    var url = templateManagerData.moduleAdminUrl + '/get_template_license';
    $.get(url, {template_name: templateName}, function (response) {
        if (response.status == 1) {
            if (response.license_text != '0') {
                $('#license_agreement_text').empty().html(response.license_text);
                $('#license_agreement_modal').modal('show');

                if (response.demodataArchiveExist) {
                    $('.demodataArchiveButton').show();
                } else {
                    $('.demodataArchiveButton').hide();
                }
            } else {
                installTempalate({
                    accept_license_agreement: 1,
                    install_demodata: false,
                    template_name: templateName
                });
            }

        } else {
            showMessage(response.error, '', 'r');
        }
    }, 'json');
});

$('.demodataArchiveButton').off('click').on('click', function () {
    var templateName = $(this).data('template_name');
    var url = templateManagerData.moduleAdminUrl + '/installFullDemodata/' + templateName;
    $('#loading').fadeIn(100);
    $.get(url, {template_name: templateName}, function (response) {
        $('#loading').fadeOut(100);
        if (response.success) {
            showMessage(lang('Message'), response.message);
        } else {
            showMessage(lang('Error'), response.message, 'r');
        }
    }, 'json');
});



$('.accept_license_install_template').off('click').on('click', function () {
    var data = {
        accept_license_agreement: $('#accept_license_agreement').attr('checked') == 'checked' ? 1 : null,
        install_demodata: $(this).data('install_demodata') == 0 ? false : parseInt($(this).data('install_demodata')),
        template_name: $(this).data('template_name')
    };
    installTempalate(data);
});


// Get cookie by name
function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2)
        return parts.pop().split(";").shift();
}


$('#template_file').change(function () {
    $('#template_file').parent().prev().attr('value', '');
    var ext = $(this).val().split('.').pop();
    if (ext != 'zip') {
        $(this).parent().prev().val('');
        $(this).val('');
        showMessage(langs.error, templateManagerData.wrongFileType, "error");
        return false;
    }
});




/*
 * Templates filter
 */
$('#templates_filter').off('keyup').on('keyup', function () {
    var inputValue = $(this).val().toLowerCase();
    if (inputValue == "") {
        $('.template_tile').show();
        return;
    }
    $('.template_tile').each(function () {
        var moduleName = $(this).find('.template_name').text().toLowerCase();
        if (moduleName.indexOf(inputValue) != -1) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
});


/**
 * Hiding template filter on other tabs
 */
$('.tabs a.btn.btn-small').off('click').on('click', function () {
    var showOnTabs = ['#list', '#remote_templates'];
    var href = $(this).attr('href');
    var bool = $.inArray(href, showOnTabs) >= 0;

    if (bool) {
        $('.filter_container').show();
    } else {
        $('.filter_container').hide();
    }

});

$('#template_file').change(function () {
    $(this).closest('.controls').find('input[type="text"]').val(this.files[0].name);
});




