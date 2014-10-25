<?php
/**
 * Created by PhpStorm.
 * User: TUNG
 * Date: 10/2/2014
 * Time: 1:27 PM
 */

require_once __DIR__ . '/../../rbac/models/model_rbac_role.php';
require_once __DIR__ . '/../CITest.php';

class ModelRbacRoleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param $input
     * @param $expected
     * @dataProvider  providerTestGet
     */
    public function testGet($input, $expected)
    {
        //Create an instance of model
        $model = new Model_rbac_role();
        // Ask model to perform method that needed to test
        $actual = $model->get($input);

        //Assert equals
        $this->assertEquals($expected, $actual);

    }

    /**
     * Data provider for testGet
     * @return array
     *
     */
    function providerTestGet()
    {
        return array(
            '0' => array(
                'id' => 1,
                'expected' => array(
                    'id' => 1,
                    'title' => 'root',
                    'desc' => 'root',
                    'path' => '/asasasas/asasasas',
                    'parent_id' => '2'
                )
            ),
            '1' => array(
                'id' => 1,
                'expected' => array(
                    'id' => 1,
                    'title' => 'root',
                    'desc' => 'root',
                    'path' => '/asasasas/asasasas',
                    'parent_id' => '-1'
                ),
                '2' => array(
                    'id' => 1,
                    'expected' => array(
                        'id' => 1,
                        'title' => 'root',
                        'desc' => 'root',
                        'path' => '/asasasas/asasasas',
                        'parent_id' => 'almn'
                    )
                )
            )
        );
    }


    public function testGets()
    {
        //Create an instance of model
        $model = new Model_rbac_role();

        //Ask model to perform method that needed to test
        $actual = $model->gets();

        //Assert result
        $this->assertTrue(sizeof($actual) > 0);
    }

    /**
     * @param $input
     * @param $expected
     * @dataProvider providerTestInsertRole
     */
    public function testInsertRole($input, $expected)
    {
        //Create an instance of model
        $model = new Model_rbac_role();
        //Ask model to perform method that needed to test
        $actual = $model->insert($input);
        //Assert result
        $this->assertEquals($expected, $actual);
    }

    /**
     * Data provider for testInsertRole
     */
    function providerTestInsertRole()
    {
        return array(
            '0' => array(
                'input' => array(
                    'title' => 'asasasas',
                    'desc' => 'dfjkdlfd',
                    'parent_id' => '3'
                ),
                'expected' => true
            ),
            '0' => array(
                'input' => array(
                    'title' => 'asasasas',
                    'desc' => 'dfjkdlfd',
                    'parent_id' => '-1'
                ),
                'expected' => true
            ),
            '0' => array(
                'input' => array(
                    'title' => 'asasasas',
                    'desc' => 'dfjkdlfd',
                    'parent_id' => 'fFFVf'
                ),
                'expected' => true
            )
        );
    }

    /**
     * @param $input
     * @param $expected
     * @dataProvider providerTestInsertByPath
     */
    public function testInsertByPath($input, $expected)
    {
        //Create an instance of model
        $model = new Model_rbac_role();

        //Ask model to perform method that needed to test
        $actual = $model->insert_by_path($input);

        //Assert result
        $this->assertEquals($expected, $actual);
    }

    /**
     * Data provider for testInsertByPath
     */
    function providerTestInsertByPath()
    {
        return array(
            '0' => array(
                'input' => array(
                    'path' => 'dfdfsdf',
                    'title' => 'ddsfds',
                    'desc' => 'dsgsgsdgsd'
                ),
                'expected' => false
            )
        );
    }

    /**
     * @param $input
     * @param $expected
     * @dataProvider providerTestModify
     */
    public function testModify($input, $expected)
    {
        //Create an instance of model
        $model = new Model_rbac_role();
        //Ask model to perform method that needed to test
        $actual = $model->modify($input);

        //Assert result
        $this->assertEquals($expected, $actual);

    }

    /**
     * dataProvider for testModify
     * @return array
     */
    function providerTestModify()
    {
        return array(
            '0' => array(
                'input' => array(
                    'id' => '51',
                    'title' => 'Test edit title',
                    'desc' => 'adadsa'
                ),
                'expected' => true
            )
        );
    }

    /**
     * @param $input
     * @param $expected
     * @dataProvider providerTestRemove
     */
    public function testRemove($input, $expected)
    {
        //Create an instance of model
        $model = new Model_rbac_role();
        //Ask model to perform method that needed to test
        $actual = $model->remove($input);

        //Assert result
        $this->assertEquals($expected, $actual);
    }

    /**
     * Data provider for testRemove
     */
    function providerTestRemove()
    {
        return array(
            '0' => array(
                'input' => '-1',
                'expected' => true
            )
        );
    }

}