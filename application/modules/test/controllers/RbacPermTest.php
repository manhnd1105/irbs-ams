<?php
/**
 * Created by PhpStorm.
 * User: Tuan Long
 * Date: 9/17/2014
 * Time: 5:00 PM
 */

class RbacPermTest extends PHPUnit_Framework_TestCase{

    public function testSet_id($info=''){
        $expected = '';
        $perm = new \super_classes\RbacPerm();
        $actual = $perm->set_id($info);
        //Assert the results
        $this->assertEquals($expected, $actual);
    }
    public function testSet_title($info=''){
        $expected = '';
        $perm = new \super_classes\RbacPerm();
        $actual = $perm->set_title($info);
        //Assert the results
        $this->assertEquals($expected, $actual);
    }
    public function testSet_desc($info=''){
        $expected = '';
        $perm = new \super_classes\RbacPerm();
        $actual = $perm->set_desc($info);
        //Assert the results
        $this->assertEquals($expected, $actual);
    }
    public function testSet_parent_id($info=''){
        $expected = '';
        $perm = new \super_classes\RbacPerm();
        $actual = $perm->set_parent_id($info);
        //Assert the results
        $this->assertEquals($expected, $actual);
    }
    public function testGet_id(){
        $perm = new \super_classes\RbacPerm() ;
        $actual = $perm->get_id();
        $this->assertEquals('',$actual);
    }
    public function testGet_title(){
        $perm = new \super_classes\RbacPerm() ;
        $actual = $perm->get_title();
        $this->assertEquals('',$actual);
    }
    public function testGet_desc(){
        $perm = new \super_classes\RbacPerm() ;
        $actual = $perm->get_desc();
        $this->assertEquals('',$actual);
    }
    public function testGet_parent_id(){
        $perm = new \super_classes\RbacPerm() ;
        $actual = $perm->get_parent_id();
        $this->assertEquals('',$actual);
    }
    public function  testGet_props(){
        $expected = array(
            'id'=>'01',
            'title'=>'title',
            'desc'=>'desc',
            'parent_id' =>'01'
        );
        $perm = new \super_classes\RbacPerm() ;
        $perm->set_id(array('id'=>'01'));
        $perm->set_title(array('title'=>'title'));
        $perm->set_desc(array('desc'=>'desc'));
        $perm->set_parent_id(array('parent_id'=>'01'));
        $actual = $perm->get_props();
        $this->assertEquals($expected,$actual);
    }
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
     * @param $expected
     * @dataProvider providerTestSetInit
     */
    public  function testSet_init($info,$field,$result,$expected){
        $mock_perm = $this->getMockBuilder('\super_classes\RbacPerm')
            ->getMock();
        $actual = $this->invokeMethod($mock_perm,'init_set',array($info,$field,$result));
        $this->assertEquals($expected,$actual);
    }
    /**
     * Data provider for testSet_init()
     * @return array
     */
    public function providerTestSetInit(){
        return array(
            '0'=> array(
                'info' =>array(
                    'id' =>'01',
                    'title'=>'name',
                    'desc'=>'link',
                    'parent_id'=>'01'
                ),
                'field'=>'desc',
                'result'=>'link',
                'expected'=>'link'
            ),
            '1'=> array(
                'info' =>array(
                    'id' =>'02',
                    'title'=>'name',
                    'desc'=>'link',
                ),
                'field'=>'parent_id',
                'result'=>'',
                'expected'=>''
            )
        );
    }

} 