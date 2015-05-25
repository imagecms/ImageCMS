<div class="frame_nav header-menu-out">
    <table class="container">
        <tbody>
        <tr>
            {foreach $menu as $item}
                <td class="{$item.class} {if $item.subMenu or $item.identifier == 'modules'} dropdown{/if}">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{echo $item.text}
                        {if $item.callback}
                            {echo admin_menu\classes\MenuCallback::run($item.callback)}
                        {/if}
                    </a>
                    <ul class="dropdown-menu" {if $item.identifier == 'modules'}style="min-width: 250px;"{/if}>
                        {if $item.identifier == 'modules'}

                            {foreach $modules as $module}
                                <li>
                                    <a style="padding: 3px 15px;"
                                            {if $SAAS}
                                                href="{echo \saas\server\classes\StoreAutologin::getAutologinUrl('/admin/components/cp/' . $module['name'])}"
                                            {else:}
                                                href="/admin/components/cp/{echo $module['name']}"
                                            {/if}
                                            >
                                        {if $module['icon_class']}
                                            <i class="{echo $module['icon_class']}"
                                               style="margin-right: 5px;top: 2px;"></i>
                                        {/if}
                                        {echo $module['menu_name']}
                                        {if $module['callback']}
                                            {echo admin_menu\classes\MenuCallback::run($item.callback)}
                                        {/if}
                                    </a>
                                </li>
                            {/foreach}
                            {if $item.subMenu}
                                <li class="divider"></li>
                            {/if}
                        {/if}
                        {foreach $item.subMenu as $itemSub1}
                            <li {if $itemSub1.header} class="nav-header"{/if}>
                                {if $itemSub1.link || $itemSub1.id}
                                    <a
                                            {if $itemSub1.link}
                                                {if $SAAS}
                                                    href="{echo \saas\server\classes\StoreAutologin::getAutologinUrl($itemSub1.link)}"
                                                {else:}
                                                    href="{echo $itemSub1.link}"
                                                {/if}
                                            {/if}
                                            {if $itemSub1.id} id="{$itemSub1.id}" {/if}
                                            >
                                        {echo $itemSub1.text}
                                        {if $itemSub1.callback}
                                            {echo admin_menu\classes\MenuCallback::run($itemSub1.callback)}
                                        {/if}
                                    </a>
                                {else:}
                                    <a>{echo $itemSub1.text}</a>
                                {/if}

                            </li>
                            {if $itemSub1.divider}
                                <li class="divider"></li>
                            {/if}

                        {/foreach}


                    </ul>
                </td>
            {/foreach}
        </tr>
        </tbody>
    </table>
</div>
