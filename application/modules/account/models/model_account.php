<?php
/**
 * Class Model_account
 */
class Model_account
{
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
    public function read($where = NULL, $required_fields = '*', $return_type = 'all')
    {
        if ($where !== NULL) {
            $this->db->where($where);
        }
        $this->db->select($required_fields);
        $this->db->from('account');
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
    public function read_tables($where = NULL, $required_fields = '*', $return_type = 'all')
    { //TODO generalize this method
        if ($where !== NULL) {
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
        $info['id'] = $inserted_id;
        $inkiu_acc_info = new Inkiu_account_table($info);
        //$inkiu_acc_info->set_id($inserted_id);
        $this->db->insert('inkiu_account', $inkiu_acc_info);
        $this->db->trans_complete();
        return $inserted_id;
    }


    /**
     * Update information of an account
     * @param array $info
     * @return bool
     */
    public function update($info)
    {
        try
        {
            $account_info = new Account_table($info);
            $inkiu_account_info = new Inkiu_account_table($info);
            $account_id = $inkiu_account_info->id;

            $this->db->update('account', $account_info, array('id' => $account_id));
            $this->db->update('inkiu_account', $inkiu_account_info, array('id' => $account_id));
        } catch (Exception $e)
        {
            log_message($e->getMessage());
            return false;
        }
        return true;

    }

    /**
     * Remove information of an account
     * @param int $account_id
     */
    public function remove($account_id)
    {
        $this->db->trans_start();
        $this->db->delete('rbac_userroles', array('UserID' => $account_id));
        $this->db->delete('inkiu_account', array('id' => $account_id));
        $this->db->delete('account', array('id' => $account_id));
        $this->db->trans_complete();
    }

//    /**
//     * Assign a role to an account
//     * @param int $account_id
//     * @param int $role_id
//     */
//    public function assign_role($account_id, $role_id)
//    {
//        $this->db->insert('account_has_role', array(
//            'account_id' => $account_id,
//            'role_id' => $role_id
//        ));
//    }
//
//    /**
//     * Unassign a role or all roles according to an account
//     * @param int $account_id
//     * @param int $role_id
//     */
//    public function unassign_role($account_id, $role_id = NULL)
//    {
//        $where = array(
//            'account_id' => $account_id
//        );
//        if ($role_id !== NULL) {
//            $where['role_id'] = $role_id;
//        }
//        $this->db->delete('account_has_role', $where);
//    }

//    /**
//     * Get information of roles according to an account
//     * @param int $account_id
//     * @param string $fields
//     * @return mixed
//     */
//    public function list_roles($account_id, $fields = '*')
//    {
//        $this->db->select($fields);
//        $this->db->from('account_has_role');
//        $this->db->join('role', 'account_has_role.role_id = role.id');
//        $this->db->where('account_has_role.account_id = ' . $account_id);
//        $query = $this->db->get();
//        return $query->result_array(); //TODO improve by providing another object type instead of array
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
    public $address;

    /**
     * @param $data
     */
    public function __construct($data)
    {
        $this->address = $data['address'];
        $this->id = $data['id'];
    }

    /**
     * @param $id
     */
    public function set_id($id)
    {
        $this->id = $id;
    }
}

