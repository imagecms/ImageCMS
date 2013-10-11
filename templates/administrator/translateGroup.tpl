<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Roles group edit","admin")}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/rbac/groupEdit/{echo $id}" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Return','admin')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#group_ed_form" data-action="tomain" data-submit><i class="icon-ok"></i>{lang("Save","admin")}</button>                
                <button type="button" class="btn btn-small formSubmit" data-form="#group_ed_form" data-action="toedit"><i class="icon-check"></i>{lang('Save and exit','admin')}</button>

                <div class="dropdown d-i_b">
                    <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                {if $lang_sel == 'en'}{lang("English","admin")}{else:}{lang("Russian","admin")}{/if}
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{$BASE_URL}admin/rbac/translateGroup/{echo $id}/{if $lang_sel == 'en'}ru{else:}en{/if}">                                   
                {if $lang_sel == 'en'} {lang("Russian","admin")} {else:} {lang("English","admin")} (beta){/if}
            </a>
        </li> 
    </ul>

</div>
</div>
</div>

</div>  
<form method="post" action="{$ADMIN_URL}{echo $lang_sel}" class="form-horizontal" id="group_ed_form">
    <div class="tab-content">
        <div class="tab-pane active" id="params">
            <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th colspan="6">
                            {lang("Properties","admin")}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd span9">
                                <div class="control-group">
                                    <label class="control-label" for="Description">{lang("Description","admin")}:</label>
                                    <div class="controls">
                                        <input type="text" name="Description" id="Description" value="{echo $model->description}"/>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
    {form_csrf()}
</form>
</section>