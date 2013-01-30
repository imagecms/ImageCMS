<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('a_role_group_list')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="$('.modal').modal();"><i class="icon-trash icon-white"></i>{lang('a_delete')}</button>
                <a class="btn btn-small btn-success pjax" href="/admin/rbac/groupCreate" ><i class="icon-plus-sign icon-white"></i>Создать групу ролей</a>
            </div>
        </div>  
    </div>
    <div class="tab-content">
        {if count($model) > 0}
            <div class="row-fluid">            
                <form method="post" action="#" class="form-horizontal" data-url-delete="/admin/rbac/groupDelete">
                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th class="span1">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox" value="On"/>
                                        </span>
                                    </span>
                                </th>
                                <th class="span1">{lang('a_id')}</th>
                                <th>{lang('a_name')}</th>
                                <th>{lang('a_desc')}</th>
                            </tr>    
                        </thead>
                        <tbody id="rltbl">
                            {foreach $model as $item}
                                <tr>
                                    <td>
                                        <span class="frame_label">
                                            <span class="niceCheck b_n">
                                                <input type="checkbox" value="{echo $item->id}" name="ids"/>
                                            </span>
                                        </span>
                                    </td>
                                    <td>{echo $item->id}</td>
                                    <td>
                                        <a class="pjax" href="/admin/rbac/groupEdit/{echo $item->id}">{echo ShopCore::encode($item->name)}</a>
                                    </td>
                                    <td>
                                        {echo $item->description}
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </form>
            </div>
        {else:}
            </br>
            <div class="alert alert-info">
                {lang('a_list')} {lang('a_group')} {lang('a_privilegy')} {lang('a_empty')}
            </div>
        {/if}
    </div>
</section>
<!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
<div class="modal hide fade modal_del">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Удаление выбраних групп</h3>
    </div>
    <div class="modal-body">
        <p>Удалить группу?</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('{$ADMIN_URL}groupDelete')" >{lang('a_delete')}</a>
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">Отмена</a>
    </div>
</div>


<div id="delete_dialog" style="display: none">
    {lang('a_rb_del_roles')}
</div>
<!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->