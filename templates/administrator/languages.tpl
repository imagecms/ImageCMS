<div class="container">

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>{lang('Delete language',"admin")}</h3>
        </div>
        <div class="modal-body">
            <p>{lang('Delete selected languages?',"admin")}</p>
            <p>{lang('Attention! All pages in this language will be deleted!', 'admin')}</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('/admin/languages/delete')" >{lang('Delete',"admin")}</a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang("Cancel","admin")}</a>
        </div>
    </div>

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->

    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Languages list',"admin")}</span>
            </div>  
            <div class="pull-right">
                <div class="d-i_b">
                    <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="delete_function.deleteFunction()" id="module_delete"><i class="icon-trash icon-white"></i>{lang("Delete","admin")}</button>
                    <button type="button" class="btn btn-small btn-success" onclick="window.location.href = '/admin/languages/create_form'" data-submit><i class="icon-plus-sign icon-white"></i>{lang('Create language',"admin")}</button>
                </div>
            </div>
        </div>
        <div class="content_big_td">
            <div class="tab-content">
                <div class="tab-pane active" id="lang">
                    <div class="row-fluid">
                        <div class="form-horizontal">
                            <table class="table table-striped table-bordered table-hover table-condensed t-l_a">
                                <thead>
                                    <tr>
                                        <th class="t-a_c span1">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">
                                                    <input type="checkbox"/>
                                                </span>
                                            </span>
                                        </th>
                                        <th>{lang("Language","admin")}</th>
                                        <th>{lang("Identifier","admin")}</th>
                                        <th>{lang("Locale","admin")}</th>
                                        <th>{lang("Template","admin")}</th>
                                        <th>{lang("Image","admin")}</th>
                                        <th class="span2">{lang("by default","admin")}</th>
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
                                            <td>
                                                <p>
                                                    <a href="{$BASE_URL}admin/languages/edit/{$lang.id}" 
                                                       data-rel="tooltip" 
                                                       data-title="{lang("Editing","admin")}"
                                                       class="pjax"
                                                       >
                                                        {$lang.lang_name}
                                                    </a>
                                                </p>
                                            </td>
                                            <td><p>{$lang.identif}</p></td>
                                            <td><p>{$lang.locale}</p></td>
                                            <td><p>{if $lang.default == 1}{echo $template_selected}{else:}{$lang.template}{/if}</p></td>
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