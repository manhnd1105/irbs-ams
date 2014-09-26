<?php
/**
 * Class Model_account
 */
class Model_account
{
    private $db;
    private $db_test;
    /**
     * Construct function
     */
    private  $CI;
    function __construct()
    {
        $this->CI = & get_instance();
        if (defined('PHPUNIT_TEST')){
            $db_testing_name = $this->CI->db->database.'_testing';
            $host = $this->CI->db->hostname;
            $username = $this->CI->db->username;
            $password = $this->CI->db->password;
            $db_driver = $this->CI->db->dbdriver;
            $dsn = $db_driver.'://'.$username.':'.$password.'@'.$host.'/'.$db_testing_name;
            $this->db_test = $this->CI->load->database($dsn,true);
        }else{
            $this->db = $this->CI->db;
        }
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
        $db = null;
        if (defined('PHPUNIT_TEST')) {
            if ($where !== NULL) {
                $this->db_test->where($where);
            }
            $this->db_test->select($required_fields);
            $this->db_test->from('account');
            $result = array();
            switch ($return_type) {
                case 'all':
                    $result = $this->db_test->get()->result_array();
                    break;
                case 'one':
                    $result = $this->db_test->get()->row_array();
            }
            return $result;
        }
        else{
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
    {
        if (defined('PHPUNIT_TEST')) {
            if ($where !== NULL) {
                $this->db_test->where($where);
            }
            $this->db_test->select($required_fields);
            $this->db_test->from('account');
            $this->db_test->join('inkiu_account', 'account.id = inkiu_account.id');
            $result = array();
            switch ($return_type) {
                case 'all':
                    $result = $this->db_test->get()->result_array();
                    break;
                case 'one':
                    $result = $this->db_test->get()->row_array();
            }
            return $result;
        }
        else{
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

    }

    /**
     * Insert information of new account
     * @param array $info
     * @return mixed
     */
    public function insert($info)
    {
        if (defined('PHPUNIT_TEST')) {
            $this->db_test->trans_start();
            //Insert into account table
            $acc_info = new Account_table($info);
            $this->db_test->insert('account', $acc_info);

            //Get inserted id and then insert into inkiu account table
            $inserted_id = $this->db_test->insert_id();
            $info['id'] = $inserted_id;
            $inkiu_acc_info = new Inkiu_account_table($info);
            //$inkiu_acc_info->set_id($inserted_id);
            $this->db_test->insert('inkiu_account', $inkiu_acc_info);
            $this->db_test->trans_complete();
            return $inserted_id;
        }
        else{
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

    }


    /**
     * Update information of an account
     * @param array $info
     * @return bool
     */
    public function update($info)
    {
        if (defined('PHPUNIT_TEST')) {
            try
            {
                $account_info = new Account_table($info);
                $inkiu_account_info = new Inkiu_account_table($info);
                $account_id = $inkiu_account_info->id;

                $this->db_test->update('account', $account_info, array('id' => $account_id));
                $this->db_test->update('inkiu_account', $inkiu_account_info, array('id' => $account_id));
            } catch (Exception $e)
            {
                log_message($e->getMessage());
                return false;
            }
            return true;
        }
        else{
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
    }

    /**
     * Remove information of an account
     * @param int $account_id
     * @return bool
     */
    public function remove($account_id)
    {
        if (defined('PHPUNIT_TEST')) {
            try{
                $this->db_test->trans_start();
                $this->db_test->delete('account_has_role', array('account_id' => $account_id));
                $this->db_test->delete('inkiu_account', array('id' => $account_id));
                $this->db_test->delete('account', array('id' => $account_id));
                $this->db_test->trans_complete();
                return true;
            }catch (Exception $e){
                print $e->getMessage();
                return false;
            }
        }
        else{
            try{
                $this->db->trans_start();
                $this->db->delete('account_has_role', array('account_id' => $account_id));
                $this->db->delete('inkiu_account', array('id' => $account_id));
                $this->db->delete('account', array('id' => $account_id));
                $this->db->trans_complete();
                return true;
            }catch (Exception $e){
                print $e->getMessage();
                return false;
            }

        }

    }

    /**
     * Assign a role to an account
     * @param int $account_id
     * @param int $role_id
     * @return bool
     */
    public function assign_role($account_id, $role_id)
    {
        if (defined('PHPUNIT_TEST')) {
            try{
                $this->db_test->insert('account_has_role', array(
                    'account_id' => $account_id,
                    'role_id' => $role_id
                ));
                return true;
            }catch (Exception $e){
                print $e->getMessage();
                return false;
            }
        }
        else{
            try{
                $this->db->insert('account_has_role', array(
                    'account_id' => $account_id,
                    'role_id' => $role_id
                ));
                return true;
            }catch (Exception $e){
                print $e->getMessage();
                return false;
            }

        }

    }

    /**
     * Unassign a role or all roles according to an account
     * @param int $account_id
     * @param int $role_id
     */
    public function unassign_role($account_id, $role_id = NULL)
    {
        if (defined('PHPUNIT_TEST')) {
            $where = array(
                'account_id' => $account_id
            );
            if ($role_id !== NULL) {
                $where['role_id'] = $role_id;
            }
            $this->db_test->delete('account_has_role', $where);

        }
        else{
            $where = array(
                'account_id' => $account_id
            );
            if ($role_id !== NULL) {
                $where['role_id'] = $role_id;
            }
            $this->db->delete('account_has_role', $where);
        }

    }

    /**
     * Get information of roles according to an account
     * @param int $account_id
     * @param string $fields
     * @return mixed
     */
    public function list_roles($account_id, $fields = '*')
    {
        if (defined('PHPUNIT_TEST')) {
            $this->db_test->select($fields);
            $this->db_test->from('account_has_role');
            $this->db_test->join('role', 'account_has_role.role_id = role.id');
            $this->db_test->where('account_has_role.account_id = ' . $account_id);
            $query = $this->db_test->get();
            return $query->result_array(); //TODO improve by providing another object type instead of array
        }
        else{
            $this->db->select($fields);
            $this->db->from('account_has_role');
            $this->db->join('role', 'account_has_role.role_id = role.id');
            $this->db->where('account_has_role.account_id = ' . $account_id);
            $query = $this->db->get();
            return $query->result_array(); //TODO improve by providing another object type instead of array
        }

    }

    /**
     * Check if account name and password are matched or not
     * @param string $account_name
     * @param string $password
     * @return bool
     */
    public function validate_account($account_name, $password)
    {
        if (defined('PHPUNIT_TEST')) {
            // Build a query to retrieve the user's details
            // based on the received username and password
            $this->db_test->from('account');
            $this->db_test->where('account_name', $account_name);
            $this->db_test->where('password', $password);
            $login = $this->db_test->get()->result_array();

            // The results of the query are stored in $login.
            // If a value exists, then the user account exists and is validated
            if (is_array($login) && count($login) == 1) {
                return true;
            }
            return false;
        }
        else{
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

    }

    /**
     * Get id of an account by searching its account name
     * @param $account_name
     * @return mixed
     */
    public function get_id_by_name($account_name)
    {
        if (defined('PHPUNIT_TEST')) {
            $this->db_test->from('account');
            $this->db_test->where('account_name', $account_name);
            return $this->db_test->get()->row_array()['id'];
        }
        else{
            $this->db->from('account');
            $this->db->where('account_name', $account_name);
            return $this->db->get()->row_array()['id'];
        }

    }
//    /**
//     * Used to manage all database operations
//     * @var mixed
//     */
//    private static $_db;
//
//    /**
//     * Construct function
//     */
//    function __construct()
//    {
//        parent::__construct();
//        $this->db = & get_instance()->db;
//    }
//
//    /**
//     * Get information of accounts from a table
//     * @param null $where
//     * Type: array
//     *        Desc: content of WHERE statement in query
//     *        Example: $where = array('Name' => 'manhnd')
//     *        Default: NULL (query has no where statement)
//     * @param string $required_fields
//     * Type: string
//     *        Desc: Table columns that you want to select in query
//     *        Example: $required_fields = 'RoleName, RoleDescription'
//     *    Default: '*' to select all columns
//     * @param string $return_type
//     *     *        Type: string
//     *        Desc: number of rows that you want to take in query
//     *        Example: $return_type = 'one'
//     *        Values:
//     *            'all': select all rows in result
//     *            'one': select one row in result (first row)
//     *        Default: 'all'
//     * @return mixed
//     */
//    public static function read($where = NULL, $required_fields = '*', $return_type = 'all')
//    {
//        if ($where !== NULL) {
//            $this->db->where($where);
//        }
//        $this->db->select($required_fields);
//        $this->db->from('account');
//        $result = array();
//        switch ($return_type) {
//            case 'all':
//                $result = $this->db->get()->result_array();
//                break;
//            case 'one':
//                $result = $this->db->get()->row_array();
//        }
//        return $result;
//    }
//
//    /**
//     * Get information of accounts from joined tables
//     * @param null $where
//     * Type: array
//     *        Desc: content of WHERE statement in query
//     *        Example: $where = array('Name' => 'manhnd')
//     *        Default: NULL (query has no where statement)
//     * @param string $required_fields
//     * Type: string
//     *        Desc: Table columns that you want to select in query
//     *        Example: $required_fields = 'RoleName, RoleDescription'
//     *    Default: '*' to select all columns
//     * @param string $return_type
//     *     *        Type: string
//     *        Desc: number of rows that you want to take in query
//     *        Example: $return_type = 'one'
//     *        Values:
//     *            'all': select all rows in result
//     *            'one': select one row in result (first row)
//     *        Default: 'all'
//     * @return mixed
//     */
//    public static function read_tables($where = NULL, $required_fields = '*', $return_type = 'all')
//    { //TODO generalize this method
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
//    }
//
//    /**
//     * Insert information of new account
//     * @param $info
//     * @return mixed
//     */
//    public static function insert($info)
//    {
//        $this->db->trans_start();
//        //Insert into account table
//        $acc_info = new Account_table($info);
//        $this->db->insert('account', $acc_info);
//
//        //Get inserted id and then insert into inkiu account table
//        $inserted_id = $this->db->insert_id();
//        $info['id'] = $inserted_id;
//        $inkiu_acc_info = new Inkiu_account_table($info);
//        //$inkiu_acc_info->set_id($inserted_id);
//        $this->db->insert('inkiu_account', $inkiu_acc_info);
//        $this->db->trans_complete();
//        return $inserted_id;
//    }
//
//
//    /**
//     * Update information of an account
//     * @param $info
//     * @return bool
//     */
//    public static function update($info)
//    {
//        try
//        {
//            $account_info = new Account_table($info);
//            $inkiu_account_info = new Inkiu_account_table($info);
//            $account_id = $inkiu_account_info->id;
//
//            $this->db->update('account', $account_info, array('id' => $account_id));
//            $this->db->update('inkiu_account', $inkiu_account_info, array('id' => $account_id));
//        } catch (Exception $e)
//        {
//            log_message($e->getMessage());
//            return false;
//        }
//        return true;
//
//    }
//
//    /**
//     * Remove information of an account
//     * @param $account_id
//     */
//    public static function remove($account_id)
//    {
//        $this->db->trans_start();
//        $this->db->delete('account_has_role', array('account_id' => $account_id));
//        $this->db->delete('inkiu_account', array('id' => $account_id));
//        $this->db->delete('account', array('id' => $account_id));
//        $this->db->trans_complete();
//    }
//
//    /**
//     * Assign a role to an account
//     * @param $account_id
//     * @param $role_id
//     */
//    public static function assign_role($account_id, $role_id)
//    {
//        $this->db->insert('account_has_role', array(
//            'account_id' => $account_id,
//            'role_id' => $role_id
//        ));
//    }
//
//    /**
//     * Unassign a role or all roles according to an account
//     * @param $account_id
//     * @param null $role_id
//     */
//    public static function unassign_role($account_id, $role_id = NULL)
//    {
//        $where = array(
//            'account_id' => $account_id
//        );
//        if ($role_id !== NULL) {
//            $where['role_id'] = $role_id;
//        }
//        $this->db->delete('account_has_role', $where);
//    }
//
//    /**
//     * Get information of roles according to an account
//     * @param $account_id
//     * @param string $fields
//     * @return mixed
//     */
//    public static function list_roles($account_id, $fields = '*')
//    {
//        $this->db->select($fields);
//        $this->db->from('account_has_role');
//        $this->db->join('role', 'account_has_role.role_id = role.id');
//        $this->db->where('account_has_role.account_id = ' . $account_id);
//        $query = $this->db->get();
//        return $query->result_array(); //TODO improve by providing another object type instead of array
//    }
//
//    /**
//     * Check if account name and password are matched or not
//     * @param $account_name
//     * @param $password
//     * @return bool
//     */
//    public static function validate_account($account_name, $password)
//    {
//        // Build a query to retrieve the user's details
//        // based on the received username and password
//        $this->db->from('account');
//        $this->db->where('account_name', $account_name);
//        $this->db->where('password', $password);
//        $login = $this->db->get()->result_array();
//
//        // The results of the query are stored in $login.
//        // If a value exists, then the user account exists and is validated
//        if (is_array($login) && count($login) == 1) {
//            return true;
//        }
//        return false;
//    }
//
//    /**
//     * Get id of an account by searching its account name
//     * @param $account_name
//     * @return mixed
//     */
//    public static function get_id_by_name($account_name)
//    {
//        $this->db->from('account');
//        $this->db->where('account_name', $account_name);
//        return $this->db->get()->row_array()['id'];
//    }
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

