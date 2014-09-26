<?php
namespace super_classes;

/**
 * Class Account
 * @package super_classes
 */
abstract class Account
{
    /**
     * @var array of Role objects
     */
    var $_roles;

    /**
     * @var string Name of account, used to log in
     */
    var $_account_name;

    /**
     * @var string Name of owner of account
     */
    var $_staff_name;

    /**
     * @var string Password of account
     */
    var $_password;

    /**
     * @var int ID of account
     */
    var $_id;

    /**
     * Construct function
     */
    function __construct()
    {
        $this->reset_roles();
    }

    /**
     * Init template to automatically set properties of this class
     * @param $info Array of input
     * @param $field string Name of the property that would be set
     * @param string $result Just to avoid declaring variable
     * @return string Result value that would be set for property
     */
    protected function init_set($info, $field, $result = '')
    {
        if (is_array($info) && isset($info[$field])) {
            $result = $info[$field];
        } else if (is_string($info)) {
            $result = $info;
        }
        return $result;
    }

    /**
     * Reset roles of this instance
     */
    function reset_roles()
    {
        $this->_roles = array();
    }

    /**
     * @param $info Array of string containing the needed value
     */
    public function set_account_name($info)
    {
        $this->_account_name = $this->init_set($info, 'account_name');
    }

    /**
     * @param $info Array of string containing the needed value
     */
    public function set_staff_name($info)
    {
        $this->_staff_name = $this->init_set($info, 'staff_name');
    }

    /**
     * @param $info Array of string containing the needed value
     */
    public function set_password($info)
    {
        $this->_password = $this->init_set($info, 'password');
    }

    /**
     * @return string
     */
    public function get_account_name()
    {
        return $this->_account_name;
    }

    /**
     * @return string
     */
    public function get_staff_name()
    {
        return $this->_staff_name;
    }

    /**
     * @return string
     */
    public function get_password()
    {
        return $this->_password;
    }

    /**
     * @return Array of Role objects
     */
    public function get_roles()
    {
        return $this->_roles;
    }

    /**
     * @param $info Array of string containing the needed value
     */
    public function set_id($info)
    {
        $this->_id = $this->init_set($info, 'id');
    }

    /**
     * @return int
     */
    public function get_id()
    {
        //If this id has been set => get in directly
        $id = $this->_id;
        //If this id has not been set => search for it in database
//        if (!isset($id) || $id == '' || $id === NULL) {
//            return \Model_account::read(array('account_name' => $this->_account_name), 'id', 'one')[0];
//        }
        return $id;
    }

    /**
     * Get all properties of this instance
     * @return array
     */
    public function get_props()
    {
        $props = array(
            'account_name' => $this->_account_name,
            'staff_name' => $this->_staff_name,
            'password' => $this->_password,
            'roles' => $this->_roles
        );
        return $props;
    }

    /**
     * Assign a role to this instance
     * @param $role_obj Role object
     */
    public function assign_role($role_obj)
    {
        //Push directly selected role object into roles array of this instance
        array_push($this->_roles, $role_obj);
    }

    /**
     * Unassign a role or all roles of this instance
     * @param Role $role_obj
     */
    public function unassign_role($role_obj = NULL)
    {
        if ($role_obj === NULL) {
            $this->reset_roles();
        } else {
            //Search whether the selected role exists in roles array of this instance
            foreach ($this->_roles as $row) {
                if ($role_obj->_id === $row->_id) {
                    unset($this->_roles[$role_obj]);
                }
            }
        }
    }
}
