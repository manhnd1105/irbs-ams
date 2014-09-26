<?php
/**
 * Created by PhpStorm.
 * User: Tuan Long
 * Date: 9/19/2014
 * Time: 2:25 PM
 */
require_once __DIR__ . '/../../account/models/model_account.php';

/**
 * Class ModelAccountTest
 */
class ModelAccountTest extends  PHPUnit_Framework_TestCase
{
    /**
     * @param array $where
     * @param string $required_fields
     * @param string $return_type
     * @param array $expected
     * @dataProvider providerRead
     */
    public function testRead($where, $required_fields, $return_type,
                                $expected)
    {
        //Create an instance of model
        $model = new Model_account();

        //Ask model to perform method that needed to test
        $actual = $model->read();
//        var_dump($actual);
        //Assert the result
        $this->assertEquals($expected, $actual);
    }

    /**
     * Data provider for testRead()
     */
    function providerRead()
    {
        return array(
            '0' => array(
                'where' => NULL,
                'require_fields' => '*',
                'return_type' => 'all',
                'expected' => array(
                    '0' => array (
                        'id' => "8",
                        'account_name' => "manhnd",
                        'staff_name' => "Nguyễn Đức Mạnh",
                        'password' => "123456"
                    ),
                    '1' => array (
                        'id' => "22",
                        'account_name' => "jhk",
                        'staff_name' => "jhk",
                        'password' => "jhk"
                    ),
                )
            )
        );
    }

    private $CI;

    public static function setUpBeforeClass()
    {
        $CI =& get_instance();
        $CI->load->helper('email');
    }
    public function testEmailValidation()
    {
        $this->assertTrue(valid_email('test@test.com'));
        $this->assertFalse(valid_email('test#test.com'));
    }

}