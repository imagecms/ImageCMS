<?php

class NotificationEditPage
{
 //заголовки
    public static $Title                = '.title';
    public static $TitleBlockEdit       = '//section[@class="mini-layout"]//form//th';
    
    //кнопки
    Public static $ButtonBack           = '.t-d_u';
    Public static $ButtonSave           = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[1]';
    Public static $ButtonSaveExit       = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[2]';
    
    public static $ButtonNotify         = '//section[@class="mini-layout"]//dl//dd[6]/img';
    
    //текст
    public static $TextID               = '//section[@class="mini-layout"]//dl//dd[1]';
    public static $TextDateOfCreating   = '//section[@class="mini-layout"]//dl//dd[3]';
    public static $TextStatusSetBy      = '//section[@class="mini-layout"]//dl//dd[5]';
    
    //селекти
    public static $SelectStatus         = '//section[@class="mini-layout"]//dl//dd[2]/select';
        //опції
        public static function selectStatusOption($number) { return "//section[@class='mini-layout']//dl//dd[2]/select/option[$number]";}
    
    //поля для вводу
    public static $InputDateActiveTo    = '#end_date';
    public static $InputName            = '//div[@class="form-horizontal"]/div[1]//input';
    public static $InputEmail           = '//div[@class="form-horizontal"]/div[2]//input';
    public static $InputPhone           = '//div[@class="form-horizontal"]/div[3]//input';
    public static $InputComment         = '//div[@class="form-horizontal"]/div[4]//textarea';
    
    //лейбли
    public static $TextIDLabel               = '//section[@class="mini-layout"]//dl//dt[1]';
    public static $TextDateOfCreatingLabel   = '//section[@class="mini-layout"]//dl//dt[3]';
    public static $TextStatusSetByLabel      = '//section[@class="mini-layout"]//dl//dt[5]';
    
    public static $SelectStatusLabel         = '//section[@class="mini-layout"]//dl//dt[2]';
    
    public static $ButtonNotifyLabel         = '//section[@class="mini-layout"]//dl//dt[6]';
    
    public static $InputDateActiveToLabel    = '//section[@class="mini-layout"]//dl//dt[4]';
    public static $InputNameLabel            = '//div[@class="form-horizontal"]/div[1]/label';
    public static $InputEmailLabel           = '//div[@class="form-horizontal"]/div[2]/label';
    public static $InputPhoneLabel           = '//div[@class="form-horizontal"]/div[3]/label';
    public static $InputCommentLabel         = '//div[@class="form-horizontal"]/div[4]/label';
    
    //таблиця з продуктом
    public static $HeadImage    = '//section[@class="mini-layout"]/div[2]//thead//th[1]';
    public static $HeadProduct  = '//section[@class="mini-layout"]/div[2]//thead//th[2]';
    public static $LineImage    = '//section[@class="mini-layout"]/div[2]//tbody//tr/td[1]//img';
    public static $LineProduct  = '//section[@class="mini-layout"]/div[2]//tbody//tr/td[2]//a';
}