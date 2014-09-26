<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/8/14
 * Time: 3:07 PM
 */

class RbacAssigningFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test get_role_assigned_perms_title() in case correct inputs
     * @param int $input
     * @param array $expected_mock
     * @param array $expected
     * @dataProvider providerTestGetRoleAssignedPerms
     */
    public function testGetRoleAssignedPermsTitle($input, $expected_mock, $expected)
    {
        //Mock RbacAssigningFactory object to fake get_role_assigned_perms()
        $mock_factory = $this->getMockBuilder('super_classes\RbacAssigningFactory')
            ->setMethods(array('get_role_assigned_perms'))
            ->disableOriginalConstructor()
            ->getMock();

        //Set expected value for get_role_assigned_perms()
        $mock_factory->expects($this->any())
            ->method('get_role_assigned_perms')
            ->will($this->returnValue($expected_mock));

        //Ask the mock factory to perform the testing function
        $actual = $mock_factory->get_role_assigned_perms_title($input);

        //Assert the results
        $this->assertEquals($expected, $actual);
    }

    /**
     * DataProvider for testGetRoleAssignedPerms()
     * @return array ($input, $expected_mock, $expected)
     */
    public function providerTestGetRoleAssignedPerms()
    {
        return array(
            array(
                '3',
                array(
                    '0' => array(
                        'ID' => '2',
                        'Title' => 'irbs',
                        'Description' => ''
                    ),
                    '1' => array(
                        'ID' => '3',
                        'Title' => 'account',
                        'Description' => ''
                    )
                ),
                array(
                    'irbs',
                    'account'
                )
            ),
            array(
                '1',
                array(
                    '0' => array(
                        'ID' => '4',
                        'Title' => 'account_controller',
                        'Description' => ''
                    ),
                    '1' => array(
                        'ID' => '11',
                        'Title' => 'list_roles',
                        'Description' => ''
                    ),
                ),
                array(
                    'account_controller',
                    'list_roles',
                )
            )
        );
    }

    /**
     * Test get_acc_assigned_roles_name() in case correct inputs
     * @param int $input
     * @param array $expected_mock
     * @param array $expected
     * @dataProvider providerTestGetAccAssignedRolesName
     */
    public function testGetAccAssignedRolesName($input, $expected_mock, $expected)
    {
        //Mock RbacAssigningFactory object to fake get_role_assigned_perms()
        $mock_factory = $this->getMockBuilder('super_classes\RbacAssigningFactory')
            ->setMethods(array('get_acc_assigned_roles'))
            ->disableOriginalConstructor()
            ->getMock();

        //Set expected value for get_role_assigned_perms()
        $mock_factory->expects($this->any())
            ->method('get_acc_assigned_roles')
            ->will($this->returnValue($expected_mock));
        //Ask the mock factory to perform the testing function
        $actual = $mock_factory->get_acc_assigned_roles_name($input);

        //Assert the results
        $this->assertEquals($expected, $actual);
    }

    /**
     * DataProvider for testGetAccAssignedRolesName()
     * @return array ($input, $expected_mock, $expected)
     */
    public function providerTestGetAccAssignedRolesName()
    {
        return array(
            array(
                '0',
                array(
                    array(
                        'Title' => 'irbs',
                        'ID' => '2',
                        'Lft' => '2',
                        'Rght' => '7',
                        'Description' => ''
                    ),
                    array(
                        'Title' => 'admin',
                        'ID' => '3',
                        'Lft' => '3',
                        'Rght' => '7',
                        'Description' => ''
                    )
                ),
                array(
                    'irbs',
                    'admin'
                )
            ),
            array(
                '0',
                array(
                    array(
                        'Title' => 'local-admin',
                        'ID' => '2',
                        'Lft' => '2',
                        'Rght' => '7',
                        'Description' => ''
                    ),
                    array(
                        'Title' => 'guest',
                        'ID' => '3',
                        'Lft' => '3',
                        'Rght' => '7',
                        'Description' => ''
                    )
                ),
                array(
                    'local-admin',
                    'guest'
                )
            )
        );
    }

    /**
     * Test get_acc_assigned_roles_id() in case correct inputs
     * @param int $input
     * @param array $expected_mock
     * @param array $expected
     * @dataProvider providerTestGetAccAssignedRolesId
     */
    public function testGetAccAssignedRolesId($input, $expected_mock, $expected)
    {
        //Mock RbacAssigningFactory object to fake get_role_assigned_perms()
        $mock_factory = $this->getMockBuilder('super_classes\RbacAssigningFactory')
            ->setMethods(array('get_acc_assigned_roles'))
            ->disableOriginalConstructor()
            ->getMock();

        //Set expected value for get_role_assigned_perms()
        $mock_factory->expects($this->any())
            ->method('get_acc_assigned_roles')
            ->will($this->returnValue($expected_mock));

        //Ask the mock factory to perform the testing function
        $actual = $mock_factory->get_acc_assigned_roles_id($input);

        //Assert the results
        $this->assertEquals($expected, $actual);
    }

    /**
     * DataProvider for testGetAccAssignedRolesId()
     * @return array ($input, $expected_mock, $expected)
     */
    public function providerTestGetAccAssignedRolesId()
    {
        return array(
            '0' => array(
                '0',
                array(
                    array(
                        'Title' => 'local-admin',
                        'ID' => '2',
                        'Lft' => '2',
                        'Rght' => '7',
                        'Description' => ''
                    ),
                    array(
                        'Title' => 'guest',
                        'ID' => '3',
                        'Lft' => '3',
                        'Rght' => '7',
                        'Description' => ''
                    )
                ),
                array(
                    '2',
                    '3'
                )
            ),
            '1' => array(
                '0',
                array(
                    array(
                        'Title' => 'local-admin',
                        'ID' => '4',
                        'Lft' => '2',
                        'Rght' => '7',
                        'Description' => ''
                    ),
                    array(
                        'Title' => 'guest',
                        'ID' => '5',
                        'Lft' => '3',
                        'Rght' => '7',
                        'Description' => ''
                    )
                ),
                array(
                    '4',
                    '5'
                )
            ),
        );
    }

    /**
     * Test get_acc_assigned_roles_html() in case correct inputs
     * @param int $input
     * @param array $expected_mock
     * @param string $expected
     * @dataProvider providerTestGetAccAssignedRolesHtml
     */
    public function testGetAccAssignedRolesHtml($input, $expected_mock, $expected)
    {
        //Mock RbacAssigningFactory object
        $mock_factory = $this->getMockBuilder('super_classes\RbacAssigningFactory')
            ->setMethods(array('get_acc_assigned_roles_name'))
            ->disableOriginalConstructor()
            ->getMock();

        //Set expected value
        $mock_factory->expects($this->any())
            ->method('get_acc_assigned_roles_name')
            ->will($this->returnValue($expected_mock));

        //Ask the mock factory to perform the testing function
        $actual = $mock_factory->get_acc_assigned_roles_html($input);

        //Assert the results
        $this->assertEquals($expected, $actual);
    }

    /**
     * DataProvider for testGetAccAssignedRolesHtml()
     * @return array
     */
    public function providerTestGetAccAssignedRolesHtml()
    {
        return array(
            '0' => array(
                '0',
                array(
                    'admin',
                    'local-admin',
                ),
                "<p>admin</p>" . "<p>local-admin</p>"
            ),
            '1' => array(
                '0',
                array(
                    'guest',
                    'unauthorized'
                ),
                "<p>guest</p>" . "<p>unauthorized</p>"
            ),
        );
    }
}
 