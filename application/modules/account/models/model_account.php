<?php

/**
 * Class Model_account
 */
class Model_account
{
    /**
     * @var CI_DB_active_record
     */
    private $db;


    /**
     * @var CI_Controller
     */
    private $CI;

    /**
     * Construct function
     */
    function __construct()
    {
        $this->CI = &get_instance();
        $this->db = $this->CI->db;
    }

    /**
     * Get information of accounts from a table
     *
     * @param string $table
     * @param array  $where           Content of WHERE statement in query
     *                                Example: $where = array('Name' => 'manhnd')
     * @param string $required_fields Table columns that you want to select in query
     *                                Example: $required_fields = 'RoleName, RoleDescription'
     * @param string $return_type     Number of rows that you want to take in query
     *                                Example: $return_type = 'one'
     *                                Values:
     *                                'all': select all rows in result
     *                                'one': select one row in result (first row)
     * @return mixed
     */
    public function read($table, $where = null, $required_fields = '*', $return_type = 'all')
    {
        if ($where !== null) {
            $this->db->where($where);
        }
        $this->db->select($required_fields);
        $this->db->from($table);
        $result = array();
        switch ($return_type) {
            case 'all':
                $result = $this->db->get()->result_array();
                break;
            case 'one':
                $result = $this->db->get()->row_array();
        }
        return $result;
    }

    /**
     * Get information of accounts from joined tables
     *
     * @param array  $where           Content of WHERE statement in query
     *                                Example: $where = array('Name' => 'manhnd')
     * @param string $required_fields Table columns that you want to select in query
     *                                Example: $required_fields = 'RoleName, RoleDescription'
     * @param string $return_type     Number of rows that you want to take in query
     *                                Example: $return_type = 'one'
     *                                Values:
     *                                'all': select all rows in result
     *                                'one': select one row in result (first row)
     * @return mixed
     */
    public function read_tables($where = null, $required_fields = '*', $return_type = 'all')
    {
        if ($where !== null) {
            $this->db->where($where);
        }
        $this->db->select($required_fields);
        $this->db->from('account');
        $this->db->join('inkiu_account', 'account.id = inkiu_account.id');
        $result = array();
        switch ($return_type) {
            case 'all':
                $result = $this->db->get()->result_array();
                break;
            case 'one':
                $result = $this->db->get()->row_array();
        }
        return $result;
    }

    /**
     * Get information of accounts from multi joined tables
     *
     * @param array  $where           Content of WHERE statement in query
     *                                Example: $where = array('Name' => 'manhnd')
     * @param string $required_fields Table columns that you want to select in query
     *                                Example: $required_fields = 'RoleName, RoleDescription'
     * @param string $return_type     Number of rows that you want to take in query
     *                                Example: $return_type = 'one'
     *                                Values:
     *                                'all': select all rows in result
     *                                'one': select one row in result (first row)
     * @param string $tables          The tables' names in FROM statement
     *                                Example: $tables = 'account, inkiu_account, userroles'
     * @return array
     */
    public function read_multi_tables(
        $where = null,
        $required_fields = '*',
        $return_type = 'all',
        $tables
    ) {
        if ($where !== null) {
            foreach ($where as $row) {
                $this->db->where($row);
            }
        }
        $this->db->select($required_fields);
        $this->db->from($tables);
        $result = array();
        switch ($return_type) {
            case 'all':
                $result = $this->db->get()->result_array();
                break;
            case 'one':
                $result = $this->db->get()->row_array();
        }
        return $result;
    }

    /**
     * Perform complex sql queries
     * @param $sql
     * @return mixed
     */
    public function query($sql) {
        return $this->db->query($sql);
    }
//    /**
//     * Insert information of new account
//     * @param array $info
//     * @return mixed
//     */
//    public function insert($info)
//    {
//        $this->db->trans_start();
//        //Insert into account table
//        $acc_info = new Account_table($info);
//        $this->db->insert('account', $acc_info);
//
//        //Get inserted id and then insert into inkiu account table
//        $inserted_id = $this->db->insert_id();
//        $inkiu_acc_info = new Inkiu_account_table($info);
//        $inkiu_acc_info->setId($inserted_id);
//
//        //Calculate the left, right, path, depth
//
//        $this->db->insert('inkiu_account', $inkiu_acc_info);
//        $this->db->trans_complete();
//        return $inserted_id;
//    }

