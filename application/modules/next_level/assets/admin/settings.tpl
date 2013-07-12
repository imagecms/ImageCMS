{var_dumps($settings)}
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
                        {lang(wish_list_settings)}
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
                                    <input type = "text" name = "settings[propertiesTypes]" class="textbox_short" value="{implode(', ', $settings['propertiesTypes'])}" id="maxListName"/>
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