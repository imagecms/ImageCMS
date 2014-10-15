<?php

use \PremmerceTester;

class CheckAdminPanelCest {

    /**
     *  Тест запускатиметься кожних 15 хв для перевірки справності адмінки на Premmerce i на Imagego
     *  Для роботи теста має бути створений магазин 
     * 
     */
    protected $StoreUrl     = 'http://testqaimagego.premme.com/admin';
    protected $UserPassword = 'mnkvlqxnfi';
    protected $UserEmail    = 'qa@image.go';

    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkAdminPanel(PremmerceTester\PremmerceSteps $I) {
        $I->amOnUrl($this->StoreUrl);
        $I->login($this->UserEmail, $this->UserPassword);
        $I->seeElement('#topPanelNotifications');
        for ($i = 1; $i <= 7; $i++) {
            $I->seeElement("//div[@class = 'frame_nav']//tbody//tr/td[$i]");
        }
    }

}
