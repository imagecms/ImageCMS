<div>
	<div class="form_text">{lang('amt_author')}:</div>
	<div class="form_input"><input type="text" class="textbox_long" value="{$comment.user_name}" id="comment_author" /></div>
	<div class="form_overflow"></div>

	<div class="form_text">{lang('amt_email')}:</div>
	<div class="form_input"><input type="text" class="textbox_long" value="{$comment.user_mail}" id="comment_email" /></div>
	<div class="form_overflow"></div>

	<div class="form_text">{lang('amt_status')}:</div>
	<div class="form_input">
        <select id="comment_status">
            <option value="0" {if $comment.status == 0} selected="selected" {/if}>{lang('amt_app')}</option>
            <option value="1" {if $comment.status == 1} selected="selected" {/if}>{lang('amt_waiting_for_app')}</option>
            <option value="2" {if $comment.status == 2} selected="selected" {/if}>{lang('amt_spam')}</option>
        </select>
    </div>
	<div class="form_overflow"></div>

	<div class="form_text">{lang('amt_content')}:</div>
	<div class="form_input">
        <textarea id="comment_text" style="width:300px;height:180px;">{$comment.text}</textarea>
    </div>
	<div class="form_overflow"></div>

	<div class="form_text"></div>
	<div class="form_input">
        <input type="submit" name="button" class="button" value="{lang('amt_save')}" onclick="update_comment_data({$comment.id});" />
        <input type="button" name="button" class="button" value="{lang('amt_cancel')}" onclick="MochaUI.closeWindow($('edit_comment_window')); return false;" />
	</div>
</div>

{literal}
<script type="text/javascript">

    function update_comment_data(c_id)
    {
        var c_author = $('comment_author').value;
        var c_email  = $('comment_email').value;
        var c_text  = $('comment_text').value;
        var c_status  = $('comment_status').value;

		var req = new Request.HTML({
			method: 'post',
			url: base_url + 'admin/components/cp/comments/update/',
			onComplete: function(response) {
{/literal}
                {if $update_list == 1} 
                        ajax_div('page', comments_cur_url);
                {/if}

                {if $update_list == 'dashboard'} 
                        ajax_div('page', base_url + 'admin/dashboard/index');
                {/if}
{literal}
                }
		}).post({'id': c_id, 'text': c_text, 'user_mail': c_email, 'user_name': c_author, 'status': c_status});

        MochaUI.closeWindow($('edit_comment_window'));
    }

</script>
{/literal}
