<?php
/**
 * Created by PhpStorm.
 * User: Tuan Long
 * Date: 9/24/2014
 * Time: 1:14 AM
 */

require_once __DIR__ . '/../DBUnitTestUtility.php';

class RefreshDatabaseTest extends PHPUnit_Framework_TestCase{

    private $db;

    protected function setUp()
    {
        $this->db = & get_instance()->db;
    }

    public  function testRefreshMySqlIrbsTesting(){
        $db_unit_test = new DBUnitTestUtility();
        $db_unit_test->setUpDatabaseIrbsTesting();
    }

    public function testConnectToMySQLIrbsTesting()
    {
        $db_testing_name = $this->db->database.'_testing';
        $host = $this->db->hostname;
        $username = $this->db->username;
        $password = $this->db->password;
        $conn = new mysqli($host,$username,$password,$db_testing_name);
        $this->assertTrue($conn != null);
    }


}