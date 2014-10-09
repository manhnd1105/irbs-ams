<?php
/**
 * Created by PhpStorm.
 * User: Tuan Long
 * Date: 9/26/2014
 * Time: 12:27 PM
 */

require_once __DIR__ .'/../../rbac/models/model_rbac_perm.php';

class ModelRbacPermTest extends PHPUnit_Framework_TestCase {

    /**
     * @param $input
     * @param $expected
     * @dataProvider providerTestGet
    */
    public  function testGet($input, $expected){

        //Create an instance of model
        $model = new Model_rbac_perm();

        //Ask model to perform method that needed to test
        $actual = $model->get($input);

        //Assert result
        $this->assertEquals($expected,$actual);


    }
    /**
     * Data provider for testGet
    */
    function providerTestGet(){
        return array(
            '0'=>array(
                'id'=>1,
                'expected'=>array(
                    'id'=> 1,
                    'title'=>'root',
                    'desc'=>'root',
                    'path'=>'/',
                )
            ),
            '1'=>array(
                'id'=>2,
                'expected'=>array(
                    'id'=> 2,
                    'title'=>'irbs',
                    'desc'=>"",
                    'path'=>'/irbs',
                )
            ),
            '2'=>array(
                'id'=>4,
                'expected'=>array(
                    'id'=> 4,
                    'title'=>'account_controller',
                    'desc'=>"",
                    'path'=>'/irbs/account/account_controller',
                )
            )
        );
    }


    /**
     *
    */
    public  function  testGets(){
        //Create an instance of model
        $model = new Model_rbac_perm();

        //Ask model to perform method that needed to test
        $actual = $model->gets();

        //Assert result
        $this->assertTrue(sizeof($actual) > 0);

    }


    /**
     * @param $input array
     * @param $expected bool
     * @dataProvider providerTestInsert
     */
    public  function testInsert($input, $expected){
        //Create an instance of model
        $model = new Model_rbac_perm();

        //Ask model to perform method that needed to test
        $actual = $model->insert($input);

        //Assert result
        $this->assertEquals($expected,$actual);
    }

    /**
     * Data provider for testInsert
     */
    function providerTestInsert(){
        return array(
            '0'=> array(
                'input' => array(
                    'title' => 'child lv 3',
                    'desc' => 'Test insert Permissions',
                    'parent_id' =>'3'
                ),
                'expected' => true
            ),
            '1'=> array(
                'input' => array(
                    'title' => 'child lv 3',
                    'desc' => 'Test insert Permissions',
                    'parent_id' =>'-1'
                ),
                'expected' => true
            ),
            '2'=> array(
                'input' => array(
                    'title' => 'child lv 3',
                    'desc' => 'Test insert Permissions',
                    'parent_id' =>'dasdadadas'
                ),
                'expected' => false
            )
        );
    }

    /**
     * @param $input array
     * @param $expected bool
     * @dataProvider providerTestInsertByPath
     */
    public  function testInsertByPath($input, $expected){
        //Create an instance of model
        $model = new Model_rbac_perm();

        //Ask model to perform method that needed to test
        $actual = $model->insert_by_path($input);

        //Assert result
        $this->assertEquals($expected,$actual);
    }

    /**
     * Data provider for testInsertByPath
     */
    function providerTestInsertByPath(){
        return array(
            '0'=> array(
                'input' => array(
                    'path' => 'dadasdasda',
                    'title' => 'dadsadsa',
                    'desc' =>'Test insert by path'
                ),
                'expected' => false
            )
        );
    }

    /**
     * @param $input array
     * @param $expected bool
     * @dataProvider providerTestModify
     */
    public  function testModify($input, $expected){
        //Create an instance of model
        $model = new Model_rbac_perm();

        //Ask model to perform method that needed to test
        $actual = $model->modify($input);

        //Assert result
        $this->assertEquals($expected,$actual);
    }

    /**
     * Data provider for testModify
     */
    function providerTestModify(){
        return array(
            '0'=> array(
                'input' => array(
                    'id' => '51',
                    'title' => 'Test edit title',
                    'desc' =>'adadsa'
                ),
                'expected' => true
            )
        );
    }

    /**
     * @param $input array
     * @param $expected bool
     * @dataProvider providerTestRemove
     */
    public  function testRemove($input, $expected){
        //Create an instance of model
        $model = new Model_rbac_perm();

        //Ask model to perform method that needed to test
        $actual = $model->remove($input);

        //Assert result
        $this->assertEquals($expected,$actual);
    }

    /**
     * Data provider for testRemove
     */
    function providerTestRemove(){
        return array(
            '0'=> array(
                'input' =>'-1',
                'expected' => -1
            )
        );
    }



} 