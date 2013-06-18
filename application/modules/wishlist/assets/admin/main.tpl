<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">Настройка Списков Желания</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/modules_table"
                   class="t-d_n m-r_15 pjax">
                    <span class="f-s_14">←</span>
                    <span class="t-d_u">{lang('a_back')}</span>
                </a>
                <button type="button"
                        class="btn btn-small btn-primary action_on formSubmit"
                        data-form="#wishlist_settings_form"
                        data-action="tomain">
                    <i class="icon-ok"></i>{lang('a_save')}
                </button>
            </div>
        </div>
    </div>
    <form method="post" action="{site_url('admin/components/cp/wishlist/update_settings')}" class="form-horizontal" id="wishlist_settings_form">
        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th colspan="6">
                        Настройка Списков Желания
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">

                            <div class="control-group">
                                <label class="control-label" for="settings[maxItemsCount]">Максимальное количество товаров в Списках Желания</label>
                                <div class="controls">
                                    <input type = "number" name = "settings[maxItemsCount]" class="textbox_short" value="{$settings['maxItemsCount']}" id="maxItemsCount"/>
                                </div>
                            </div>

                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</section>