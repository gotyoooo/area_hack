<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Selenium TestCase for login related tests
 *
 * @version $Id: PmaSeleniumLoginTest.php 12848 2009-08-21 07:38:43Z nijel $
 * @package phpMyAdmin-test
 */

require_once('PmaSeleniumTestCase.php');


class PmaSeleniumLoginTest extends PmaSeleniumTestCase 
{
    public function testLogin()
    {
        $this->doLogin();
        $this->assertRegExp("/phpMyAdmin .*-dev/", $this->getTitle());
    }
}
?>
