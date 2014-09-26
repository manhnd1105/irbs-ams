<?php

/**
 * Created by PhpStorm.
 * User: dell
 * Date: 8/8/14
 * Time: 9:46 AM
 */
class Model_template
{
    /**
     * @var mixed
     */
    private $db;

    /**
     * Construct function
     */
    function __construct()
    {
        $this->db = & get_instance()->db;
    }

    /**
     * Get information of accounts from a table
     *
     * @param string $table Table name
     * @param array $where Content of WHERE statement in query
     *        Example: $where = array('Name' => 'manhnd')
     * @param string $required_fields Table columns that you want to select in query
     *        Example: $required_fields = 'RoleName, RoleDescription'
     * @param string $return_type Number of rows that you want to take in query
     *        Example: $return_type = 'one'
     *        Values:
     *            'all': select all rows in result
     *            'one': select one row in result (first row)
     * @return mixed
     */
    public function get($table, $where = NULL, $required_fields = '*', $return_type = 'all')
    {
        if ($where !== NULL) {
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
     * @param array $where Content of WHERE statement in query
     * @param string $required_fields Table columns that you want to select in query
     * @param string $return_type Number of rows that you want to take in query
     * @return mixed
     */
    public function gets($where = NULL, $required_fields = '*', $return_type = 'all')
    {
//        if ($where !== NULL) {
//            $this->db->where($where);
//        }
//        $this->db->select($required_fields);
//        $this->db->from('account');
//        $this->db->join('inkiu_account', 'account.id = inkiu_account.id');
//        $result = array();
//        switch ($return_type) {
//            case 'all':
//                $result = $this->db->get()->result_array();
//                break;
//            case 'one':
//                $result = $this->db->get()->row_array();
//        }
//        return $result;
    }

    /**
     * Insert a new record into a table
     * @param string $table Table name
     * @param array $info
     * @return mixed
     */
    public function insert($table, $info)
    {
        return $this->db->insert($table, $info);
    }

    /**
     * Insert new record into joined tables
     * @param string $table Table name
     * @param array $info
     * @return mixed
     */
    public function inserts($table, $info)
    {
//        $this->db->trans_start();
//        //Insert into account table
//        $acc_info = new Account_table($info);
//        $this->db->insert($table, $acc_info);
//
//        //Get inserted id and then insert into inkiu account table
//        $inserted_id = $this->db->insert_id();
//        $info['id'] = $inserted_id;
//        $inkiu_acc_info = new Inkiu_account_table($info);
//        //$inkiu_acc_info->set_id($inserted_id);
//        $this->db->insert('inkiu_account', $inkiu_acc_info);
//        $this->db->trans_complete();
//        return $inserted_id;
    }

    /**
     * Update information of a record of a table
     * @param string $table Table name
     * @param array $info Information need to update to a record
     * @param array $where Condition of update sql command
     * @return bool
     */
    public function update($table, $info, $where)
    {
        return $this->db->update($table, $info, $where);
    }

    /**
     * Update information of record of joined tables
     * @param string $table Table name
     * @param array $info
     * @return bool
     */
    public function updates($table, $info)
    {
//        $account_info = new Account_table($info);
//        $inkiu_account_info = new Inkiu_account_table($info);
//        $account_id = $inkiu_account_info->id;
//
//        $this->db->update('account', $account_info, array('id' => $account_id));
//        $this->db->update('inkiu_account', $inkiu_account_info, array('id' => $account_id));
    }

    /**
     * Remove records of a table
     * @param string $table Table name
     * @param array $where
     */
    public function delete($table, $where)
    {
        return $this->db->delete($table, $where);
    }

    /**
     * Remove records of joined tables
     * @param int $id
     */
    public function deletes($id)
    {
//        $this->db->trans_start();
//        $this->db->delete('rbac_userroles', array('UserID' => $account_id));
//        $this->db->delete('inkiu_account', array('id' => $account_id));
//        $this->db->delete('account', array('id' => $account_id));
//        $this->db->trans_complete();
    }
}