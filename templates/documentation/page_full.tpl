<div class="frame-inside">
    <div class="">
        {/*<div class="crumbs-custome">
        {widget('path')}
        </div>*/}
        <div class="clearfix">
            <div class="text left container">
                <h1 class="titleEditTinyMCE">{$page.title}</h1>
                <ul class="nav nav-tabs" id="my-tabs">
                    <li class="dropdown">
                        {if !$otherVersion}
                            <a href="#currentVersion" data-toggle="tab">Текущая версия 4.6</a>
                        {else:}
                            <a id="drop1" role="button" data-toggle="dropdown" href="#">Выберете версию <b class="caret"></b></a>
                            <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
                                <li><a href="#currentVersion" data-toggle="tab">Текущая версия 4.6.1</a></li>
                                <li><a href="#" data-toggle="tab">Версия 4.6</a></li>
                            </ul>
                        {/if}
                    </li>
                    {/*<li><a href="#" data-toggle="tab">Видео</a></li>*/}
                    <li><a href="#QA" data-toggle="tab">Q&A</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="currentVersion">
                        <div class="descriptionEditTinyMCE">
                            {echo $CI->load->module('documentation')->preTags($page.full_text)}
                        </div>
                    </div>
                    <div class="tab-pane active" id="QA">
                        {$Comments = $CI->load->module('comments')->init($page)}
                        <script type="text/javascript">
                            {literal}
                                $(function() {
                                    renderPosts($('.for_comments'));
                                });
                            {/literal}
                        </script>
                        <div id="comment">
                            <div class="for_comments" id="comment-documentation"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{literal}
    <script>
        $('document').ready(function() {
            if ($('#menu1').length > 0)
                $('#menu1 a:first').tab('show'); // Select first tab
            else {
                $('#my-tabs a:first').tab('show') // Select first tab
            }
        });
    </script>
{/literal}