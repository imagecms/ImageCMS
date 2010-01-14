<div class="top-navigation">
    <ul>
        <li><p>Настройки виджета <b>{$widget.name}</b></p></li>
    </ul>
</div>

<form action="{$BASE_URL}admin/widgets_manager/update_widget/{$widget.id}" id="widget_form" method="post">
    <div class="form_text">Страницы</div>
    <div class="form_input"> 
        <select name="display">
            <option value="recent"  {if $widget.settings.display == 'recent'} selected="selected" {/if} >Последние</option>
            <option value="popular" {if $widget.settings.display == 'popular'} selected="selected" {/if}    >Популярные</option>
        </select>
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">Категории</div>
    <div class="form_input"> 

        <select name="categories[]" multiple="multiple">
        <option value="0">Без категории</option>
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

    <div class="form_text">Количество новостей для отображения</div>
    <div class="form_input"> 
        <input type="text" class="textbox_long" name="news_count" value="{$widget.settings.news_count}" /> 
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">Максимальное число символов</div>
    <div class="form_input"> 
        <input type="text" class="textbox_long" name="max_symdols" value="{$widget.settings.max_symdols}" />
    </div>
    <div class="form_overflow"></div>

    <div class="form_text"></div>
    <div class="form_input">
        <input type="submit" class="button" value="Сохранить" onclick="ajax_me('widget_form');" /> 
        <a href="#" onclick="ajax_div('page', base_url + 'admin/widgets_manager/'); return false" >Перейти к списку виджетов</a>
    </div>
{form_csrf()}</form>
