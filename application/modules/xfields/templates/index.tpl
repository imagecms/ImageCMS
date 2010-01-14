<div id="xfields_tabs">

	<h4>Все поля</h4>
    <div style="padding:5px;" id="xfields_list"> </div>

	<h4>Создать Поле</h4>
    <div style="padding:5px;">
        {$create_tpl}   
    </div>

	<h4>Группы</h4>
    <div style="padding:5px;" id="xfield_groups">{$groups_tpl}</div>

</div>

{literal}
<script type="text/javascript">
    var xfieldtabs = null;
    ajax_div('create_tpls', base_url + 'admin/components/cp/xfields/load_item_tpl/');

    function edit_group(id)
    {
		new MochaUI.Window({
			id: 'edit_xfield_g_w',
			title: 'Редактировать группу полей',
			loadMethod: 'xhr',
            type: 'modal',
			contentURL: base_url + 'admin/components/cp/xfields/edit_group/' + id,
			width: 490,
			height: 160
		});
    }

    function delete_group(id)
    {
	    alertBox.confirm('<h1> </h1><p>Удалить группу ID: '+ id +'? </p>', {onComplete:
    	function(returnvalue) {
		if(returnvalue)
		{
					var req = new Request.HTML({
					method: 'post',
					url: base_url + 'admin/components/cp/xfields/delete_group/' + id,
					onComplete: function() {
                            ajax_div('xfield_groups', base_url + 'admin/components/cp/xfields/update_groups_list');
                        }
				}).post();
		}
	    }
        });
    }

    window.addEvent('domready', function() {
	    xfieldtabs = new SimpleTabs('xfields_tabs', {
	    selector: 'h4'
	   	});
    
        ajax_div('xfields_list', base_url + 'admin/components/cp/xfields/fields_list');
        });

	function load_item_tpl(i_type)
	{
		$('create_from').action = base_url + 'admin/components/cp/xfields/create/' + i_type;
		ajax_div('create_tpls', base_url + 'admin/components/cp/xfields/load_item_tpl/' + i_type);
	}

	function edit_field(id)
	{
    	new MochaUI.Window({
			id: 'edit_field_window',
			title: 'Редактировать',
			loadMethod: 'xhr',
			contentURL: base_url + 'admin/components/cp/xfields/edit_field/' + id,
			width: 490,
			height: 300
		});
    }

    function delete_field(id)
    {
       		var req = new Request.HTML({
			method: 'post',
			url: base_url + 'admin/components/cp/xfields/delete_field/' + id ,
			
			onComplete: function() { ajax_div('xfields_list', base_url + 'admin/components/cp/xfields/fields_list');  }
	    	}).send(); 
    }
	</script>
{/literal}
