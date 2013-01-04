<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('a_edit')} {lang('a_privilege')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/rbac/privilegeEdit/{echo $idRole}" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_go_back')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#priv_ed_form" data-action="close" data-submit><i class="icon-ok"></i>{lang('a_save')}</button>
                <button type="button" class="btn btn-small formSubmit" data-form="#priv_ed_form" data-action="exit"><i class="icon-check"></i>{lang('a_save_and_exit')}</button>    

                <div class="dropdown d-i_b">
                    <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                {if $lang_sel == 'en'}{lang('a_english')}{else:}{lang('a_russian')}{/if}
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{$BASE_URL}admin/rbac/translatePrivilege/{echo $idRole}/{if $lang_sel == 'en'}ru{else:}en{/if}">                                   
                {if $lang_sel == 'en'} {lang('a_russian')} {else:} {lang('a_english')} (beta){/if}
            </a>
        </li> 
    </ul>

</div>
</div>
</div>

</div>
<form method="post" action="{$ADMIN_URL}{echo $lang_sel}" class="form-horizontal" id="priv_ed_form">
    <div class="tab-content">
        <div class="tab-pane active" id="params">
            <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th colspan="6">
                            {lang('a_param')}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd span9">                                
                                <div class="control-group">
                                    <label class="control-label" for="Title">{lang('a_desc')}:</label>
                                    <div class="controls">
                                        <input type="text" name="Title" id="Title" value="{echo $model->title}"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="Description">Полное описание:</label>
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