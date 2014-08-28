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
        $I->fillField('site_title', 'ImageCMS');                                //Site title
        $I->fillField('db_user', 'root');                                       //Database user 
        $I->fillField('db_name', 'cmsprem');                                    //Database name
        $I->fillField('admin_mail', 'ad@min.com');                              //user name
        $I->fillField('admin_pass', 'admin');                                   //user password
        $I->click('.btn.btn-success');                                          
        $I->waitForElement('.mini-layout');
        $I->see('Установка завершена.', 'h2');
    }

}
