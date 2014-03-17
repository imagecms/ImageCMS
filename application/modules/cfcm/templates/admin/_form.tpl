<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left w-s_n">
            <span class="help-inline"></span>
            <span class="title w-s_n">{echo $form->title}</span>
        </div>

        <div class="pull-right">
            <span class="help-inline"></span>
            <div class="d-i_b">
                <a href="/admin/components/cp/cfcm/index{if $form->type == "group"}#fields_groups{else:}#additional_fields{/if}" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back", 'cfcm')}</span></a>
                <button type="button" class="btn btn-small action_on formSubmit btn-success" data-action="close" data-form="#{echo $f_id = uniqid()}"><i class="icon-plus-sign icon-white"></i>{lang("Save", 'cfcm')}</button>
            </div>
        </div>                            
    </div>             
    <div>
        <table class="table table-striped table-bordered table-hover table-condensed t-l_a">
            <thead>
                <tr>
                    <th colspan="6">
                        {lang("Information", 'cfcm')}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd span9">
                            <form action="{echo $form->action}" method="post" id="{$f_id}" class="form-horizontal">
                                {foreach $form->asArray() as $f}
                                    <div class="control-group">
                                        <label class="control-label">
                                            {$f.label}
                                        </label>
                                        <div class="controls">
                                            {$f.field}
                                            {$f.help_text}
                                        </div>
                                    </div>
                                {/foreach}
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

