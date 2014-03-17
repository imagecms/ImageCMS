<div class="container">
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Удалить розсилку</h3>
        </div>
        <div class="modal-body">
            <p>Удалить розсилку</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary pjax" onclick="delete_function.deleteFunctionConfirm('/admin/components/init_window/mail_chimp/delete/')">Удалить</a>
            <a href="#" class="btn pjax" onclick="$('.modal').modal('hide');">Отмена</a>
        </div>
    </div>
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">MailChimp</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/components/modules_table" class="t-d_n m-r_15">
                        <span class="f-s_14">←</span> 
                        <span class="t-d_u">назад</span>
                    </a>
                </div>
                <div class="d-i_b">
                    <a class="btn btn-small pjax" href="/admin/components/init_window/mail_chimp/create_campain">
                        <i class="icon-plus-sign"></i>
                        Создать розсилку
                    </a>
                    <button type="button" class="btn btn-small btn-danger disabled action_on" id="trash_del" onclick="delete_function.deleteFunction()">
                        <i class="icon-trash icon-white"></i>
                        Удалить
                    </button>
                </div>
            </div>                            
        </div>
        <div class="row-fluid">
            <form method="post" action="/admin/components/init_window/mail_chimp/create/" class="form-horizontal" id="mail_form">
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th class="t-a_c span1">
                                <span class="frame_label">
                                    <span class="niceCheck b_n">
                                        <input type="checkbox"/>
                                    </span>
                                </span>
                            </th>
                            <th>Назва</th>
                            <th>Автор</th>
                            <th>Создан</th>
                            <th>Отправить</th>
                        </tr>    
                    </thead>
                    <tbody class="">
                        {foreach $model['data'] as $data}
                            <tr>
                                <td class="t-a_c">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox" name="ids" value="{echo $data['id']}"/>
                                        </span>
                                    </span>
                                </td>
                                <td>
                                    <a class="pjax" 
                                       href="/admin/components/init_window/mail_chimp/edit_campain/{echo $data['id']}" 
                                       data-rel="tooltip" 
                                       data-title="{lang("Edit", 'mail_chimp')}">
                                        {echo $data['title']}
                                    </a>
                                </td>
                                <td>
                                    <label>{echo $data['content_edited_by']}</label>
                                </td>
                                <td>
                                    <label>{echo $data['create_time']}</label>
                                </td>
                                <td>
                                    {if $data['send_time']}
                                        <label>{lang("Sendet", 'mail_chimp')}</label>
                                    {else:}
                                        <button class="btn btn-success pjax" onclick="send('{echo $data['id']}')">Отправить</button>
                                    {/if}
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </form>
        </div>
    </section>
</div>
