<?php
use \ProductsTester;

class CreateProductCest
{
    
    public function Autorization(CurrenciesTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage(ProductsPage::$URL);
        $I->waitForText("Отменить фильтрацию", "10", ProductsPage::$CancelFilterButton);
    }
    
    
    public function NamesInCreate(CurrenciesTester $I)
    {
        $I->amOnPage(ProductsPage::$URL);        
        $I->click(ProductsPage::$CreateProductButton);
        $I->waitForElement(".//*[@id='parameters']/table[1]/thead/tr/th");
        $I->see('Создание товара', 'span.title');
        $I->see('Информация', './/*[@id="cur_cr_form"]/table/thead/tr/th');
        $I->see('Название товара:', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[1]/label');
        $I->see('Статус:', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[2]/label');
        $I->see('Название варианта товара', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[3]/label');
        $I->see('Цена', './/*[@id="mod_name"]/label');
        $I->see('Валюта', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[2]/div/p');
        $I->see('Артикул', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[3]/div/p');
        $I->see('Количество', './/*[@id="mod_name"]/div/p');
        $I->see('Фото', './/*[@id="mod_name"]/div/p');
        $I->see('Добавить вариант', './/*[@id="mod_name"]/div/p');
        $I->see('Название бренда:', './/*[@id="mod_name"]/div/p');
        $I->see('Категория:', './/*[@id="mod_name"]/div/p');
        $I->see('Дополнительные категории:', './/*[@id="mod_name"]/div/p');
        $I->see('Краткое описание:', './/*[@id="mod_name"]/div/p');
        $I->see('Полное описание:', './/*[@id="mod_name"]/div/p');
        $I->see('Настройки', './/*[@id="mod_name"]/div/p');
        $I->see('Разрешить комментирование:', './/*[@id="mod_name"]/div/p');
        $I->see('Дата создания:', './/*[@id="mod_name"]/div/p');
        $I->see('Формат даты: гггг-мм-дд чч:мм:сс', './/*[@id="mod_name"]/div/p');
        $I->see('Старая цена:', './/*[@id="mod_name"]/div/p');
        $I->see('Главный шаблон:', './/*[@id="mod_name"]/div/p');
        $I->see('Основной шаблон товара. По-умолчанию product.tpl', './/*[@id="mod_name"]/div/p');
        $I->see('Мета-данные', './/*[@id="mod_name"]/div/p');
        $I->see('URL:', './/*[@id="mod_name"]/div/p');
        $I->see('Автоподбор', './/*[@id="mod_name"]/div/p');
        $I->see('Meta Title', './/*[@id="mod_name"]/div/p');
        $I->see('Meta Description', './/*[@id="mod_name"]/div/p');
        $I->see('Meta Keywords', './/*[@id="mod_name"]/div/p');
        $I->see('Вернуться', CurrenciesPage::$GoBackButton);
        $I->see('Создать', CurrenciesPage::$SaveButton);
        $I->see('Создать и выйти', CurrenciesPage::$SaveAndExitButton);
    }
    
    
    public function RequiredFieldsSaveButtonInCreate(CurrenciesTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/currencies/create');
        $I->click(CurrenciesPage::$SaveButton);
        $I->see('Это поле обязательное.', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[1]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[2]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[3]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="mod_name"]/div/label');
        $I->click(CurrenciesPage::$GoBackButton);
        $I->waitForText('Список валют');
        InitTest::ClearAllCach($I);
    }
    
    
    public function RequiredFieldsSaveAndExitButtonInCreate(CurrenciesTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/currencies/create');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->see('Это поле обязательное.', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[1]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[2]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[3]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="mod_name"]/div/label');
    }
}