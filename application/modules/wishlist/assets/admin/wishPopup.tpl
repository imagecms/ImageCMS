<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Move item', 'wishlist')}: {echo $fullName}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/cp/wishlist"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('Back', 'admin')}</span>
                    </a>
                    <a class="btn btn-small pjax" href="{$BASE_URL}admin/components/cp/wishlist/settings">
                        <i class="icon-wrench"></i>
                        {lang('Settings', 'wishlist')}
                    </a>
                </div>
            </div>
        </div>
        <div class="row-fluid m-t_15">
            <table class="table  table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th colspan="6">{lang('Lists', 'wishlist')}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd">
                                <form method="post" action="{site_url('/admin/components/cp/wishlist/moveItem/'.$varId . '/' . $wish_list_id)}">
                                    <div id="wishCart" class="active" data-effect-off="fadeOut" data-duration="500" data-elrun="#popupCart" style="top: 922px; left: 571.5px; display: block;">
                                        <div class="fancy fancy_cleaner frame_head_content wishTMP">
                                            <div class="header_title">{lang('Choose Wish List', 'wishlist')}
                                            </div>
                                            <div class="drop-content">
                                                <div class="inside_padd">
                                                    <div class="addWL">
                                                        {foreach $wish_lists as $wish_list}
                                                            <label>
                                                                <input type="radio" name="wishlist" value="{$wish_list.id}" data-id="{$wish_list.id}" style="position: relative;top: 3px;">
                                                                <span class="text-el">{$wish_list.title}</span>
                                                            </label>
                                                        {/foreach}
                                                        <label class="newWishListLable">
                                                            <span class="d_b">
                                                                <input type="radio" checked="checked" name="wishlist"  value="sd" class="newWishList" data-listsCount="{count($wish_lists)}" data-maxListsCount={$max_lists_count} style="position: relative;top: 3px;">
                                                                       <span class="text-el">{lang('Create list', 'wishlist')}</span>
                                                            </span>
                                                            <input type="text"  name="wishListName"  value="" class="wish_list_name m-t_5">
                                                        </label>
                                                        <button type="submit" class="{$class} m-t_15" id="{$varId}">{lang('Move in list', 'wishlist')}</button>
                                                        <input type="hidden" name="user_id" value="{$user_id}"/>
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
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>