    /**
     * Update information of an account
     * @param array $info
     * @return bool
     */
    public function update($info)
    {
        try {
            $account_info = new Account_table($info);
            $inkiu_account_info = new Inkiu_account_table($info);
            $account_id = $info['id'];

            $this->db->update('account', $account_info, array('id' => $account_id));
            $this->db->update('inkiu_account', $inkiu_account_info, array('id' => $account_id));
        } catch (\Exception $e) {
            \super_classes\IrbsException::write_log('error', $e);
            return false;
        }
        return true;
    }

//    /**
//     * Remove information of an account
//     * @param int $account_id
//     * @return bool
//     */
//    public function remove($account_id)
//    {
//        try
//        {
//            $this->db->trans_start();
//            $this->db->delete('rbac_userroles', array('UserID' => $account_id));
//            $this->db->delete('inkiu_account', array('id' => $account_id));
//            $this->db->delete('account', array('id' => $account_id));
//            $this->db->trans_complete();
//            return true;
//        }catch (\Exception $e){
//            \super_classes\IrbsException::write_log('error', $e);
//            return false;
//        }
//
//    }

    /**
     * Check if account name and password are matched or not
     * @param string $account_name
     * @param string $password
     * @return bool
     */
    public function validate_account($account_name, $password)
    {
        // Build a query to retrieve the user's details
        // based on the received username and password
        $this->db->from('account');
        $this->db->where('account_name', $account_name);
        $this->db->where('password', $password);
        $login = $this->db->get()->result_array();

        // The results of the query are stored in $login.
        // If a value exists, then the user account exists and is validated
        if (is_array($login) && count($login) == 1) {
            return true;
        }
        return false;

    }

    /**
     * Get id of an account by searching its account name
     * @param $account_name
     * @return mixed
     */
    public function get_id_by_name($account_name)
    {
        $this->db->from('account');
        $this->db->where('account_name', $account_name);
        return $this->db->get()->row_array()['id'];
    }

    /**
     * Insert information of new account
     * @param array $info
     * @return mixed
     */
    public function insert($info)
    {

        $this->db->trans_start();
        //Insert into account table
        $acc_info = new Account_table($info);
        $this->db->insert('account', $acc_info);

        //Get inserted id and then insert into inkiu account table
        $inserted_id = $this->db->insert_id();
        $inkiu_acc_info = array(
            'id'        => $inserted_id,
            'address'   => 'dump',
            'parent_id' => $info['parent_id'],
            'path'      => 'dump',
            'email'     => $info['email'],
            'depth'     => '-1'
        );
        //Calculate the left, right, path, depth
        $this->insert_child($info['parent_id'], $inkiu_acc_info);

//        $this->db->insert('inkiu_account', $inkiu_acc_info);
        $this->db->trans_complete();
        return $inserted_id;
    }

    /**
     * Insert a new child as a children of a selected node
     * @param int   $id
     * @param array $info
     */
    private function insert_child($id, $info)
    {
        //Find the Sibling
        $Sibl = $this->get_slibings($id)[0];
        if ($Sibl == null) {
            $Sibl['lft'] = 0;
        }
        $lft = $Sibl['lft'];

        $sql = "UPDATE inkiu_account SET inkiu_account.rgt = inkiu_account.rgt + 2 WHERE inkiu_account.rgt > {$lft}";
        $this->db->query($sql);
        $sql = "UPDATE inkiu_account SET inkiu_account.lft = inkiu_account.lft + 2 WHERE inkiu_account.lft > {$lft}";
        $this->db->query($sql);

        $this->db->set('id', $info['id']);
        $this->db->set('address', $info['address']);
        $this->db->set('lft', $lft + 1);
        $this->db->set('rgt', $lft + 2);
        $this->db->set('parent_id', $info['parent_id']);
        $this->db->set('path', $info['path']);
        $this->db->set('email', $info['email']);
        $this->db->set('depth', $info['depth']);
        $this->db->insert('inkiu_account');

        $inserted_id = $this->db->insert_id();
        $path = $this->get_path($inserted_id);
        $depth = $this->find_depth($inserted_id);

        $this->db->trans_start();
        $this->db->set('path', $path);
        $this->db->set('depth', $depth);
        $this->db->where('id', $inserted_id);
        $this->db->update('inkiu_account');
        $this->db->trans_complete();
    }

    /**
     * Get all slibings of a node in array
     * @param $id
     * @return mixed array
     */
    private function get_slibings($id)
    {
        $this->db->from('inkiu_account');
        $this->db->where('id', $id);
        $this->db->select('lft');
        return $this->db->get()->result_array();
    }

    /**
     * Get path of a node as string path
     * @param $id
     * @return string
     */
    public function get_path($id)
    {
        $path_nodes = $this->get_path_nodes($id);
        $path = '';
        foreach ($path_nodes as $row) {
            $this->db->where(array('id' => $row->id));
            $this->db->select('account_name');
            $this->db->from('account');

            $path .= $this->db->get()->row_array()['account_name'] . '/';
        }
        return $path;
    }

