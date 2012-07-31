<div class="top-navigation">
<ul>
    <li><p>{lang('amt_rss_channel_sett')}</p></li>
</ul>
</div>

<div style="clear:both"></div> 

<form method="post" action="{site_url('admin/components/cp/rss/settings_update')}" id="rss_settings_form" style="width:100%;">
   		<div class="form_text"></div>
		<div class="form_input"></div>
		<div class="form_overflow"></div>     
  
   		<div class="form_text">{lang('amt_tname')}</div>
		<div class="form_input"><input type="text" class="textbox_long" name="title" value="{$settings.title}" /></div>
		<div class="form_overflow"></div>    

   		<div class="form_text">{lang('amt_description')}</div>
		<div class="form_input"><textarea class="textarea" name="description">{$settings.description}</textarea></div>
		<div class="form_overflow"></div>

        <div class="form_text">{lang('amt_categories')}</div>
        <div class="form_input"> 
            <select name="categories[]" multiple="multiple">
            <option value="0" {if $settings.categories.0 == 0} selected="selected" {/if}>{lang('amt_without_category')}</option>
            <option disabled="disabled"> </option>
            {build_cats_tree($cats, $settings.categories)}
            <?php  function build_cats_tree($cats, $selected_cats = array()) { ?>        
                {foreach $cats as $cat}
                     <option {foreach $selected_cats as $k} {if $k == $cat.id} selected="selected" {/if} {/foreach}
                     value="{$cat['id']}">{for $i=0;$i < $cat['level'];$i++}-{/for} {$cat['name']}</option>
                    {if $cat['subtree']} {build_cats_tree($cat['subtree'], $selected_cats)} {/if}
                {/foreach}
            <?php } ?>   
            </select>
            <br/>
            <span class="lite">{lang('amt_sel_cat_f_trans')}</span>
        </div>
        <div class="form_overflow"></div>

   		<div class="form_text">{lang('amt_pages_count')}</div>
		<div class="form_input">
            <input type="text" class="textbox_long" name="pages_count" value="{$settings.pages_count}" />
            <br/>
            <span class="lite">{lang('amt_select_pages_count_for_display')}</span> 
        </div>
		<div class="form_overflow"></div>

   		<div class="form_text">{lang('amt_cache')}</div>
		<div class="form_input">
            <input type="text" class="textbox_long" name="cache_ttl" value="{$settings.cache_ttl}" />
            <br/>
            <span class="lite">{lang('amt_cache_life_in_minutes')}</span> 
        </div>
		<div class="form_overflow"></div>

   		<div class="form_text"></div>
		<div class="form_input">
            <input type="submit" name="button"  class="button_130" value="{lang('amt_save')}" onclick="ajax_me('rss_settings_form');" />
        </div>
		<div class="form_overflow"></div> 
{form_csrf()}</form>
