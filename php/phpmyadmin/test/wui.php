<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * runs all defined tests
 *
 * @version $Id: wui.php 12848 2009-08-21 07:38:43Z nijel $
 * @package phpMyAdmin-test
 */

/**
 *
 */
require_once 'AllTests.php';

echo '<pre>';
AllTests::main();
echo '</pre>';

?>