<!--Start. Button which display hidden form-->
<a id="foundLessExpensixe" class="">
    <span class="d_l_b">
        {lang('Found less cheaper', 'found_less_expensive')}                                                    
    </span>
</a>
<!--End. Button which display hidden form-->
<!--Start. Render hidden form-->
<div class="drop-found dropF" id ="foundLessExpensixeDrop">
    <!--    Button for hide form-->
    <button type="button" class="iconF-times-enter" id="hideFormButton"></button>
    <div class="dropF-content">
        <div class="headerF_title">
            {lang('Found less cheaper', 'found_less_expensive')}
        </div>
        <div class="insideF_padd">
            <span class="errorMessage"> </span>
            <div class="horizontalF_form standartF_form">
                <!--               Start. Form with name, phone, email, link, question  -->
                <form method="post" id="fLessExpensiveForm">
                    <label>
                        <span>{lang('Your name', 'found_less_expensive')} <span class="colorRed"> *</span></span>
                        <span class="frame_formF_field">
                            <input class="forClear required" type="text" name="name"/>
                        </span>
                    </label>
                    <label>
                        <span>{lang('Phone number', 'found_less_expensive')} <span class="colorRed"> *</span></span>
                        <span class="frame_formF_field">
                            <input class="forClear required"type="text" name="phone"/>
                        </span>
                    </label>
                    <label>
                        <span>Email <span class="colorRed"> *</span></span>
                        <span class="frame_formF_field">
                            <input class="forClear required emailRequired" type="text" name="email"/>
                        </span>
                    </label>
                    <label>
                        <span>{lang('Product link', 'found_less_expensive')}</span>
                        <span class="frame_formF_field">
                            <input class="forClear" type="text" name="link"/>
                        </span>
                    </label>
                    <label>
                        <span>{lang('Question', 'found_less_expensive')}</span>
                        <span class="frame_formF_field">
                            <textarea class="forClear" name="question"></textarea>
                        </span>
                    </label>
                    <div class="f-align_center">
                        <input type="submit" value="{lang('Send', 'found_less_expensive')}"  class="btnF btnF_Send"/>
                    </div>
                    <input type="hidden" name="productUrl" value="{echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']}">
                    {form_csrf()}
                </form>
                <!--               End. Form with name, phone, email, link, question  -->
            </div>
        </div>
    </div>
    <div class="dropF-footer"></div>
</div>
<!--End. Display hidden form-->
