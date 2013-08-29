<div class="container">
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>{lang('Template_email_deleting')}</h3>
        </div>
        <div class="modal-body">
            <p>{lang('Delete_selected_templates')}?</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('/admin/components/cp/cmsemail/delete/')" >{lang('Delete')}</a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel')}</a>
        </div>
    </div>

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->

    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Template_list_view')}</span>
            </div>
            <div class="pull-right">
                <span class="help-inline"></span>
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/modules_table" class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('Back')}</span>
                    </a>
                    <a class="btn btn-small pjax" href="{$BASE_URL}admin/components/cp/cmsemail/settings">
                        <i class="icon-wrench"></i>
                        {lang('Settings')}
                    </a>
                    <button type="button"
                            class="btn btn-small btn-danger disabled action_on"
                            onclick="delete_function.deleteFunction()"
                            id="del_sel_property">
                        <i class="icon-trash icon-white"></i>{lang('Delete')}
                    </button>
                    <a class="btn btn-small btn-success pjax" href="/admin/components/cp/cmsemail/create" >
                        <i class="icon-list-alt icon-white"></i>{lang('Create_template')}
                    </a>
                </div>
            </div>
        </div>
        <div class="tab-content">
            {if count($models)>0}
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
                                    <th>{lang('Name')}</th>
                                    <th>{lang('Description')}</th>
                                    <th>{lang('Theme')}</th>
                                    <th>{lang("From")}</th>
                                </tr>
                            </thead>
                            <tbody class="sortable">
                                {foreach $models as $model}
                                    <tr>
                                        <td class="t-a_c">
                                            {if $model.id > 6}
                                                <span class="frame_label">
                                                    <span class="niceCheck b_n">
                                                        <input type="checkbox" name="ids" value="{echo $model.id}"/>
                                                    </span>
                                                </span>
                                            {/if}
                                        </td>
                                        <td>
                                            <a class="pjax" href="/admin/components/cp/cmsemail/edit/{echo $model.id}/#settings">{echo $model.name}</a>
                                        </td>
                                        <td>
                                            <p>{echo $model.description}</p>
                                        </td>
                                        {$settings = unserialize($model.settings)}
                                        <td>{echo $model.theme}</td>
                                        <td>{echo $model.from}</td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </form>
                </div>
            {else:}
                </br>
                <div class="alert alert-info">
                    {lang('Template_list_empty')}
                </div>
            {/if}
        </div>
    </section>
</div>