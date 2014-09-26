<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/8/14
 * Time: 2:03 PM
 */

class TreeBuilderTest extends PHPUnit_Framework_TestCase
{
    public function testMyRenderTreeHTMLCaseEmpty()
    {
        $input = array();
        $expected = '';
        $actual = \super_classes\TreeBuilder::my_render_tree_html($input);

        $this->assertEquals($expected, $actual);
    }

    public function testMyRenderTreeHTMLCaseOneNode()
    {
        $input = array(
            'root' => array(
                'id' => '1',
                'left' => '0',
                'right' => '1',
                'title' => 'root',
                'desc' => '',
                'depth' => '0',
                'parent_id' => '',
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
        $actual = \super_classes\TreeBuilder::my_render_tree_html($input);

        $this->assertEquals($expected, $actual);
    }

    public function testMyRenderTreeHTMLCaseManyNode()
    {
        $input = array(
            '0' => array(
                'id' => '2',
                  'left' => '1',
                  'right' => '14',
                  'title' => 'irbs',
                  'desc' => '',
                  'path' => '/irbs',
                  'depth' =>'1',
                  'parent_id' => '1'
                ),
            '1' => array(
                'id' => '3',
                'left' => '2',
                'right' => '7',
                'title' =>'admin',
                'desc' => '',
                'path' => '/irbs/admin',
                'depth' => '2',
                'parent_id' => '2'
            ),
            '2' => array(
                'id' => '4',
                'left' => '3',
                'right' => '4',
                'title' =>'local-admin',
                'desc' => '',
                'path' => '/irbs/admin/local-admin',
                'depth' => '3',
                'parent_id' => '3'
            ),
            '3' => array(
                'id' => '5',
                'left' => '5',
                'right' => '6',
                'title' =>'remote-admin',
                'desc' => '',
                'path' => '/irbs/admin/remote-admin',
                'depth' => '3',
                'parent_id' => '3'
            ),
            '4' => array(
                'id' => '6',
                'left' => '8',
                'right' => '9',
                'title' =>'member',
                'desc' => '',
                'path' => '/irbs/member',
                'depth' => '2',
                'parent_id' => '2'
            ),
            '5' => array(
                'id' => '7',
                'left' => '10',
                'right' => '11',
                'title' =>'guest',
                'desc' => '',
                'path' => '/irbs/guest',
                'depth' => '2',
                'parent_id' => '2'
            ),
            '6' => array(
                'id' => '8',
                'left' => '12',
                'right' => '13',
                'title' =>'unauthorized',
                'desc' => '',
                'path' => '/irbs/unauthorized',
                'depth' => '2',
                'parent_id' => '2'
            )
        );

        $expected =
            "<ul>".
                "<li>".
                    "<a href='/irbs' entity_id='2' parent_entity_id='1'>irbs</a>".
                    "<ul>".
                        "<li>".
                            "<a href='/irbs/admin' entity_id='3' parent_entity_id='2'>admin</a>".
                            "<ul>".
                                "<li>".
                                    "<a href='/irbs/admin/local-admin' entity_id='4' parent_entity_id='3'>local-admin</a>".
                                "</li>".
                                "<li>".
                                    "<a href='/irbs/admin/remote-admin' entity_id='5' parent_entity_id='3'>remote-admin</a>".
                                "</li>".
                            "</ul>".
                        "</li>".
                        "<li>".
                            "<a href='/irbs/member' entity_id='6' parent_entity_id='2'>member</a>".
                        "</li>".
                        "<li>".
                            "<a href='/irbs/guest' entity_id='7' parent_entity_id='2'>guest</a>".
                        "</li>".
                        "<li>".
                            "<a href='/irbs/unauthorized' entity_id='8' parent_entity_id='2'>unauthorized</a>".
                        "</li>".
                    "</ul>".
                "</li>".
            "</ul>";
        $expected .= "</li></ul>"; //just to adapt bug
        $actual = \super_classes\TreeBuilder::my_render_tree_html($input);

        $this->assertEquals($expected, $actual);
    }
} 