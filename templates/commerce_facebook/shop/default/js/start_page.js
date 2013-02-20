$(window).load(function()
{
    init_slideshow();
})

init_slideshow = function()
{
    $('#slides').cycle({
        fx:'fade',
        timeout:8000,
        pager:'#slide_navigation',
        after:update_slide_caption,
        before:fade_slide_caption
    })
}

function mycarousel_itemLoadCallback(carousel, state)
{
    // Check if the requested items already exist
    if (carousel.has(carousel.first, carousel.last)) {
        return;
    }

    jQuery.get(
        '/shop/ajax/getCarouselImages',
        {
            first: carousel.first,
            last: carousel.last
        },
        function(xml) {
            mycarousel_itemAddCallback(carousel, carousel.first, carousel.last, xml);
        },
        'xml'
    );
};

function mycarousel_itemAddCallback(carousel, first, last, xml)
{
    // Set the size of the carousel
    carousel.size(parseInt(jQuery('total', xml).text()));
    jQuery('product', xml).each(function(i) {
        var url = $("url", this).text();
        var image_url = $("image", this).text();
        carousel.add(first + i, mycarousel_getItemHTML(url, image_url));
    });
};

/**
 * Item html creation helper.
 */
function mycarousel_getItemHTML(url, image_url)
{
    return '<a class = "product_url" href="/shop/product/' + url +'"><img src="' + image_url + '" width="75" height="75" alt="" /></a>';
};

jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel({
        // Uncomment the following option if you want items
        // which are outside the visible range to be removed
        // from the DOM.
        // Useful for carousels with MANY items.

        // itemVisibleOutCallback: {onAfterAnimation: function(carousel, item, i, state, evt) { carousel.remove(i); }},
        scroll:6,
        itemLoadCallback: mycarousel_itemLoadCallback
    });
});