<div class="company-news aside-jaw">
    <h3>{lang('Новости компании','corporate')}</h3>
    <ul>
        {foreach $recent_news as $item}
            <li>
                <div class="date">
                    <span class="day">{date('d',$item.publish_date)}.</span><span class="mounth">{date('m.Y',$item.publish_date)}</span>
                </div>
                <p><a href="{site_url($item.full_url)}">{$item.title}</a></p>
                <p>{lang('Позволяет пользователям сформировать заказ на покупку, выбрать способ оплаты и доставки заказа в сети Интернет','corporate')}.</p>
            </li>
        {/foreach}
    </ul>        
</div>
<div class="btn">
    <a href="{site_url('novosti')}">{lang('Архив новостей','corporate')}</a>
</div>