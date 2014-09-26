<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/11/14
 * Time: 10:58 AM
 */

class RestrictAccessFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param array $input (int $acc_id, string $perm_path)
     * @param array $expected_mock
     * @param array $expected
     * @dataProvider providerTestCheckAccess
     */
    public function testCheckAccess($input, $expected_mock, $expected)
    {
//        //Mock RbacAssigningFactory object
//        $mock_factory = $this->getMockBuilder('super_classes\RbacRestrictAccessFactory')
//            ->setMethods(array('find_path_id'))
//            ->disableOriginalConstructor()
//            ->getMock();
//
//        //Set expected value
//        $mock_factory->expects($this->any())
//            ->method('find_path_id')
//            ->will($this->returnValue($expected_mock));
//
//        //Ask the mock factory to perform the testing function
//        $actual = $mock_factory->check_access($input['acc_id'], $input['perm_path']);
//
//        //Assert the results
//        $this->assertEquals($expected, $actual);
    }

    /**
     * Data provider for testCheckAccess()
     * @return array
     */
    public function providerTestCheckAccess()
    {
        return array(
            '0' => array(
                array(
                    'acc_id' => '8',
                    'perm_path' => '/irbs/home/home_controller'
                ),
                '23',
                false
            ),
            '1' => array(
                array(
                    'acc_id' => '0',
                    'perm_path' => '/irbs/account/account_controller'
                ),
                '23',
                false
            ),
        );
    }
}