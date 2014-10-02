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
    //Checkbox
    public static $AgreeCheckbox = ".//*[@id='register-form']/div/div[2]/input";
    //Buttons And Links
    public static $CreateShopNowRegisterFormButton = ".//*[@id='register-form']/div/div[3]/button";
    public static $WorkConditionLink = ".//*[@id='register-form']/div/div[2]/button";
}