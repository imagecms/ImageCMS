<div class="top-navigation">
    <ul>
        <li><p>{lang('amt_widget_settings')}<b>{$widget.name}</b></p></li>
    </ul>
</div>

<form action="{$BASE_URL}admin/widgets_manager/update_widget/{$widget.id}" id="widget_form" method="post">
    
    <div class="form_text">{lang('amt_category')}</div>
    <div class="form_input"> 
        <select name="category">
        <option value="0" disabled="disabled">Не указано</option>
        {build_cats_tree($cats, $widget.settings.category)}
        <?php  function build_cats_tree($cats, $category = 0 ) { ?>        
            {foreach $cats as $cat}
                 <option {if $category == $cat.id}selected="selected"{/if}
                 value="{$cat.id}">{for $i=0; $i < $cat.level; $i++}-{/for} {$cat.name}</option>
                {if $cat.subtree} {build_cats_tree($cat.subtree, $category)} {/if}
            {/foreach}
        <?php } ?>   
        </select>
    </div>
    
    <div class="form_overflow"></div>

    <div class="form_text">Вложенность</div>
    <div class="form_input"> 
        <input type="text" class="textbox_long" name="depth" value="{$widget.settings.depth}" /> 
    </div>
    
    <div class="form_overflow"></div>

    <div class="form_text"></div>
    <div class="form_input">
        <input type="submit" class="button" value="{lang('amt_save')}" onclick="ajax_me('widget_form');" /> 
        <a href="#" onclick="ajax_div('page', base_url + 'admin/widgets_manager/'); return false" >{lang('amt_to_widget_list')}</a>
    </div>
{form_csrf()}
</form>