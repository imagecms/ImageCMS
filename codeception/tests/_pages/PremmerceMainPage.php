<?php

class PremmerceMainPage
{
    // include url of current page
    public static $URL = '/';

    public static $CreateShopField = '[name="domain"]';
    public static $DomainEnd = '[class="addon d_i-b"]';
    
    
    //Buttons
    public static $CreateShopFreeButton = '[id="createStoreButton"]';
    public static $CreateShopButton = 'html/body/div[3]/header/div/div/div/div[1]/div[2]/a';
    public static $EnterButton = ".//*[@id='loginButton']";
    public static $BenefitsButton = 'html/body/div[3]/header/div/ul/li[1]/a';
    public static $DesignButton = 'html/body/div[3]/header/div/ul/li[2]/a';
    public static $TariffsButton = 'html/body/div[3]/header/div/ul/li[3]/a';
    public static $ServicesButton = 'html/body/div[3]/header/div/ul/li[4]/button';
    
    public static $CabinetButton = '//header/div/div/div/div[1]/div[1]/a';
    public static $EnterInCabinetButton = '/html/body/div[3]/div[1]/div/div[1]/div/div/div/div[2]/div[1]/a';
    public static $ChooseDesignButton = '/html/body/div[3]/div[1]/div/div[1]/div/div/div/div[2]/div[2]/a';
    
    //Language Buttons on .COM.UA    
    public static $UkrLangRegisterFormLink = "/html/body/footer/div/div/div[1]/ul/li[1]";
    public static $RusLangRegisterFormLink = "/html/body/footer/div/div/div[1]/ul/li[2]";
    
    
    
    //---Saas---
    
    public static $ButtonEnter = '#loginButton';
    public static $ButtonCreateStore = '.btn-create-shop>a';
    public static $ButtonCreateStoreNow = '#createStoreButton';
    public static $FieldNameShop = '.f-s_0.d_i-b.v-a_t.p_r.shop_create_form>input';
    
    public static $WindowLoginTitle = '//body/div[10]/div/div[1]/div';
    public static $WindowLoginFieldEmail = '//form/label[1]/span/input';
    public static $WindowLoginFieldPassword = '//form/label[2]/span/input';
    public static $WindowLoginButtonSend = '//form/div/div/div/span/button';
    public static $WindowLoginButtonClose = '//body/div[10]/div/button';
    public static $WindowLoginLinkRecallPassword = '//div[10]/div/div[2]/div[1]/div/form/div/div/div/div/button';
    public static $WindowLoginCreateShop = '//div[10]/div/div[2]/div[2]/div/a';
    public static $WindowLoginTextRegistration = '//div[10]/div/div[2]/div[2]/div/span';

    
    public static $WindowForgotPasswordTitle = '//body/div[12]/div/div[1]/div';
    public static $WindowForgotPasswordFieldEmail = '//form/div/label/span/input';
    public static $WindowForgotPasswordButtonClose = '//body/div[12]/div/button';
    public static $WindowForgotPasswordButtonSend = '//div[12]/div/div[2]/div/div/form/div/div/div/div/button';
    
}