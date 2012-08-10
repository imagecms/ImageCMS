<div class="top-navigation">
    <ul>
        <li><p>{lang('amt_widget_settings')}<b>{$widget.name}</b></p></li>
    </ul>
</div>

<form action="{$BASE_URL}admin/widgets_manager/update_widget/{$widget.id}" id="widget_form" method="post">
    <div class="form_text">{lang('amt_display_comment_count')}</div>
    <div class="form_input"> 
        <input type="text" class="textbox_long" name="comments_count" value="{$widget.settings.comments_count}" /> 
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{lang('amt_max_char_count')}</div>
    <div class="form_input"> 
        <input type="text" class="textbox_long" name="symbols_count" value="{$widget.settings.symbols_count}" /> 
    </div>
    <div class="form_overflow"></div>

    <div class="form_text"></div>
    <div class="form_input">
        <input type="submit" class="button" value="{lang('amt_save')}" onclick="ajax_me('widget_form');" /> 
        <a href="#" onclick="ajax_div('page', base_url + 'admin/widgets_manager/'); return false" >{lang('amt_to_widget_list')}</a>
    </div>
{form_csrf()}</form>
