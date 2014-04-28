$('#role').live('change', function() {
    setTimeout(function() {
        $('.listFilterSubmitButton').trigger('click');
    }, 100);
    
});