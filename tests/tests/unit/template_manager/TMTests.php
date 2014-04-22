<?php

require_once realpath(dirname(__FILE__) . '/../../..') . '/enviroment.php';

require_once 'classes/TArchiveTest.php';
require_once 'classes/TemplateManagerTest.php';
require_once 'classes/TemplateTest.php';
require_once 'components/TTemplateEditor/TTemplateEditorTest.php';
require_once 'installer/DependenceDirectorTest.php';
require_once 'installer/ModuleDependenceTest.php';
require_once 'installer/WidgetDependenceTest.php';

/**
 * 
 *
 *
 */
class TMTests {

    public static function suite() {
        $suite = new \PHPUnit_Framework_TestSuite('MySuite');
        
        $suite->addTestSuite('template_manager\classes\TemplateManagerTest');
        $suite->addTestSuite('template_manager\classes\TArchiveTest');
        
        $suite->addTestSuite('template_manager\classes\TemplateTest');
        
        $suite->addTestSuite('TTemplateEditorTest');
        $suite->addTestSuite('template_manager\installer\DependenceDirectorTest');
        $suite->addTestSuite('template_manager\installer\ModuleDependenceTest');
        $suite->addTestSuite('template_manager\installer\WidgetDependenceTest');
//        $suite->addTestSuite('template_manager\classes\TemplateManagerTest');

        return $suite;
    }

}

?>
