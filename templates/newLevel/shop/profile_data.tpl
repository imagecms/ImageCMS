<div class="inside-padd clearfix">
    <div class="frame-change-profile">
        <div class="horizontal-form">
            <form method="post" id="form_change_info" onsubmit="ImageCMSApi.formAction('/shop/profileapi/changeInfo', '#form_change_info', {literal}{hideForm: false, durationHideForm: 1000}{/literal});
                    return false;">
                <label>
                    <span class="title">{lang('s_c_uoy_name_u')}:</span>
                    <span class="frame-form-field">
                        <input type="text" value="{echo encode($profile->getName())}" name="name"/>
                        <span class="help-block">{lang('s_email_4_sumbls')}</span>
                    </span>
                </label>
                <label>
                    <span class="title">{lang('s_phone')}:</span>
                    <span class="frame-form-field">
                        <input type="text" value="{echo encode($profile->getPhone())}" name="phone"/>
                    </span>
                </label>
                <label>
                    <span class="title">Email:</span>
                    <span class="frame-form-field">
                        <input type="text" disabled="disabled" value="{echo encode($profile->getUserEmail())}" name="email"/>
                        <input type="hidden" value="{echo encode($profile->getUserEmail())}" name="email"/>
                        <span class="help-block">{lang('s_email_is_login')}</span>
                    </span>
                </label>
                {echo ShopCore::app()->CustomFieldsHelper->setRequiredHtml('<span class="must">*</span>')->setPatternMain('pattern_custom_field')->getOneCustomFieldsByName('city','user',$profile->getId())->asHtml()}
                <label>
                    <span class="title">Адрес:</span>
                    <span class="frame-form-field">
                        <input type="text" value="{echo encode($profile->getAddress())}" name="address"/>
                    </span>
                </label>
                <div class="frame-label">
                    <span class="title">&nbsp;</span>
                    <span class="frame-form-field">
                        <span class="btn-form">
                            <input type="submit" value="Сохранить данные"/>
                        </span>
                    </span>
                </div>
                <input type="hidden" name="refresh" value="false"/>
                <input type="hidden" name="redirect" value="false"/>
                {form_csrf()}
            </form>
        </div>
    </div>

    {$discount = $CI->load->module('mod_discount/discount_api')->get_user_discount_api()}







    <div class="layout-highlight info-discount">
        <div class="title-default">
            <div class="title">Скидки пользователя</div>
        </div>
        <div class="content">
            <ul class="items items-info-discount">
                <li class="inside-padd">
                    <div>
                        Куплено товаров на сумму:
                        <span class="price-item">
                            <span class="text-discount">
                                <span class="price">{echo ShopCore::app()->SCurrencyHelper->convert($profile->getamout())}</span>
                                <span class="curr">{$CS}</span>
                            </span>
                        </span>
                    </div>
                    {if $discount['user']}  
                        <div>
                            Ваша текущая скидка пользователя:
                            <span class="price-item">
                                <span class="text-discount">{echo $discount['user'][0]['value']}{if $discount['user'][0]['type_value'] == 1}%{else:}{$CS}{/if}</span>
                            </span>
                        </div>
                    {/if}
                    {if $discount['group_user']}    
                        <div>
                            Ваша текущая скидка групи пользователя:
                            <span class="price-item">
                                <span class="text-discount">{echo $discount['group_user'][0]['value']}{if  $discount['group_user'][0]['type_value'] == 1}%{else:}{$CS}{/if}</span>
                            </span>
                        </div>
                    {/if}

                </li>
                <li class="inside-padd">
                    <div>Для следующей <b>скидки 20%</b> осталось</div>
                    <div>совершить покупок на сумму: <b>3500 грн</b></div>
                </li>
                <li class="inside-padd">
                    <button type="button" class="d_l_1" data-drop=".drop-comulativ-discounts" data-place="noinherit" data-placement="top left" data-overlayopacity= "0">Просмотр таблицы скидок</button>
                </li>
            </ul>
        </div>
    </div>
    {if  $discount['comulativ']}
        <div class="drop-style drop drop-comulativ-discounts">
            <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
            <div class="drop-header">
                <div class="title">Накопительные скидки</div>
            </div>
            <div class="drop-content">
                <div class="inside-padd characteristic">
                    <table class="">
                        <thead>
                            <tr>
                                <th>Процент скидки</th>
                                <th>Сумма покупок от</th>
                                <th>Сумма покупок до</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $discount['comulativ'] as $disc}
                                <tr>
                                    <td class="text-discount">{echo $disc['value']}{if $disc['type_value'] == 1}%{else:}{$CS}{/if}</td>
                                    <td>{echo $disc['begin_value']} {$CS}</td>
                                    <td>{echo $disc['end_value']} {$CS}</td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="drop-footer"></div>
        </div>
    {/if}