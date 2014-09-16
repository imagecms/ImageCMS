<!--    menu-row-category || menu-col-category-->
{$openLevels = getOpenLevels()}
{if $openLevels}
    {if $openLevels == 'all'}
        {$menuClass = 'menu-col-category'}
    {else:}
        {$menuClass = 'menu-row-category'}
    {/if}
{else:}
    {$menuClass = 'menu-col-category'}
{/if}
<div class="container">
    <div class="menu-main not-js {$menuClass}">
        <nav>
            <table>
                <tbody>
                    <tr>
                        {$wrapper}
                    </tr>
                </tbody>
            </table>
        </nav>
    </div>
</div>