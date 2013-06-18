<div id="wishCart" class="drop active" data-effect-off="fadeOut" data-duration="500" data-elrun="#popupCart" style="top: 922px; left: 571.5px; display: none;">
    <div class="fancy fancy_cleaner frame_head_content wishTMP">
        <div class="header_title">Вибирите cписок  желаний        
        </div>
        <div class="drop-content">
            <div class="inside_padd">
                {foreach $wish_lists as $wish_list}
                    <label>
                        <input type="radio" 
                               name="wishlist" 
                               value="{$wish_list.title}" 
                               data-id="{$wish_list.id}">
                        {$wish_list.title}
                    </label>
                {/foreach}
                <label>
                    <input type="radio" name="wishlist"  value="{$wish_list.title}" class="newWishList">
                    <input type="text"  name="wishlist"  value="Создать список" class="wish_list_name">
                </label>
                <input type="submit"  class="{$class}" id="{$varId}"  value="{$value}" onclick="addToWL('{$varId}')"/>
            </div>            
        </div>        
    </div>
</div>  
                
                
                
{literal}
    <script>
       
        $('.wish_list_name').mousedown(function (){
            if($(this).val()== "Создать список")
            {
               $(this).val(''); 
            }
        });
        $('.wish_list_name').blur(function (){
            if(!$(this).val())
            {
                $(this).val('Создать список'); 
            }
        });
        
       
        
    </script>
{/literal}