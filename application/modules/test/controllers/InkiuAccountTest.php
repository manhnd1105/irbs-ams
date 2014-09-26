<?php

class InkiuAccountTest extends PHPUnit_Framework_TestCase {

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    /**
     * Test set_init() in case of correct inputs
     * @param $info
     * @param $field
     * @param $result
     * @param $expected
     * @dataProvider providerTestInitSet
     */
    public function testInitSet($info, $field, $result,$expected) {
        $mock_account = $this->getMockBuilder('InkiuAccount')
                ->setMethods(array('init_set'))
                ->getMock();
        $actual=$this->invokeMethod($mock_account,'init_set',array($info,$field,$result));

        $this->assertEquals($expected, $actual);
    }

    /**
     * Data provider for testSet_init()
     * @return array
     */
    public function providerTestInitSet(){
        return array(
            '0' => array(
                'input' => array(
                    'id' => '8',
                    'account_name' => 'manhnd',
                    'staff_name' => 'aaa',
                    'password' => '123456',
                    'address' => 'asw huy6',
                    'roles' => array()
                ),
                'field'=>'',
                'result'=>'',
                'expected'=>''
            ),
            '1' => array(
                'input' => array(
                    'id' => '2',
                    'account_name' => 'fsdfg',
                    'staff_name' => 'aa33a',
                    'password' => '123456',
                    'address' => 'asw huy6',
                    'roles' => array()
                ),
                'field'=>'',
                'result'=>'',
                'expected'=>''
            )
        );

    }


//    public function testReset_roles() {
//        //input
//        $input=array();
//        // expect data output
//        $expected = array();
//
//        // actual data output
//        $acc = new \super_classes\InkiuAccount();
//        $actual=$acc->reset_roles();
//        //assert between actual and expexted
//        $this->assertEquals($expected, $actual);
//    }

    public function testSet_account_name($info = '') {
        $expected = '';
        $acc = new \super_classes\InkiuAccount();
        $actual = $acc->set_account_name($info);
        //Assert the results
        $this->assertEquals($expected, $actual);
    }

    public function testSet_staff_name() {
        $acc = new \super_classes\InkiuAccount();
        $actual = $acc->set_staff_name('');
        //Assert the results
        $this->assertEquals('', $actual);
    }

    public function testSet_password() {
        $acc = new \super_classes\InkiuAccount();
        $actual = $acc->set_password('');
        //Assert the results
        $this->assertEquals('', $actual);
    }

    public function testGet_account_name() {
        $acc = new \super_classes\InkiuAccount();
        $actual = $acc->get_account_name();
        //Assert the results
        $this->assertEquals('', $actual);
    }

    public function testGet_staff_name() {
        $acc = new \super_classes\InkiuAccount();
        $actual = $acc->get_staff_name();
        //Assert the results
        $this->assertEquals('', $actual);
    }

    public function testGet_password() {
        $acc = new \super_classes\InkiuAccount();
        $actual = $acc->get_password();
        //Assert the results
        $this->assertEquals('', $actual);
    }

    public function testGet_props() {
        $expected = array(
            'id' => '8',
            'account_name' => 'manhnd',
            'staff_name' => 'aaa',
            'password' => '123456',
            'address' => 'asw huy6',
            'roles' => array()
        );
        $acc = new \super_classes\InkiuAccount();
        $acc->set_id(array('id' => '8'));
        $acc->set_account_name(array( 'account_name' => 'manhnd'));
        $acc->set_staff_name(array('staff_name' => 'aaa'));
        $acc->set_password(array( 'password' => '123456'));
        $acc->set_address(array( 'address' => 'asw huy6'));
//        $acc->set_role(array(array()));
        $actual = $acc->get_props();
        $this->assertEquals($expected, $actual);
    }

    public function testSet_address() {
        $acc = new \super_classes\InkiuAccount();
        $actual = $acc->set_address('');
        //Assert the results
        $this->assertEquals('', $actual);
    }

    public function testGet_address() {
        $acc = new \super_classes\InkiuAccount();
        $actual = $acc->get_address();
        //Assert the results
        $this->assertEquals('', $actual);
    }

}
