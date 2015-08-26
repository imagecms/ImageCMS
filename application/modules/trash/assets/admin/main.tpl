<div class="container">
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>{lang('Redirect links removing', 'trash')}</h3>
        </div>
        <div class="modal-body">
            <p>{lang('Remove links?', 'trash')}</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('/admin/components/init_window/trash/delete_trash/')">{lang("Delete", 'trash')}</a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang("Cancel", 'trash')}</a>
        </div>
    </div>
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Redirect', 'trash')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/components/modules_table" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back", 'admin')}</span></a>
                </div>
                <div class="d-i_b">
                    <a href="/admin/components/init_window/trash/create_trash/" class="btn btn-small btn-success"><i class="icon-plus-sign icon-white"></i>{lang('Create redirect', 'trash')}</a>
                    <a href="/admin/components/init_window/trash/create_trash_list/" class="btn btn-small btn-success"><i class="icon-plus-sign icon-white"></i>{lang('Create redirect list', 'trash')}</a>
                    <button type="button" class="btn btn-small btn-danger disabled action_on" id="trash_del" onclick="delete_function.deleteFunction()"><i class="icon-trash"></i>{lang("Delete", 'trash')}</button>
                </div>
            </div>
        </div>

        <div class="btn-group myTab m-t_20">
            <input type="text" id="search_urls" class="span5 v-a_t m-r_15" placeholder="Введите часть URL'a" />
            <select class="span3 v-a_t" id="autocomplete_param">
                <option value="old">{lang("search by old URL",'trash')}</option>
                <option value="new">{lang("search by redirect",'trash')}</option>
            </select>
        </div>

        <div class="row-fluid">
            <form method="post" action="#" class="form-horizontal">
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td t-l_a">
                    <thead>
                        <tr>
                            <th class="t-a_l span1">
                                <span class="frame_label">
                                    <span class="niceCheck b_n">
                                        <input type="checkbox"/>
                                    </span>
                                </span>
                            </th>
                            <th style="font-size: 12px;color: #3f5a6a; width:200px" class="span3">{lang('Old URL', 'trash')}</th>
                            <th style="font-size: 12px;color: #3f5a6a;">{lang('Redirect type', 'trash')}</th>
                            <th style="font-size: 12px;color: #3f5a6a;">{lang('Redirect kind', 'trash')}</th>
                            <th style="font-size: 12px;color: #3f5a6a;">{lang('Redirect', 'trash')}</th>
                        </tr>
                    </thead>
                    <tbody class="sortable">
                        {foreach $model as $item}
                        <tr>
                            <td class="t-a_c">
                                <span class="frame_label">
                                    <span class="niceCheck b_n">
                                        <input type="checkbox" name="ids" value="{echo $item->id}"/>
                                    </span>
                                </span>
                            </td>
                            <td class="span3" style="padding: 0px">
                                <a href="/admin/components/init_window/trash/edit_trash/{echo $item->id}"
                                data-rel="tooltip"
                                data-title="{lang("Editing", 'trash')}">
                                <pre style="width: 350px; border: none; color: rgb(0, 136, 204);">{echo site_url().$item->trash_url}</pre>
                            </a>
                        </td>
                        <td>
                            <label>{echo $item->trash_redirect_type}</label>
                        </td>
                        <td>
                            <label>{echo $item->trash_type}</label>
                        </td>
                        <td style="padding: 0px">
                            <a href="{echo $item->trash_redirect}" target="_blank">
                                <pre style="width: 350px; border: none; color: rgb(0, 136, 204);">{echo $item->trash_redirect}</pre>
                            </a>
                        </td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
        </form>
        {echo $pagination}
    </div>
</section>
</div>
