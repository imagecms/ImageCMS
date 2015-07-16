<footer class="b-footer">
    <div class="b-footer__inner">
        <div class="g-container">
            <div class="g-row g-row_indent-20">
                <div class="g-col-4 g-col-4_from-l g-col-6_from-m g-col-12_xs">
                    <div class="b-footer__section">
                        {if trim(siteinfo('copytight')) != ""}
                            <div class="b-footer__title">
                                {echo siteinfo('copytight')}
                            </div>
                        {/if}
                        {if trim(siteinfo('copytight_desc')) != ""}
                            <p class="b-footer__item">
                                {echo siteinfo('copytight_desc')}
                            </p>
                        {/if}
                        <div class="b-footer__item">
                            <div class="b-socgroups">
                                {if siteinfo('vk_group') != ""}
                                    <a class="b-socgroups__item b-socgroups__item_vk fa fa-vk fa-lg" href="{siteinfo('vk_group')}" target="_blank"></a>
                                {/if}
                                {if siteinfo('fb_group') != ""}
                                    <a class="b-socgroups__item b-socgroups__item_fb fa fa-facebook fa-lg" href="{siteinfo('fb_group')}" target="_blank"></a>
                                {/if}
                                {if siteinfo('google_group') != ""}
                                    <a class="b-socgroups__item b-socgroups__item_gp fa fa-google-plus fa-lg" href="{siteinfo('google_group')}" target="_blank"></a>
                                {/if}
                                {if siteinfo('youtube_group') != ""}
                                    <a class="b-socgroups__item b-socgroups__item_yt fa fa-youtube fa-2x" href="{siteinfo('youtube_group')}" target="_blank"></a>
                                {/if}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="g-col-2 g-col-2_from-l g-col-6_from-m g-col-12_xs">
                    <div class="b-footer__section">
                        <div class="b-footer__title">
                            {tlang('Company')}
                        </div>
                        <nav class="b-footer__item">
                            {load_menu('footer_menu')}
                        </nav>
                    </div>
                </div>
                <div class="g-col-3 g-col-3_from-l g-col-6_from-m g-col-12_xs">
                    <div class="b-footer__section">
                        <div class="b-footer__title">
                            {tlang('Contacts')}
                        </div>
                        <div class="b-footer__item">
                            {if trim(siteinfo('schedule')) != ""}
                                <p>
                                    {echo siteinfo('schedule')}
                                </p>
                            {/if}
                            {if trim(siteinfo('address')) != ""}
                                <address>
                                    {echo siteinfo('address')}
                                </address>
                            {/if}
                            {if trim(siteinfo('mainphone')) != ""}
                                <p>
                                    {echo siteinfo('mainphone')}
                                </p>
                            {/if}
                            <p>
                                <a class="g-link_footer" href="{site_url('feedback')}">{tlang('Feedback')}</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="g-col-3 g-col-3_from-l g-col-6_from-m g-col-12_xs">
                    <div class="b-footer__section">
                        <div class="b-footer__title">
                            {tlang('Search for articles')}
                        </div>
                        <div class="b-footer__item">
                            <form class="g-form-s" action="{site_url('search')}" method="post">
                                <label class="g-form-s__section g-form-s_icon-left">
                                    <input class="g-form-s__input" type="text" name="text" value="{$search_title}" placeholder="{tlang('Search')}" required>
                                    <i class="g-form-s__icon fa fa-search"></i>
                                </label>
                                <input class="g-form-s__submit" type="submit" value="{tlang('Search')}">
                                {form_csrf()}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="b-footer__line">
        <div class="g-container">
            <div class="g-row g-row_indent-10">
                <div class="g-col-6 g-col-12_from-s">
                    <div class="b-footer__line-left">
                        {include_tpl('main_profile')}
                    </div>
                </div>
                <div class="g-col-6 g-col-12_from-s">
                    <div class="b-footer__line-right">
                        <p class="b-engine">{tlang('Powered by ')} <a class="g-link_footer" target="_blank" href="http://www.imagecms.net">{tlang('ImageCMS')}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>