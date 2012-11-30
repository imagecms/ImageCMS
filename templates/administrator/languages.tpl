<div class="container">

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>{lang('a_language_delete')}</h3>
        </div>
        <div class="modal-body">
            <p>{lang('a_delete_selected_languages')}</p>
            <p>{lang('a_warning_ld')}</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('/admin/languages/delete')" >{lang('a_delete')}</a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('a_cancel')}</a>
        </div>
    </div>

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->

    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('a_languages')}</span>
            </div>  
            <div class="pull-right">
                <div class="d-i_b">
                    <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="delete_function.deleteFunction()" id="module_delete"><i class="icon-trash icon-white"></i>{lang('a_delete')}</button>
                    <button type="button" class="btn btn-small btn-success" onclick="window.location.href = '/admin/languages/create_form'" data-submit><i class="icon-plus-sign icon-white"></i>{lang('a_create_language')}</button>
                </div>
            </div>
        </div>
        <div class="content_big_td">
            <div class="tab-content">
                <div class="tab-pane active" id="lang">
                    <div class="row-fluid">
                        <div class="form-horizontal">
                            <table class="table table-striped table-bordered table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th class="span1 t-a_c">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">
                                                    <input type="checkbox"/>
                                                </span>
                                            </span>
                                        </th>
                                        <th class="span4">{lang('a_name')}</th>
                                        <th class="span4">{lang('a_folder')}</th>
                                        <th class="span4">{lang('a_identif')}</th>
                                        <th class="span4">{lang('a_tpl')}</th>
                                        <th class="span2">{lang('a_image')}</th>
                                        <th class="span2">{lang('a_by_default')}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {foreach $langs as $lang}                                  
                                    <tr class="simple_tr">
                                        <td class="t-a_c">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">
                                                    <input type="checkbox" name="ids" value="{$lang.id}"/>
                                                </span>
                                            </span>
                                        </td>
                                        <td><p><a href="{$BASE_URL}admin/languages/edit/{$lang.id}" data-rel="tooltip" data-title="{lang('a_edit')}">{$lang.lang_name}</a></p></td>
                                        <td><p>{$lang.folder}</p></td>
                                        <td><p>{$lang.identif}</p></td>
                                        <td><p>{$lang.template}</p></td>
                                        <td><p><img src="{$lang.image}" width="16" height="16" /></p></td>
                                        <td class="t-a_c"><button class="btn btn-small lan_def {if $lang.default == 1} btn-primary active {/if}" data-id="{$lang.id}"><i class="icon-star"></i></button></td>
                                    </tr>
                                    {/foreach}     
                                </tbody>
                            </table>   
                        </div>
                        <!--                        <div class="clearfix">
                                                    <div class="pagination pull-left">
                                                        <ul>{$paginator}
                                                        </ul>
                                                    </div>
                                                    <div class="pagination pull-right">
                                                    </div>
                                                </div>-->
                    </div>
                </div> 
            </div>
        </div>   
    </section>
</div>