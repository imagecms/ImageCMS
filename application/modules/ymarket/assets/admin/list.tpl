<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Yandex Market management', 'ymarket')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-form="#settings_form"><i class="icon-ok"></i>{lang('Save','ymarket')}</button>
                </div>
            </div>                            
        </div>
        <form id="settings_form" action="/admin/components/cp/ymarket/save" method="post" class="m-t_10">
            <div class="clearfix">
                <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                    <a href="" onclick="changeAgregator('yandexMarket');" class="btn btn-small active">{lang('Yandex.Market','ymarket')}</a>
                    <a href="" onclick="changeAgregator('priceUa');" class="btn btn-small">{lang('Price.ua','ymarket')}</a>
                </div>
            </div>
                
            <div class="tab-pane" id="yandexMarket">
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang('Settings Yandex.Market','ymarket')}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd" >
                                    <div class="control-group" >
                                        <label class="control-label">{lang('Бренды','ymarket')}:</label>
                                        <div class="controls">
                                            <select name="displayedBrands[]" multiple="multiple" style="width:285px;height:129px;">
                                                {foreach $hold->brands as $brand}
                                                    <option value="{echo $brand['id']}"
                                                            {if @in_array($brand['id'], $hold->ymarket_model['unserBrands'])}
                                                                selected="selected"
                                                            {/if}>
                                                        {echo ShopCore::encode($brand['name'])}
                                                    </option>
                                                {/foreach}
                                            </select>
                                        </div>

                                        <label class="control-label">{lang('Displayed categories selection','ymarket')}:</label>
                                        <div class="controls">
                                            <select name="displayedCats[]" multiple="multiple" style="width:285px;height:129px;">
                                                {foreach $hold->categories as $category}
                                                    <option value="{echo $category->getId()}"
                                                            {if @in_array($category->getId(), $hold->ymarket_model['unserCats'])}
                                                                selected="selected"
                                                            {/if}>
                                                        {str_repeat('-',$category->getLevel())} {echo ShopCore::encode($category->getName())}
                                                    </option>
                                                {/foreach}
                                            </select>
                                        </div>
                                        <div class="controls">
                                            <span class="frame_label no_connection">
                                                <span class="niceCheck b_n">
                                                    <input type="checkbox" name="adult" value="1" {if $hold->ymarket_model['adult'] == 1}checked="checked"{/if} id="yandex[isAdult]" />
                                                </span>
                                                {lang('Adult products','ymarket')}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>                  
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                    <th>{lang('Yandex.Market document','ymarket')}</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="inside_padd">
                                    <div class="control-group">
                                        <a href="{site_url('ymarket')}" target="_blank">{lang('XML document','ymarket')}</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
                                        
                                        
                                        
            {//price.ua}
            <div class="tab-pane" id="priceUa">
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang('Настройки Price.ua','ymarket')}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr> 
                            <td colspan="6">
                                <div class="inside_padd" >
                                    <div class="control-group" >
                                        <label class="control-label">{lang('Бренды','ymarket')}:</label>
                                        <div class="controls">
                                            <select name="displayedBrandsPriceUa[]" multiple="multiple" style="width:285px;height:129px;">
                                                {foreach $hold->brands as $brand}
                                                    <option value="{echo $brand['id']}"
                                                            {if @in_array($brand['id'], $hold->price_ua_model['unserBrands'])}
                                                                selected="selected"
                                                            {/if}>
                                                        {echo ShopCore::encode($brand['name'])}
                                                    </option>
                                                {/foreach}
                                            </select>
                                        </div>

                                        <label class="control-label">{lang('Displayed categories selection','ymarket')}:</label>
                                        <div class="controls">
                                            <select name="displayedCatsPriceUa[]" multiple="multiple" style="width:285px;height:129px;">
                                                {foreach $hold->categories as $category}
                                                    <option value="{echo $category->getId()}"
                                                            {if @in_array($category->getId(), $hold->price_ua_model['unserCats'])}
                                                                selected="selected"
                                                            {/if}>
                                                        {str_repeat('-',$category->getLevel())} {echo ShopCore::encode($category->getName())}
                                                    </option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                    <th>{lang('Price.ua документ','ymarket')}</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="inside_padd">
                                    <div class="control-group">
                                        <a href="{site_url('ymarket/priceua')}" target="_blank">{lang('XML document','ymarket')}</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </section>
</form>                                               
</div>
