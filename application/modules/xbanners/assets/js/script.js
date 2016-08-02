function hideVisibleParams(){
    var flag = $('#hiddenParams').css('display');
    var oldName = $('#urlVisible').html();
    var newName = $('#urlVisibleNew').val();
    
    if(flag == 'none'){
        $('#hiddenParams').css('display','block');
        $('#urlVisible').html(newName);
        $('#urlVisibleNew').val(oldName);
    }else{
        $('#hiddenParams').css('display','none');
        $('#urlVisible').html(newName);
        $('#urlVisibleNew').val(oldName);        
    }
}
function log(param) {
    console.log(param);
}

$(document).on("pjax:end", function () {
    setTimeout(function(){
        initBanners();
    } , 1000);

});

$(document).ready(function () {
    initBanners();
});



function initBanners() {


    $(".frame_label:has(.niceCheck)").die('click').live('click', function () {
        var $this = $(this);
        if ($('#show_in_all_cat').attr('checked')) {
            $('#cat_list').removeAttr('disabled');
        } else {
            $('#cat_list').attr('disabled', 'disabled');
            $('#cat_list option:selected').each(function () {
                this.selected = false;
            });
        }
        if ($this.closest('thead')[0] != undefined) {
            changeCheck($this.find('.niceCheck'));
            if ($this.hasClass('active')) {
                $this.parents('table').find('.frame_label').each(function () {
                    changeCheckallchecks($(this).find('.niceCheck'));
                });
            }
            else {
                $(this).parents('table').find('.frame_label').each(function () {
                    changeCheckallreset($(this).find('.niceCheck'));
                });
            }
        }
        else if ($this.closest('.head')[0] != undefined) {
            changeCheck($this.find('.niceCheck'));
            if ($this.hasClass('active')) {
                $this.parents('#category').find('.frame_label').each(function () {
                    changeCheckallchecks($(this).find('.niceCheck'));
                });
            }
            else {
                $(this).parents('#category').find('.frame_label').each(function () {
                    changeCheckallreset($(this).find('.niceCheck'));
                });
            }
        }
        else {
            changeCheck($this.find('.niceCheck'));
        }
        if (!$this.hasClass('no_connection')) {
            dis_un_dis();
        }
        return false;
    });
    $(".urlcomplete").autocomplete({
        source: function(){
            var  locale = $('.urlcomplete').data('locale');
            return "/admin/components/cp/xbanners/url_search_autocomplete/" + locale;

        }(),
        create: function (ev, ui) {
            $(this).data('autocomplete')._renderMenu = function (ul, items) {
                var self = this;

                $.each(items, function (index, item) {
                    var itemData = [];
                    for (var it in item.value) {
                        self._renderItem(ul, {label: item.label + ' : ' + it, value: item.value[it]});
                    }
                });
            }
        },
    });
    function changeCheck(el) {
        var el = el,
                input = el.find("input"),
                inputHideDate = el.find("input.show-date-banner"),
                inputHideCat = el.find("input.show-categories"),
                inputHideAutoplay = el.find('input.show-autoplay');
        if (!input.attr("checked")) {
            inputHideDate.closest('.control-group').next('.hide-control-group').hide();
            inputHideCat.closest('.control-group').next('.show-control-group').hide();
            inputHideAutoplay.closest('.control-group').next('.show-control-group').show();
            check1(el, input);
            //textcomment_s_h('s', el);
        }
        else {
            inputHideCat.closest('.control-group').next('.show-control-group').show();
            inputHideAutoplay.closest('.control-group').next('.show-control-group').hide();
            inputHideDate.closest('.control-group').next('.hide-control-group').show();
            check2(el, input);
            //textcomment_s_h('h', el);
        }
    }
    if ($('.myTab a.btn-small-setting').hasClass('active')) {
        $('.myTab a.btn-small-setting').closest('.tabbable').prev('.frame_title').find('.saveEditformSubmit').show();
    }
    $('select[name="image[allowed_page]"]').chosen();
    $('body').on('click', '.btnAddNewSlide', function () {
        var $this = $(this),
                slideCreate = $('.addNewSlide');
        $this.hide();
        if (slideCreate) {
            slideCreate.show();
        }
        initChosenSelect();
    });
    $('body').on('click', '.btnCloseNewSlide', function () {
        var $this = $(this),
                slideCreate = $('.addNewSlide');

        $('.btnAddNewSlide').show();
        if (slideCreate) {
            slideCreate.hide();
        }
    });
    $('body').on('click', '.btnCloseEditSlide', function () {
        var $this = $(this),
                hideControls = $this.closest('.form-horizontal').find('.hide-control'),
                hideControlsPrev = hideControls.prev('.controls'),
                formHorizontal = $this.closest('.success-form-horizontal');
        $this.hide().prev().hide();
        $this.prev().prev().show();
        $this.prev().prev().prev().show();
        $this.closest('td').find('input[type="file"]').attr('disabled', 'disabled');
        if (hideControls) {
            formHorizontal.addClass('hide-select').removeClass('is-margin');
            hideControls.hide();
            hideControlsPrev.show();
        }
    });



    $('body').on('click', '.editSlide', function () {
        var $this = $(this),
                hideControls = $this.closest('.form-horizontal').find('.hide-control'),
                hideControlsPrev = hideControls.prev('.controls'),
                formHorizontal = $this.closest('.success-form-horizontal');
        $this.hide().next().hide();
        $this.next().next().show();
        $this.next().next().next().show();
        $this.closest('td').find('input[type="file"]').removeAttr('disabled');
        if (hideControls) {
            formHorizontal.removeClass('hide-select').addClass('is-margin');
            hideControls.show();
            hideControlsPrev.hide();
        }
    });
}

