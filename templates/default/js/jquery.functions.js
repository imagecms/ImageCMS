/*
 * Slideshow Functions
 */
 
$(window).load(function()
{
    //this is intended to wait for all the images to load before running the slideshow
    init_slideshow()
})

init_slideshow = function()
{
    $('#slides').cycle({
        speed: 600,
        timeout: 2000,
        fx: 'fade',
        pager: '#slide_navigation',
        pagerEvent: 'click',
        pauseOnPagerHover: true,
        pagerAnchorBuilder: function(idx, slide) {
            return '<a href="#"></a>';
        }
    }).hover(function() {
        $('#slides').cycle('pause');
    }, function() {
        $('#slides').cycle('resume');
    });
}