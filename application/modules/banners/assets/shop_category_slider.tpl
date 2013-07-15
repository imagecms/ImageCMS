    <div class="mainFrameBaner">
        <section class="container">

            <div class="frame_baner">
                <ul class="cycle">
                    {foreach $banners as $banner}
                    <li>
                        {if trim($banner['url'])}
                            <a href="{echo $banner['url']}">
                        {/if}
                            <img src="{echo $banner['photo']}" alt="banner"/>
                        {if trim($banner['url'])}    
                            </a>
                        {/if}
                        
                    </li>
                    {/foreach}
                </ul>
                <div class="group-button-carousel">
                    <button class="next" type="button"></button>
                    <button class="prev" type="button"></button>
                </div>
                <div class="pager"></div>
            </div>

        </section>
    </div>


