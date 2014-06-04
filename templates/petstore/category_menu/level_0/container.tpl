<!--    menu-row-category || menu-col-category-->
<div class="container">
    <div class="menu-main not-js menu-col-category">
        <nav>
            <table>
                <tbody>
                    <tr>
                       <td class="mq-table-cell mq-w-320 mq-w-480 mq-min">
                            <div class="frame-item-menu-out frameItemMenu">
                                <div class="frame-title is-sub">
                                    <span class="title title-united"><span class="helper"></span><span class="icon-catalog"></span><span class="text-el mq-mq-w-320 mq-w-480 mq-min mq-inline">{lang('Каталог продукции', 'newLevel')}</span></span>
                                </div>
                                <div class="frame-drop-menu" id="unitedCatalog">
                                </div>
                            </div>
                        </td>


                         <td data-mq-max="767" data-mq-min="0" data-mq-target="#unitedCatalog" class="mq-w-768 mq-max mq-table-cell">
                            <table>
                                <tbody>
                                    <tr>
                                        {$wrapper}
                                    </tr>
                                </tbody>
                            </table>
                        </td>


                         <td class="mq-w-480 mq-min mq-table-cell" id="topSearchShop">

                        </td>
                    </tr>
                </tbody>
            </table>
        </nav>
    </div>
</div>