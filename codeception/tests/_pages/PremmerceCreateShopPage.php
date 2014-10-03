<?php

class PremmerceCreateShopPage
{
    // include url of current page
    public static $URL = '/saas/create_store';

    public static $RegisterForm = './/*[@class="frame-inside page-register"]';
    public static $ShopNameField = ".//*[@id='register-form']/div/label/input";
    public static $DomainEndInRegisterForm = ".//*[@id='register-form']/div/label/span";
    public static $EmailField = ".//*[@id='register-form']/div/div[1]/div[2]/div[1]/input";
    public static $PasswordField = ".//*[@id='register-form']/div/div[1]/div[3]/div[1]/input";
    public static $UserNameField = ".//*[@id='register-form']/div/div[1]/div[2]/div[2]/input";
    public static $PhoneNumberField = ".//*[@id='register-form']/div/div[1]/div[3]/div[2]/input";
    public static $CountrySelectMenu = '//*[@id="cuselFrame-id1"]';
    public static $CityField = ".//*[@id='register-form']/div/div[1]/div[3]/div[3]/input";
    public static $CategorySelectMenu = '//*[@id="cuselFrame-id2"]';
    public static $LevelOfUseSelectMenu = '//*[@id="cuselFrame-id3"]';
    public static $CreateLoadingForm = 'html/body/div[10]/div';
    //Checkbox
    public static $AgreeCheckbox = ".//*[@id='register-form']/div/div[2]/input";
    //Buttons And Links
    public static $CreateShopNowRegisterFormButton = ".//*[@id='register-form']/div/div[3]/button";
    public static $WorkConditionLink = ".//*[@id='register-form']/div/div[2]/button";
    //Error Message
    public static $ErrorDomain = ".//*[@id='register-form']/div/label[1]/label";
    public static $ErrorEmail = ".//*[@id='register-form']/div/div[1]/div[2]/div[1]/label";
    public static $ErrorPassword = ".//*[@id='register-form']/div/div[1]/div[3]/div[1]/label";
    public static $ErrorUserName = ".//*[@id='register-form']/div/div[1]/div[2]/div[2]/label";
    public static $ErrorPhoneNumber = ".//*[@id='register-form']/div/div[1]/div[3]/div[2]/label";
    public static $ErrorCity = ".//*[@id='register-form']/div/div[1]/div[3]/div[3]/label";    
    public static $ErrorLevelOfUse = ".//*[@id='register-form']/div/div[1]/div[3]/div[4]/label";
    public static $ErrorAgree = ".//*[@id='register-form']/div/label[2]";
}