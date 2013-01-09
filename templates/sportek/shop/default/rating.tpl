  
  
        
        {; $rate = getRate($_SERVER['PATH_INFO'])}
        
        
        {; $rat = (int) @round($rate['rating'] / $rate['votes'])}
        {; $men = $rate['votes']}
        {; $id = $_SERVER['PATH_INFO']}
        {; $p = 'page'}
        

    
    <div class="star_rating">
        <span class="rating {get_class_rat($rat)} star_rait">
            <div data-rat="1" data-id="{echo $id}" data-val="{echo $p}" class="rate one"><a title="1">1</a></div>
            <div data-rat="2" data-id="{echo $id}" data-val="{echo $p}" class="rate two"><a title="2" >2</a></div>
            <div data-rat="3" data-id="{echo $id}" data-val="{echo $p}" class="rate three"><a title="3">3</a></div>
            <div data-rat="4" data-id="{echo $id}" data-val="{echo $p}" class="rate four"><a title="4">4</a></div>
            <div data-rat="5" data-id="{echo $id}" data-val="{echo $p}" class="rate five"><a title="5">5</a></div>
        </span>
    </div>
    
    <div itemscope="" itemtype="http://data-vocabulary.org/Review-aggregate" style="float:left" id="pageRatingData">
        {if $CI->uri->segment(2) != 'product'}   &nbsp;Рейтинг страницы: «<span itemprop="itemreviewed">Спортек</span>» {/if} <meta itemprop="rating" content="{echo $rat}"> оставило <span itemprop="count">{if $men}{echo $men}{else:}0 {/if}</span> человек. 
    </div>
     
   
    
{literal}
<script type="text/javascript">
    $(document).ready(function(){
        $('.rate').click(function(){
            var rat = $(this).attr('data-rat');
            var type = $(this).attr('data-val');
            var id = $(this).attr('data-id');
            $.ajax({
                url : '/star_rating/rate',
                type : 'post',
                data : 'pid='+id+'&val='+rat+'&type='+type,
                success : function(){
                    $('.star_rait').attr('class','').attr('class','rating star_rait');
                    if (rat == 1)
                        $('.star_rait').addClass('onestar');
                    if (rat == 2)
                        $('.star_rait').addClass('twostar');
                    if (rat == 3)
                        $('.star_rait').addClass('threestar');
                    if (rat == 4)
                        $('.star_rait').addClass('fourstar');
                    if (rat == 5)
                        $('.star_rait').addClass('fivestar');
                }
            })
            return false;
        })
    })
</script>
{/literal}