    /**
     * Get path of a node as array of nodes
     * @param $id
     */
    private function get_path_nodes($id)
    {
        $path_sql =
            "SELECT parent.*
            FROM inkiu_account AS node, inkiu_account AS parent
            WHERE node.lft BETWEEN parent.lft AND parent.rgt
            AND node.id = " . $id . "
            ORDER BY parent.lft";
        return $this->db->query($path_sql)->result();
    }

    /**
     * @param $id
     * @return int
     */
    public function find_depth($id)
    {
        $path = $this->get_path_nodes($id);
        return count($path);
    }

    /**
     * Get all descendants of a node as an array
     * @param $id
     */
    public function get_descendants($id)
    {
        $DepthConcat = "- (sub_tree.depth )";
        $sql = "
            SELECT node.*, (COUNT(parent.id)-1 {$DepthConcat} ) AS Depth
            FROM inkiu_account AS node,
            	inkiu_account AS parent,
            	inkiu_account AS sub_parent,
            	(
            		SELECT node.id, (COUNT(parent.id) - 1) AS depth
            		FROM inkiu_account AS node,
            		inkiu_account AS parent
            		WHERE node.lft BETWEEN parent.lft AND parent.rgt
            		AND node.id = {$id}
            		GROUP BY node.id
            		ORDER BY node.lft
            	) AS sub_tree
            WHERE node.lft BETWEEN parent.lft AND parent.rgt
            	AND node.lft BETWEEN sub_parent.lft AND sub_parent.rgt
            	AND sub_parent.id = sub_tree.id
            GROUP BY node.id
            HAVING Depth > 0
            ORDER BY node.lft";
        return $this->db->query($sql)->result_array();
    }

    /**
     * Delete a node and all of its descendants
     * @param $id
     */
    public function remove_sub($id)
    {

        $sql = "SELECT lft AS 'Left',rgt AS 'Right' ,rgt-lft+ 1 AS 'Width' FROM inkiu_account WHERE id = {$id};
        ";
        $info = $this->db->query($sql)->result_array()[0];

        $sql = "DELETE FROM inkiu_account WHERE lft BETWEEN {$info['Left']} AND {$info['Right']}";
        $this->db->query($sql);

        $sql = "UPDATE inkiu_account SET rgt = rgt - {$info['Width']} WHERE rgt > {$info['Right']}";
        $this->db->query($sql);

        $sql = "UPDATE inkiu_account SET lft = lft - {$info['Width']} WHERE lft > {$info['Right']}";
        $this->db->query($sql);
    }

    /**
     * Remove
     * @param $id
     * @return bool
     */
    public function remove($id)
    {
        try {
            $this->db->trans_start();
            $this->db->delete('rbac_userroles', array('UserID' => $id));
            $this->remove_shift($id);
            $this->db->delete('account', array('id' => $id));
            $this->db->trans_complete();
            return true;
        } catch (Exception $e) {
            print $e->getMessage();
            return false;
        }

    }

    /**
     * Delete a node and shift its descendants
     * @param $id
     */
    private function remove_shift($id)
    {
        $sql = "SELECT lft AS 'Left',rgt AS 'Right' ,rgt-lft+ 1 AS 'Width' FROM inkiu_account WHERE id = {$id};
        ";
        $info = $this->db->query($sql)->result_array()[0];

        $sql = "DELETE FROM inkiu_account WHERE lft = {$info['Left']}";
        $this->db->query($sql);

        $sql = "UPDATE inkiu_account SET rgt = rgt - 1, lft = lft - 1 WHERE lft BETWEEN {$info['Left']} AND {$info['Right']}";
        $this->db->query($sql);

        $sql = "UPDATE inkiu_account SET rgt = rgt - 2 WHERE rgt > {$info['Right']}";
        $this->db->query($sql);

        $sql = "UPDATE inkiu_account SET lft = lft - 2 WHERE lft > {$info['Right']}";
        $this->db->query($sql);
    }
}

/**
 * Just to fill information from mixed array
 * Class Account_table
 */
class Account_table
{
    /**
     * @var
     */
    public $account_name;
    /**
     * @var
     */
    public $staff_name;
    /**
     * @var
     */
    public $password;

    /**
     * @param $data
     */
    public function __construct($data)
    {
        $this->account_name = $data['account_name'];
        $this->staff_name = $data['staff_name'];
        $this->password = $data['password'];
    }
}

/**
 * Just to fill information from mixed array
 * Class Inkiu_account_table
 */
class Inkiu_account_table
{
    /**
     * @var
     */
    public $id;

    /**
     * @var
     */
    public $email;

    /**
     * @var
     */
    public $left;
    /**
     * @var
     */
    public $right;
    /**
     * @var
     */
    public $parent_id;
    /**
     * @var
     */
    public $path;
    /**
     * @var
     */
    public $depth;

    /**
     * @param $data
     */
    public function __construct($data)
    {
        $this->email = $data['email'];
        $this->id = $data['id'];
//        $this->parent_id = $data['parent'];
    }
}

