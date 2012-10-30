<form method="post" action="{$BASE_URL}admin/categories/translate/{$orig_cat.id}/{$lang}" id="edit_cat_form_t" style="width:100%;">

<div id="edit_cat_tabs_t">
    <div style="padding:2px;">
        <div class="form_text"></div>
        <div class="form_input"><h3>{lang('a_cat_translate')} {$orig_cat.name}</h3></div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('a_name')}:</div>
        <div class="form_input"><input type="text" name="name" id="cat_name" value="{$cat.name}" class="textbox_long" /></div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('a_image')}:</div>
        <div class="form_input">
            <input type="text" name="image" id="cat_image_t" value="{$cat.image}" class="textbox_long" />
            <img src="{$THEME}/images/images.png" width="16" height="16" title="{lang('a_select_image')}" style="cursor:pointer;" align="absmiddle"  onclick="tinyBrowserPopUp('image', 'cat_image_t');" />
        </div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('a_desc')}:</div>
        <div class="form_input">
             <textarea name="short_desc" id="short_desc" class="mceEditor textarea">{htmlspecialchars($cat.short_desc)}</textarea>
        </div>
        <div class="form_overflow"></div>
    </div>


    <div>
        <div class="form_text">{lang('a_meta_title')}:</div>
        <div class="form_input"><input type="text" name="title" value="{$cat.title}" class="textbox_long" /></div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('a_meta description')}:</div>
        <div class="form_input"><textarea name="description" rows="2" cols="48">{$cat.description}</textarea></div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('a_meta keywords')}:</div>
        <div class="form_input"><textarea name="keywords" rows="2" cols="48">{$cat.keywords}</textarea></div>
        <div class="form_overflow"></div>
    </div>

</div>


<div class="form_text"></div>
<div class="form_input">
    <input type="submit" name="button" class="button" value="{lang('a_save')}" onclick="ajax_me('edit_cat_form_t');" />
    <input type="submit" name="button" class="button" value="{lang('a_cancel')}" onclick="MochaUI.closeWindow($('translate_category_w')); return false;" />
    <br/>
    <br/>
<div class="form_overflow"></div>
</div>

{form_csrf()}
</form>
