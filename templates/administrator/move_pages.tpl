{lang("Select a category","admin")}:
<select id="move_cat_id">
<option value="0" selected="selected">{lang("No","admin")}</option>
{ $this->view("cats_select.tpl", $this->template_vars); }
</select>
<br/>
<br/>
<div align="center">
<input type="submit" name="button"  class="button" value="{lang("Send","admin")}" onclick="move_to_cat('{$action}'); MochaUI.closeWindow($('move_pages_window')); return false;" />
<input type="submit" name="button"  class="button" value="{lang("Cancel","admin")}" onclick="MochaUI.closeWindow($('move_pages_window')); return false;" />
</div>
