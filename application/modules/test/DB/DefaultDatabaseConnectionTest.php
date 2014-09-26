<?php
/**
 * Created by PhpStorm.
 * User: Tuan Long
 * Date: 9/23/2014
 * Time: 3:00 PM
 */

require_once __DIR__ . '/../CITest.php';

class DefaultDatabaseConnectionTest extends PHPUnit_Framework_TestCase{


    public function getConnection()
    {
        $ci_test = new CITestCase();
        $conn = $ci_test->getConnection();
        return $conn;

    }


    public function testConnectToMySQLIrbs()
    {
        $conn = $this->getConnection();
        $count = $conn->getRowCount('account');
        $this->assertTrue($count >= 0);
    }
}