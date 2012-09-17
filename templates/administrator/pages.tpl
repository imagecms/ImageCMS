<form method="post" action="#">
    <ul class="breadcrumb">
        <li><a href="#">Главная</a> <span class="divider">/</span></li>
        <li class="active">{lang('a_cont_nocat')}</li>
    </ul>
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('a_cont_nocat')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <button type="button" class="btn btn-small disabled action_on pages_action" url="{$BASE_URL}admin/pages/move_pages/copy">{lang('a_copy')}</button>
                    <button type="button" class="btn btn-small disabled action_on pages_action" url="{$BASE_URL}admin/pages/move_pages/move"><i class="icon-move"></i>{lang('a_repalce')}</button>
                    <button type="button" class="btn btn-small disabled action_on pages_action" url="{$BASE_URL}admin/pages/delete_pages/"><i class="icon-trash"></i>{lang('a_delete')}</button>
                    <button type="button" class="btn btn-small btn-success" onclick="window.location.href='{$BASE_URL}admin/pages'"><i class="icon-plus-sign icon-white"></i>{lang('a_create_page')}</button>
                </div>
            </div>                            
        </div>
        <div class="row-fluid">
            <table class="table table-striped table-bordered table-hover table-condensed pages-table">
                <thead>
                    <tr>
                        <th class="t-a_c span1">
                            <span class="frame_label">
                                <span class="niceCheck b_n">
                                    <input type="checkbox"/>
                                </span>
                            </span>
                        </th>
                        <th class="span1">ID</th>
                        <th class="span4">{lang('a_title')}</th>
                        <th class="span3">{lang('a_url')}</th>
                        {if $cat_id != "0"}<th class="span2">Категория</th>{/if}
                        <th class="span1">{lang('a_status')}</th>
                    </tr>
                    <tr class="head_body">
                        <td>
                        </td>
                        <td class="number">
                            <input type="text" data-original-title="{lang('a_numbers_only')}"/>
                        </td>
                        <td>
                            <input type="text"/>
                        </td>
                        <td>
                            <input type="text"/>
                        </td>
                        {if $cat_id != "0"}
                        <td>
                            <select id="categorySelect" url="{$BASE_URL}admin/pages/GetPagesByCategory/">
                                <option value=""></option>
                                {foreach $cats as $cat}
                                <option value="{$cat.id}" {if $cat.id == $cat_id}selected="selected"{/if}>{$cat.name}</option>
                                {/foreach}
                            </select>
                        </td>
                        {/if}
                        <td>

                        </td>
                    </tr>
                </thead>
                <tbody class="sortable">
                    {foreach $pages as $page}
                    <tr data-title="перетащите товар" data-id="{$page.id}">
                        <td class="t-a_c">
                            <span class="frame_label">
                                <span class="niceCheck b_n">
                                    <input type="checkbox" data-id="{$page.id}"/>
                                </span>
                            </span>
                        </td>
                        <td><span>{$page.id}</span></td>
                        <td class="share_alt">
                            <a href="{$BASE_URL}{$page.cat_url}{$page.url}" target="_blank" class="go_to_site pull-right btn btn-small"  data-rel="tooltip" data-placement="top" data-original-title="{lang('a_goto_site')}"><i class="icon-share-alt"></i></a>
                            <a href="{$BASE_URL}admin/pages/edit/{$page.id}" class="title ajax_load">{$page.title}</a>
                        </td>
                        <td><span>{truncate($page.url, 40, '...')}</span></td>
                        {if $cat_id != "0"}<td><span>{if $page.cat_name}{$page.cat_name}{else:}{$category.name}{/if}</span></td>{/if}
                        <td>
                            <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="{if $page['post_status'] == 'publish'}{lang('a_show')}{else:}{lang('a_dont_show')}{/if}" onclick="change_page_status('{$page.id}');">
                                <span class="prod-on_off {if $page['post_status'] != 'publish'}disable_tovar{/if}" style="{if $page['post_status'] != 'publish'}left: -28px;{/if}"></span>
                            </div>
                        </td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
        {if $paginator > ''}
        <div class="clearfix">
            <div class="pagination pull-left">
                {$paginator}
            </div>
            <div class="pagination pull-right">
                <ul>
                    <li class="disabled"><span>Prev</span></li>
                    <li><a href="#">Next</a></li>
                </ul>
            </div>
        </div>
        {/if}
    </section>
</form>