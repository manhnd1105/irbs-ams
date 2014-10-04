<?php
namespace super_classes;

/**
 * Created by PhpStorm.
 * User: dell
 * Date: 8/8/14
 * Time: 9:11 AM
 */
//TODO implement this class by Javascript
class TreeBuilder
{
//    /**
//     * @param $tree
//     * @param $current_depth
//     * @return string
//     */
//    static function render_tree_html($tree, $current_depth = -1)
//    {
//        $currNode = array_shift($tree);
//        $result = '';
//
//        // Going down?
//        if ($currNode['Depth'] > $current_depth) {
//            // Yes, prepend <ul>
//            $result .= '<ul>';
//
//        }
//        $result .= '<li>' . anchor($currNode['Path'], $currNode['Title']);
//        // Going up?
//        if ($currNode['Depth'] < $current_depth) {
//            // Yes, close n open <ul>
//            $result .= str_repeat('</ul>', $current_depth - $currNode['Depth']);
//        }
//        $result .= '</li>';
//        // Always add the node
//        //$result .= '<li>' . anchor($currNode['Path'], $currNode['Title']) . '</li>';
//        // Anything left?
//        if (!empty($tree)) {
//            // Yes, recurse
//            $result .= self::render_tree_html($tree, $currNode['Depth']);
//        } else {
//            // No, close remaining <ul>
//            $result .= str_repeat('</ul>', $currNode['Depth'] + 1);
//        }
//        return $result;
//    }
//
//    static function render_tree_html2($tree)
//    {
//        $buf = '';
//        $depth = -1;
//        foreach ($tree as $node) {
//            if ($node['Depth'] > $depth) {
//                $buf .= "<ul><li>";
//                $buf .= "<a href='" . $node['Path'] . "'>" . $node['Title'] . "</a>";
//            } else {
//                $buf .= str_repeat("</li></ul>", $depth - $node['Depth']);
//                $buf .= "</li><li>";
//                $buf .= "<a href='" . $node['Path'] . "'>" . $node['Title'] . "</a>";
//            }
//            $depth = $node['Depth'];
//        }
//        $buf .= str_repeat("</li></ul>", $depth + 1);
//        return $buf;
//    }

    static function my_render_tree_html($tree,
                                        $custom_fields = array(
                                            'depth' => 'depth',
                                            'path' => 'path',
                                            'id' => 'id',
                                            'parent_id' => 'parent_id',
                                            'title' => 'title'
                                        )
    )
    {
        $buf = '';
        $depth = -1;
        foreach ($tree as $node) {
            if ($node[$custom_fields['depth']] > $depth) {
                $buf .= "<ul><li>";
                $buf .= "<a" .
                    " href='" . $node[$custom_fields['path']] . "'" .
                    " entity_id='" . $node[$custom_fields['id']] . "'" .
                    " parent_entity_id='" . $node[$custom_fields['parent_id']] . "'" .
                    ">" .
                    $node[$custom_fields['title']] . "</a>";
            } else {
                $buf .= str_repeat("</li></ul>", $depth - $node[$custom_fields['depth']]);
                $buf .= "</li><li>";
                $buf .= "<a" .
                    " href='" . $node[$custom_fields['path']] . "'" .
                    " entity_id='" . $node[$custom_fields['id']] . "'" .
                    " parent_entity_id='" . $node[$custom_fields['parent_id']] . "'" .
                    ">" .
                    $node[$custom_fields['title']] . "</a>";
            }
            $depth = $node[$custom_fields['depth']];
        }
        $buf .= str_repeat("</li></ul>", $depth + 1);
        //TODO fix bug there is one "</li></ul>" spare on end of string line
        return $buf;
    }

//    static function build_tree($results)
//    {
//        $return = array_shift($results);
//        if ($return['Lft'] + 1 == $return['Rght'])
//            $return['Leaf'] = true;
//        else {
//            foreach ($results as $key => $result) {
//                if ($result['Lft'] > $return['Rght']) //not a child
//                    break;
//                /** @var $rgt int */
//                if (@$rgt > $result['Lft']) //not a top-level child
//                    continue;
//                $return['children'][] = self::build_tree(array_values($results));
//
//                foreach ($results as $child_key => $child) {
//                    if ($child['Rght'] < $result['Rght'])
//                        unset($results[$child_key]);
//
//                }
//                $rgt = $result['Rght'];
//                unset($results[$key]);
//            }
//        }
//
//        unset($return['Lft'], $return['Rght']);
//        return $return;
//    }
} 