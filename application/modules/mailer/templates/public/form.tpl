
<div class="frame_form_search" style="float: left;padding: 38px 0 0 50px;position: absolute;">

    <form action="{$BASE_URL}mailer" method="post"  style="">
    
    <input type="text" name="user_email" /><br />
    <label><input type="radio" name="add_user_mail" checked="true" value="2"/>{lang("Subscribe", 'mailer')}<br /></label>
    <label><input type="radio" name="add_user_mail" value="1" />{lang("Unsubscribe", 'mailer')}<br /></label>
    <div >
        <input type="submit" value="ok" />
    </div>
    {form_csrf()}
    </form>
    </div>