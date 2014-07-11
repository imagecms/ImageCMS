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
        <form id="settings_form" action="/admin/components/cp/ymarket/save" method="post">
            <table class="table table-striped table-bordered table-hover table-condensed t-l_a">
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
            <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
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
        </form>
    </section>
</form>                                               
</div>


