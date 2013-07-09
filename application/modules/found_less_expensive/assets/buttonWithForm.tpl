<!--Start. Button which display hidden form-->
<a id="foundLessExpensixe" class="">
    <span class="d_l_b">
        Нашли дешевле                                                    
    </span>
</a>
<!--End. Button which display hidden form-->
<!--Start. Render hidden form-->
<div class="drop-found dropF" id ="foundLessExpensixeDrop">
<!--    Button for hide form-->
    <button type="button" class="iconF-times-enter" id="hideFormButton"></button>
    <div class="dropF-content">
        <div class="headerF_title">
            Нашли дешевле
        </div>
        <div class="insideF_padd">
            <span class="errorMessage"> </span>
            <div class="horizontalF_form standartF_form">
<!--               Start. Form with name, phone, email, link, question  -->
                <form method="post" id="fLessExpensiveForm">
                    <label>
                        <span>Ваше имя <span class="colorRed"> *</span></span>
                        <span class="frame_formF_field">
                            <input class="forClear required" type="text" name="name"/>
                        </span>
                    </label>
                    <label>
                        <span>Номер телефона <span class="colorRed"> *</span></span>
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
                        <span>Ссилка на товар</span>
                        <span class="frame_formF_field">
                            <input class="forClear" type="text" name="link"/>
                        </span>
                    </label>
                    <label>
                        <span>Вопрос</span>
                        <span class="frame_formF_field">
                            <textarea class="forClear" name="question"></textarea>
                        </span>
                    </label>
                    <div class="f-align_center">
                        <input type="submit" value="Отправить"  class="btnF btnF_Send"/>
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
