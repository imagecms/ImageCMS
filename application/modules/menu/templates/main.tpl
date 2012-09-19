<div class="container">
    <form method="post" action="#">
        <ul class="breadcrumb">
            <li><a href="#">Главная</a> <span class="divider">/</span></li>
            <li class="active">Главное меню</li>
        </ul>
        <section class="mini-layout">
            <div class="frame_title clearfix">
                <div class="pull-left">
                    <span class="help-inline"></span>
                    <span class="title">Главное меню</span>
                </div>
                <div class="pull-right">
                    <div class="d-i_b"><a href="admin/components/cp/menu/create_item/{$insert_id}">Create</a>
                        <button type="button" class="btn btn-small btn-success createLink"><i class="icon-list-alt icon-white"></i>Создать ссылку</button>
                        <button type="button" class="btn btn-small disabled action_on"><i class="icon-trash"></i>Удалить</button>
                        <div class="dropdown d-i_b">
                            <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                                Русский
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Английский</a></li>
                            </ul>
                        </div>
                    </div>
                </div>                            
            </div>
            <div class="tab-content">
                <div class="row-fluid">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th class="t-a_c span1">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox"/>
                                        </span>
                                    </span>
                                </th>
                                <th class="span1">{lang('amt_id')}</th>
                                <th class="span3">{lang('amt_tname')}</th>
                                <th class="span3">{lang('amt_link')}</th>
                                <th class="span1">{lang('amt_type')}</th>
                                <th class="span1"> {lang('amt_position')}<img src="{$THEME}/images/save.png" align="absmiddle" style="cursor:pointer;width:22px;height:22px;" onclick="save_position(); return false;" /></th>
                                <th class="span1">{lang('amt_hidden')}</th>
                                <th class="span1">{lang('amt_hidden')}</th>
                            </tr>
                        </thead>
                        <tbody class="sortable">
                            {foreach $menu_result as $item}
                                <tr data-title="перетащите пользователя">
                                    <td class="t-a_c">
                                        <span class="frame_label">
                                            <span class="niceCheck b_n">
                                                <input type="checkbox"/>
                                            </span>
                                        </span>
                                    </td>
                                    <td><p>{$item.id}</p></td>
                                    <td>
                                        <a href="#">{$item.title}</a>
                                    </td>
                                    <td><p>{$item.url}</p></td>
                                    <td><p>{ switch $item['item_type'] }
                                            { case "page": }
                                            {lang('amt_page')}
                                            {break;}
                                            { case "category": }
                                            {lang('amt_category')}
                                            {break;}
                                            { case "module" }
                                            {lang('amt_module')}
                                            {break;}
                                            { case "url": }
                                            {lang('amt_url')}
                                            {break;}
                                            { /switch } </p></td>
                                    <td><p><input type="text" value="{$item.position}" style="width:23px;" class="item_pos" id="item{$item.id}" /></p></td>
                                    <td>
                                        <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="показывать пункт меню">
                                            {if $item['hidden'] == "0"}
                                                <span class="prod-on_off"></span>
                                                {else:}
                                                    <span class="prod-on_on"></span>
                                                     {/if}
                                        </div>
                                    </td>
                                     <td><p>
                                               {if count($langs) > 1}
    	        <img onclick="translate_m_item({$item.id}); return false;" src="{$THEME}/images/translit.png" width="16" height="16" /> 	
            {/if}
				<img onclick="edit_item({$item.id},{$insert_id}); return false;" src="{$THEME}/images/edit.png" width="16" height="16" />
				
                                         </p></td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </form>
</div>