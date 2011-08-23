{$sProfile['name'] = ''}
{$sProfile['phone'] = ''} 
{if ShopCore::$ci->dx_auth->is_logged_in() === true}
    {$sUserProfile = SUserProfileQuery::create()->filterByUserId(ShopCore::$ci->dx_auth->get_user_id())->findOne()}
    {if $sUserProfile}
        {$sProfile['name'] = $sUserProfile->getName()}
        {$sProfile['phone'] = $sUserProfile->getPhone()}
    {/if}       
{/if} 
<div align="right">
    <div id="callback-dialog-form" title="Call Back" style="height: 575px;display: none;">
            <p class="validateTips" style="color: #d2691e;"></p>
            <form>
            <fieldset>
                    <label for="topic">Тема:</label>
                    <select type="text" name="theme" id="callback-dialog-theme" value="" class="text ui-widget-content ui-corner-all">
                        {foreach SCallbackThemesQuery::create()->orderByPosition()->find() as $theme}
                            <option value="{echo $theme->getId()}">{echo encode($theme->getText())}</option>
                        {/foreach}
                    </select>
                    <label for="name">Ваше имя:</label>
                    <input type="text" name="name" id="callback-dialog-name" class="text ui-widget-content ui-corner-all" value="{echo $sProfile['name']}"/>
                    <label for="phone">Мобильный телефон:</label>
                    <input type="text" name="phone" id="callback-dialog-phone" class="text ui-widget-content ui-corner-all" value="{echo $sProfile['phone']}" />
                    <label for="comment">Дополнительная информация:</label>
                    <textarea name="comment" id="callback-dialog-comment" class="text ui-widget-content ui-corner-all" style="min-width: 95%;height: 75px;"></textarea>
            </fieldset>
            </form>
    </div>
   </div>
    
<div class="sp"></div>