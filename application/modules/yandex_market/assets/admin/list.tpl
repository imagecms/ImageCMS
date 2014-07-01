<div class="container">
                    <section class="mini-layout">
                        <div class="frame_title clearfix">
                            <div class="pull-left">
                                <span class="help-inline"></span>
                                <span class="title">{lang('Yandex Market management', 'banners')}</span>
                            </div>
                            <div class="pull-right">
                                <div class="d-i_b">
                                    <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-form="#settings_form"><i class="icon-ok"></i>{lang('Save','admin')}</button>
                                        {echo create_language_select(ShopCore::$ci->cms_admin->get_langs(true), $locale, "/admin/components/run/shop/settings/index")}
                                </div>
                            </div>                            
                        </div>
                           <form id="settings_form" action="/admin/components/cp/yandex_market/update" method="post">
                            <table class="table table-striped table-bordered table-hover table-condensed t-l_a">
                                <thead>
                                    <tr>
                                        <th colspan="6">
                                            {lang('Settings Yandex.Market','admin')}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="6">
                                            <div class="inside_padd" >
                                                <div class="control-group" >
                                                    <label class="control-label">{lang('Displayed categories selection','admin')}:</label>
                                                    {$hold = new Admin()}
                                                    {$holder = $hold->getSelectedCats()}
                                                    {$categories = ShopCore::app()->SCategoryTree->getTree()}
                                                    <div class="controls">
                                                        <select name="displayedCats[]" multiple="multiple" style="width:285px;height:129px;">
                                                            {foreach $categories as $category}
                                                                <option value="{echo $category->getId()}"{if @in_array($category->getId(), $holder)}selected="selected"{/if}>
                                                                    {str_repeat('-',$category->getLevel())} {echo ShopCore::encode($category->getName())}
                                                                </option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                    <div class="controls">
                                                        <span class="frame_label no_connection">
                                                            <span class="niceCheck b_n">
                                                                {$adult = new Admin()}
                                                                {$isAdult = $adult->IsAdult()} 
                                                                <input type="checkbox" name="yandex[isAdult]" value="1"{if $isAdult['value'] == 1}checked="checked"{/if} id="yandex[isAdult]" />
                                                            </span>
                                                            {lang('Adult products','admin')}
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                                <thead>
                                <th>{lang('Yandex.Market document','admin')}</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="inside_padd">
                                                <div class="control-group">
                                                    <a href="{site_url('yandex_market/genreyml')}" target="_blank">{lang('XML document','admin')}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </form>
    </section>
                                                
</form>                                               
</div>
                                                    

