<div class="container">
    <form method="post" action="#">
        <ul class="breadcrumb">
            <li><a href="#">Главная</a> <span class="divider">/</span></li>
            <li class="active">Список товаров</li>
        </ul>
        <section class="mini-layout">
            <div class="frame_title clearfix">
                <div class="pull-left">
                    <span class="help-inline"></span>
                    <span class="title">Меню</span>
                </div>
                <div class="pull-right">
                    <div class="d-i_b">
                        <input type="button" class="button" value="{lang('amt_create_menu')}" onclick="open_create_winow(); return false;" />
                        <button type="button" class="btn btn-small btn-success"><i class="icon-list-alt icon-white"></i>Создать категорию</button>
                        <button type="button" class="btn btn-small disabled action_on"><i class="icon-trash"></i>Удалить</button>
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
                                <th class="span3">{lang('amt_name')}</th>
                                <th class="span4">{lang('amt_description')}</th>
                                <th class="span2">{lang('amt_crea')}</th>
                                <th class="span2">Редактировать</th>
                            </tr>
                        </thead>
                        <tbody>
                            {if count($menus) > 0}
                                {foreach $menus as $item}
                                    <tr data-title="перетащите пользователя" class="simple_tr">
                                        <td class="t-a_c">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">
                                                    <input type="checkbox"/>
                                                </span>
                                            </span>
                                        </td>
                                        <td ><p>{$item.id}</p></td>
                                        <td>
                                            <a href="#" id="del" onclick="ajax_div('menus_table','{$SELF_URL}/menu_item/{$item.name}'); return false;">{$item.main_title}</a>
                                        </td>
                                        <td><p>{$item.name}</p></td>
                                        <td>{$item.description}
                                            <!--                                                <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="показывать">
                                                                                                <span class="prod-on_off"></span>
                                                                                            </div>-->
                                        </td>
                                        <td>{$item.created}</td>
                                        <td><a onclick="edit_menu({$item.id}); return false;" >Редактировать</a></td>
                                    </tr>

                                    </tr>
                                {/foreach}
                            {/if}
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </form>
</div>
                        {literal}
        <script language="text/javascript">
          
            $('#del').on('click', function(){
     alert('Delete menu');
    })
 			window.addEvent('domready', function(){
				menus_table = new sortableTable('mt1', {overCls: 'over', sortOn: -1 ,onClick: function(){}});
                menus_table.altRow();
			}); 
  
            function open_create_winow()
            {
                new MochaUI.Window({
                    id: 'create_menu_w',
                    title: '',
                    type: 'modal',
                    loadMethod: 'xhr',
                    contentURL: base_url + 'admin/components/cp/menu/create_tpl/',
                    width: 490,
                    height: 350
                });            
            }

            function edit_menu(id)
            {
                new MochaUI.Window({
                    id: 'edit_menu_w',
                    title: '',
                    type: 'modal',
                    loadMethod: 'xhr',
                    contentURL: base_url + 'admin/components/cp/menu/edit_menu/' + id,
                    width: 490,
                    height: 350
                });       
            }
                
                
            function delete_menu(name,title)
            {
                alertBox.confirm('<h1> </h1><p>Удалить меню <b>'+ title + '</b> ? </p>', {onComplete:
                    function(returnvalue) {
                    if(returnvalue)
                    {
                        var req = new Request.HTML({
                        method: 'post',
                        url: base_url + 'admin/components/cp/menu/delete_menu/' + name,
                        onComplete: function(response) { 
                            ajax_div('menu_module_block',base_url + 'admin/components/cp/menu/index');
                            }
                        }).post();
                    }
                    }
                });
            }
        </script>
    {/literal}