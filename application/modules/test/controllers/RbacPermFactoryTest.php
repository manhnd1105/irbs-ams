<?php
/**
 * Created by PhpStorm.
 * User: Tuan Long
 * Date: 9/17/2014
 * Time: 5:46 PM
 */

class RbacPermFactoryTest extends PHPUnit_Framework_TestCase {

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
     * Test create_perm_obj() in case of correct inputs
     * @param $input
     * @param $expected
     * @dataProvider providerTestCreatePermObj
     */

    public function testCreatePermObj($input,$expected){
        $mock_factory = $this->getMockBuilder('\super_classes\RbacPermFactory')
            ->setMethods(array('get_instance'))
            ->disableOriginalConstructor()
            ->getMock();
        $actual = $mock_factory->create_perm_obj($input);
        $this->assertInstanceOf($expected,$actual);
        $actual_info = $actual->get_props();
        $this->assertEquals($input,$actual_info);
    }
    /**
     * providerTestCreatePermObj for testCreatePermObj
     * @return array
    */
    public function  providerTestCreatePermObj(){
        return array(
            '0'=>array(
                'input'=>array(
                    'id'=>'1',
                    'title'=>'    ',
                    'desc'=>'   ',
                    'parent_id' => ''
                ),
                'expected'=>'\super_classes\RbacPerm'
            ),
            '1'=>array(
                'input'=>array(
                    'id'=>'1',
                    'title'=>'title',
                    'desc'=>'desc',
                    'parent_id' => ''
                ),
                'expected'=>'\super_classes\RbacPerm'
            )
        );
    }

    /**
     * Test create_perm() in case of correct inputs
     * @param $input
     * @param $expected_map_db
     * @param $expected
     * @dataProvider providerTestCreatePerm
    */
    public function testCreatePerm($input,$expected_map_db,$expected){
        //build mock for RbacPermFactory class
        $mock_factory = $this->getMockBuilder('\super_classes\RbacPermFactory')
            ->setMethods(array('get_instance','map_db'))
            ->disableOriginalConstructor()
            ->getMock();

        //Set expected values to mocking methods
        $mock_factory->expects($this->any())
            ->method('map_db')
            ->will($this->returnValue($expected_map_db));

        //Ask factory to perform method
        $actual = $mock_factory->create_perm($input);

        //Assert result
        $this->assertEquals($expected,$actual);
    }

    /**
     * Data provider for testCreatePerm
     * @return array
    */
    public function providerTestCreatePerm(){
        return array(
            '0' => array(
                'input' => array(
                    'id' => '1',
                    'title'=>'title',
                    'desc'=>'desc',
                    'parent_id'=>''
                ),
                'expected_map_db' => true,
                'expected' => true
            ),
            '1' => array(
                'input' => array(
                    'id' => '1',
                    'title'=>'title',
                    'desc'=>'desc',
                    'parent_id'=>''
                ),
                'expected_map_db' => false,
                'expected' => false
            )
        );
    }

    /**
     * Test update_perm() in case of correct inputs
     * @param $input
     * @param $expected_map_db
     * @param $expected
     * @dataProvider providerTestUpdatePerm
     */
    public function testUpdatePerm($input,$expected_map_db,$expected){
        //build mock for RbacPermFactory class
        $mock_factory = $this->getMockBuilder('\super_classes\RbacPermFactory')
            ->setMethods(array('get_instance','map_db'))
            ->disableOriginalConstructor()
            ->getMock();

        //Set expected values to mocking methods
        $mock_factory->expects($this->any())
            ->method('map_db')
            ->will($this->returnValue($expected_map_db));

        //Ask factory to perform method
        $actual = $mock_factory->update_perm($input);

        //Assert result
        $this->assertEquals($expected,$actual);
    }

