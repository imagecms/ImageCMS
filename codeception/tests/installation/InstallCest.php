<?php

use \AcceptanceTester;

class InstallCest {

    /**
     * @group install
     */
    public function IntallImageCMSPremium(AcceptanceTester $I) {
        $I->amOnPage("/install");
        $I->waitForElement(".btn.btn-primary");
        $I->click(".btn.btn-primary");
        $I->waitForElement('.btn.btn-success');
        $I->click('.btn.btn-success');
        $I->fillField('site_title', 'ImageCMS');                                
        $I->fillField('db_user', 'root');                                        
        $I->fillField('db_name', 'cmsprem');                                    
        $I->fillField('admin_mail', USER_EMAIL);                                
        $I->fillField('admin_pass', USER_PASSWORD);                             
        $I->click('.btn.btn-success');                                          
        $I->waitForElement('.mini-layout');
        $I->see('Установка завершена.', 'h2');
    }

}
