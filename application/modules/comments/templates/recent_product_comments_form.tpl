<div class="top-navigation">
    <ul>
        <li><p>Настройки виджета <b>{$widget.name}</b></p></li>
    </ul>
</div>

<form action="{$BASE_URL}admin/widgets_manager/update_widget/{$widget.id}" id="widget_form" method="post">
    <div class="form_text">Количество отзывов для отображения</div>
    <div class="form_input"> 
        <input type="text" class="textbox_long" name="comments_count" value="{$widget.settings.comments_count}" /> 
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">Маскимальное число символов</div>
    <div class="form_input"> 
        <input type="text" class="textbox_long" name="symbols_count" value="{$widget.settings.symbols_count}" /> 
    </div>
    <div class="form_overflow"></div>

    <div class="form_text"></div>
    <div class="form_input">
        <input type="submit" class="button" value="Сохранить" onclick="ajax_me('widget_form');" /> 
        <a href="#" onclick="ajax_div('page', base_url + 'admin/widgets_manager/'); return false" >Перейти к списку виджетов</a>
    </div>
{form_csrf()}</form>
