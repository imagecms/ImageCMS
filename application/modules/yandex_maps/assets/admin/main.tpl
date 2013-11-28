<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">Настройки адресов</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/modules_table"
                   class="t-d_n m-r_15 pjax">
                    <span class="f-s_14">←</span>
                    <span class="t-d_u">Вернуться</span>
                </a>
                <button type="button"
                        class="btn btn-small btn-primary action_on formSubmit"
                        data-form="#yandex_maps_settings_form"
                        data-action="tomain">
                    <i class="icon-ok"></i>Сохранить
                </button>
            </div>
        </div>
    </div>
    <form method="post" action="{site_url('admin/components/cp/yandex_maps/update_adr')}" class="form-horizontal" id="yandex_maps_settings_form">
       
        {form_csrf()}
    </form>
</section>