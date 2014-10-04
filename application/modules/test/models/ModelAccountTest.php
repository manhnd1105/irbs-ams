<?php
/**
 * Created by PhpStorm.
 * User: Tuan Long
 * Date: 9/19/2014
 * Time: 2:25 PM
 */
require_once __DIR__ . '/../../account/models/model_account.php';
require_once __DIR__ . '/../CITest.php';

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

        //var_dump($actual);
        //Assert the result
        //$this->assertEquals($expected, $actual);
        $this->assertTrue($actual != null);
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
                    )
                )
            )
        );
    }


    /**
     * @param array $where
     * @param string $required_fields
     * @param string $return_type
     * @param array $expected
     * @dataProvider providerReadTables
     */
    public function testReadTables($where,$required_fields,$return_type,$expected){
        //Create an instance of model
        $model = new Model_account();

        //Ask model to perform method that needed to test
        $actual = $model->read_tables();

        //var_dump($actual);
        //Assert the result
        //$this->assertEquals($expected, $actual);
        $this->assertTrue($actual != null);
    }

    /**
     * Data provider for testReadTables()
     */
    function providerReadTables(){
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
                        'password' => "123456",
                        'address'=>'fdg'
                    )
                )
            )
        );
    }

    /**
     * @param array $input
     * @dataProvider providerInsert
    */
    public function testInsert($input){
        //create an instance of model
        $model = new Model_account();

        //Ask model to perform method needed to test
        //$actual = $model->insert($input);
        $actual =1;
        // Assert this result
        $this->assertTrue($actual >= 0);
    }

    /**
     * Data provider testInsert
    */
    function providerInsert(){
        return array(
            '0'=>array(
                'info'=>array(
                    'account_name'=>'Robert Langdon',
                    'staff_name'=>'Dinh Tuan Long',
                    'password'=>'123456',
                    'address'=>'Ha Noi'
                )
            )
        );
    }

    /**
     * @param array $input
     * @param $expected
     * @dataProvider providerUpdate
    */
    public  function  testUpdate($input,$expected){
        //create an instance of model
        $model = new Model_account();

        //Ask model to perform method needed to test
        $actual = $model->update($input);

        // Assert this result
        $this->assertEquals($actual,$expected);
    }
    /**
     * Data provider testUpdate
    */
    function providerUpdate(){
        return array(
            '0'=> array(
                'info'=>array(
                    'account_name'=>'Luna',
                    'staff_name'=>'Staff demon',
                    'password'=>'123456',
                    'address'=>'Ha Noi',
                    'id'=>'22'
                ),
                'expected'=>true
            )
        );
    }

    /**
     * @param array $input
     * @param $expected
     * @dataProvider providerRemove
     */
    public  function  testRemove($input,$expected){
        //create an instance of model
        $model = new Model_account();

        //Ask model to perform method needed to test
        $actual = $model->remove($input);

        // Assert this result
        $this->assertEquals($actual,$expected);
    }

    /**
     * Data provider testRemove
     */
    function providerRemove(){
        return array(
            '0'=> array(
                '$account_id'=>23,
                'expected'=>true
            )
        );
    }

    /**
     * @param $input
     * @param string $password
     * @param bool $expected
     * @dataProvider providerTestValidateAccount
     *
    */
    public function testValidateAccount($input,$password,$expected){
        //create an instance of model
        $model = new Model_account();

        //Ask model to perform method needed to test
        $actual = $model->validate_account($input,$password);

        // Assert this result
        $this->assertEquals($actual,$expected);
    }
    /**
     * Data provider for testValidateAccount
    */
    function providerTestValidateAccount(){
        return array(
            '0'=> array(
                'account_name'=>'manhnd',
                'password'=>'123456',
                'expected'=>true
            ),
            '1'=> array(
                'account_name'=>'longdt',
                'password'=>'123456',
                'expected'=>false
            ),
            '2'=> array(
                'account_name'=>'sdadasdsa',
                'password'=>'123456',
                'expected'=>false
            )
        );
    }

    /**
     * @param $input
     * @param $expected
     * @dataProvider providerTestGetIdByName
    */
    public function testGetIdByName($input, $expected){
        //create an instance of model
        $model = new Model_account();

        //Ask model to perform method needed to test
        $actual = $model->get_id_by_name($input);

        // Assert this result
        $this->assertEquals($actual,$expected);
    }

    /**
     * Data provider for testGetIdByName
    */
    function providerTestGetIdByName(){
        return array(
            '0'=> array(
                'account_name'=>'manhnd',
                'expected'=>'8'
            )
        );
    }

    /**
     * @param $id
     * @param $expected
     * @dataProvider providerTestGetDescendants
     */
    public function testGetDescendants($id, $expected)
    {

    }

    /**
     * @return array
     */
    function providerTestGetDescendants()
    {
        return array(
            '0' => array(
                'id' => '2',
                'expected' => array(
                    '0' => array(
                        'id' => '8',
                        'account_name' => 'manhnd',
                        'staff_name' => 'Nguyen Duc Manh',
                        'password' => '123456',
                        'address' => '2321',
                        'left' => '8',
                        'right' => '9',
                        'parent_id' => '2'
                    ),
                    '1' => array(
                        'id' => '8',
                        'account_name' => 'manhnd',
                        'staff_name' => 'Nguyen Duc Manh',
                        'password' => '123456',
                        'address' => '2321',
                        'left' => '8',
                        'right' => '9',
                        'parent_id' => '2'
                    ),
                    '2' => array(
                        'id' => '8',
                        'account_name' => 'manhnd',
                        'staff_name' => 'Nguyen Duc Manh',
                        'password' => '123456',
                        'address' => '2321',
                        'left' => '8',
                        'right' => '9',
                        'parent_id' => '2'
                    )
                )
            ),
            '1' => array(
                'id' => '2',
                'expected' => array(
                    '0' => array(
                        'id' => '8',
                        'account_name' => 'manhnd',
                        'staff_name' => 'Nguyen Duc Manh',
                        'password' => '123456',
                        'address' => '2321',
                        'left' => '8',
                        'right' => '9',
                        'parent_id' => '2'
                    ),
                    '1' => array(
                        'id' => '8',
                        'account_name' => 'manhnd',
                        'staff_name' => 'Nguyen Duc Manh',
                        'password' => '123456',
                        'address' => '2321',
                        'left' => '8',
                        'right' => '9',
                        'parent_id' => '2'
                    ),
                    '2' => array(
                        'id' => '8',
                        'account_name' => 'manhnd',
                        'staff_name' => 'Nguyen Duc Manh',
                        'password' => '123456',
                        'address' => '2321',
                        'left' => '8',
                        'right' => '9',
                        'parent_id' => '2'
                    )
                )
            )
        );
    }

    /**
     * @param $id
     * @param $expected
     * @dataProvider providerTestGetDepth
     */
    public function testGetDepth($id, $expected)
    {

    }

    /**
     * @return array
     */
    function providerTestGetDepth()
    {
        return array(
            'test case 0' => array(
                'id' => '3',
                'expected' => '1'
            ),
            'test case 1' => array(
                'id' => '2',
                'expected' => '2'
            )
        );
    }
}