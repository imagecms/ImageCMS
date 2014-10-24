<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Comment editing', 'comments')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    
                    <a href="{if $_SERVER['HTTP_REFERER']}{echo $_SERVER['HTTP_REFERER']}{else:}{site_url('admin/components/cp/comments')}{/if}" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back', 'admin')}</span></a>
                    <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-form="#update" data-action="close"><i class="icon-ok"></i>{lang("Save", 'comments')}</button>
                    <button type="button" class="btn btn-small action_on formSubmit" data-form="#update" data-action="exit"><i class="icon-check"></i>{lang('Save and exit', 'admin')}</button>

                </div>
            </div>
        </div>
        <div class="tab-pane">
            <table class="table  table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th colspan="6">
                            {lang("Settings", 'comments')}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd">
                                <div class="form-horizontal">
                                    <div class="row-fluid">
                                        <form id="update" method="post" action="/admin/components/cp/comments/update">

                                            <div class="control-group">
                                                <label class="control-label" for="username">{lang("Author", 'comments')}:</label>
                                                <div class="controls">
                                                    <input type="text" name="user_name" value="{$comment.user_name}" />
                                                    <input type="hidden" name="id" value="{$comment.id}" />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="email">{lang("E-Mail", 'comments')}:</label>
                                                <div class="controls">
                                                    <input type="text" name="user_mail" value="{$comment.user_mail}"/>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="role_id">{lang("Status", 'comments')}:</label>
                                                <div class="controls">
                                                    <select id="comment_status" name="status">
                                                        <option value="0" {if $comment.status == 0} selected="selected" {/if}>{lang("Approved", 'comments')}</option>
                                                        <option value="1" {if $comment.status == 1} selected="selected" {/if}>{lang("Pending approval", 'comments')}</option>
                                                        <option value="2" {if $comment.status == 2} selected="selected" {/if}>{lang("Spam", 'comments')}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="email">{lang("Contents", 'comments')}:</label>
                                                <div class="controls">
                                                    <textarea id="comment_text" name="text" style="width:300px;height:180px;">{$comment.text}</textarea>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>