<div class="main_body">
    <div class="content">
        <div class="center">
            <h1>{lang('s_private_office')}</h1>
            <div  class="msg_form_edit">
                {if $errors}
                    <div class="msg_form_edit_prof">
                        {echo $errors}
                    </div>
                {/if}</div>
            <div class="personal_info f_l">
                <div class="block_title_18"><span class="title_18">{lang('s_profile_me')}</span></div>
                <ul>
                    <li>
                        <span>{lang('s_c_uoy_name_u')}:</span>
                        <b>{echo encode($profile->getName())}</b>
                    </li>
                    <li>
                        <span>{lang('s_c_uoy_user_el')}:</span>
                        <b>{echo encode($profile->getUserEmail())}</b>
                    </li>
                    <li>
                        <span>{lang('s_phone')}:</span>
                        <b>{echo encode($profile->getPhone())}</b>
                    </li>
                    <li>
                        <span>{lang('s_profile_me_address')}:</span>
                        <b>{echo encode($profile->getAddress())}</b>
                    </li>
                </ul>
                    
                <a href="{shop_url('/cart')}" class="f_r w-s_n-w">{lang('s_profile_me_bascket')}</a>
                <a href="{shop_url('wish_list')}"  style="margin-right:9px;" class="f_l w-s_n-w" >{lang('s_profile_me_change_view_wishlist')}</a><br />
                <a href="#" class="f_r w-s_n-w" id="user_form">{lang('s_edit_personal_information')}</a>
                <a href="#" class="f_l w-s_n-w" id="change_password">{lang('s_profile_me_change_password')}</a>


                <div class="fancy c_b" style="border: none; display: none;" id="change_password_fields">
                    <form action="{shop_url('profile')}" method="post" name="editFormpass" style="padding-left: 0;">
                        <div id="change_info_edit">
                            <h3>{lang('s_profile_me_change_password')}</h3>
                            <label>{lang('lang_old_password')}:
                                <input type="password" class="required" name="old_password">
                            </label>
                            <label> {lang('lang_new_password')}:
                                <input type="password" class="required" name="password">
                            </label>
                            <label>{lang('s_newpassword')}:
                                <input type="password" class="required" name="confirm_new_password">
                            </label>

                            <div id="buttons">
                                <div class="p-t_19 c_b clearfix" style="width: 191px;">
                                    <div class="buttons button_middle_blue f_r">
                                        <input type="hidden" value="1" name="cangePassword" />
                                        <a href="#" id="checkout" onClick="document.editFormpass.submit();">{echo ShopCore::t(lang('s_save'))}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {form_csrf()}
                    </form>
                </div>

                <div class="fancy c_b" style="border: none; display: none;" id="change_user_fields">
                    <form action="{shop_url('profile')}" method="post" name="editForm" style="padding-left: 0;">
                        <div id="change_info_edit">

                            <h3>{lang('s_edit_personal_information')}</h3>
                            <label>{lang('s_name_and_surname')}:
                                <input type="text" class="required" value="{echo encode($profile->getName())}" name="name"/>
                            </label>
                            <label>{lang('s_email')}:
                                <input type="text" class="required" value="{echo encode($profile->getUserEmail())}" name="email"/>
                            </label>                          
                            <label>{lang('s_address')} {lang('s_delivery')}:
                                <input type="text" class="required" value="{echo encode($profile->getAddress())}" name="address"/>
                            </label>
                            <label> {lang('s_phone')}:
                                <input type="text" class="required" value="{echo encode($profile->getPhone())}" name="phone"/>
                            </label>

                            <div id="buttons">
                                <div class="p-t_19 c_b clearfix"  style="width: 191px;">
                                    <div class="buttons button_middle_blue f_r">
                                        <input type="hidden" value="1" name="changeName"/>
                                        <input type="submit" id="checkout"  value="{lang('s_save')}"/>
                                    </div>
                                </div>
                            </div>                                    
                        </div>
                        {form_csrf()}
                </div>
                </form>
            </div> 

            <div class="history_order f_r">
                <div class="block_title_18"><span class="title_18">{lang('s_order_history')}</span></div>

                {lang('s_in_p')} {lang('s_cart_p')}:
                <span style="font-weight: bold;">
                    {echo ShopCore::app()->SCart->totalItems()}
                    {echo SStringHelper::Pluralize(ShopCore::app()->SCart->totalItems(), array(lang('s_product_o'), lang('s_product_t'), lang('s_product_tr')))}
                </span>
                <table cellspacing="0">
                    <colgroup>
                        <col span="1" width="79">
                        <col span="1" width="88">
                        <col span="1" width="70">
                        <col span="1" width="119">
                        <col span="1" width="119">
                        <col span="1" width="89">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>{lang('s_pay')}</th>
                            <th>{lang('s_status')}</th>
                            <th>{lang('s_create')}</th>
                            <th>{lang('s_refresh')}</th>
                            <th>{lang('s_summ')}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            {foreach $orders as $order}
                                <td><a rel="nofollow" href="{shop_url('cart/view/' . $order->getKey())}">{echo $order->getId()}</a></td>
                                <td>{if $order->getPaid()}{lang('s_yes')} {else:} {lang('s_no')} {/if}</td>
                                <td>{echo SOrders::getStatusName('Id', $order->getStatus())}</td>
                                <td>{date("d-m-Y H:i", $order->getDateCreated())}</td>
                                <td>{date("d-m-Y H:i", $order->getDateUpdated())}</td>
                                <td>{echo ShopCore::app()->SCurrencyHelper->convert($order->getTotalPrice())} {$CS}</td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>

            <div class="history_order f_r">
                <div class="block_title_18"><span class="title_18">{lang('s_to_fal_do')}</span></div>

                {lang('s_to_fal_mo_ti')}:
                <span style="font-weight: bold;">
                    {echo count($goodsinspy)}
                </span>
                {if count($goodsinspy)>0}
                    <table cellspacing="0">
                        <colgroup>
                            <col span="1" width="100">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>{lang('s_to_falitem_number')}</th>
                                <th style="width:300px;">{lang('s_to_falo_product_name')}</th>
                                <th style="width:100px;">Разница</th>
                                <th style="width:100px;">Разница в процентах</th>
                                <th style="width:100px;">Отписатся</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $goodsinspy as $good}
                                {$product = $good->getProduct()}
                                <tr>
                                    <td>{echo $product[0]->getId()}</td>
                                    <td><a href="{$BASE_URL}shop/product/{echo $product[0]->getId()}">{echo $product[0]->getName()}</td>
                                    <td>
                                        {echo $good->getdist()}
                                    </td>
                                    <td>
                                        {echo $good->getpercentdist()}
                                    </td>
                                    <td>
                                        <a href="{echo $good->getLink()}">Отписатся</a>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                {/if}
            </div>
        </div>
        <div class="center">
        </div>
    </div></div>



{literal}
    <script>
        $("#change_password").click(function () {
            $("#change_password_fields").slideToggle();
            $("#change_user_fields").hide();
        });

        $("#user_form").click(function () {
            $("#change_password_fields").hide();
            $("#change_user_fields").slideToggle();
        });
    </script>
{/literal}


