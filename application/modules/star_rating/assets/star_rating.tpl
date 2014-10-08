{if $CI->core->core_data['data_type'] != null}
    {if $CI->core->core_data['data_type'] == 'product'}
        <div class="star">    
            <div class="productRate star-big" data-id="{echo $CI->core->core_data['id']}" data-type="product">
                <div style="width: {if $model->getVotes() != null}{echo ($model->getRating()*20)."%\""}{else:} 0%"{/if}></div>
            </div>        
            <span itemscope="" itemtype="" id="pageRatingData"> 
                <meta itemprop="rating" content="4"> {lang('Leav', 'star_rating')} <span id="count_votes_g" itemprop="count">{if $model->getVotes() != null}{echo $model->getVotes()}{else:} 0 {/if}</span> {lang('people(s)', 'star_rating')}.
            </span>
        </div>
    {else:}    
        <div class="star">   
            <div class="productRate star-big" data-id="{echo $CI->core->core_data['id']}" data-type="{echo $CI->core->core_data['data_type']}">
                <div style="width: {if $data['votes'] != null}{echo $data['rating']."%\" "}{else:} 0%"{/if}></div>
            </div>        
            <span> 
                <meta itemprop="rating" content="4"> {lang('Leav', 'star_rating')} <span id="count_votes_g" itemprop="count">{if $data['votes'] != null}{echo $data['votes']}{else:} 0 {/if}
                </span> {lang('people(s)', 'star_rating')}.
            </span>
        </div>
    {/if}
{/if}
