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
                <label>
                    <span class="title">Город:</span>
                    <span class="frame-form-field">
                        <input type="text" value="{echo encode($profile->getAddress())}" name="address"/>
                    </span>
                </label>
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
                {form_csrf()}
            </form>
        </div>
    </div>
    {$discount = ShopCore::app()->SDiscountsManager->getActive();}
    {if $discount['0']!=null && $discount['0']->getDiscount() != null}
        <div class="layout-highlight info-discount">
            <div class="title-default">
                <div class="title">Накопительная скидка</div>
            </div>
            <div class="content">
                <ul class="items items-info-discount">
                    <li class="inside-padd">
                        <div>
                            Куплено товаров на сумму:
                            <span class="price-item">
                                <span class="text-discount">
                                    <span class="price"></span>
                                    <span class="curr">{$CS}</span>
                                </span>
                            </span>
                        </div>
                        <div>
                            Ваша текущая скидка:
                            <span class="price-item">
                                <span class="text-discount">{echo $discount['0']->getDiscount()}%</span>
                            </span>
                        </div>
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
    {/if}
</div>
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
                    <tr>
                        <td class="text-discount">11%</td>
                        <td>415 {$CS}</td>
                        <td>425 {$CS}</td>
                    </tr>
                    <tr>
                        <td class="text-discount">11%</td>
                        <td>415 {$CS}</td>
                        <td>425 {$CS}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>