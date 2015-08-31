$(document).ready(function() {

    /**
     * 
     * @returns {Boolean}
     */
    function isDebugOn() {
        return $('#debug').is(':checked');
    }

    /**
     * 
     * @param {Boolean} enable
     */
    function changeDebugRelatedInputsState(enable) {
        $('.debug_related input').each(function() {
            if (enable) {
                $(this).attr('disabled', 'disabled');
            } else {
                $(this).removeAttr('disabled');
            }
        });
    }

    function onDebugChange() {
        changeDebugRelatedInputsState(!isDebugOn());
    }

    // not working...
    $(document).on('change', '#debug', function() {
        console.log(12345);
    });
    
    

});