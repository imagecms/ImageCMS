<div class="top-navigation">
    <div style="float:left;">
    <div style="padding-left:10px;">
        <form style="width:100%;" onsubmit="return false;" method="post" action="{$BASE_URL}admin/admin_search" id="g_search_form">
            <input type="text" value="{$search_title}" name="search_text" class="textbox_long" onclick="if (this.value=='Поиск страниц...') this.value='';" onblur="if (this.value=='') this.value='Поиск страниц...';" />
            <input type="submit" value="Search" class="search_submit" onclick="ajax_form('g_search_form', 'page');"/>
           
            <a href="javascript:ajax_div('page', base_url + 'admin/admin_search/advanced_search')">Расширенный поиск</a>
         </form>
    </div>

    </div>

    <div align="right" style="padding:7px 13px;">
    <input type="button" class="button_silver_130" value="Создать страницу" onclick="ajax_div('page', base_url + 'admin/pages/index'); return false;" />
    <span style="padding:5px;"></span>
    <input type="button" class="button_silver_130" value="Создать Категорию" onclick="ajax_div('page', base_url + 'admin/categories/create_form'); return false;" />
    </div>
</div>

<div style="clear:both"></div>

<form action="{$BASE_URL}admin/admin_search/validate_advanced_search" method="post" id="filter_form" style="width:100%;">

    <?php if (!function_exists('build_cats_tree')) { ?>
    <?php  function build_cats_tree($cats, $selected_cats = array()) { ?>        
        {foreach $cats as $cat}
             <option {foreach $selected_cats as $k} {if $k == $cat.id} selected="selected" {/if} {/foreach}
             value="{$cat['id']}">{for $i=0;$i < $cat['level'];$i++}-{/for} {$cat['name']}</option>
            {if $cat['subtree']} {build_cats_tree($cat['subtree'], $selected_cats)} {/if}
        {/foreach}
    <?php } ?>   
    <?php } ?> 

	<div class="form_text">Текст</div>
	<div class="form_input">
        <input type="text" class="textbox_long" value="" name="search_text" />
    </div>
	<div class="form_overflow"></div>


	<div class="form_text">Категории</div>
	<div class="form_input">
        <select name="category[]" multiple="multiple" style="width:270px;">
        <option value="0">root</option>
        <option disabled="disabled"> </option>
            {build_cats_tree($categories)}  
        </select>
    </div>
	<div class="form_overflow"></div>

    {$cfcm_groups = $this->CI->db->get('content_field_groups')}
    {if $cfcm_groups->num_rows() > 0}
	<div class="form_text">Группа для поиска:</div>
	<div class="form_input">
    <select id="cfcm_search_group_id" onchange="filter_load_form();">
            <option value="0">-- Выберите группу --</option>
        {foreach $cfcm_groups->result_array() as $g}
            <option value="{$g.id}">{$g.name}</option>
        {/foreach}
    </select>
    </div>
	<div class="form_overflow"></div>

    <div id="dynamic_cfcm_form" class="CForms"></div>

    {/if}

	<div class="form_text"></div>
	<div class="form_input">
        <input type="submit" value="Поиск" class="button_silver"  onclick="ajax_me('filter_form');" />
    </div>
	<div class="form_overflow"></div>

</form>


{literal}
    	<script type="text/javascript">
            function filter_load_form()
            {
                gid = $('cfcm_search_group_id').value;

                ajax_div('dynamic_cfcm_form', base_url + 'admin/admin_search/form_from_group/'+gid);
            }
		</script>
{/literal}
