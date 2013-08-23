<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">Информация о обновлении</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin"
                   class="t-d_n m-r_15 pjax">
                    <span class="f-s_14">←</span>
                    <span class="t-d_u">{lang('a_back')}</span>
                </a>
                {if $newRelise}
                    <a href="{$BASE_URL}admin/sys_update/update"
                       class="btn btn-small btn-primary pjax">
                        <span class="icon-play"></span>
                        <span class="">Перейти к обновлению</span>
                    </a>
                {/if}
                {if SHOP_INSTALLED}
                    <a href="/admin/sys_update/properties"
                       class="btn btn-small">
                        <span class="icon-wrench"></span>
                        <span>Настройки</span>
                    </a>
                {/if}
            </div>
        </div>
    </div>
    {if $newRelise}
        <form method="post" action="{$BASE_URL}admin/sys_update/update" class="form-horizontal" id="sys_form">
            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                        <th colspan="6">
                            Информация
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd">
                                <div class="control-group">
                                    <label class="control-label">Текущая версия:</label>
                                    <div class="controls">
                                        <label name="{BUILD_ID}">{echo BUILD_ID}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="inside_padd">
                                <div class="control-group">
                                    <label class="control-label">Новая версия:</label>
                                    <div class="controls">
                                        <label name="{$build}">{echo $build}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="inside_padd">
                                <div class="control-group">
                                    <label class="control-label">Дата выпуска:</label>
                                    <div class="controls">
                                        <label name="{$date}">{echo $date}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="inside_padd">
                                <div class="control-group">
                                    <label class="control-label">Размер:</label>
                                    <div class="controls">
                                        <label name="{$size}">{echo $size} мб.</label>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    {else:}
        <div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;">
            Нет файлов восстановления.
        </div>
    {/if}
</section>