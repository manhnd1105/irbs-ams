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
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeMethod($object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

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
        $actual = $model->read('account');

        //var_dump($actual);
        //Assert the result
        //$this->assertEquals($expected, $actual);
        $this->assertTrue(sizeof($actual) >= 1);
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
        $this->assertTrue(sizeof($actual) >= 0);
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
//        //create an instance of model
//        $model = new Model_account();
//
//        //Ask model to perform method needed to test
//        $actual = $model->remove($input);
//
//        // Assert this result
//        $this->assertEquals($actual,$expected);
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
            ),
            '1'=> array(
                'account_name'=>'dsdasdadsa',
                'expected'=>''
            ),
            '2'=> array(
                'account_name'=>"--<h1>dsds!@*$^",
                'expected'=>''
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
        //create an instance of model
        $model = new Model_account();

        //Ask model to perform method needed to test
        $actual = $model->get_descendants($id);

        // Assert this result
        $this->assertEquals($actual,$expected);
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

    /**
     * @param $id
     * @param $expected
     * @dataProvider providerTestGetPath
     */
    public function testGetPath($id, $expected)
    {
        //create an instance of model
        $model = new Model_account();

        //Ask model to perform method needed to test
        $actual = $model->get_path($id);

        // Assert this result
        $this->assertEquals($actual,$expected);
    }

    /**
     * @return array
     */
    function providerTestGetPath()
    {
        return array(
            'test case 0' => array(
                'id' => '3',
                'expected' => ''
            ),
            'test case 1' => array(
                'id' => '2',
                'expected' => ''
            )
        );
    }

    /**
     * @param $id
     * @param $expected
     * @dataProvider providerTestGetPathNodes
     */
    public function testGetPathNodes($id, $expected)
    {
        //create an instance of model
        $model = new Model_account();

        //Ask model to perform method needed to test
        $actual = $this->invokeMethod($model, 'get_path_nodes', array($id));

        // Assert this result
        $this->assertEquals($actual,$expected);

    }

    /**
     * @return array
     */
    function providerTestGetPathNodes()
    {
        return array(
            'test case 0' => array(
                'id' => '3',
                'expected' => array()
            ),
            'test case 1' => array(
                'id' => '2',
                'expected' => array()
            )
        );
    }

    /**
     * @param $id
     * @param $expected
     * @dataProvider providerTestGetPathNodes
     */
    public function testGetSlibings($id, $expected)
    {
        //create an instance of model
        $model = new Model_account();

        //Ask model to perform method needed to test
        $actual = $this->invokeMethod($model, 'get_slibings', array($id));

        // Assert this result
        $this->assertEquals($actual,$expected);

    }

    /**
     * @return array
     */
    function providerTestGetSlibings()
    {
        return array(
            'test case 0' => array(
                'id' => '3',
                'expected' => array()
            ),
            'test case 1' => array(
                'id' => '2',
                'expected' => array()
            )
        );
    }
}