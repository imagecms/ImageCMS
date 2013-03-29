<div class="content-footer">
    <div class="container">
        <div class="box">
            {if $CI->uri->total_segments() > 0}
                <a href="{site_url('')}" class="logo d_b"><img src="{$THEME}images/logo.png" alt="logo.png"/></a>
                {else:}
                <span class="logo d_b"><img src="{$THEME}images/logo.png" alt="logo.png"/></span>
                {/if}
            <p>© {echo date('Y', time())} Интернет-супермаркет «Negro»<br/>Все права защищены</p>
            <div class="social-block-footer">
                <a href="#" class="vk icon-"></a>
                <a href="#" class="fb icon-"></a>
                <a href="#" class="tw icon-"></a>
            </div>
        </div>
        <div class="box">
            <div class="title_h3">Сайт</div>
            <ul>
                {load_menu('top_menu')}
            </ul>
        </div>
        <div class="box">
            <div class="title_h3">Продукция</div>
             {load_menu('top_menu')}
        </div>
        <div class="box">
            <div class="title_h3">Мы принимаем</div>
            <div class="frame-method-pay icon-">
                <span class="helper"></span>
                <div class="master icon-"></div>
            </div>
            <div class="frame-method-pay icon-">
                <span class="helper"></span>
                <div class="visa icon-"></div>
            </div>
            <div class="frame-method-pay icon-">
                <span class="helper"></span>
                <div class="webmoney icon-"></div>
            </div>
            <div class="frame-method-pay icon-">
                <span class="helper"></span>
                <div class="privat24 icon-"></div>
            </div>
        </div>
    </div>
</div>
<div class="footer-footer">
    <div class="container">
        <div class="f_l">
            <a href="#"><span class="icon-mobile-version"></span>Мобильная версия</a>
        </div>
        <div class="f_r">Раскрутка и разработка сайта  —  компания <a target="_blank" href="http://www.siteimage.com.ua/"><span class="icon-siteimage"></span>Siteimage</a></div>
    </div>
</div>