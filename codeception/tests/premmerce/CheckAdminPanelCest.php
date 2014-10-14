<?php

use \PremmerceTester;

class CheckAdminPanelCest {

    protected $UserPassword = 'mnkvlqxnfi';
    protected $UserEmail = 'mnkvlqxnfi@gmail.com';
    protected $StoreName;
    protected $StoreUrl = 'http://mnkvlqxnfi.premme.com/admin';
    protected $CreateStoreUrl = 'http://imagego.ru/saas/create_store';

    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function createStore(PremmerceTester\PremmerceSteps $I){
        $I->amOnUrl($this->CreateStoreUrl);
        $this->StoreName = $this->UserPassword = $I->generateName();
        $this->UserEmail = $this->StoreName . '@gmail.com';
        $this->StoreUrl = 'http://' . $this->StoreName . '.premme.com/admin';
        $I->createStore($this->StoreName, $this->UserEmail, $this->UserPassword);
        $I->comment('store name: '      . $this->StoreName);
        $I->comment('store url: '       . $this->StoreUrl);
        $I->comment('user email: '      . $this->UserEmail);
        $I->comment('user password: '   . $this->UserPassword);
        $I->logout();
    }

    public function login(PremmerceTester $I) {
        $I->amOnUrl($this->StoreUrl);
        $I->submitForm('#with_out_article', ['login' => $this->UserEmail, 'password' => $this->UserPassword]);
        $I->waitForElement('#topPanelNotifications');
        $I->seeElement('#topPanelNotifications');
        $this->checkAdminPanel($I);
    }

    public function checkAdminPanel(PremmerceTester $I) {
        $times = 3;
        $interval = 60;
        while (--$times != 0) {

            sleep($interval);
            for ($i = 1; $i <= 8; $i++) {
                $I->see("//div[@class = 'frame_nav']//tbody//tr/td[$i]");
            }
        }
    }

}
