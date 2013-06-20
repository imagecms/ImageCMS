<div id="wishCart" class="drop active" data-effect-off="fadeOut" data-duration="500" data-elrun="#popupCart" style="top: 922px; left: 571.5px; display: block;">
    <div class="fancy fancy_cleaner frame_head_content wishTMP">
        <div class="header_title">Вибирите cписок  желаний
        </div>
        <div class="drop-content">
            <div class="inside_padd">
                <div class="addWL">
                    {foreach $wish_lists as $wish_list}
                        <label>
                            <input type="radio"
                                   name="wishlist"
                                   value="{$wish_list.title}"
                                   data-id="{$wish_list.id}">
                            {$wish_list.title}
                        </label>
                    {/foreach}
                    <label class="newWishListLable">
                        <input type="radio" name="wishlist"  value="{$wish_list.title}" class="newWishList" data-listsCount="{count($wish_lists)}" data-maxListsCount={$max_lists_count}>
                        <input type="text"  name="wishlist"  value="Создать список" class="wish_list_name">
                    </label>
                    <lable>Коментар
                        <textarea class="wishProductComment"></textarea>
                    </lable>
                    <input type="submit" class="{$class}" id="{$varId}"  value="{$value}" onclick="addToWL('{$varId}')"/>
                </div>
                <div class="share_tov">
                    {echo $CI->load->module('share')->_make_share_form()}
                </div>            
                <div id="errors" class="msg"><div class="error"></div></div>
            </div>
            
        </div>
    </div>
</div>



{literal}
    <script>

                    $('.wish_list_name').mousedown(function() {
                        if ($(this).val() == "Создать список")
                        {
                            $(this).val('');
                        }
                    });
                    $('.wish_list_name').blur(function() {
                        if (!$(this).val())
                        {
                            $(this).val('Создать список');
                        }
                    });



    </script>
{/literal}