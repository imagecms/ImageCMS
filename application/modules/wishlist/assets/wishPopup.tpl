<article class="container">
    <form method="post" action="{if $wish_list_id}{site_url('/wishlist/moveItem/'.$varId . '/' . $wish_list_id)}{else:}{site_url('/wishlist/addItem/'.$varId)}{/if}">
        <div id="wishCart" class="active" data-effect-off="fadeOut" data-duration="500" data-elrun="#popupCart" style="top: 922px; left: 571.5px; display: block;">
            <div class="fancy fancy_cleaner frame_head_content wishTMP">
                <div class="header_title">{lang('Select Wishlist', 'wishlist')}
                </div>
                <div class="drop-content">
                    <div class="inside_padd">
                        <div class="addWL">
                            {foreach $wish_lists as $wish_list}
                                <label>
                                    <input type="radio" name="wishlist" value="{$wish_list.id}" data-id="{$wish_list.id}">
                                    {$wish_list.title}
                                </label>
                            {/foreach}
                            <label class="newWishListLable">
                                <input type="radio" name="wishlist"  value="sd" class="newWishList" data-listsCount="{count($wish_lists)}" data-maxListsCount={$max_lists_count}>
                                    {lang('Create WishList', 'wishlist')}
                                <input type="text"  name="wishListName"  value="" class="wish_list_name">
                            </label>
                            <input type="submit" class="{$class}" id="{$varId}"  value="{if $wish_list_id}{lang('Move in list', 'wishlist')}{else:}{lang('Add to list', 'wishlist')}{/if}"/>
                        </div>
                        <div id="errors" class="msg">
                            <div class="error"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {form_csrf()}
    </form>
</article>