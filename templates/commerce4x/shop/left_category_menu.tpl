
    <nav class="menu_vertical_side m-b_10">
        <ul class="nav">
            <li>
                <span class="title">{echo $cat_main->getname()}</span>
                <ul>
                    {foreach $category as $menu}
                        <li>
                            <a href="{shop_url('category/' . $menu->getfullpath())}" title="{$menu->getname()}">
                                {echo $menu->getname()}
                            </a>
                        </li>
                    {/foreach}
                </ul>
            </li>

        </ul>
    </nav>
