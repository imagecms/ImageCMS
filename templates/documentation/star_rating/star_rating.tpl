<!--link rel='stylesheet' type='text/css' href='/application/modules/star_rating/templates/public/star-rating.css' /-->

<div class='sta'>
    <span itemprop='itemreviewed' class='d_i-b vote-for-cms'>Голосуй за ImageCMS:</span>
    <div class='star_rating d_i-b'>
        <span class='rating {$class} star_rait star-big' data-id="{echo $CI->core->core_data['id']}" data-type="{echo $CI->core->core_data['data_type']}">
            <div data-rat='1' data-id='{$id}' data-val='{$p}' class='rate one'><a title='1'>1</a></div>
            <div data-rat='2' data-id='{$id}' data-val='{$p}' class='rate two'><a title='2' >2</a></div>
            <div data-rat='3' data-id='{$id}' data-val='{$p}' class='rate three'><a title='3'>3</a></div>
            <div data-rat='4' data-id='{$id}' data-val='{$p}' class='rate four'><a title='4'>4</a></div>
            <div data-rat='5' data-id='{$id}' data-val='{$p}' class='rate five'><a title='5'>5</a></div>
        </span>
    </div>

    <div  class='' itemscope='' itemtype='http://data-vocabulary.org/Review-aggregate'  id='pageRatingData'>
        <meta id='metaRatingCount' itemprop='rating' content='{$data['rating']}'> Проголосовало <span id="count_votes_g" class='rating_votes_count' itemprop='count'>{if $data['votes'] != null}{echo $data['votes']}{else:} 0 {/if}</span> человек

    </div>
</div>

{literal}
    <script type='text/javascript'>
        $(document).ready(function() {
            var rating = parseInt($("meta#metaRatingCount").attr('content'));
            var cssClass = getRatingCssClass(Math.round(rating / 20));
            $('.star_rait').addClass(cssClass);

            $('.rate').click(function() {
                var rating = parseInt($(this).data('rat'));
                var cssClass = getRatingCssClass(rating);
                $('.star_rait').attr('class', '').attr('class', 'rating star_rait star-big');
                $('.star_rait').addClass(cssClass);
            });

            function getRatingCssClass(countStars_) {
                var countStars = parseInt(countStars_);
                var classes = [
                    'onestar',
                    'twostar',
                    'threestar',
                    'fourstar',
                    'fivestar',
                ];

                for (var i = 0; i < classes.length; i++) {
                    if (countStars == (i + 1))
                        return classes[i];
                }
                console.log('error');
                return '';
            }
        })
    </script>
{/literal}