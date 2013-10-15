<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Permission to edit', 'documentation')}</span>
        </div>

        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/init_window/documentation" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back', 'admin')}</span></a>
                <button type="button"
                        class="btn btn-small btn-success action_on formSubmit"
                        data-form="#doc_roles_settings"
                        data-action="save">
                    <i class="icon-ok icon-white"></i>{lang('Save', 'admin')}
                </button>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <form action="{$BASE_URL}admin/components/cp/documentation/saveSettings" method="POST" id="doc_roles_settings">
            <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th class="span1">
                            <span class="frame_label">
                                <span class="niceCheck" style="background-position: -46px 0px;">
                                    <input type="checkbox">
                                </span>
                            </span>
                        </th>
                        <th class="span1">ID</th>
                        <th>Имя</th>
                        <th>Описание</th>                                   
                    </tr>    
                </thead>
                <tbody>

                    {if count($roles) > 0}
                        {foreach $roles as $role}
                            <tr>
                                <td>                                            
                                    <span class="frame_label role_checkbox {if $role.edit == '1'}active{/if}" data-id="{$role.id}">
                                        <span class="niceCheck" style="background-position: -46px 0px;">
                                            <input type="checkbox" name="ids[]"{if $role.edit == '1'}checked="checked"{/if} value="{$role.id}">
                                        </span>
                                    </span>
                                </td>
                                <td>{$role.id}</td>
                                <td>
                                    <a class="pjax" href="/admin/rbac/roleEdit/{$role.id}">{$role.alt_name}</a>
                                </td>
                                <td>
                                    {$role.description}                                       
                                </td>
                            </tr>
                        {/foreach}
                    {else:}
                        <tr>
                            <td colspan="4"> {lang("No roles", "admin")}</td>
                        </tr>
                    {/if}

                </tbody>

            </table>
            {form_csrf()}
        </form>

    </div>
</section>