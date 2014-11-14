<div class="frame-inside">
    <div class="container">
        <h1><?php echo lang ('Регистрация','corporate'); ?></h1>
        <div class="vertical-form w_50">
            <?php if(validation_errors() OR $info_message): ?>
                <div class="msg">
                    <div class="error"> 
                        <div class="text-el">
                            <?php echo validation_errors (); ?>
                            <?php if(isset($info_message)){ echo $info_message; } ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <form id="register-form" onsubmit="ImageCMSApi.formAction('<?php echo site_url ('/auth/authapi/register'); ?>', '#register-form');
                    return false;">
                <label>
                    <span class="title"><?php echo lang ('E-mail','corporate'); ?></span>
                    <span class="frame-form-field">
                        <input type="text" size="30" name="email" id="email" value="<?php echo set_value ('email'); ?>" />
                    </span>
                </label>
                <label>
                    <span class="title"><?php echo lang ('ФИО','corporate'); ?></span>
                    <span class="frame-form-field">
                        <input type="text" size="30" name="username" id="username" value="<?php echo set_value ('username'); ?>"/>
                    </span>
                </label>
                <label>
                    <span class="title"><?php echo lang ('Пароль','corporate'); ?></span>
                    <span class="frame-form-field">
                        <input type="password" size="30" name="password" id="password" value="<?php echo set_value ('password'); ?>" />
                    </span>
                </label>
                <label>
                    <span class="title"><?php echo lang ('Повторите Пароль','corporate'); ?></span>
                    <span class="frame-form-field">
                        <input type="password" class="text" size="30" name="confirm_password" id="confirm_password" />
                        </spans>
                </label>

                <?php if($cap_image): ?>
                    <label>
                        <span class="title">&nbsp;</span>
                        <span class="frame-form-field">
                            <input type="text" name="captcha" id="captcha"/>
                        </span>
                        <?php if(isset($cap_image)){ echo $cap_image; } ?>
                    </label>
                <?php endif; ?>
                <div class="frame-label">
                    <span class="frame-form-field">
                        <div class="btn">
                            <input type="submit" id="submit" class="submit" value="<?php echo lang ('Отправить','corporate'); ?>" />
                        </div>
                    </span>
                </div>
                <button class="d_l" data-drop=".drop-forgot" data-source="<?php echo site_url ('auth/forgot_password'); ?>"><?php echo lang ('Забыли Пароль?','corporate'); ?></button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button class="d_l" data-drop=".drop-enter" data-source="<?php echo site_url ('auth'); ?>"><?php echo lang ('Вход', 'corporate'); ?></button>
                <input type="hidden" name="refresh" value="false"/>
                <input type="hidden" name="redirect" value="<?php echo site_url ('/'); ?>"/>
                <?php echo form_csrf (); ?>
            </form>
        </div>
    </div>
</div><?php $mabilis_ttl=1415876627; $mabilis_last_modified=1415789038; ///var/www/image-c.loc/templates/corporate/register.tpl ?>