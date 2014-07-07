<div class="container">
    <div class="logo">
        <a href="{echo site_url()}">
            <img src="{$THEME}img/logo.jpg" alt="{echo lang('Логотип', 'premmerce')}"/>
        </a>
    </div>
    <ul class="right-header items">
        <li class="item-profile">
            <button type="button" class="btn-profile btn">
                <span class="frame-ico">
                    <span class="helper"></span>
                    <span class="icon-person"></span>
                </span>
                <span class="d_i-b">
                    <span class="text-el">{echo lang('Профиль', 'premmerce')}</span>
                    <span class="icon-arrow"></span>
                </span>
            </button>
            <ul class="drop nav">
                <li>
                    <a href="#">
                        <span class="text-el">{echo lang('Личные данные', 'premmerce')}</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="text-el">{echo lang('Выход', 'premmerce')}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="btn-shop btn">
                <span class="frame-ico">
                    <span class="helper"></span>
                    <span class="icon-bask"></span>
                </span>
                <span class="text-el">{echo lang('Магазин', 'premmerce')}</span>
            </a>
        </li>
        <li>
            <span class="divider"></span>
        </li>
        <li>
            <a href="{site_url('')}" class="btn-admin btn">
                <span class="text-el">{echo lang('Админчасть', 'premmerce')}</span>
            </a>
        </li>
    </ul>
    <div class="content-header">
        <a href="#" class="header-out-info-lost">
            {echo lang('Осталось', 'premmerce')} 
            <span style="font-size: 22px;">14</span>
            {echo lang('дней', 'premmerce')}
        </a>
        <div class="info-header">
            <span class="info-text-phone">
                Незнаете с чего начать?
                <span class="d_i-b">{echo siteinfo('siteinfo_mainphone')}</span>
            </span>
            <a href="#consult" class="btn-consultation fancybox">
                <span class="text-el">{echo lang('Консультация', 'premmerce')}</span>
            </a>
        </div>
    </div>
</div>