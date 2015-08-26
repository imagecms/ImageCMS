{use admin_menu\classes\AdminMenuBuilder;}

<div class="frame_nav">
    <table class="container">
        <tbody>
        <tr>
            {foreach $menu as $item}
                <td
                        data-identifier="{echo $item.identifier}"
                        data-text="{echo $item.text}"
                        data-link="{echo $item.link}"
                        data-class="{echo $item.class}"
                        data-id="{echo $item.id}"
                        data-pjax="{echo $item.pjax}"
                        data-icon="{echo $item.icon}"
                        data-divider="{echo $item.divider}"
                        data-callback="{echo $item.callback}"

                        class="{$item.class} {if $item.subMenu or $item.identifier == 'modules'}dropdown{/if}">

                    <a href="#" class="dropdown-toggle"
                       data-toggle="dropdown">{echo AdminMenuBuilder::getItemName($item.text)}
                        {if $item.callback}
                            {echo admin_menu\classes\MenuCallback::run($item.callback)}
                        {/if}
                    </a>

                    <ul class="dropdown-menu sortableT"
                        {if $item.identifier == 'modules'}style="min-width: 250px;"{/if}>
                        {foreach $item.subMenu as $itemSub1}
                            <li
                                    data-identifier="{echo $itemSub1.identifier}"
                                    data-text="{echo $itemSub1.text}"
                                    data-link="{echo $itemSub1.link}"
                                    data-class="{echo $itemSub1.class}"
                                    data-id="{echo $itemSub1.id}"
                                    data-pjax="{echo $itemSub1.pjax}"
                                    data-icon="{echo $itemSub1.icon}"
                                    data-divider="{echo $itemSub1.divider}"
                                    data-callback="{echo $itemSub1.callback}"

                                    {if $itemSub1.header} class="nav-header"{/if}>
                                {if $itemSub1.link || $itemSub1.id}
                                    <a {if $itemSub1.id} id="{$itemSub1.id}" {/if}>
                                        {echo AdminMenuBuilder::getItemName($itemSub1.text)}
                                    </a>
                                {else:}
                                    <a>{echo AdminMenuBuilder::getItemName($itemSub1.text)}</a>
                                {/if}
                            </li>
                            {if $itemSub1.divider}
                                <li class="divider">
                                </li>
                            {/if}
                        {/foreach}
                    </ul>
                </td>
            {/foreach}
        </tr>
        </tbody>
    </table>
</div>
{$curentLocale = $CI->config->item('language');\MY_Lang::setLang($curentLocale);}
