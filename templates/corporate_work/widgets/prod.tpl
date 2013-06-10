<div class="blog-news f_l">
            <h3>Обзор продукции</h3>
            <ul>
                {foreach $recent_news as $item}
                <li>
                    <div class="date">
                        <span class="day">{date('d',$item.publish_date)}</span>
                        <span class="mounth">{date('m.Y',$item.publish_date)}</span>
                    </div>
                    <div class="content-new">
                        <a href="{site_url($item.full_url)}">{$item.title}</a>
                        <p>{$item.prev_text}</p>
                    </div>
                </li>
                {/foreach}

            </ul>
                {/*}
            <div class="btn btn-link-ref btn-link-rss ">
                <a href="#"><span class="icon-rss"></span>Подписаться  на блог</a>
            </div>
            { */ }
        </div>



