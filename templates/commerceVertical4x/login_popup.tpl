{#
/**
* @file template file for creating drop-down login form uses imagecms.api.js for submiting and appending validation errors
*/
#}
<div class="drop-enter drop">
    <button type="button" class="icon-times-enter" data-closed="closed-js"></button>
    <div class="drop-content">
        <div class="header_title">
            {lang("Authorization","admin")}
        </div>
        <div class="inside_padd">
            <div class="horizontal_form standart_form">
                <form method="post" id="login_form" onsubmit="ImageCMSApi.formAction('/auth/authapi/login', 'login_form');
                                        return false;">
                    <label>
                        <span class="title">{lang("Email","admin")}</span>
                        <span class="frame_form_field">
                            <span class="icon-email"></span>
                            <input type="text" name="email"/>
                            <label id="for_email" class="for_validations"></label>
                        </span>
                    </label>
                    <label>
                        <span class="title">{lang("Password","admin")}</span>
                        <span class="frame_form_field">
                            <span class="icon-password"></span>
                            <input type="password" name="password"/>
                            <label id="for_password" class="for_validations"></label>
                        </span>
                    </label>
                    <!-- captcha block -->
                    <lable id="captcha_block">
                        
                    </lable>
                    <div class="frameLabel">
                        <span class="title">&nbsp;</span>
                        <span class="frame_form_field c_n">
                            <a href="/auth/forgot_password" class="f_l neigh_btn">{lang("Forgot your password?","admin")}</a>
                            <input type="submit" value="Войти" class="btn btn_cart f_r" />
                        </span>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>