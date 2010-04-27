    <div class="post">
        <h1><a href="{site_url($page.full_url)}">{$page.title}</a></h1>  
        <span class="post-pub-info">{date('d-m-Y', $page.publish_date)} | Раздел: <a href="{site_url($page.cat_url)}">{get_category_name($page.category)}</a></span>
        
        {$page.prev_text}
        
        <div class="postinfo">
           <a href="javascript:history.back(-1);">{lang('history_back')}</a>
        </div> 
     </div>

<link rel="stylesheet" type="text/css" href="{media_url('application/modules/star_rating/templates/public/star-rating.css')}" />


<ul id="1001" class="rating onestar">
  <li id="1" class="rate one"><a href="#" title="1 Star">1</a></li>
  <li id="2" class="rate two"><a href="#" title="2 Stars">2</a></li>

  <li id="3" class="rate three"><a href="#" title="3 Stars">3</a></li>
  <li id="4" class="rate four"><a href="#" title="4 Stars">4</a></li>
  <li id="5" class="rate five"><a href="#" title="5 Stars">5</a></li>
</ul>
{literal}
<script type="text/javascript">
$$('.rate').each(function(element,i){
        element.addEvent('click', function(){
                var myStyles = ['nostar', 'onestar', 'twostar', 'threestar', 'fourstar', 'fivestar'];
                myStyles.each(function(myStyle){
                        if(element.getParent().hasClass(myStyle)){
                                element.getParent().removeClass(myStyle)
                        }
                });             
                myStyles.each(function(myStyle, index){
                        if(index == element.id){
                                element.getParent().toggleClass(myStyle);
                                alert('Clicked '+element.id); 
                                exit;
                        }
                });             
                
        });
});
</script>
{/literal}


    <div id="comments">
        {$comments}
    </div>
