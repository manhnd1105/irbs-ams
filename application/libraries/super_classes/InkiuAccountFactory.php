<?php
namespace super_classes;


/**
 * Class InkiuAccountFactory
 * @package super_classes
 */
class InkiuAccountFactory implements ISingleton
{

    /**
     * Just for implement Singleton pattern
     * @var
     */
    private static $instance;
    /**
     * Instance of RbacRoleFactory class, used to execute its functions
     * @var RbacRoleFactory
     */
    private $rbac_role_factory;
    /**
     * @var \Model_account
     */
    private $model_account;

    /**
     * @var \Model_rbac_assigning
     */
    private $model_rbac_assigning;

    /**
     * Private constructor so nobody else can instance it
     */
    private function __construct()
    {
        //Load model for later use
        $CI = &get_instance();
        $CI->load->model('account/Model_account');
        $CI->load->model('rbac/Model_rbac_assigning');
        $this->model_account = $CI->Model_account;
        $this->model_rbac_assigning = $CI->Model_rbac_assigning;

        //Assign RbacRoleFactory instance to later use
        $this->rbac_role_factory = RbacRoleFactory::get_instance();
    }

    /**
     * Call this method to get singleton
     * @return InkiuAccountFactory
     */
    public static function get_instance()
    {
        try {
            if (!self::$instance) {
                self::$instance = new InkiuAccountFactory();
            }
            return self::$instance;

        } catch (\Exception $e) {
            IrbsException::write_log('error', $e);
        }
    }

    /**
     * Create account and save it into database
     * @param $info array of input
     * @return bool Status of this transaction
     */
    public function create_account($info)
    {
        try {
            //Create Account object and fill it with basic information (except roles)
            $acc = $this->create_account_obj($info);

//            //Assign roles to this Account instance
//            if (isset($info['roles_id']))
//            {
//                foreach ($info['roles_id'] as $row)
//                {
//                    //Load role obj
//                    $role_obj = $this->read_role_obj($row);
//                    $acc->assign_role($role_obj);
//                }
//            }
            //Save changes to database
            $status = $this->map_db($acc);
        } catch (\Exception $e) {
            IrbsException::write_log('error', $e);
            return false;
        }
        return $status;
    }

    /**
     * Create an Account object
     * @param $info array of input
     * @return InkiuAccount
     */
    public function create_account_obj($info)
    {
        //Create a new instance and then fill information into it
        $acc = new InkiuAccount();
        $acc->set_account_name($info);
        $acc->set_staff_name($info);
        $acc->set_password($info);
        $acc->set_email($info);
        $acc->set_id($info);
        $acc->set_parent_id($info);
        return $acc;
    }

    /**
     * Update all changes of InkiuAccount instance to database
     * @param InkiuAccount $acc_obj
     * @return bool
     */
    public function map_db(InkiuAccount $acc_obj)
    {
        $info = $acc_obj->get_props();
        $acc_id = $info['id'];

        try {
            //If it has no id => create new record in database
            if ($acc_id === null || $acc_id == "") {
                $this->map_db_has_no_id($info);
            } //If it has id => update existing record in database
            else {
                $this->map_db_has_id($info);
            }
        } catch (\Exception $e) {
            IrbsException::write_log('error', $e);
            return false;
        }
        return true;
    }

    /**
     * Child of map_db(), in case there is no passed id
     * Perform insert new record in to database
     * @param $info
     * @returns bool
     * @throws \Exception
     */
    private function map_db_has_no_id($info)
    {
        //Insert this account's basic information (except roles)
        $acc_id = $this->model_acc_insert($info);
        if (!$acc_id) {
            throw new \Exception('Error while asking model to insert basic information of account');
        }

//        //Assign roles to this account
//        /** @var $row RbacRole */
//        $roles = $info['roles'];
//        foreach ($roles as $row)
//        {
//            $status = $this->model_rbac_assign_acc_role($row->get_id(), $acc_id);
//            if (!$status)
//            {
//                throw new \Exception('Error while assigning role to account');
//            }
//        }
        return true;
    }

    /**
     * @param $info
     * @return mixed
     */
    function model_acc_insert($info)
    {
        return $this->model_account->insert($info);
    }

    /**
     * Child of map_db(), in case there is passed id
     * Perform update existing record in database
     * @param $info
     * @returns bool
     * @throws \Exception
     */
    private function map_db_has_id($info)
    {
        $acc_id = $info['id'];
        $roles = $info['roles'];

        //Update this account's basic information (except roles)
        $status = $this->model_acc_update($info);
        if (!$status) {
            throw new \Exception('Error while updating basic information of this account');
        }

        //Assign roles to this account
        /** @var $row RbacRole */
        foreach ($roles as $row) {
            //Remove all assigned roles of this account
            $status = $this->model_rbac_unassign_acc_roles($acc_id);
            if (!$status) {
                throw new \Exception('Error while removing all assigned roles of this account');
            }

            //Assign new roles to this account
            $status = $this->model_rbac_assign_acc_role($row->get_id(), $acc_id);
            if (!$status) {
                throw new \Exception('Error while assigning new roles to this account');
            }
        }
        return true;
    }

    /**
     * @param $info
     * @return mixed
     */
    function model_acc_update($info)
    {
        return $this->model_account->update($info);
    }

    /**
     * @param $id
     * @return mixed
     */
    function model_rbac_unassign_acc_roles($id)
    {
        return $this->model_rbac_assigning->unassign_acc_roles($id);
    }

