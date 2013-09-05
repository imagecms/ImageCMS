<div class="container">
    <div class="row">
        <div class="span9 item_tovar">
            <h1>{lang('s_private_office')}</h1>
            <!-- Start errors block -->
            <div  class="msg_form_edit">
                {if $errors}
                    <div class="msg_form_edit_prof">
                        {echo $errors}
                    </div>
                {/if}
            </div>
            <!-- End errors block -->
            <!-- Start tabs block -->
            <ul class="tabs clearfix">
                <li>
                    <button type="button" data-href="#my_data">
                        <span class="icon-mydata"></span>
                        <span class="text-el">{lang('s_profile_me')}</span>
                    </button>
                </li>
                <li>
                    <button type="button" data-href="#change_pass">
                        <span class="icon-chgpass"></span>
                        <span class="text-el">{lang('s_profile_me_change_password')}</span>
                    </button>
                </li>
                <li>
                    <button type="button" data-href="#history_order">
                        <span class="icon-historyorder"></span>
                        <span class="text-el">{lang('s_order_history')}</span>
                    </button>
                </li>
            </ul>
            <!-- End tabs block -->
            <!-- Start user tab block -->
            <div class="frame_tabs">
                <div id="my_data">
                    <div class="standart_form horizontal_form">
                        <form method="post" id="form_change_info" onsubmit="ImageCMSApi.formAction('/shop/profileapi/changeInfo', 'form_change_info');
                                return false;">
                            <label>
                                <span class="title">{lang('s_c_uoy_name_u')}:</span>
                                <span class="row">
                                    <span class="frame_form_field">
                                        <input type="text" value="{echo encode($profile->getName())}" name="name"/>
                                        <label id="for_name" class="for_validations"></label>
                                        <span class="help_inline">{lang('s_email_4_sumbls')}</span>
                                    </span>
                                </span>
                            </label>
                            <label>
                                <span class="title">{lang('s_c_uoy_user_el')}:</span>
                                <span class="frame_form_field">
                                    <input type="text" disabled="disabled" value="{echo encode($profile->getUserEmail())}" name="email"/>
                                    <input type="hidden" value="{echo encode($profile->getUserEmail())}" name="email"/>
                                    <span class="help_inline">{lang('s_email_is_login')}</span>
                                    <label id="for_email" class="for_validations"></label>
                                </span>
                            </label>
                            <label>
                                <span class="title">{lang('s_phone')}:</span>
                                <span class="frame_form_field">
                                    <input type="text" value="{echo encode($profile->getPhone())}" name="phone"/>
                                    <label id="for_phone" class="for_validations"></label>
                                </span>
                            </label>
                            <label>
                                <span class="title">{lang('s_profile_me_address')}:</span>
                                <span class="frame_form_field">
                                    <input type="text" value="{echo encode($profile->getAddress())}" name="address"/>
                                    <label id="for_address" class="for_validations"></label>
                                </span>
                            </label>
                            {/*}
                            {if $profile->getdiscount()}
                                <label>
                                    <span class="title">Скидка:</span>
                                    <span class="frame_form_field">
                                        <input disabled="disabled" type="text" value="{echo encode($profile->getdiscount())}%" name="address"/>

                                    </span>
                                </label>
                            {/if} 
                            { */}
                            {echo ShopCore::app()->CustomFieldsHelper->setPatternMain('pattern_custom_field')->getCustomFields('user', $profile->getId())->asHtml()}
                            <div class="frameLabel">
                                <span class="title">&nbsp;</span>
                                <span class="frame_form_field">
                                    <input type="submit" value="{lang('s_edit')}" class="btn"/>
                                </span>
                            </div>
                                
                            
                            {form_csrf()}
                        </form>
                    </div>
                </div>
                <!-- End user tab block -->
                <!-- Start registration data tab block -->
                <div id="change_pass">
                    <div class="standart_form horizontal_form">
                        <form method="post" id="form_change_pass">
                            <label>
                                <span class="title">{lang('lang_old_password')}:</span>
                                <span class="frame_form_field">
                                    <input type="password" name="old_password"/>
                                    <label id="for_old_password" class="for_validations"></label>
                                </span>
                            </label>
                            <label>
                                <span class="title">{lang('lang_new_password')}:</span>
                                <span class="frame_form_field">
                                    <input type="password" name="new_password"/>
                                    <label id="for_new_password" class="for_validations"></label>
                                </span>
                            </label>
                            <label>
                                <span class="title">{lang('s_newpassword')}:</span>
                                <span class="frame_form_field">
                                    <input type="password" name="confirm_new_password"/>
                                    <label id="for_confirm_new_password" class="for_validations"></label>
                                </span>
                            </label>
                            <div class="frameLabel">
                                <span class="title">&nbsp;</span>
                                <span class="frame_form_field">
                                    <input type="submit" value="{lang('s_save')}" class="btn" onclick="ImageCMSApi.formAction('/auth/authapi/change_password', 'form_change_pass');
                                return false;"/>
                                </span>
                            </div>
                            {form_csrf()}
                        </form>
                    </div>
                </div>
                <!-- End registration data tab block -->
                <!-- Start orders history tab block -->
                <div id="history_order">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>{lang('s_order_date')}</th>
                                <th>{lang('s_refresh')}</th>
                                <th>{lang('s_summ')}</th>
                                <th>{lang('s_status')}</th>
                                <th>{lang('s_pay')}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                {foreach $orders as $order}
                                    <td><a rel="nofollow" href="{shop_url('cart/view/' . $order->getKey())}">{lang('s_order')} №{echo $order->getId()}</a></td>
                                    <td>{date("d-m-Y H:i", $order->getDateCreated())}</td>
                                    <td>{date("d-m-Y H:i", $order->getDateUpdated())}</td>
                                    <td>{echo $order->getTotalPrice()} {$CS}</td>
                                    <td>{echo $order->getSOrderStatuses()->getName()}</td>
                                    <td>
                                        {if $order->getPaid()}
                                            <span class="icon-paid"></span> 
                                        {else:} 
                                            <span class="icon-paid_not"></span> 
                                        {/if}
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
                <!-- End orders history tab block -->
            </div>
                        
           {//$CI->load->module('mod_discount/discount_api')->get_user_discount_api(1)}             
        </div>
    </div>
</div>