    /**
     * Data provider for testUpdatePerm
     * @return array
     */
    public function providerTestUpdatePerm(){
        return array(
            '0' => array(
                'input' => array(
                    'id' => '1',
                    'title'=>'title',
                    'desc'=>'desc',
                    'parent_id'=>''
                ),
                'expected_map_db' => true,
                'expected' => true
            ),
            '1' => array(
                'input' => array(
                    'id' => '1',
                    'title'=>'title',
                    'desc'=>'desc',
                    'parent_id'=>''
                ),
                'expected_map_db' => false,
                'expected' => false
            )
        );
    }

    /**
     * Test map_db_has_no_id() in case of correct inputs
     * @param $input
     * @param $expected_model_rbac_perm_insert
     * @param $expected
     * @dataProvider providerTestMapDBHasNoId
     */
    public function  testMapDbHasNoId($input, $expected_model_rbac_perm_insert, $expected){

        //build mock for RbacPermFactory class
        $mock_factory = $this->getMockBuilder('\super_classes\RbacPermFactory')
            ->setMethods(array('get_instance','model_rbac_perm_insert'))
            ->disableOriginalConstructor()
            ->getMock();

        //Set expected values to mocking methods
        $mock_factory->expects($this->any())
            ->method('model_rbac_perm_insert')
            ->will($this->returnValue($expected_model_rbac_perm_insert));

        //Ask factory to perform method
        $actual = $this->invokeMethod($mock_factory,'map_db_has_no_id',array($input));

        //Assert result
        $this->assertEquals($expected,$actual);
    }

    /**
     * Data provider for testMapDbHasNoId
     * @return array
     */
    public function  providerTestMapDBHasNoId(){

        return array(
            '0'=>array(
                'input'=>array(
                    'id' =>'',
                    'title' => '',
                    'desc'=>'',
                    'parent_id'=>''
                ),
                'expected_model_rbac_perm_insert' => true,
                'expected'=>true
            ),
            '1'=>array(
                'input'=>array(
                    'title' => '',
                    'desc'=>'',
                    'parent_id'=>''
                ),
                'expected_model_rbac_perm_insert' => true,
                'expected'=>true
            )
        );
    }

    /**
     * Test map_db_has_id() in case of correct inputs
     * @param $input
     * @param $expected_model_rbac_perm_modify
     * @param $expected
     * @dataProvider providerTestMapDBHasId
     */
    public function  testMapDbHasId($input, $expected_model_rbac_perm_modify, $expected){

        //build mock for RbacPermFactory class
        $mock_factory = $this->getMockBuilder('\super_classes\RbacPermFactory')
            ->setMethods(array('get_instance','model_rbac_perm_modify'))
            ->disableOriginalConstructor()
            ->getMock();

        //Set expected values to mocking methods
        $mock_factory->expects($this->any())
            ->method('model_rbac_perm_modify')
            ->will($this->returnValue($expected_model_rbac_perm_modify));

        //Ask factory to perform method
        $actual = $this->invokeMethod($mock_factory,'map_db_has_id',array($input));

        //Assert result
        $this->assertEquals($expected,$actual);
    }

    /**
     * Data provider for testMapDbHasId
     * @return array
     */
    public function  providerTestMapDBHasId(){
        return array(
            '0'=>array(
                'input'=>array(
                    'id' =>'1',
                    'title' => 'title',
                    'desc'=>'desc',
                    'parent_id'=>'parent'
                ),
                'expected_model_rbac_perm_modify' => true,
                'expected'=>true
            ),
            '1'=>array(
                'input'=>array(
                    'id' => '',
                    'title' => 'title',
                    'desc'=>'desc',
                    'parent_id'=>'parent'
                ),
                'expected_model_rbac_perm_modify' => false,
                'expected'=>false
            )

        );
    }