var Banners = {
    showImagesCategory: function (curEl) {
        var categoryToShow = $(curEl).val();
        var allCategories = $('table[categoryName]');

        $(allCategories).each(function () {
            if ($(this).attr('categoryName') === categoryToShow) {
                $(this).show();
            } else {
                $(this).hide();
            }

            if (categoryToShow === 'all') {
                $(this).show();
            }
        });
    },
    showEditable: function (curEl) {
        var closestTd = $(curEl).closest('td');
        $(closestTd).find('.saveSlide').show();
        $(closestTd).find('.toEdit').show();

        $(closestTd).find('.photo_album').hover(function () {
            $(closestTd).find('.photo_album > .btn-group, .photo_album > .fon').show();
            $(closestTd).find('.photo_album input[name="file-image"]').removeAttr('disabled');
            $(closestTd).find('.photo_album img').css('cursor', 'pointer');
            $(closestTd).find('.photo_album > .fon, .photo_album img').addClass('editImageFon');
        },
                function () {
                    $(closestTd).find('.photo_album > .btn-group, .photo_album > .fon').hide();
                    $(closestTd).find('.photo_album > .fon, .photo_album img').removeClass('editImageFon');
                }
        );
    },
    hideEditable: function (curEl) {
        var closestTd = $(curEl).closest('td');
        $(closestTd).find('.photo_album > .btn-group, .photo_album > .fon').hide();
        $(closestTd).find('.photo_album input[name="file-image"]').attr('disabled', 'disabled');
        $(closestTd).find('.photo_album img').css('cursor', 'default');
        $(closestTd).find('.photo_album > .fon, .photo_album img').removeClass('editImageFon');
        $(closestTd).find('.saveSlide').hide();
        $(closestTd).find('.toEdit').hide();
        $(closestTd).find('.photo_album').hover(function () {
            $(closestTd).find('.photo_album > .btn-group, .photo_album > .fon').hide();
            $(closestTd).find('.photo_album > .fon, .photo_album img').removeClass('editImageFon');
        });
    }
};

var BannersEffects = {
    removeDotsCheck: function (curEl) {
        var arrows = $(curEl).closest('.control-group').next('div').find('input');

        $(arrows).removeAttr('checked');

        if ($(arrows).closest('.frame_label').hasClass('active')) {
            $(arrows).closest('.frame_label').removeClass('active');
            $(arrows).closest('.frame_label').find('.niceCheck').attr('style', '')
        }
    },
    removeArrowsCheck: function (curEl) {
        var arrows = $(curEl).closest('.control-group').prev('div').find('input');

        $(arrows).removeAttr('checked');

        if ($(arrows).closest('.frame_label').hasClass('active')) {
            $(arrows).closest('.frame_label').removeClass('active');
            $(arrows).closest('.frame_label').find('.niceCheck').attr('style', '')
        }
    }

}

