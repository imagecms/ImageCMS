{$openLevels = getOpenLevels()}
{if $openLevels == 'all'}
    {$menuClass = 'menu-col-category'}
{else:}
    {$menuClass = 'menu-row-category'}
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