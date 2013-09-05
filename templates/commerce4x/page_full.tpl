{$page = $CI->load->module('cfcm')->connect_fields($page, 'page')}
<div class="container">
    <div class="row">
        <div class="span3">
            {if  $CI->uri->uri_string() != ''}
                 {load_menu('left_menu')}
            {/if}
        </div>
        <div class="span6">
            <article>
                <h1>{echo encode($page.title)}</h1>
                <div class="text">
                    {if $page.id == 68 || $page.lang_alias == 68}
                        <div class="map">
                            <img src="{$THEME}images/map.jpg" alt="map"/>
                        </div> 
                            {$page.full_text}
                    {else:}
                        {$page.full_text}
                    {/if}
                </div>
                    {$Comments = $CI->load->module('comments')->init($page)}

                    <script type="text/javascript">
                        {literal}
                            $(function() {
                                renderPosts($('[name=for_comments]'));
                            })
                        {/literal}
                    </script>
                    <div id="comment">
                        <div id="for_comments" name="for_comments"></div>
                    </div>
            </article>
        </div>
    </div>
</div>