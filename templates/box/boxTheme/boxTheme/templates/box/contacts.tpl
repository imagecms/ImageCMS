<div class="frame-crumbs">
    {widget('path')}
</div>
<div class="frame-inside page-text">
    <div class="container">
        <div class="text-left">{load_menu('left_menu')}</div>
        <div class="text-right">
            <div class="text">
                <h1>{$page.title}</h1>
                <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.ua/maps?f=q&amp;source=s_q&amp;hl=uk&amp;geocode=&amp;q=%D0%92%D0%BE%D0%B4%D0%BE%D0%B3%D1%96%D0%BD%D0%BD%D0%B0+%D0%B2%D1%83%D0%BB.,+2+%D1%81%D0%B0%D0%B9%D1%82%D1%96%D0%BC%D1%96%D0%B4%D0%B6&amp;aq=&amp;sll=49.827656,24.044452&amp;sspn=0.011323,0.033023&amp;t=h&amp;g=%D0%92%D0%BE%D0%B4%D0%BE%D0%B3%D1%96%D0%BD%D0%BD%D0%B0+%D0%B2%D1%83%D0%BB.,+2,+%D0%9B%D0%B8%D1%87%D0%B0%D0%BA%D1%96%D0%B2%D1%81%D1%8C%D0%BA%D0%B8%D0%B9+%D1%80%D0%B0%D0%B9%D0%BE%D0%BD,+%D0%9B%D1%8C%D0%B2%D1%96%D0%B2,+%D0%9B%D1%8C%D0%B2%D1%96%D0%B2%D1%81%D1%8C%D0%BA%D0%B0+%D0%BE%D0%B1%D0%BB%D0%B0%D1%81%D1%82%D1%8C&amp;ie=UTF8&amp;hq=%D1%81%D0%B0%D0%B9%D1%82%D1%96%D0%BC%D1%96%D0%B4%D0%B6&amp;hnear=%D0%92%D0%BE%D0%B4%D0%BE%D0%B3%D1%96%D0%BD%D0%BD%D0%B0+%D0%B2%D1%83%D0%BB.,+2,+%D0%9B%D1%8C%D0%B2%D1%96%D0%B2,+%D0%9B%D1%8C%D0%B2%D1%96%D0%B2%D1%81%D1%8C%D0%BA%D0%B0+%D0%BE%D0%B1%D0%BB%D0%B0%D1%81%D1%82%D1%8C&amp;ll=49.827656,24.044452&amp;spn=0.002831,0.008256&amp;z=14&amp;iwloc=A&amp;cid=16384824365677287861&amp;output=embed"></iframe><br /><br />
                {$page.full_text}

                {$Comments = $CI->load->module('comments')->init($page)}
                {$c=$CI->load->module('comments/commentsapi')->renderAsArray($CI->uri->uri_string())}
                <div class="forComments p_r">
                    {echo $c['comments']}
                </div>
            </div>
        </div>
    </div>
</div>