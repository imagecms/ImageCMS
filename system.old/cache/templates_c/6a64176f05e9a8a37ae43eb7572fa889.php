<?php if(!$is_logged_in): ?>
    <nav class="nav nav-enter-reg f_r">
        <ul>
            <li class="btn-enter user-btn">
                <button type="button" 
                        data-drop=".drop-enter"
                        data-source="<?php echo site_url ('auth'); ?>">
                    <span class="icon-enter"></span>
                    <span><?php echo lang ('Вход', 'corporate'); ?></span>
                </button>
            </li>
            <li class="btn-reg user-btn">
                <a href="<?php echo site_url ('auth/register'); ?>">
                    <span class="icon-reg"></span>
                    <span><?php echo lang ('Регистрация', 'corporate'); ?></span>
                </a>
            </li>
        </ul>
    </nav>
<?php else:?>
    <nav class="nav nav-user-profile f_r">
        <ul>
            <li class="user-btn active">
                <button type="button">
                    <span class="f-w_n"><?php echo lang ('Вы вошли как', 'corporate'); ?>&nbsp;</span><span class="user-name"><?php echo $CI->dx_auth->get_username()?></span>
                </button>
            </li>
            <li class="btn-exit user-btn">
                <a href="<?php echo site_url ('auth/logout'); ?>">
                    <span class="icon-exit"></span>
                    <span><?php echo lang ('Выход', 'corporate'); ?></span>
                </a>
            </li>
        </ul>
    </nav>
<?php endif; ?><?php $mabilis_ttl=1415876595; $mabilis_last_modified=1415789038; ///var/www/image-c.loc/templates/corporate/auth_data.tpl ?>