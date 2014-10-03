<?php

class RbacRoleFactoryTest extends PHPUnit_Framework_TestCase {

//    /**
//     * Call protected/private method of a class.
//     *
//     * @param object &$object    Instantiated object that we will run method on.
//     * @param string $methodName Method name to call
//     * @param array  $parameters Array of parameters to pass into method.
//     *
//     * @return mixed Method return.
//     */
//    public function invokeMethod($object, $methodName, array $parameters = array())
//    {
//        $reflection = new \ReflectionClass(get_class($object));
//        $method = $reflection->getMethod($methodName);
//        $method->setAccessible(true);
//
//        return $method->invokeArgs($object, $parameters);
//    }
//
//
////    public function testReset_all() {
////        //Build mock for RbacRoleFactory class
////        $mock_factory = $this->getMockBuilder('\super_classes\RbacRoleFactory')
////            ->setMethods(array(
////                'get_instance',
////                'model_rbac_role_reset_all'
////            ))
////            ->disableOriginalConstructor()
////            ->getMock();
////        //Set expected value to mock methods
////        $mock_factory->expects($this->any())
////            ->method('model_rbac_role_reset_all')
////            ->will($this->returnValue(true));
////
////        //Ask factory to perform method
////        $actual=$mock_factory->reset_all();
////
////        //assert between expected and actual
////        $this->assertEquals(true, $actual);
////    }
//
//    /**
//     * Test create_role_obj() in case of correct inputs
//     * @param  $input
//     * @param $expected
//     * @dataProvider providerTestCreateRoleObj
//     */
//    public function testCreateRoleObj($input, $expected) {
//
//        //Build mock for RbacRoleFactory class
//        $mock_factory = $this->getMockBuilder('\super_classes\RbacRoleFactory')
//                ->setMethods(array('get_instance'))
//                ->disableOriginalConstructor()
//                ->getMock();
//        //Set expected value to mock methods
//        $actual = $mock_factory->create_role_obj($input);
//        $this->assertInstanceOf($expected, $actual);
//
//        //Ask factory to perform method
//        $actual_info = $actual->get_props();
//
//        //assert between expected and actual
//        $this->assertEquals($input,$actual_info);
//    }
//
//    /**
//     * Data provider for testCreateRoleObj()
//     * @return array
//     */
//    public function providerTestCreateRoleObj() {
//        return array(
//            '0' => array(
//                'input'=>array(
//                    'id' => '1',
//                    'title' => 'home',
//                    'desc' => 'no',
//                    'parent_id' => ''
//                ),
//                '$expected'=>'\super_classes\RbacRole'
//            ),
//            '1' => array(
//                'input'=> array(
//                    'id' => '2',
//                    'title' => 'index',
//                    'desc' => 'no',
//                     'parent_id' => ''
//                ),
//                '$expected'=>'\super_classes\RbacRole'
//            ),
//        );
//    }
//
//    /**
//     * Test create_role() in case of correct inputs
//     * @param $input
//     * @param $expected_map_db
//     * @param $expected
//     * @dataProvider providerTestCreateRole
//     */
//
//    public function testCreateRole($input,$expected_map_db, $expected){
//        //Build mock for RbacRoleFactory class
//    $mock_factory =$this->getMockBuilder('\super_classes\RbacRoleFactory')
//        ->setMethods(array(
//            'get_instance',
//            'map_db'
//        ))
//        ->disableOriginalConstructor()
//        ->getMock();
//        //Set expected value to mock methods
//        $mock_factory->expects($this->any())
//            ->method('map_db')
//            ->will($this->returnValue($expected_map_db));
//
//        //Ask factory to perform method
//        $actual=$mock_factory->create_role($input);
//
//        //assert between expected and actual
//        $this->assertEquals($expected, $actual);
//    }
//
//    /**
//     * Data provider for testCreateRole()
//     * @return array
//     */
//    public function providerTestCreateRole(){
//        return array(
//            '0' => array(
//                'input'=>array(
//                    'id' => '1',
//                    'title' => 'home',
//                    'desc' => 'no',
//                    'parent_id' => '01'
//                ),
//                'expected_map_db' => false,
//                'expected' => false
//            ),
//            '1' => array(
//                'input'=>array(
//                    'id' => '2',
//                    'title' => 'index',
//                    'desc' => 'no',
//                    'parent_id' => '01'
//                ),
//                'expected_map_db' => true,
//                'expected' => true
//            ),
//        );
//    }
//
//    /**
//     * @param $input
//     * @param $expected_read_role
//     * @param $expected
//     * @dataProvider providerTestReadRole
//     */
////    public function testReadRoleObj($input, $expected_read_role, $expected){
////        $mock_factory =$this->getMockBuilder('\super_classes\RbacRoleFactory')
////            ->setMethods(array(
////                'get_instance',
////                'read_role',
////                'create_role_obj'
////            ))
////            ->disableOriginalConstructor()
////            ->getMock();
////
////        //Set expected values to mocking methods
////        $mock_factory->expects($this->any())
////            ->method('read_role')
////            ->will($this->returnValue($expected_read_role));
////
////        $mock_factory->expects($this->any())
////            ->method('create_role_object')
////            ->will($this->returnValue(array()));
////
////        //Ask factory to perform method
////        $actual=$mock_factory->read_role_obj($input);
////
////        //Assert result
////        $this->assertEquals($expected, $actual);
////    }
//
//    /**
//     * Provider for testReadRoleObj
//     * @return array
//     */
//    public function providerTestReadRole()
//    {
//        return array(
//            '0' => array(
//                'input' => '8',
//                'expected_read_role' => array(),
//                'expected' => array()
//            ),
//            '1' => array(
//                'input' => '0',
//                'expected_read_role' => array(),
//                'expected' => array()
//            ),
//        );
//    }
//
//    /**
//     * @param $input
//     * @param $expected_map_db
//     * @param $expected_update_role_obj
//     * @param $expected
//     * @dataProvider providerTestUpdateRole
//     */
//
//    public function testUpdateRole($input,$expected_map_db,$expected_update_role_obj,$expected){
//    // Build mock for RbacRoleFactory class
//            $mock_factory =$this->getMockBuilder('\super_classes\RbacRoleFactory')
//        ->setMethods(array(
//            'get_instance',
//            'map_db',
//            'update_role_obj'
//        ))
//        ->disableOriginalConstructor()
//        ->getMock();
//        //Set expected value to mock methods
//
//            $mock_factory->expects($this->any())
//            ->method('update_role_obj')
//            ->will($this->returnValue($expected_update_role_obj));
//
//        $mock_factory->expects($this->any())
//            ->method('map_db')
//            ->will($this->returnValue($expected_map_db));
//
//        //Ask factory to perform method
//        $actual=$mock_factory->update_role($input);
//
//        //assert between expected and actual
//        $this->assertEquals($expected, $actual);
//    }
//
//    /**
//     * Provider for testUpdateRole
//     * @return array
//     */
//    public function providerTestUpdateRole(){
//        $role_obj = new \super_classes\RbacRole();
//        $role_obj->set_id('1');
//        $role_obj->set_title('root');
//        $role_obj->set_desc('root');
//        $role_obj->set_parent_id(null);
//        return array(
//            '0' => array(
//                'input'=>$role_obj,
//                'expected_map_db' => true,
//                'expected_update_role_obj'=>array(),
//                'expected' => false
//            ),
//            '1' => array(
//                'input'=>$role_obj,
//                'expected_map_db' => true,
//                'expected_update_role_obj'=>array(),
//                'expected' => false
//            ),
//        );
//    }
//
//
//    /**
//     *
//     * @param $input
//     * @param $expected_model_rbac_insert
//     * @param $expected_model_rbac_modify
//     * @param $expected
//     * @dataProvider providerTestMapDB
//     */
//    public function testMapDB($input,$expected_model_rbac_insert,$expected_model_rbac_modify,$expected){
//        //Build mock for InkiuAccountFactory class
//        $mock_factory=$this->getMockBuilder('\super_classes\RbacRoleFactory')
//            ->setMethods(array(
//                'get_instance',
//                'model_rbac_insert',
//                'model_rbac_modify'
//            ))
//            ->disableOriginalConstructor()
//            ->getMock();
//
//        //Set expected values to mocking methods
//        $mock_factory->expects($this->any())
//            ->method('model_rbac_insert')
//            ->with($this->returnValue($expected_model_rbac_insert));
//
//        $mock_factory->expects($this->any())
//            ->method('model_rbac_modify')
//            ->with($this->returnValue($expected_model_rbac_modify));
//
//        //Ask factory to perform method
//        $actual=$mock_factory-> map_db($input);
//
//        //Assert result
//        $this->assertEquals($expected, $actual);
//    }
//
//
//    /**
//     * Provider for testMapDB
//     * @return array
//     */
//    public function providerTestMapDB(){
//        $role_obj = new \super_classes\RbacRole();
//        $role_obj->set_id('1');
//        $role_obj->set_title('root');
//        $role_obj->set_desc('root');
//        $role_obj->set_parent_id(null);
//        return array(
//            '0' => array(
//                'input'=>$role_obj,
//                'expected_model_rbac_insert'=>false,
//                'expected_model_rbac_modify'=>false,
//                'expected'=>false
//            ),
//            '1' => array(
//                'input'=>$role_obj,
//                'expected_model_rbac_insert'=>false,
//                'expected_model_rbac_modify'=>false,
//                'expected'=>false
//            ),
//        );
//    }
////
////    public function testMakeSample(){
////
////        $input=array(
////            'admin',
////            'admin/local-admin',
////            'admin/remote-admin',
////            'member',
////            'guest',
////            'unauthorized'
////        );
////        //Build mock for InkiuAccountFactory class
////        $mock_factory=$this->getMockBuilder('\super_classes\RbacRoleFactory')
////            ->setMethods(array(
////                'get_instance',
////                'model_rbac_role_make_sample'
////            ))
////            ->disableOriginalConstructor()
////            ->getMock();
////
////        //Set expected values to mocking methods
////        $mock_factory->expects($this->any())
////            ->method('model_rbac_role_make_sample')
////            ->with($this->returnValue(true));
////
////        $actual=$mock_factory->make_sample($input);
////        //Assert result
////        $this->assertEquals(true, $actual);
////
////    }
//
//
//    public function testReadRoleHtml(){
//        //set expected values
//        $input = array(
//            'root' => array(
//                'id' => '1',
//                'title' => 'title',
//                'desc' => '',
//                'parent_id' => '',
//                'depth' => '0',
//                'path' => '/'
//            )
//        );
//        $buf = '';
//        $buf .= "<ul><li>";
//        $buf .= "<a" .
//            " href='" . '/' . "'" .
//            " entity_id='" . $input['root']['id'] . "'" .
//            " parent_entity_id='" . $input['root']['parent_id'] . "'" .
//            ">" .
//            $input['root']['title'] . "</a>";
//        $buf .= "</li></ul>";
//        $expected = $buf;
//
//        //build mock for RbacPermFactory class
//        $mock_factory = $this->getMockBuilder('\super_classes\RbacRoleFactory')
//            ->setMethods(array('get_instance','read_roles'))
//            ->disableOriginalConstructor()
//            ->getMock();
//        //Set expected values to mocking methods
//        $mock_factory->expects($this->any())
//            ->method('read_roles')
//            ->will($this->returnValue($input));
//
//        //Ask factory to perform method
//        $actual = $mock_factory->read_roles_html();
//        //$actual = \super_classes\TreeBuilder::my_render_tree_html($input);
//        //Assert result
//        $this->assertEquals($expected,$actual);
//    }
//
//    /**
//     * Test delete_role() in case of correct inputs
//     * @param $input
//     * @param $expected_model_rbac_role_delete
//     * @param $expected
//     * @dataProvider providerTestDeleteRole
//     */
//    public function testDeleteRole($input, $expected_model_rbac_role_delete,$expected){
//        //build mock for RbacPermFactory class
//        $mock_factory = $this->getMockBuilder('\super_classes\RbacRoleFactory')
//            ->setMethods(array('get_instance','model_rbac_role_delete'))
//            ->disableOriginalConstructor()
//            ->getMock();
//
//        //Set expected values to mocking methods
//        $mock_factory->expects($this->any())
//            ->method('model_rbac_role_delete')
//            ->will($this->returnValue($expected_model_rbac_role_delete));
//
//        //Ask factory to perform method
//        $actual = $mock_factory->delete_role($input);
//
//        //Assert result
//        $this->assertEquals($expected,$actual);
//    }
//
//    /**
//     *Data provider for testDeteleRole
//     * @return array
//     */
//    public function providerTestDeleteRole(){
//        return array(
//            '0' => array(
//                'input' => array(
//                    'id'=>'1'
//                ),
//                'expected_model_rbac_role_detele' => true,
//                'expected' =>true
//            ),
//            '1' => array(
//                'input' => array(
//                    'id'=>'1'
//                ),
//                'expected_model_rbac_role_delete' => false,
//                'expected' =>false
//            )
//        );
//    }

    public function test()
    {
    }
}
