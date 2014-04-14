<?php

require_once realpath(dirname(__FILE__) . '/../../..') . '/enviroment.php';

require_once 'classes/TArchiveTest.php';
//require_once 'classes/TemplateManagerTest.php';
//require_once 'classes/TemplateTest.php';
//require_once 'components/TTemplateEditor/TTemplateEditorTest.php';
//require_once 'installer/DependenceDirectorTest.php';
//require_once 'installer/ModuleDependenceTest.php';
//require_once 'installer/WidgetDependenceTest.php';

/**
 * 
 *
 *
 */
class TMTests {

    public static function suite() {
        $suite = new \PHPUnit_Framework_TestSuite('MySuite');

        $suite->addTest(new TArchiveTest);
        
//        $suite->addTest(new TemplateManagerTest);
//        $suite->addTest(new TemplateTest);
//        $suite->addTest(new TTemplateEditorTest);
//        $suite->addTest(new DependenceDirectorTest);
//        $suite->addTest(new ModuleDependenceTest);
//        $suite->addTest(new WidgetDependenceTest);

        return $suite;
    }

}

?>
