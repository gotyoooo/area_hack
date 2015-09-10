<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * runs all defined Selenium tests
 *
 * @version $Id: AllSeleniumTests.php 12848 2009-08-21 07:38:43Z nijel $
 * @package phpMyAdmin-test
 */


/**
 *
 */
require_once 'PHPUnit/Framework.php';
require_once 'PHPUnit/TextUI/TestRunner.php';
require_once './PmaSeleniumTestCase.php';
require_once './PmaSeleniumLoginTest.php';
require_once './PmaSeleniumXssTest.php';
require_once './PmaSeleniumPrivilegesTest.php';

class AllSeleniumTests
{
    public static function main()
    {
        $parameters = array();
        PHPUnit_TextUI_TestRunner::run(self::suite(), $parameters);
    }

    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('phpMyAdmin');

        $suite->addTestSuite('PmaSeleniumLoginTest');
        $suite->addTestSuite('PmaSeleniumXssTest');
        $suite->addTestSuite('PmaSeleniumPrivilegesTest');
        return $suite;
    }
}
?>
