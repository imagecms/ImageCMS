<div class="container">
                    <section class="mini-layout">
                        <div class="frame_title clearfix">
                            <div class="pull-left">
                                <span class="help-inline"></span>
                                <span class="title">{lang('Yandex Market management', 'banners')}</span>
                            </div>
                            <div class="pull-right">
                                <div class="d-i_b">

                                    <span style="position: relative">
                                        <a href="#" onclick="$(this).next().slideToggle();
                                                return false" class="btn btn-small">{lang('Template settings', 'banners')}</a>
                                        <div style="position: absolute; display: none; background-color: white; padding: 8px; margin-top: 5px; border-radius: 5px; width: 335px;">
                                            <input {if $show_tpl}checked='checked'{/if}type="checkbox" onclick="chckTplParam(this);" /> {lang('Use different templates for different pages', 'banners')}
                                        </div>
                                    </span>

                                    <a href="/admin/components/init_window/banners/create" class="btn btn-small btn-success pjax"><i class="icon-plus-sign icon-white"></i>{lang('Create a banner', 'banners')}</a>
                                    <button type="button" class="btn btn-small btn-danger disabled action_on" id="banner_del" onclick="DeleteSliderBanner()"><i class="icon-trash icon-white"></i>{lang('Delete', 'banners')}</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="yandexMarket">
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
                                            <div class="inside_padd">
                                                <div class="control-group">
                                                    <label class="control-label">{lang('Displayed categories selection','admin')}:</label>
                                                    {$holder = ShopCore::app()->SSettings->getSelectedCats()}
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
                                                                <input type="checkbox" name="yandex[isAdult]" value="1"{if $isAdult == 1}checked="checked"{/if} id="yandex[isAdult]" />
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
                                                    <a href="{site_url('shop/yandex_market/genreyml')}" target="_blank">{lang('XML document','admin')}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>            
    </section>
</div>
