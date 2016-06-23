$('#prod').on(
    'click',
    function() {
        $('#forProd').fadeIn();
        $('#forUrl').fadeOut();
        $('#forCat').fadeOut();
        $('#forBase').fadeOut();
        initChosenSelect();
    }
);
$('#url').on(
    'click',
    function() {
        $('#forUrl').fadeIn();
        $('#forProd').fadeOut();
        $('#forCat').fadeOut();
        $('#forBase').fadeOut();
    }
);
$('#cat').on(
    'click',
    function() {
        $('#forCat').fadeIn();
        $('#forUrl').fadeOut();
        $('#forProd').fadeOut();
        $('#forBase').fadeOut();
        initChosenSelect();
    }
);
$('#base').on(
    'click',
    function() {
        $('#forUrl').fadeOut();
        $('#forProd').fadeOut();
        $('#forCat').fadeOut();
        $('#forBase').fadeIn();
        initChosenSelect();
    }
);
$('#404').on(
    'click',
    function() {
        $('#forUrl').fadeOut();
        $('#forProd').fadeOut();
        $('#forCat').fadeOut();
        $('#forBase').fadeOut();
    }
);