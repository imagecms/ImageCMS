$('#prod').on('click', function() {
    $('#forProd').fadeIn();
    $('#forUrl').fadeOut();
    $('#forCat').fadeOut();
    $('#forBase').fadeOut();
});
$('#url').on('click', function() {
    $('#forUrl').fadeIn();
    $('#forProd').fadeOut();
    $('#forCat').fadeOut();
    $('#forBase').fadeOut();
});
$('#cat').on('click', function() {
    $('#forCat').fadeIn();
    $('#forUrl').fadeOut();
    $('#forProd').fadeOut();
    $('#forBase').fadeOut();
});
$('#base').on('click', function() {
    $('#forUrl').fadeOut();
    $('#forProd').fadeOut();
    $('#forCat').fadeOut();
    $('#forBase').fadeIn();
});
$('#404').on('click', function() {
    $('#forUrl').fadeOut();
    $('#forProd').fadeOut();
    $('#forCat').fadeOut();
    $('#forBase').fadeOut();
});