<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left w-s_n">
            <span class="help-inline"></span>
            <span class="title w-s_n">{echo $form->title}</span>
        </div>
        <div class="pull-right">
            <span class="help-inline"></span>
            <div class="d-i_b">
                <a href="/admin/components/cp/cfcm/index{if $form->type == "group"}#fields_groups{else:}#additional_fields{/if}" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back", 'admin')}</span></a>
                <button type="button" class="btn btn-small action_on formSubmit btn-primary"  data-action="edit" data-form="#{echo $f_id = uniqid()}"><i class="icon-ok icon-white"></i>{if $CI->uri->segment(5) == 'create_field'}{lang("Create", 'admin')}{else:}{lang("Save", 'cfcm')}{/if}</button>
                <button type="button" class="btn btn-small action_on formSubmit btn-default" data-action="close" data-form="#{echo $f_id}"><i class="icon-check"></i>{if $CI->uri->segment(5) == 'create_field'}{lang('Create and exit', 'admin')}{else:}{lang("Save and exit", 'cfcm')}{/if}</button>
            </div>
        </div>                            
    </div>             
    <div>
        <table class="table  table-bordered table-hover table-condensed t-l_a content_big_td">
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

