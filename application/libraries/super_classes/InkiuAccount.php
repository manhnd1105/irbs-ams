<?php
namespace super_classes;

/**
 * Class InkiuAccount
 * @package super_classes1
 */
class InkiuAccount extends Account
{
    /**
     * @var string Address of owner of this account
     */
    var $_address;

    /**
     * Construct function
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all properties of this instance
     * @return array mixed
     */
    public function get_props()
    {
        $props = array(
            'id' => $this->_id,
            'account_name' => $this->_account_name,
            'staff_name' => $this->_staff_name,
            'password' => $this->_password,
            'address' => $this->_address,
            'roles' => $this->_roles
        );
        return $props;
    }

    /**
     * @param $info Array of string containing the needed value
     */
    public function set_address($info)
    {
        $this->_address = $this->init_set($info, 'address');
    }

    /**
     * @return string
     */
    public function get_address()
    {
        return $this->_address;
    }

    /**
     * Wrap this instance by an Role object
     * @param string $role_name Name of the Role that would be used to wrap this instance
     * @return mixed New Role object with new features
     */
    public function wrap_role($role_name)
    {
        return new $role_name($this);
    }
}
