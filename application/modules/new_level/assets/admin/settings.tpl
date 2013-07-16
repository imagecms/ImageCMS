{//var_dumps($settings)}
<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">Настройки</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/modules_table"
                   class="t-d_n m-r_15 pjax">
                    <span class="f-s_14">←</span>
                    <span class="t-d_u">{lang('a_back')}</span>
                </a>
                <a href="{$BASE_URL}admin/components/cp/wishlist" class="btn btn-small pjax">
                    {lang(users)}
                </a>
                <button type="button"
                        class="btn btn-small btn-primary action_on formSubmit"
                        data-form="#wishlist_settings_form"
                        data-action="tomain">
                    <i class="icon-ok"></i>Сохранить
                </button>
            </div>
        </div>
    </div>
    <form method="post" action="{site_url('admin/components/cp/next_level/update_settings')}" class="form-horizontal" id="wishlist_settings_form">
        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th colspan="6">
                        Типи свойств
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">
                            <div class="control-group">
                                <label class="control-label" for="settings[propertiesTypes]">{lang(max_user_name_length)}</label>
                                <div class="controls">
                                    <table class="propertyTypes table table-striped table-bordered table-hover table-condensed">
                                        {foreach $settings['propertiesTypes'] as $type}
                                            <tr>
                                                <td>
                                                    <div class="p_r o_h frame_price ">
                                                        <div class="propertyType">{$type}</div>
                                                        <input type="text" name="typeEdit" class="typeEdit" style="display: none"/>
                                                        <button data-update="count" onclick="PropertiesTypes.edit($(this), '{$type}')" class="btn btn-small" type="button" style="display: none;">
                                                            <i class="icon-refresh"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="span1">
                                                    <button class="btn my_btn_s btn-small" type="button" onclick="PropertiesTypes.delete('{$type}', $(this))">
                                                       <i class="icon-trash"></i>
                                                    </button>
                                                </td>
                                                <td class="span1">
                                                    <button class="btn my_btn_s btn-small" type="button">
                                                       <i class="icon-edit"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        {/foreach}
                                         <tr class="addTypeContainer" style="display: none">
                                             <td class="span20" colspan="3">
                                                    <div class="p_r o_h frame_price">
                                                        <input type="text" name="typeAdd" class="typeAdd" style="display: block"/>
                                                        <button data-update="count" onclick="PropertiesTypes.add($(this))" class="btn btn-small" type="button" style="display: inline-block;">
                                                            <i class="icon-plus"></i>
                                                        </button>
                                                    </div>
                                             </td>
                                        </tr>
                                    </table>
                                    <a href="#" class="btn btn-small btn-success addType">
                                        <i class="icon-plus icon-white"></i>&nbsp;Добавить новый тип свойства
                                    </a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        {form_csrf()}
    </form>
</section>