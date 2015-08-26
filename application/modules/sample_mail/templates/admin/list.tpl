<div class="container">
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Удаление шаблона письма</h3>
        </div>
        <div class="modal-body">
            <p>Удалить выбраные шаблоны?</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('/admin/components/cp/sample_mail/delete/')" >Удалить</a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">Отмена</a>
        </div>
    </div>

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->

    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">Просмотр списка шаблонов</span>
            </div>
            <div class="pull-right">
                <span class="help-inline"></span>
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/modules_table" class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('Back', 'admin')}</span>
                    </a>
                    <button type="button"
                            class="btn btn-small btn-danger disabled action_on"
                            onclick="delete_function.deleteFunction()"
                            id="del_sel_property">
                        <i class="icon-trash"></i>{lang('Delete', 'admin')}
                    </button>
                    <a class="btn btn-small btn-success pjax" href="/admin/components/cp/sample_mail/create" >
                        <i class="icon-plus-sign icon-white"></i>Создать шаблон
                    </a>
                </div>
            </div>
        </div>
        <div class="tab-content">
            {if count($models)>0}
                <div class="row-fluid">
                    <form method="post" action="#" class="form-horizontal">
                        <table class="table  table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th class="t-a_c span1">
                                        <span class="frame_label">
                                            <span class="niceCheck b_n">
                                                <input type="checkbox"/>
                                            </span>
                                        </span>
                                    </th>
                                    <th>Имя</th>
                                    <th>Описание</th>
                                    <th>Тема</th>
                                    <th>От кого</th>
                                </tr>
                            </thead>
                            <tbody class="sortable">
                                {foreach $models as $model}
                                    <tr>
                                        <td class="t-a_c">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">
                                                    <input type="checkbox" name="ids" value="{echo $model.name}"/>
                                                </span>
                                            </span>
                                        </td>
                                        <td>
                                            <a class="pjax" href="/admin/components/cp/sample_mail/edit/{echo $model.name}/{echo $locale}">{echo $model.name}</a>
                                        </td>
                                        <td>
                                            <p>{echo $model.description}</p>
                                        </td>
                                        {$settings = unserialize($model.settings)}
                                        <td>{echo $settings.theme}</td>
                                        <td>{echo $settings.from}</td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </form>
                </div>
            {else:}
                </br>
                <div class="alert alert-info">
                    Список шаблонов пустой
                </div>
            {/if}
        </div>
    </section>
</div>