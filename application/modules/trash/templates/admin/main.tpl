<div class="container">
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Удаление ссылок редиректа</h3>
        </div>
        <div class="modal-body">
            <p>Удалить ссылки?</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('/admin/components/init_window/trash/delete_trash/')">{lang('a_delete')}</a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('a_footer_cancel')}</a>
        </div>
    </div>
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">Редиректы</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/components/modules_table" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                </div>
                <div class="d-i_b">
                    <a href="/admin/components/init_window/trash/create_trash/" class="btn btn-small btn-success pjax"><i class="icon-plus-sign icon-white"></i>Создать редирект</a>
                    <button type="button" class="btn btn-small btn-danger disabled action_on" id="trash_del" onclick="delete_function.deleteFunction()"><i class="icon-trash icon-white"></i>{lang('a_delete')}</button>
                </div>
            </div>                            
        </div>

        <div class="row-fluid">
            <form method="post" action="#" class="form-horizontal">
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th class="span1 t-a_c">
                                <span class="frame_label">
                                    <span class="niceCheck b_n">
                                        <input type="checkbox"/>
                                    </span>
                                </span>
                            </th>
                            <th>Старый URL</th>
                            <th>Тип редиректа</th>
                            <th>Вид редиректа</th>
                            <th>Редирект</th>
                        </tr>    
                    </thead>
                    <tbody class="sortable">
                        {foreach $model as $item}
                            <tr>
                                <td class="t-a_c">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox" name="ids" value="{echo $item->id}"/>
                                        </span>
                                    </span>
                                </td>
                                <td>
                                    <a class="pjax" href="/admin/components/init_window/trash/edit_trash/{echo $item->id}" data-rel="tooltip" data-title="{lang('a_edit')}">{echo $item->trash_url}</a>
                                </td>
                                <td>
                                    <label>{echo $item->trash_redirect_type}</label>
                                </td>
                                <td>
                                    <label>{echo $item->trash_type}</label>
                                </td>
                                <td>
                                    <a href="{echo $item->trash_redirect}" target="_blank">{echo $item->trash_redirect}</a>
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </form>
    </section>
</div>
