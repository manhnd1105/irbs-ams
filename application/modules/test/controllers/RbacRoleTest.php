<?php

class RbacRoleTest extends PHPUnit_Framework_TestCase{


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


    public function testSetParentId($info=''){
        
        $expected=''; 
        $role= new \super_classes\RbacRole();
        $actual=$role->set_parent_id($info);
        //Assert the results
        $this->assertEquals($expected, $actual);
    }
    
     public function testGetParentId() {
        $role= new \super_classes\RbacRole();
        $actual=$role->get_parent_id();
        //Assert the results
        $this->assertEquals('', $actual);
    }
    
    public function testSetId($info=''){
         $expected=''; 
        $role= new \super_classes\RbacRole();
        $actual=$role->set_id($info);
        //Assert the results
        $this->assertEquals($expected, $actual);
    }
       
     public function testGetId() {
        $role= new \super_classes\RbacRole();
        $actual=$role->get_id();
        //Assert the results
        $this->assertEquals('', $actual);
    }
    
     public function testTitle($info=''){
         $expected=''; 
        $role= new \super_classes\RbacRole();
        $actual=$role->set_title($info);
        //Assert the results
        $this->assertEquals($expected, $actual);
    }
       
     public function testGetTitle() {
        $role= new \super_classes\RbacRole();
        $actual=$role->get_title();
        //Assert the results
        $this->assertEquals('', $actual);
    }
    
     public function testSetDesc($info=''){
         $expected=''; 
        $role= new \super_classes\RbacRole();
        $actual=$role->set_desc($info);
        //Assert the results
        $this->assertEquals($expected, $actual);
    }
       
     public function testGetDesc() {
        $role= new \super_classes\RbacRole();
        $actual=$role->get_desc();
        //Assert the results
        $this->assertEquals('', $actual);
    }

    /**
     * Test set_init() in case of correct inputs
     * @param $info
     * @param $field
     * @param $expected
     * @dataProvider providerTestSetInit
     */
    public  function testSet_init($info,$field,$result,$expected){
        $mock_role = $this->getMockBuilder('\super_classes\RbacRole')
            ->getMock();
        $actual = $this->invokeMethod($mock_role,'init_set',array($info,$field,$result));
        $this->assertEquals($expected,$actual);
    }
    /**
     * Data provider for testSet_init()
     * @return array
     */
    public function providerTestSetInit(){
        return array(
            '0' => array(
                array(
                    'id' => '1',
                    'title' => 'home',
                    'desc' => 'no',
                    'parent_id' => ''
                ),
                'field'=>'',
                'result'=>'',
                'expected'=>''
            ),
            '1' => array(
                array(
                    'id' => '2',
                    'title' => 'index',
                    'desc' => 'no',
                    'parent_id' => ''
                ),
                'field'=>'',
                'result'=>'',
                'expected'=>''
            ),
        );
    }

    public function  testGet_props(){
        $expected = array(
            'id'=>'01',
            'title'=>'title',
            'desc'=>'desc',
            'parent_id' =>'01'
        );
        $role = new \super_classes\RbacRole() ;
        $role->set_id(array('id'=>'01'));
        $role->set_title(array('title'=>'title'));
        $role->set_desc(array('desc'=>'desc'));
        $role->set_parent_id(array('parent_id'=>'01'));
        $actual = $role->get_props();
        $this->assertEquals($expected,$actual);
    }

    
}

