{# Variables
# @var items
# @var capImage
# @var profile
#}


<h5>Список пожеланий {if $items}({count($items)}){/if}</h5>
<div class="spLine"></div>

{if !$items}
    {echo ShopCore::t('Список пожеланий пуст')}
    {return}
{/if}

{if $CI->session->flashdata('makeWish') === true}
    <div style="padding:10px;background-color:#f5f5dc;">
        Ваше пожелание отправлено адресату на e-mail.
    </div>
    {/if}

<form action="{shop_url('wish_list')}" method="post" name="wishListForm">
<input type="hidden" name="recount" value="1">
{form_csrf()}
<table class="wishListTable" width="100%">
    <thead align="left">
        <th>{echo ShopCore::t('Фото')}</th>
        <th>{echo ShopCore::t('Название')}</th>
        <th>{echo ShopCore::t('Цена')}</th>
        <th class="admin"></th>
    </thead>
    <tbody>
    {foreach $items as $key=>$item}
        <tr>
            <td style="width:90px;padding:2px;">
                <div style="width:90px;height:90px;overflow:hidden;">
                {if $item.model->getMainImage()}
                    <img src="{productImageUrl($item.model->getId() . '_main.jpg')}" border="0" alt="image" width="90" />
                {/if}
                </div>
            </td>
            <td>
                <a href="{shop_url('product/' . $item.model->getUrl())}">{echo ShopCore::encode($item.model->getName())}</a> {$item.variantName}
            </td>
            <td>{echo ShopCore::app()->SCurrencyHelper->convert($item.price)} {$CS}</td>
            <td><a href="{shop_url('wish_list/delete/' . $key)}" class="delete">X</a></td>
        </tr>
    {/foreach}
    </tbody>
    <tfoot>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tfoot>
</table>
</form>

<div id="total">
    <span class="value" id="totalPriceText">
        {echo ShopCore::app()->SWishList->totalPrice()} {$CS}
    </span>
    <span class="label">
        {echo ShopCore::t('Итог')}
    </span>
</div>
    
{if ShopCore::$ci->dx_auth->is_logged_in()}
<div class="sp"></div>
<h5>Отправить пожелание</h5>

{if $errors}
    <div class="spLine"></div>
    <div class="errors">
        {$errors}
    </div>
{/if}

<div class="spLine"></div><br/>
<div style="margin-left:20px;">
    <form action="{shop_url('wish_list')}" method="post" name="wishForm">
    <input type="hidden" name="makeWish" value="1">
        <div class="fieldName">Ваше имя, фамилия:</div>
        <div class="field">
            <input type="text" class="input" name="userInfo[fullName]" value="{$profile.name}">
        </div>
        <div class="clear"></div>

        <div class="fieldName">Отправить на Email:</div>
        <div class="field">
            <input type="text" class="input" name="userInfo[email]">
        </div>
        <div class="clear"></div>

        <div class="fieldName">Ваш Телефон:</div>
        <div class="field">
            <input type="text" class="input" name="userInfo[phone]" value="{$profile.phone}">
        </div>
        <div class="clear"></div>

        <div class="fieldName">Комментарий к пожеланию:</div>
        <div class="field">
            <textarea name="userInfo[commentText]" class="input" rows="6"></textarea> 
        </div>
        <div class="clear"></div>
        
        <div class="fieldName">{lang('lang_captcha')}</div>
        <div class="field">        
            <input type="text" name="captcha" id="captcha" />  <span style="color:red;">*</span>
        </div>
        {$capImage}
        
        <div id="buttons">
            <a href="#" id="sendwish" onClick="document.wishForm.submit();">{echo ShopCore::t('Отправить пожелание')}</a>
        </div>
        {form_csrf()}
    </form>
</div>
{else:}
    Только зарегестрированные пользователи могут делится вишлистом!
{/if}
