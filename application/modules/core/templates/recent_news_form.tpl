<div class="top-navigation">
    <ul>
        <li><p>{lang('amt_widget_settings')}<b>{$widget.name}</b></p></li>
    </ul>
</div>

<form action="{$BASE_URL}admin/widgets_manager/update_widget/{$widget.id}" id="widget_form" method="post">
    <div class="form_text">{lang('amt_pages')}</div>
    <div class="form_input"> 
        <select name="display">
            <option value="recent"  {if $widget.settings.display == 'recent'} selected="selected" {/if} >{lang('amt_last')}</option>
            <option value="popular" {if $widget.settings.display == 'popular'} selected="selected" {/if}>{lang('amt_popular')}</option>
        </select>
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{lang('amt_categories')}</div>
    <div class="form_input"> 

        <select name="categories[]" multiple="multiple">
        <option value="0">{lang('amt_without_category')}</option>
        <option disabled="disabled"> </option>
        {build_cats_tree($cats, $widget.settings.categories)}
        <?php  function build_cats_tree($cats, $selected_cats = array()) { ?>        
            {foreach $cats as $cat}
                 <option {foreach $selected_cats as $k} {if $k == $cat.id} selected="selected" {/if} {/foreach}
                 value="{$cat['id']}">{for $i=0;$i < $cat['level'];$i++}-{/for} {$cat['name']}</option>
                {if $cat['subtree']} {build_cats_tree($cat['subtree'], $selected_cats)} {/if}
            {/foreach}
        <?php } ?>   
        </select>
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{lang('amt_displayed_news_count')}</div>
    <div class="form_input"> 
        <input type="text" class="textbox_long" name="news_count" value="{$widget.settings.news_count}" /> 
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{lang('amt_max_char_count')}</div>
    <div class="form_input"> 
        <input type="text" class="textbox_long" name="max_symdols" value="{$widget.settings.max_symdols}" />
    </div>
    <div class="form_overflow"></div>

    <div class="form_text"></div>
    <div class="form_input">
        <input type="submit" class="button" value="{lang('amt_save')}" onclick="ajax_me('widget_form');" /> 
        <a href="#" onclick="ajax_div('page', base_url + 'admin/widgets_manager/'); return false" >{lang('amt_to_widget_list')}</a>
    </div>
{form_csrf()}</form>
