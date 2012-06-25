{if $no_pages == TRUE}
    <div id="notice" style="width:500px;">В  категории <b>{$category['name']}</b> нет страниц.
    <a href="#" onclick="ajax_div('page', base_url + 'admin/pages/index/category/{$category.id}'); return false;">Создать.</a> 
    </div>    
    {return}
{/if}

<div class="top-navigation">
    <div style="float:left;">
    <div style="padding-left:10px;">
        <form style="width:100%;" onsubmit="return false;" method="post" action="{$BASE_URL}admin/admin_search" id="g_search_form">
            <input type="text" value="Поиск страниц..." name="search_text" class="textbox_long" onclick="if (this.value=='Поиск страниц...') this.value='';" onblur="if (this.value=='') this.value='Поиск страниц...';" />
            <input type="submit" value="Search" class="search_submit" onclick="ajax_form('g_search_form', 'page');"/>

            <a href="javascript:ajax_div('page', base_url + 'admin/admin_search/advanced_search')">Расширенный поиск</a>
         </form>
    </div>
    </div>

    <div align="right" style="padding:7px 13px;">
 <input type="button" class="button_silver_130" value="Создать страницу" onclick="ajax_div('page', base_url + 'admin/pages/index/category/{$cat_id}'); return fa;se;" />
    </div>
</div>


<div style="clear:both"></div>

<div id="sortable" >
		  <table id="pages_table">
		  	<thead>
                <th width="5px">
                    <input type="checkbox" onclick="switchChecks(this);"/>
                </th>
				<th axis="number" width="5px;">ID</th>
				<th axis="string">Заголовок</th>
				<th axis="string">URL</th>
				<th axis="date">Создано</th>
				<th style="width:80px;" width="80px">
                Позиция
                <img src="{$THEME}/images/save.png" align="absmiddle" style="cursor:pointer;width:22px;height:22px;"
                onclick="save_pages_position('{echo $CI->uri->uri_string()}'); return false;" /> 
                </th>
				<th axis="string">Автор</th>
				<th>Статус</th>
				<th></th>
			</thead>
			<tbody>
		{foreach $pages as $page}
		<tr id="{$page.number}">
            <td>
            <input type="checkbox" id="chkb_{$page.id}" class="chbx"/>  
            </td>
			<td class="">{$page.id}</td>
			<td title="{$page.title}. Просмотров: {$page.showed}" onclick="ajax_div('page','{$BASE_URL}admin/pages/edit/{$page.id}'); return false;">{truncate($page.title, 50)}</td>
			<td><a href="{$BASE_URL}{$page.cat_url}{$page.url}" target="_blank">{truncate($page.url, 40, '...')}</a></td>
			<td>{ date('Y-m-d H:i:s', $page['created']) }</td>
			<td>
            <div align="center">
            <input type="text" value="{$page.position}" style="width:26px;" class="page_pos" id="page{$page.id}" /> 
            </div>
            </td>
			<td>{$page.author}</td>
			<td>
			{ switch $page['post_status'] }
				{ case "publish" }
				<div style="visibility:hidden;float:left">1</div>
                <img id="p_status_{$page.id}" onclick="change_page_status('{$page.id}');" title="Опубликовано" src="{$THEME}/images/publish.png" width="16" height="16" />
                {break;}
				{ case "pending" }
				<div style="visibility:hidden;float:left">2</div>
                <img id="p_status_{$page.id}" onclick="change_page_status('{$page.id}');" title="Ожидает одобрения" src="{$THEME}/images/pending.png" width="16" height="16" />
                {break;}
				{ case "draft" }
					<div style="visibility:hidden;float:left">3</div>
                    <img id="p_status_{$page.id}" onclick="change_page_status('{$page.id}');" title="Не опубликовано" src="{$THEME}/images/draft.png" width="16" height="16" />
                {break;}
			{ /switch }
			</td>
			<td  class="rightAlign">
			<img onclick="ajax_div('page','{$BASE_URL}admin/pages/edit/{$page.id}/{$page.lang}');" style="cursor:pointer" src="{$THEME}/images/edit_page.png" width="16" height="16" title="Редактировать" />
			<img onclick="confirm_delete_page({$page.id});" src="{$THEME}/images/delete_page.png"  style="cursor:pointer" width="16" height="16" title="Удалить" />
			</td>
		</tr>
		{/foreach}
			</tbody>
			<tfoot>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tfoot>
		  </table>
</div>

<div align="center" style="padding:5px;" id="pagination">
{$paginator}
</div>

<div class="footer_block" align="right">
    С отмечеными:
    <input type="submit" name="delete" class="button_silver" value="Переместить" onclick="show_move_window('move');" />
    <input type="submit" name="delete" class="button_silver" value="Копировать" onclick="show_move_window('copy');" />
    <input type="submit" name="delete" class="button_red" style="font-weight:bold;" value="Удалить" onclick="delete_sel_pages({$cat_id}); return false;" />
</div>

{literal}
    	<script type="text/javascript">
			window.addEvent('domready', function(){
				pages_table = new sortableTable('pages_table', {overCls: 'over', sortOn: -1 ,onClick: function(){}});
                pages_table.altRow();
			});

            function switchChecks(el)
            {
                if (el.checked == true){
                    check_all();
                }else{
                    uncheck_all();
                }
            }

            function check_all()
            {
                var items = $('pages_table').getElements('input');
                items.each(function(el,i){
                if(el.hasClass('chbx')) 
                {
                    el.checked = true;
                }  
                });
            }

            function uncheck_all()
            {
                var items = $('pages_table').getElements('input');
                items.each(function(el,i){
                if(el.hasClass('chbx')) 
                {
                    el.checked = false;
                }  
                });
            }

            function show_move_window(action)
            {
                new MochaUI.Window({
                    id: 'move_pages_window',
                    title: 'Копировать/Переместить страницы ',
                    type: 'modal',
                    loadMethod: 'xhr',
                    contentURL: base_url + 'admin/pages/show_move_window/' + action,
                    width: 410,
                    height: 100
                });
            }
		</script>
{/literal}
