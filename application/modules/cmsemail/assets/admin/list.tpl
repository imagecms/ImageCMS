<div class="container">
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>{lang('Template email deleting', 'cmsemail')}</h3>
        </div>
        <div class="modal-body">
            <p>{lang('Delete selected templates', 'cmsemail')}?</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('/admin/components/cp/cmsemail/delete/')" >{lang('Delete', 'cmsemail')}</a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel', 'cmsemail')}</a>
        </div>
    </div>

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->

    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Email-notifications managing', 'cmsemail')}</span>
            </div>
            <div class="pull-right">
                <span class="help-inline"></span>
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/modules_table" class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('Back', 'cmsemail')}</span>
                    </a>
                    <a class="btn btn-small pjax" href="{$BASE_URL}admin/components/cp/cmsemail/settings">
                        <i class="icon-wrench"></i>
                        {lang('Settings', 'cmsemail')}
                    </a>
                    <button type="button"
                            class="btn btn-small btn-danger disabled action_on"
                            onclick="delete_function.deleteFunction()"
                            id="del_sel_property">
                        <i class="icon-trash"></i>{lang('Delete', 'cmsemail')}
                    </button>
                    <a class="btn btn-small btn-success pjax" href="/admin/components/cp/cmsemail/create" >
                        <i class="icon-plus-sign icon-white"></i>{lang('Create template', 'cmsemail')}
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
                                    <th>{lang('Name', 'cmsemail')}</th>
                                    <th>{lang('Template variable', 'cmsemail')}</th>
                                    <th>{lang('Theme', 'cmsemail')}</th>
                                    <th>{lang("From", 'cmsemail')}</th>
                                </tr>
                            </thead>
                            <tbody class="sortable">
                                {foreach $models as $model}
                                    <tr>
                                        <td class="t-a_c">
                                            {if $model.id > 7}
                                                <span class="frame_label">
                                                    <span class="niceCheck b_n">
                                                        <input type="checkbox" name="ids" value="{echo $model.id}"/>
                                                    </span>
                                                </span>
                                            {/if}
                                        </td>
                                        <td>
                                            <p>{echo $model.description}</p>
                                        </td>
                                        <td>
                                            <a class="pjax" href="/admin/components/cp/cmsemail/edit/{echo $model.id}/#settings">{echo $model.name}</a>
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
                    {lang('Templates list empty', 'cmsemail')}
                </div>
            {/if}
        </div>
    </section>
</div>