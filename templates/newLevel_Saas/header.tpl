<div class="container">
    <div class="logo">
        <img src="{$THEME}img/logo.jpg" alt="Логотип"/>
    </div>
    <ul class="right-header items">
        <li class="item-profile">
            <button type="button" class="btn-profile btn">
                <span class="frame-ico">
                    <span class="helper"></span>
                    <span class="icon-person"></span>
                </span>
                <span class="d_i-b">
                    <span class="text-el">Профиль</span>
                    <span class="icon-arrow"></span>
                </span>
            </button>
            <ul class="drop nav">
                <li>
                    <a href="#">
                        <span class="text-el">Личные данные</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="text-el">Выход</span>
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
                <span class="text-el">Магазин</span>
            </a>
        </li>
        <li>
            <span class="divider"></span>
        </li>
        <li>
            <a href="{site_url('')}" class="btn-admin btn">
                <span class="text-el">Админчасть</span>
            </a>
        </li>
    </ul>
    <div class="content-header">
        <a href="#" class="header-out-info-lost">
            Осталось 
            <span style="font-size: 22px;">14</span>
            дней 
        </a>
        <div class="info-header">
            <span class="info-text-phone">
                Незнаете с чего начать?
                <span class="d_i-b">{echo siteinfo('siteinfo_mainphone')}</span>
            </span>
            <a href="#consult" class="btn-consultation fancybox">
                <span class="text-el">Консультация</span>
            </a>
        </div>
    </div>
</div>