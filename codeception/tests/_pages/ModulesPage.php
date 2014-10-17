<?php

class ModulesPage
{
    public static $URL = '/admin/components/modules_table#modules';

    public static $HeadCheck                = '//div[@class="tab-content"]//thead//th[1]/span/span';
    public static $HeadModuleText           = '//div[@class="tab-content"]//thead//th[2]';
    public static $HeadUrlText              = '//div[@class="tab-content"]//thead//th[4]';
    public static $HeadAutoloadText         = '//div[@class="tab-content"]//thead//th[5]';
    public static $HeadDescriptionText      = '//div[@class="tab-content"]//thead//th[3]';
    public static $HeadShowText             = '//div[@class="tab-content"]//thead//th[7]';
    public static $HeadUrlPermissionText    = '//div[@class="tab-content"]//thead//th[6]';
    

    public static function lineModuleLink($row)         { return "//div[@class='tab-content']//tbody/tr[$row]/td[2]/a"; }
    public static function lineCheck($row)              { return "//div[@class='tab-content']//tbody/tr[$row]/td[1]/span/span"; }
    public static function lineDescriptionText($row)    { return "//div[@class='tab-content']//tbody/tr[$row]/td[3]/p"; }
    public static function lineUrlLink($row)            { return "//div[@class='tab-content']//tbody/tr[$row]/td[4]//a"; }
    public static function lineAutoloadToggle($row)     { return "//div[@class='tab-content']//tbody/tr[$row]/td[5]//span"; }
    public static function lineUrlPermissionToggle($row){ return "//div[@class='tab-content']//tbody/tr[$row]/td[6]//span"; }
    public static function lineShowToggle($row)         { return "//div[@class='tab-content']//tbody/tr[$row]/td[7]//span"; }


}