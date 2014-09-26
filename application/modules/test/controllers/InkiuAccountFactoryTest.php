<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/11/14
 * Time: 2:49 PM
 */

class InkiuAccountFactoryTest extends PHPUnit_Framework_TestCase
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
     * Test create_account_obj() in case of correct inputs
     * @param $input
     * @param $expected
     * @dataProvider providerTestCreateAccountObj
     */
    public function testCreateAccountObj($input, $expected)
    {
        $mock_factory = $this->getMockBuilder('\super_classes\InkiuAccountFactory')
            ->setMethods(array('get_instance'))
            ->disableOriginalConstructor()
            ->getMock();
        $actual = $mock_factory->create_account_obj($input);
        $this->assertInstanceOf($expected, $actual);

        $actual_info = $actual->get_props();
        $this->assertEquals($input, $actual_info);
    }

    /**
     * Data provider for testCreateAccountObj()
     * @return array
     */
    public function providerTestCreateAccountObj()
    {
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
                'expected' => '\super_classes\InkiuAccount'
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
                'expected' => '\super_classes\InkiuAccount'
            )
        );
    }

    /**
     * Test create_account() in case of correct inputs
     * @param $input
     * @param $expected_map_db
     * @param $expected_read_role_obj
     * @param $expected
     * @dataProvider providerTestCreateAccount
     */
    public function testCreateAccount($input,
                                      $expected_map_db, $expected_read_role_obj, $expected)
    {
//        //Build mock for InkiuAccountFactory class
//        $mock_factory = $this->getMockBuilder('\super_classes\InkiuAccountFactory')
//            ->setMethods(array(
//                'get_instance',
//                'map_db',
//                'read_role_obj'
//            ))
//            ->disableOriginalConstructor()
//            ->getMock();
//
//        //Set expected values to mocking methods
//        $mock_factory->expects($this->any())
//            ->method('read_role_obj')
//            ->will($this->returnValue($expected_read_role_obj));
//        $mock_factory->expects($this->any())
//            ->method('map_db')
//            ->will($this->returnValue($expected_map_db));
//
//        //Ask factory to perform method
//        $actual = $mock_factory->create_account($input);
//
//        //Assert result
//        $this->assertEquals($expected, $actual);
    }

    /**
     * Data provider for testCreateAccount()
     * @return array
     */
    public function providerTestCreateAccount()
    {
        $role_obj = new \super_classes\RbacRole();
        $role_obj->set_id('1');
        $role_obj->set_title('root');
        $role_obj->set_desc('root');
        $role_obj->set_parent_id(null);
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
                'expected_read_role_obj' => $role_obj,
                'expected_map_db' => true,
                'expected' => false
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
                'expected_read_role_obj' => $role_obj,
                'expected_map_db' => true,
                'expected' => false
            )
        );
    }

    /**
     * @param $input
     * @param $expected_map_db
     * @param $expected_read_role_obj
     * @param $expected
     * @dataProvider providerTestUpdateAccount
     */
    public function testUpdateAccount($input, $expected_map_db, $expected_read_role_obj, $expected)
    {
//        //Build mock for InkiuAccountFactory class
//        $mock_factory = $this->getMockBuilder('\super_classes\InkiuAccountFactory')
//            ->setMethods(array(
//                'get_instance',
//                'map_db',
//                'read_role_obj'
//            ))
//            ->disableOriginalConstructor()
//            ->getMock();
//
//        //Set expected values to mocking methods
//        $mock_factory->expects($this->any())
//            ->method('read_role_obj')
//            ->will($this->returnValue($expected_read_role_obj));
//        $mock_factory->expects($this->any())
//            ->method('map_db')
//            ->will($this->returnValue($expected_map_db));
//
//        //Ask factory to perform method
//        $actual = $mock_factory->create_account($input);
//
//        //Assert result
//        $this->assertEquals($expected, $actual);
    }

    /**
     * Provider for testUpdateAccount
     * @return array
     */
    public function providerTestUpdateAccount()
    {
        $role_obj = new \super_classes\RbacRole();
        $role_obj->set_id('1');
        $role_obj->set_title('root');
        $role_obj->set_desc('root');
        $role_obj->set_parent_id(null);
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
                'expected_read_role_obj' => $role_obj,
                'expected_map_db' => true,
                'expected' => false
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
                'expected_read_role_obj' => $role_obj,
                'expected_map_db' => true,
                'expected' => false
            )
        );
    }

    /**
     * @param $expected_load_acc_info
     * @param $expected
     * @dataProvider providerTestLoadAccountsInfoLinks
     */
    public function testLoadAccountsInfoLinks($expected_load_acc_info, $expected)
    {
        //Build mock for InkiuAccountFactory class
        $mock_factory = $this->getMockBuilder('\super_classes\InkiuAccountFactory')
            ->setMethods(array(
                'get_instance',
                'load_accounts_info'
            ))
            ->disableOriginalConstructor()
            ->getMock();

        //Set expected values to mocking methods
        $mock_factory->expects($this->any())
            ->method('load_accounts_info')
            ->will($this->returnValue($expected_load_acc_info));

        //Ask factory to perform method
        $actual = $mock_factory->load_accounts_info_links();

        //Assert result
        $this->assertEquals($expected, $actual);
    }

    /**
     * Provider for testLoadAccountsInfoLinks
     * @return array
     */
    public function providerTestLoadAccountsInfoLinks()
    {
        return array(
            '0' => array(
                'expected_load_acc_info' => array(

                ),
                'expected' => array()
            ),
            '1' => array(
                'expected_load_acc_info' => array(

                ),
                'expected' => array()
            ),
        );
    }

    /**
     * @param $input
     * @param $expected_load_roles_info
     * @param $expected
     * @dataProvider providerTestLoadRolesName
     */
    public function testLoadRolesName($input, $expected_load_roles_info, $expected)
    {
        //Build mock for InkiuAccountFactory class
        $mock_factory = $this->getMockBuilder('\super_classes\InkiuAccountFactory')
            ->setMethods(array(
                'get_instance',
                'load_roles_info'
            ))
            ->disableOriginalConstructor()
            ->getMock();

        //Set expected values to mocking methods
        $mock_factory->expects($this->any())
            ->method('load_roles_info')
            ->will($this->returnValue($expected_load_roles_info));

        //Ask factory to perform method
        $actual = $mock_factory->load_roles_name($input);

        //Assert result
        $this->assertEquals($expected, $actual);
    }

    /**
     * Provider for testLoadRolesName
     * @return array
     */
    public function providerTestLoadRolesName()
    {
        return array(
            '0' => array(
                'input' => '8',
                'expected_load_roles_info' => array(),
                'expected' => array()
            ),
            '1' => array(
                'input' => '0',
                'expected_load_roles_info' => array(),
                'expected' => array()
            ),
        );
    }

    /**
     * @param $input
     * @param $expected_model_acc_insert
     * @param $expected_model_rbac_assign_acc_role
     * @param $expected
     * @dataProvider providerTestMapDbHasNoId
     */
    public function testMapDbHasNoId($input, $expected_model_acc_insert, $expected_model_rbac_assign_acc_role,
                                        $expected)
    {
//        //Build mock for InkiuAccountFactory class
//        $mock_factory = $this->getMockBuilder('\super_classes\InkiuAccountFactory')
//            ->setMethods(array(
//                'get_instance',
//                'model_acc_insert',
//                'model_rbac_assign_acc_role'
//            ))
//            ->disableOriginalConstructor()
//            ->getMock();
//
//        //Set expected values to mocking methods
//        $mock_factory->expects($this->any())
//            ->method('model_acc_insert')
//            ->will($this->returnValue($expected_model_acc_insert));
//        $mock_factory->expects($this->any())
//            ->method('model_rbac_assign_acc_role')
//            ->will($this->returnValue($expected_model_rbac_assign_acc_role));
//        //Ask factory to perform method
//        $actual = $this->invokeMethod($mock_factory, 'map_db_has_no_id', array($input));
//
//        //Assert result
//        $this->assertEquals($expected, $actual);
    }

    /**
     * Provider for testMapDbHasNoId
     * @return array
     */
    public function providerTestMapDbHasNoId()
    {
        return array(
            '0' => array(
                'input' => array(
                    'id' => null,
                    'account_name' => 'manhnd',
                    'staff_name' => 'Nguyen Duc Manh',
                    'password' => '123456',
                    'address' => '321dsfsd',
                    'roles' => array()
                ),
                'expected_model_acc_insert' => '8',
                'expected_model_rbac_assign_acc_role' => true,
                'expected' => true,
            ),
            '1' => array(
                'input' => array(
                    'id' => null,
                    'account_name' => 'manhnd',
                    'staff_name' => 'Nguyen Duc Manh',
                    'password' => '123456',
                    'address' => '321dsfsd',
                    'roles' => array()
                ),
                'expected_model_acc_insert' => '0',
                'expected_model_rbac_assign_acc_role' => true,
                'expected' => true,
            ),
        );
    }

    /**
     * @param $input
     * @param $expected_model_acc_update
     * @param $expected_model_rbac_unassign_acc_roles
     * @param $expected_model_rbac_assign_acc_role
     * @param $expected
     * @dataProvider providerTestMapDbHasId
     */
    public function testMapDbHasId($input, $expected_model_acc_update, $expected_model_rbac_unassign_acc_roles,
                                     $expected_model_rbac_assign_acc_role, $expected)
    {
        //Build mock for InkiuAccountFactory class
        $mock_factory = $this->getMockBuilder('\super_classes\InkiuAccountFactory')
            ->setMethods(array(
                'get_instance',
                'model_acc_update',
                'model_rbac_unassign_acc_roles',
                'model_rbac_assign_acc_role'
            ))
            ->disableOriginalConstructor()
            ->getMock();

        //Set expected values to mocking methods
        $mock_factory->expects($this->any())
            ->method('model_acc_update')
            ->will($this->returnValue($expected_model_acc_update));
        $mock_factory->expects($this->any())
            ->method('model_rbac_unassign_acc_roles')
            ->will($this->returnValue($expected_model_rbac_unassign_acc_roles));
        $mock_factory->expects($this->any())
            ->method('model_rbac_assign_acc_role')
            ->will($this->returnValue($expected_model_rbac_assign_acc_role));

        //Ask factory to perform method
        $actual = $this->invokeMethod($mock_factory, 'map_db_has_id', array($input));

        //Assert result
        $this->assertEquals($expected, $actual);
    }

    /**
     * Provider for testMapDbHasId
     * @return array
     */
    public function providerTestMapDbHasId()
    {
        return array(
            '0' => array(
                'input' => array(
                    'id' => '8',
                    'account_name' => 'manhnd',
                    'staff_name' => 'Nguyen Duc Manh',
                    'password' => '123456',
                    'address' => '321dsfsd',
                    'roles' => array()
                ),
                'expected_model_acc_update' => true,
                'expected_model_rbac_unassign_acc_roles' => true,
                'expected_model_rbac_assign_acc_role' => true,
                'expected' => true,
            ),
            '1' => array(
                'input' => array(
                    'id' => '0',
                    'account_name' => 'gdfg',
                    'staff_name' => 'Nguyen Duc r5t5',
                    'password' => '123456',
                    'address' => '4de',
                    'roles' => array()
                ),
                'expected_model_acc_update' => true,
                'expected_model_rbac_unassign_acc_roles' => true,
                'expected_model_rbac_assign_acc_role' => true,
                'expected' => true,
            ),
        );
    }

    /**
     * @param $info
     * @param $session
     * @param $expected_validate
     * @param $expected_store_data_to_session
     * @param $expected_model_acc_get_id_by_name
     * @param $expected
     * @dataProvider providerTestAuthenticate
     */
    public function testAuthenticate($info, $session, $expected_validate,
                                     $expected_store_data_to_session, $expected_model_acc_get_id_by_name, $expected)
    {
//        //Build mock for InkiuAccountFactory class
//        $mock_factory = $this->getMockBuilder('\super_classes\InkiuAccountFactory')
//            ->setMethods(array(
//                'get_instance',
//                'model_acc_get_id_by_name',
//                'validate',
//                'store_data_to_session',
//            ))
//            ->disableOriginalConstructor()
//            ->getMock();
//
//        //Set expected values to mocking methods
//        $mock_factory->expects($this->any())
//            ->method('validate')
//            ->will($this->returnValue($expected_validate));
//        $mock_factory->expects($this->any())
//            ->method('store_data_to_session')
//            ->will($this->returnValue($expected_store_data_to_session));
//        $mock_factory->expects($this->any())
//            ->method('model_acc_get_id_by_name')
//            ->will($this->returnValue($expected_model_acc_get_id_by_name));
//
//        //Ask factory to perform method
//        $actual = $mock_factory->authenticate($info, $session);
//
//        //Assert result
//        $this->assertEquals($expected, $actual);
    }

    /**
     * Provider for testAuthenticate
     * @return array
     */
    public function providerTestAuthenticate()
    {
        $session = null;
        return array(
            '0' => array(
                'info' => array(
                    'acc_name' => 'manhnd',
                    'password' => '123456'
                ),
                'session' => $session,
                'expected_validate' => true,
                'expected_store_data_to_session' => true,
                '$expected_model_acc_get_id_by_name' => '8',
                'expected' => true
            ),
            '1' => array(
                'info' => array(
                    'acc_name' => 'manhnd',
                    'password' => '123456'
                ),
                'session' => $session,
                'expected_validate' => false,
                'expected_store_data_to_session' => false,
                '$expected_model_acc_get_id_by_name' => '0',
                'expected' => false
            ),
        );
    }
}