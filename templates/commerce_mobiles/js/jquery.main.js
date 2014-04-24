$.exists = function(selector) {
    return ($(selector).length > 0);
}
$.exists_nabir = function(nabir) {
    return (nabir.length > 0);
}
var ie = $.browser.msie,
        ieV = $.browser.version,
        ltie6 = ie && (ieV <= 6),
        ltie7 = ie && (ieV <= 7),
        ltie8 = ie && (ieV <= 8);

function setPie(nabir) {
    if (ltie8)
        nabir.css("behavior", "url(PIE/PIE.htc)")
}
;
function unsetPie(nabir) {
    if (ltie8)
        nabir.css("behavior", "none")
}
;
function resetPie(nabir) {
    if (ltie8)
    {
        unsetPie(nabir);
        setPie(nabir);
    }
}
;

$(document).ready(function() {
    $('.refresh_price').bind('click', function() {
        var el = $(this);
        var input = el.closest('.top_frame_tov').find('input[type=text]');
        var prodId = input.data('id');
        var prodCount = input.val();
        if (prodId && prodCount) {
            $.ajax({
                type: "GET",
                url: "/shop/cart/setQuantityProductByVariantId/" + prodId,
                data: "quantity=" + prodCount,
                success: function(msg) {
                    location.reload();

                }
            });
        }
    });
    $('.main_menu li a').click(function(e) {
        var $this = $(this).parent().toggleClass('active');

        $this.siblings().removeClass('active').find('ul').slideUp('fast');
        if ($this.children('ul').length > 0) {
            e.preventDefault();
            $this.children('ul').slideToggle('fast');
        }
    });
    //not_standart_checks----------------------
    if ($.exists('.niceCheck')) {
        $(".niceCheck").each(function() {
            active_b_p = '-156px -57px';
            n_active_b_p = '-130px -57px';
            changeCheckStart($(this));
        });
    }
    $(".frame_label > span").click(function() {
        changeCheck($(this).find('> span:eq(0)'));
        return false;
    });
    function changeCheck(el)
    {
        var el = el,
                input = el.find("input");
        if (!input.attr("checked")) {
            el.css("background-position", active_b_p);
            el.parent().parent().addClass('active');
            input.attr("checked", true);
        }
        else {
            el.css("background-position", n_active_b_p);
            el.parent().parent().removeClass('active');
            input.attr("checked", false);
        }
    }
    function changeCheckStart(el)
    {
        var el = el,
                input = el.find("input");
        if (input.attr("checked")) {
            el.css("background-position", active_b_p);
            el.parent().parent().addClass('active');
            input.attr("checked", true);
        }
        else {
            el.css("background-position", n_active_b_p);
            el.parent().parent().removeClass('active');
            input.attr("checked", false);
        }
        el.removeClass('b_n');
    }
    //close_not_standart_checks----------------------

    $('#method_deliv').change(function() {
        $('[id*="paymentMethod"]').hide();
        $('#paymentMethod' + $(this).val()).show().change();
    }).change();

    $('[id*="paymentMethod"]').change(function() {
        $('[name="paymentMethodId"]').val($(this).val())
    }).change();

    if (ltie7) {
        $('.head_cle_foot').replaceWith('<div class="' + $('.head_cle_foot').attr('class') + '"></div>');
    }
    
    
    // Change form url in order to check gift
    $('#checkGiftButton').on('click',function(){
        var el = $(this);
        el.closest('form').attr('action','/shop/cart').submit();
    });
});