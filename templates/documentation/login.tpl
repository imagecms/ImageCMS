<div class="container">
    <div class="page-header">
        <h1 style="display: inline-block;">{lang('Authorization','documentation')}</h1>
    </div>
    <div class="pull-left">
        {if $errors}
            <div class="alert alert-block alert-danger fade in">
                {echo $errors}
            </div>
        {/if}
        <form class="navbar-form navbar-right pull-right" method="post" id="login_form" onsubmit="'/auth/authapi/login';">
            <label>
                <span class="title">{lang('E-mail','newLevel')}</span>
                <span class="must">*</span>
            </label>
            <div class="form-group">
                <input type="text" name="email" placeholder="Email" class="form-control"/>

            </div>
            <label>
                <span class="title">{lang('Password','newLevel')}</span>
                <span class="must">*</span>
            </label>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" class="form-control"/>
            </div>
            <!-- captcha block -->
            <div class="form-group">
            <lable id="captcha_block">
                {if $cap_image}
                    <span class="title">{lang("Code protection","admin")}</span>
                    <span class="frame_form_field">
                        {if $captcha_type == 'captcha'}
                            <input type="text" name="captcha" placeholder="{lang("Code protection","admin")}"/>
                            <span class="help_inline">{$cap_image}</span>
                            <label id="for_captcha" class="for_validations"></label>
                        {/if}
                    </span>
                {/if}
            </lable>
            </div>
            <button type="submit" class="btn btn-success">
                <span class="glyphicon glyphicon-log-in"></span>
                {lang('Sign in','documentation')}
            </button>
            {form_csrf()}
        </form>
    </div>
</div>