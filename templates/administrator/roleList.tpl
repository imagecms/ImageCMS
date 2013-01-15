<div class="container">

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>{lang('a_rbak_delete_role')}</h3>
        </div>
        <div class="modal-body">
            <p>{lang('a_rbak_del_role_gro')}</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('{$ADMIN_URL}roleDelete')" >{lang('a_delete')}</a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">Отмена</a>
        </div>
    </div>


    <div id="delete_dialog" style="display: none">
        {lang('a_rb_del_roles')}
    </div>
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <form method="post" action="#">
        <section class="mini-layout">
            <div class="frame_title clearfix">
                <div class="pull-left">
                    <span class="help-inline"></span>
                    <span class="title">{lang('a_role_list')}</span>
                </div>
                <div class="pull-right">
                    <div class="d-i_b">
                        <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="delete_function.deleteFunction()" id="del_sel_role"><i class="icon-trash icon-white"></i>{lang('a_delete')}</button>
                        <a class="btn btn-small pjax btn-success" href="/admin/rbac/roleCreate" ><i class="icon-plus-sign icon-white"></i>{lang('a_rbak_new_role')}</a>
                    </div>
                </div>  
            </div>
            <div class="tab-content m-t_20">
                {if count($model)>0}
                    <div class="row-fluid">
                        <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                            <thead>
                                <tr>
                                    <th class="span1">
                                        <span class="frame_label">
                                            <span class="niceCheck b_n">
                                                <input type="checkbox"/>
                                            </span>
                                        </span>
                                    </th>
                                    <th class="span1">{lang('a_id')}</th>
                                    <th>{lang('a_name')}</th>
                                    <th>{lang('a_desc')}</th>                                   
                                </tr>    
                            </thead>
                            <tbody>
                                {foreach $model as $item}
                                    <tr data-id="{echo $item->id}" data-imp={echo $item->importance}>
                                        <td>{if $item->id != 1}
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">
                                                    <input type="checkbox" value="{echo $item->id}" name="ids"/>
                                                </span>
                                            </span>
                                                {/if}
                                        </td>
                                        <td><a class="pjax" href="/admin/rbac/roleEdit/{echo $item->id}">{echo $item->id}</a></td>
                                        <td>
                                            <a class="pjax" href="/admin/rbac/roleEdit/{echo $item->id}">{echo ShopCore::encode($item->alt_name)}</a>
                                        </td>
                                        <td>
                                            {echo $item->description}
                                        </td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                {else:}
                    </br>
                    <div class="alert alert-info">
                        {lang('a_list')} {lang('a_role')} {lang('a_empty')}
                    </div>
                {/if}
            </div>
        </section>
    </form>
</div>