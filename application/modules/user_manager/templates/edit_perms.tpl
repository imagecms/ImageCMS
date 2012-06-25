    {literal}
        <script type="text/javascript">
            function load_perms_for_role()
            {
                var role_id = $('role_id').value;
                ajax_div('perms_editor_block', base_url + 'admin/components/cp/user_manager/show_edit_prems_tpl/' + role_id); 
            }

            function check_all()
            {
                var items = $('edit_perms_form').getElements('input');
                items.each(function(el,i){
                if(el.hasClass('chbx')) 
                {
                    el.checked = true;
                }  
                });
            }

            function uncheck_all()
            {
                var items = $('edit_perms_form').getElements('input');
                items.each(function(el,i){
                if(el.hasClass('chbx')) 
                {
                    el.checked = false;
                }  
                });
            }
        </script>
    {/literal}

<!--
<div style="padding-left: 15px; padding-top: 2px;">
    <a href="#" onclick="check_all(); return false;">Отметить все</a> / <a href="#" onclick="uncheck_all(); return false;">Снять выделение</a>
</div>
-->

    <form action="{$SELF_URL}/update_role_perms" id="edit_perms_form" method="post" style="width:100%">

	<div class="form_text" style="width:150px;">Группа:</div>
	<div class="form_input">
		<select name="role_id" id="role_id" onchange="load_perms_for_role();">
	    {foreach $roles as $role}
		    <option value ="{$role.id}" {if $role.id == $selected_role} selected="selected" {/if} >{$role.alt_name}</option>
		{/foreach}
		</select>
	</div>
	<div class="form_overflow"></div>

    {foreach $groups as $group_k => $group_v}
    <div class="widget_block">
    <div class="widget_header"><b>{$group_names[$group_k]}</b></div>

    <div class="info_container">
        {foreach $group_v as $k => $v}
        <label style="clear:both;padding:2px;">
            <input type="checkbox" class="chbx" value="1" name="{$k}" {if array_key_exists($k, $permissions)} checked="checked" {/if} /> {$v}
        </label>
        {/foreach}
    </div>
    </div>
    {/foreach}

    <div style="clear:both;"></div>

	<div class="form_text" style="width:150px;"></div>
	<div class="form_input">
		<input type="submit" class="button" value="Сохранить" onclick="ajax_me('edit_perms_form');" />
        <a href="#" onclick="check_all(); return false;">Отметить все</a>  /  <a href="#" onclick="uncheck_all(); return false;">Снять выделение</a>
	</div>
	<div class="form_overflow"></div>

	{form_csrf()}
    </form>


{literal}
    <script type="text/javascript">
        var selected_module = '';
        var selected_method = '';
    </script>

    <style type="text/css">
        .widget_block {
            width:300px;
            border:2px solid #A2C449;
            margin:5px;
            float:left;
        }

        .widget_header {
            background-color:#E4F5A9;
            padding:5px;
            padding-left:11px;
        }

        .widget_info {
            padding-left:10px;
            border-bottom:1px solid silver;
        }

        .widget_info:hover { 
            background-color: #D1E2EB;
            cursor:pointer; 
        }

        .info_container {
         /*   height:200px;
            overflow:auto;
        */
        }
    </style>
{/literal}