    /**
     * @param $role_id
     * @param $acc_id
     * @return mixed
     */
    function model_rbac_assign_acc_role($role_id, $acc_id)
    {
        return $this->model_rbac_assigning->assign_acc_role($role_id, $acc_id);
    }

    /**
     * Update information of an Account object and then save changes to database
     * @param $info     array of input
     * @var   $role_obj RbacRole
     * @return bool
     */
    public function update_account($info)
    {
        try {
            //Create a new object
            $acc = $this->create_account_obj($info);

            //Assign roles to it
            foreach ($info['roles_id'] as $row) {
                $role_obj = $this->read_role_obj($row);
                $acc->assign_role($role_obj);
            }

            //Save changes of that object into database
            $this->map_db($acc);
        } catch (\Exception $e) {
            IrbsException::write_log('error', $e);
            return false;
        }
        return true;
    }

    /**
     * @param int $id
     * @return RbacRole
     */
    public function read_role_obj($id)
    {
        return $this->rbac_role_factory->read_role_obj($id);
    }

    /**
     * Remove information of an account in database
     * @param $account_id
     * @return bool
     */
    public function remove_account($account_id)
    {
        return $this->model_account->remove($account_id);
    }

    /**
     * Get id of an account according to its name
     * @param $acc_name
     * @return mixed
     */
    public function get_acc_id_by_name($acc_name)
    {
        return $this->model_account->get_id_by_name($acc_name);
    }

    /**
     * @return string
     */
    public function load_accounts_info_html()
    {
        $info = $this->load_accounts_info();
        return TreeBuilder::my_render_tree_html($info, array(
            'depth'     => 'depth',
            'path'      => 'path',
            'id'        => 'id',
            'parent_id' => 'parent_id',
            'title'     => 'account_name'
        ));
    }

    /**
     * Get all information of an account or all accounts
     * @param null $account_id
     * @return mixed
     */
    public function load_accounts_info($account_id = null)
    {
        //If has account id => get information an account based on its id
        if ($account_id !== null) {
            return $this->model_account->read_tables(array('account.id' => $account_id), '*', 'one');
        }
        //If has id => get information of all accounts
        return $this->model_account->read_tables();
    }

    /**
     * Get all reviewers which are children of a reviewer
     * @param $id
     * @return array
     */
    public function get_children_reviewers($id)
    {
        return $this->model_account->read_multi_tables(
            array(
                't1.id = t2.id',
                't2.id = t3.UserID',
                't3.RoleID = t4.ID',
                't4.Title = "reviewer"',
                "t2.parent_id = {$id}"
            ),
            '*',
            'all',
            'account AS t1, inkiu_account AS t2, rbac_userroles as t3, rbac_roles as t4'
        );
    }

    /**
     * Get all reviewers which are descendants of a reviewer
     * @param $id
     * @return array
     */
    public function get_descendants_reviewers($id)
    {
        //TODO implement this
    }

    /**
     * Get all information of all accounts and then return as array of links
     * @return array
     */
    public function load_accounts_info_links()
    {
        $info = $this->load_accounts_info();
        foreach ($info as $k => $v) {
            $info[$k] = "<a href='#'" .
                " id='" . $v['id'] . "'" .
                " class='" . "acc_list" . "'" .
                ">" .
                $v['staff_name'] . "</a>";
        }
        return $info;
    }

    /**
     * Get names of roles according to an account
     * @param $account_id
     * @return array of strings
     */
    public function load_roles_name($account_id)
    {
        $info = $this->load_roles_info($account_id);
        $result = array();
        foreach ($info as $row) {
            $result[] = $row['name'];
        }
        return $result;
    }

    /**
     * Get information of roles according to an account
     * @param int $account_id
     * @return mixed array
     */
    public function load_roles_info($account_id)
    {
        return $this->model_account->list_roles($account_id, 'name');
    }

    /**
     * Check account credentials and then store them into session
     * @param array $info Account credentials
     * @param       $session
     * @return bool
     * @throws \Exception
     */
    public function authenticate($info, $session)
    {
        $acc_name = $info['acc_name'];
        $password = $info['password'];
        $status = $this->validate($acc_name, $password);
        if (!$status) {
            throw new \Exception('Error while validating account credentials');
        }
        $session_data = array(
            'is_logged_in' => true,
            'acc_id'       => $this->model_acc_get_id_by_name($acc_name),
            'acc_name'     => $acc_name
        );
        $status = $this->store_data_to_session($session_data, $session);
        if (!$status) {
            throw new \Exception('Error while saving account credentials to session');
        }
        return true;
    }

    /**
     * Check whether an account's credentials are valid
     * @param $account_name
     * @param $password
     * @return bool
     */
    public function validate($account_name, $password)
    {
        return $this->model_account->validate_account($account_name, $password);
    }

    /**
     * @param $acc_name
     * @return mixed
     */
    function model_acc_get_id_by_name($acc_name)
    {
        return $this->model_account->get_id_by_name($acc_name);
    }

    /**
     * Push data into session
     * @param array       $data
     * @param \CI_Session $session
     * @return bool
     */
    public function store_data_to_session($data, $session)
    {
        try {
            $session->sess_create();
            $session->set_userdata($data);
        } catch (\Exception $e) {
            IrbsException::write_log('error', $e);
            return false;
        }
        return true;
    }

    /**
     *
     */
    function test()
    {
//        $r = $this->model_account->getDescendants('33');
//        var_dump($r);
    }

    /**
     * Private clone method to prevent cloning of the instance of the Singleton instance
     * @return void
     */
    private function __clone()
    {
    }
}

