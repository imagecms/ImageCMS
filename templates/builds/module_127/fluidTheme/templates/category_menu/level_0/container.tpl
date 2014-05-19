<!--    menu-row-category || menu-col-category-->
<div class="container">
    <div class="menu-main not-js menu-row-category">
        <nav>
            <table>
                <tbody>
                    <tr>
                        <td class="mq-w-480 mq-min mq-table-cell">
                            <div class="frame-item-menu-out frameItemMenu">
                                <div class="frame-title is-sub">
                                    <span class="title title-united"><span class="helper"></span><span class="text-el">{lang('Каталог', 'newLevel')}</span></span>
                                    <span class="icon-is-sub"></span>
                                </div>
                                <div class="frame-drop-menu" id="unitedCatalog">
                                </div>
                            </div>
                        </td>
                        <td data-mq-max="768" data-mq-min="0" data-mq-target="#unitedCatalog" class="mq-w-480 mq-max mq-table-cell">
                            <table>
                                <tbody>
                                    <tr>
                                        {$wrapper}
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td class="mq-w-480 mq-min mq-table-cell">
                            <div class="frame-item-menu frameItemMenu">
                                <div class="frame-title is-sub">
                                    <span class="title title-united"><span class="helper"></span><span class="text-el">{lang('Магазин', 'newLevel')}</span></span>
                                    <span class="icon-is-sub"></span>
                                </div>
                                <div class="frame-drop-menu" id="topMenuInMainMenu">

                                </div>
                            </div>
                        </td>
                        <td class="frame-search-form">
                            <div class="p_r">
                                <div class="btn-search-show-hide">
                                    <button type="button" class="icon_search mq-inline-block mq-w-480 mq-min" data-drop="[name='search']" data-place="inherit" data-overlay-opacity="0" data-before="beforeShowSearch" data-close="afterHideSearch" data-closed="closedSearch"><span class="text-el">{lang('Скрыть', 'newLevel')}</span></button>
                                </div>
                                <form name="search" method="get" action="{shop_url('search')}" class="mq-block mq-w-768 mq-max">
                                    <input type="text" class="input-search" id="inputString" name="text" autocomplete="off" value="{if strpos($CI->uri->uri_string, 'search') !== false}{htmlspecialchars($_GET['text'])}{else:}{lang('Поиск по сайту', 'newLevel')}{/if}" data-val="{lang('Поиск по сайту', 'newLevel')}" {if strpos($CI->uri->uri_string, 'search') === false}onfocus="if ($(this).val() == $(this).data('val'))
                                                $(this).val('')" onblur="if($(this).val() != $(this).data('val')) $(this).val($(this).data('val'))"{/if}/>
                                    <span class="btn-search">
                                        <button type="submit"><span class="icon_search"></span><span class="text-el">{lang('Найти','newLevel')}</span></button>
                                    </span>
                                    <div id="suggestions" class="drop drop-search"></div>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </nav>
    </div>
</div>
{literal}
    <script>
        function beforeShowSearch(el, drop) {
            el.closest('td').prevAll().hide();
            el.css('position', 'static');
            drop.removeAttr('style');
        }
        function afterHideSearch(el, drop) {
            el.closest('td').find('form').hide();
            el.closest('td').prevAll().show().css('display', '');
            el.css('position', '');
        }
        function closedSearch(el, drop){
            drop.removeAttr('style');
        }
    </script>
{/literal}