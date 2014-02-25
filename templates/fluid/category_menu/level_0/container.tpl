<!--    menu-row-category || menu-col-category-->
<div class="container">
    <div class="menu-main not-js menu-col-category">
        <nav>
            <table>
                <tbody>
                    <tr>
                        {$wrapper}
                        <td class="frame-search-form">
                            <div class="p_r">
                                <form name="search" method="get" action="{shop_url('search')}">
                                    <span class="btn-search">
                                        <button type="submit"><span class="icon_search"></span><span class="text-el">{lang('Найти','newLevel')}</span></button>
                                    </span>
                                    <div class="frame-search-input">
                                        <input type="text" class="input-search" id="inputString" name="text" autocomplete="off" value="{if strpos($CI->uri->uri_string, 'search') !== false}{htmlspecialchars($_GET['text'])}{else:}{lang('Поиск по сайту', 'newLevel')}{/if}" data-val="{lang('Поиск по сайту', 'newLevel')}" {if strpos($CI->uri->uri_string, 'search') === false}onfocus="if ($(this).val() == $(this).data('val')) $(this).val('')" onblur="if ($(this).val() != $(this).data('val')) $(this).val($(this).data('val'))"{/if}/>
                                        <div id="suggestions" class="drop drop-search"></div>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </nav>
    </div>
</div>