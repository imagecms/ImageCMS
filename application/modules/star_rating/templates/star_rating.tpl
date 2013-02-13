<script type="text/javascript">
    var currentId = '{echo $CI->core->core_data['id']}';
    var type = '{echo $CI->core->core_data['data_type']}';
</script>
{if $CI->core->core_data['data_type'] != null && $CI->core->core_data['data_type'] != null}
   {if $CI->core->core_data['data_type'] == 'product'}
        <div class="star_rating">
            <div id="star_rating_g_{$CI->core->core_data['id']}" class="rating {if $model->getVotes() != null}{echo count_star( round($model->getRating()))}{/if} star_rait">
                <div id="1" class="rate one">
                    <span title="1" class="clickrate_g">1</span>
                </div>
                <div id="2" class="rate two">
                        <span title="2" class="clickrate_g">2</span>
                </div>
                <div id="3" class="rate three">
                        <span title="3" class="clickrate_g">3</span>
                </div>
                <div id="4" class="rate four">
                    <span title="4" class="clickrate_g">4</span>
                </div>
                <div id="5" class="rate five">
                    <span title="5" class="clickrate_g">5</span>
                </div>
            </div>
        </div>
        <span itemscope="" itemtype="http://data-vocabulary.org/Review-aggregate" id="pageRatingData"> 
        <meta itemprop="rating" content="4"> Оставило <span id="count_votes_g" itemprop="count">{if $model->getVotes() != null}{echo $model->getVotes()}{else:} 0 {/if}</span> человек(а).
        </span>
    {else:}    
        <div class="star_rating">
            <div id="star_rating_g_{echo $CI->core->core_data['id']}" class="rating {if $star_rating->votes != null}{echo count_star( round($star_rating->rating/$star_rating->votes))}{/if} star_rait">
                <div id="1" class="rate one">
                    <span title="1" class="clickrate_g">1</span>
                </div>
                <div id="2" class="rate two">
                        <span title="2" class="clickrate_g">2</span>
                </div>
                <div id="3" class="rate three">
                        <span title="3" class="clickrate_g">3</span>
                </div>
                <div id="4" class="rate four">
                    <span title="4" class="clickrate_g">4</span>
                </div>
                <div id="5" class="rate five">
                    <span title="5" class="clickrate_g">5</span>
                </div>
            </div>
        </div>
        <span itemscope="" itemtype="http://data-vocabulary.org/Review-aggregate" id="pageRatingData"> 
        <meta itemprop="rating" content="4"> Оставило <span id="count_votes_g" itemprop="count">{if $star_rating->votes != null}{echo $star_rating->votes}{else:} 0 {/if}</span> человек(а).
        </span>
    {/if}
{/if}
<script type="text/javascript" src="/application/modules/star_rating/templates/js/scripts.js"></script>