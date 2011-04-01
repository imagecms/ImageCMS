<div class="top-navigation">
    <div style="float:left;">
        <ul>
        <li><a {if $status == 'all' OR $status== NULL}class="selected"{/if} href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/comments/index/status/all/page/0'); return false;">Все комментарии</a></li>
        <li><a {if $status == 'waiting'}class="selected"{/if} href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/comments/index/status/waiting/page/0'); return false;">Ожидают модерации ({$total_waiting})</a></li>
        <li><a {if $status == 'approved'}class="selected"{/if} href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/comments/index/status/approved/page/0'); return false;" >Одобренные</a></li>
        <li><a {if $status == 'spam'}class="selected"{/if} href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/comments/index/status/spam/page/0'); return false;">Спам ({$total_spam})</a></li>
        </ul>
    </div>

    <div align="right" style="padding:5px;">
        <input type="button" class="button_silver_130" value="Настройки" onclick="ajax_div('page', base_url + 'admin/components/cp/comments/show_settings'); return false;" />
    </div>
</div>
<div style="clear:both;"></div>

{if is_array($comments)}
<div id="sortable">
		  <table id="comments_table">
		  	<thead>
				<th width="10"></th>
				<th axis="string" width="10">ID</th>
				<th axis="string">Текст</th>
				<th axis="string">Пользователь</th>
				<th axis="string">E-Mail</th>
				<th axis="string">Страница</th>
				<th axis="string">IP</th>
				<th axis="string">Дата</th>
				<th></th>
			</thead>
			<tbody>
		{foreach $comments as $item }
		<tr id="comment_tr_{$item.id}" {if $item.status == 1 AND $status == 'all'} class="status1" {/if}>
			<td><input type="checkbox" id="chkb_{$item.id}" class="chbx"/></td>
			<td align="center">{$item.id}</td>
			<td>
                <span onclick="edit_comment({$item.id});">{truncate(htmlspecialchars($item.text), 80, '...')}</span>
                <div class="comment_status">
                    {if $item.status == 0}
                        <a href="#" onclick="set_comment_status({$item.id}, 1); return false;">Отклонить</a> | <a onclick="set_comment_status({$item.id}, 2); return false;" href="#">Спам</a> |
                    {elseif($item.status == 1):}
                        <a href="#" onclick="set_comment_status({$item.id}, 0); return false;">Одобрить</a> | <a onclick="set_comment_status({$item.id}, 2); return false;" href="#">Спам</a> |
                    {elseif($item.status == 2):}
                        <a href="#" onclick="set_comment_status({$item.id}, 0); return false;">Одобрить</a> |
                    {/if}
                        <a href="#" onclick="delete_comment({$item.id}); return false;" style="color: #E06242;">Удалить</a> 
                </div>
            </td>
			<td>{$item.user_name}</td>
			<td>{$item.user_mail}</td>
			<td>
            {if $item.module == 'core'}
                <a href="{$item.page_url}#comment_{$item.id}" target="_blank" title="{$item.page_title}">{truncate($item.page_title, 25, '...')}</a>
            {/if}
            {if $item.module == 'shop'}
                {if $this->CI->db->where('name','shop')->get('components')->num_rows() > 0}
                    {$p_name = SProductsQuery::create()->filterById($item.item_id)->findOne()->getName()} 
                    <a href="/shop/product/{$item.item_id}" target="_blank">{truncate($p_name,25,'...')}</a>
                {/if}
            {/if}
            </td>
			<td>{$item.user_ip}</td>
			<td>{date('d-m-Y H:i', $item.date)}</td>
			<td>
    			<img onclick="edit_comment({$item.id});" style="cursor:pointer" src="{$THEME}/images/edit_page.png" width="16" height="16" title="Редактировать" />
	    		<img onclick="delete_comment({$item.id});" src="{$THEME}/images/delete.png"  style="cursor:pointer" width="16" height="16" title="Удалить" />
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

		<script type="text/javascript">
        {literal}
			window.addEvent('domready', function(){
				comments_table = new sortableTable('comments_table', {overCls: 'over', sortOn: -1 ,onClick: function(){}}); 
                comments_table.altRow();
			});
        {/literal}
        </script>