    /**
     * Test read_perms_html
    */
    public function testReadPermsHtml(){

        //set expected values
        $input = array(
            'root' => array(
                'id' => '1',
                'title' => 'title',
                'desc' => '',
                'parent_id' => '',
                'depth' => '0',
                'path' => '/'
            )
        );
        $buf = '';
        $buf .= "<ul><li>";
        $buf .= "<a" .
            " href='" . '/' . "'" .
            " entity_id='" . $input['root']['id'] . "'" .
            " parent_entity_id='" . $input['root']['parent_id'] . "'" .
            ">" .
            $input['root']['title'] . "</a>";
        $buf .= "</li></ul>";
        $expected = $buf;

        //build mock for RbacPermFactory class
        $mock_factory = $this->getMockBuilder('\super_classes\RbacPermFactory')
            ->setMethods(array('get_instance','read_perms'))
            ->disableOriginalConstructor()
            ->getMock();
        //Set expected values to mocking methods
        $mock_factory->expects($this->any())
            ->method('read_perms')
            ->will($this->returnValue($input));

        //Ask factory to perform method
        $actual = $mock_factory->read_perms_html();
        //$actual = \super_classes\TreeBuilder::my_render_tree_html($input);
        //Assert result
        $this->assertEquals($expected,$actual);

    }

    /**
     * Test delete_perm() in case of correct inputs
     * @param $input
     * @param $expected_model_rbac_perm_remove
     * @param $expected
     * @dataProvider providerTestDeletePerm
     */
    public function testDeletePerm($input, $expected_model_rbac_perm_remove,$expected ){

        //build mock for RbacPermFactory class
        $mock_factory = $this->getMockBuilder('\super_classes\RbacPermFactory')
            ->setMethods(array('get_instance','model_rbac_perm_remove'))
            ->disableOriginalConstructor()
            ->getMock();

        //Set expected values to mocking methods
        $mock_factory->expects($this->any())
            ->method('model_rbac_perm_remove')
            ->will($this->returnValue($expected_model_rbac_perm_remove));

        //Ask factory to perform method
        $actual = $mock_factory->delete_perm($input);

        //Assert result
        $this->assertEquals($expected,$actual);

    }

    /**
     * Data provider for testDeletePerm
     * @return array
     */
    public function  providerTestDeletePerm(){
        return array(
            '0' => array(
                'input' => array(
                    'id'=>'1'
                ),
                'expected_model_rbac_perm_remove' => true,
                'expected' =>true
            ),
            '1' => array(
                'input' => array(
                    'id'=>'1'
                ),
                'expected_model_rbac_perm_remove' => false,
                'expected' =>false
            )
        );
    }

    /**
     * Test delete_perm_by_path() in case of correct inputs
     * @param $input
     * @param $expected_model_rbac_perm_remove_path
     * @param $expected
     * @dataProvider providerTestDeletePermByPath
     */
    public function testDeletePermByPath($input, $expected_model_rbac_perm_remove_path,$expected ){

        //build mock for RbacPermFactory class
        $mock_factory = $this->getMockBuilder('\super_classes\RbacPermFactory')
            ->setMethods(array('get_instance','model_rbac_perm_remove_path'))
            ->disableOriginalConstructor()
            ->getMock();

        //Set expected values to mocking methods
        $mock_factory->expects($this->any())
            ->method('model_rbac_perm_remove_path')
            ->will($this->returnValue($expected_model_rbac_perm_remove_path));

        //Ask factory to perform method
        $actual = $mock_factory->delete_perm_by_path($input);

        //Assert result
        $this->assertEquals($expected,$actual);

    }

    /**
     * Data provider for testDeletePermByPath
     * @return array
     */
    public function  providerTestDeletePermByPath(){
        return array(
            '0' => array(
                'input' => array(
                    'path'=>'1'
                ),
                'expected_model_rbac_perm_remove' => true,
                'expected' =>true
            ),
            '1' => array(
                'path' => array(
                    'id'=>'1'
                ),
                'expected_model_rbac_perm_remove' => false,
                'expected' =>false
            )
        );
    }

    /**
     * Test
    */

} 