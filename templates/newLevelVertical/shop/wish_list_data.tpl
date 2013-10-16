{if $is_logged_in}
    {$wish_list = $CI->load->module('wishlist')}
    {$countWL = $wish_list->getUserWishListItemsCount($CI->dx_auth->get_user_id())}
    <div id="wishListData">
        <div class="wish-list-btn tiny-wish-list" {if $countWL == 0}style="display:none;"{/if}>
            <button onclick="location = '{site_url('wishlist')}'">
                <span class="icon_wish_list"></span>
                <span class="text-wish-list f-s_0">
                    <span class="text-el">{lang('Список желаний','newLevel')} </span>
                    <span class="text-el">(</span>
                    <span class="text-el wishListCount">{echo $countWL}</span>
                </span>
                <span class="text-el">)</span>
                </span>
            </button>
        </div>
    </div>
{/if}