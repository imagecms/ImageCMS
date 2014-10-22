<?php

class PremmerceMainPage
{
    // include url of current page
    public static $URL = '/';

    public static $CreateShopField = '[name="domain"]';
    public static $DomainEnd = '[class="addon"]';
    public static $ErrorDomain = 'html/body/div[3]/div[1]/div/div[1]/div/div/form/div/div[1]/div[2]';
    
    //Buttons
    public static $CreateShopButtonCentre = '//*[@id="createStoreButton"]';
    public static $CreateShopButtonTop = 'html/body/div[3]/header/div/div/div/div[1]/div[2]/a';
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
}