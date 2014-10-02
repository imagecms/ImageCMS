<?php

class LocEngPage
{
   public static $URL = '/';

    
    public static $CreateShopField = '/html/body/div[1]/div[1]/div/div[1]/div/div/form/div/div[1]/input';
    public static $DomainEnd = 'html/body/div[1]/div[1]/div/div[1]/div/div/form/div/div[1]/span';
    public static $RegisterForm = './/*[@class="frame-inside page-register"]';
    public static $ShopNameField = ".//*[@id='register-form']/div/label/input";
    public static $DomainEndInRegisterForm = ".//*[@id='register-form']/div/label/span";
    public static $HelpStaticFieldRegisterForm = ".//*[@id='register-form']/div/div[1]";
    public static $EmailField = '//*[@id="register-form"]/div/div[2]/div[2]/div[1]/input';
    
    public static $PasswordField = '//*[@id="register-form"]/div/div[2]/div[3]/div[1]/input';
    public static $UserNameField = '//*[@id="register-form"]/div/div[2]/div[2]/div[2]/input';
    public static $PhoneNumberField = '//*[@id="register-form"]/div/div[2]/div[3]/div[2]/input';
    public static $CountrySelectMenu = '//*[@id="cuselFrame-id1"]';
    public static $CityField = '//*[@id="register-form"]/div/div[2]/div[3]/div[3]/input';
    public static $CategorySelectMenu = '//*[@id="cuselFrame-id2"]';
    public static $LevelOfUseSelectMenu = '//*[@id="cuselFrame-id3"]';
    public static $AgreeCheckbox = ".//*[@id='register-form']/div/div[3]/input";
    
    
    public static $CreateShopFreeButton = 'html/body/div[1]/div[1]/div/div[1]/div/div/form/div/div[2]/button';
    public static $CreateShopButton = 'html/body/div[1]/header/div/div/div/div[1]/div[2]/a';
    public static $CreateShopNowRegisterFormButton = ".//*[@id='register-form']/div/div[4]/button";
    public static $WorkConditionLink = ".//*[@id='register-form']/div/div[4]/button";
    public static $CabinetButton = 'html/body/div[1]/header/div/div/div/div[1]/div[1]/a';    
    public static $SiteLink = "/html/body/div[1]/div/div[3]/div[1]/table/tbody/tr[1]/td[1]/a";
    public static $AdminLink = "/html/body/div[1]/div/div[3]/div[1]/table/tbody/tr[2]/td/a";
    public static $StoreButton = "/html/body/div[1]/header/div/ul/li[2]/a/span[2]";
    public static $AdminButton = "/html/body/div[1]/header/div/ul/li[4]/a/span";
    public static $ProfileButton = "/html/body/div[1]/header/div/ul/li[1]/button/span[2]/span[1]";
    public static $ExitButton = "/html/body/div[1]/header/div/ul/li[1]/div/ul/li[2]/a/span";    
}