<div style="padding-left:15px;padding-top:2px;">
<a href="#" onclick="check_all(); return false;">Отметить все</a>  /  <a href="#" onclick="uncheck_all(); return false;">Снять выделение</a> 
</div>

<p align="right" style="padding:5px;padding-top:10px;">
С отмечеными:
<input type="submit" name="delete"  class="button" value="Удалить" onclick="delete_sel_comments(); return false;" />
</p>

<div align="center" style="padding:5px;">
{$paginator}
</div>

{else:}
    <div id="notice">Ничего не найдено.</div>
{/if}

{literal}
        <style type="text/css">
        .comment_status {
            visibility: hidden;
        }

        tr:hover .comment_status {
            visibility: visible;
        }

        #sortable tr.status1 {
	        background-color: #F9FFCC;
        }

        #sortable tr.status1:hover {
            background-color:#354158;
        }
        </style>

		<script type="text/javascript">
        var comments_cur_url = '{/literal}{$comments_cur_url}{literal}';

            function set_comment_status(comment_id, status_id)
            {
                var req = new Request.HTML({
                    method: 'post',
                    url: base_url + 'admin/components/cp/comments/update_status/',
                    onComplete: function(response) { 
                            ajax_div('page', comments_cur_url);
                        }
                }).post({'id': comment_id, 'status': status_id});
            }

            function check_all()
            {
                var items = $('comments_table').getElements('input');
                items.each(function(el,i){
                if(el.hasClass('chbx')) 
                {
                    el.checked = true;
                }  
                });
            }

            function uncheck_all()
            {
                var items = $('comments_table').getElements('input');
                items.each(function(el,i){
                if(el.hasClass('chbx')) 
                {
                    el.checked = false;
                }  
                });
            }

            function edit_comment(id)
            { 
                new MochaUI.Window({
                id: 'edit_comment_window',
                title: 'Редактирование комментария',
                loadMethod: 'xhr',
                contentURL: base_url + 'admin/components/cp/comments/edit/' + id,
                width: 500,
                height: 280
                });
            }

            function delete_comment(id)
            {
                alertBox.confirm('<h1>Удалить коментраий ID ' + id + '? </h1>', {onComplete:
                    function(returnvalue) {
                    if(returnvalue)
                    {
                        var req = new Request.HTML({
                           method: 'post',
                           url: base_url + 'admin/components/cp/comments/delete',
                           onRequest: function() { },
                           onComplete: function(response) {  
                                ajax_div('page', comments_cur_url); 
                            }
                        }).post({'id': id });

                        //comment_tr = 'comment_tr_' + id;
                        //var myVS = new Fx.Slide(comment_tr);
                        //myVS.slideOut();
                        //$(comment_tr).setStyle('display', 'none');
                    }
                    }
                });
            }

            function delete_sel_comments()
            {
            alertBox.confirm('<h1> </h1><p>Удалить отмеченые комментарии? </p>', {onComplete:
            function(returnvalue){
            if(returnvalue)
            {
                var items_arr = new Array();     

                var items = $('comments_table').getElements('input');
                items.each(function(el,i){
                        if(el.checked == true) 
                        {
                            id = el.id;
                            val = el.value;
                            el_info = id;
                            items_arr.include( el_info );
                        }  
                        });

                var req = new Request.HTML({
                   method: 'post',
                   url: base_url + 'admin/components/cp/comments/delete_many',
                   onRequest: function() { },
                   onComplete: function(response) {  
                         ajax_div('page', comments_cur_url);   
                    }
                }).post({'comments': items_arr });
            }
            }
            });
            }
		</script>
{/literal}
