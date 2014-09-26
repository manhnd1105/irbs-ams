<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require_once APPPATH . '/libraries/REST_Controller.php';

/**
 * Class Api_controller
 */
class Api_controller extends REST_Controller
{
    /**
     * @var super_classes\InkiuAccountFactory
     */
    private $account_factory;

    /**
     * @var super_classes\RbacRoleFactory
     */
    private $rbac_role_factory;

    /**
     * @var super_classes\RbacPermFactory
     */
    private $rbac_perm_factory;

    /**
     * @var super_classes\RbacRestrictAccessFactory
     */
    private $restrict_factory;

    /**
     * @var super_classes\RbacAssigningFactory
     */
    private $rbac_assigning_factory;

    /**
     *
     */
    function __construct()
    {
        parent::__construct();
        $this->account_factory = \super_classes\InkiuAccountFactory::get_instance();
        $this->restrict_factory = \super_classes\RbacRestrictAccessFactory::get_instance();
        $this->rbac_role_factory = \super_classes\RbacRoleFactory::get_instance();
        $this->rbac_perm_factory = \super_classes\RbacPermFactory::get_instance();
        $this->rbac_assigning_factory = \super_classes\RbacAssigningFactory::get_instance();
    }

    /**
     * Return information of all accounts
     */
    function accounts_get()
    {
        //Ask factory to get accounts information
        $info = $this->account_factory->load_accounts_info();

        //Send response to client
        if ($info) {
            $this->response($info, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Could not find any accounts!'), 404);
        }
    }

    /**
     * Return information of an account
     */
    function account_get()
    {
        //Get information from GET method of Restful standard
        $id = $this->get('id');

        //Ask factory to get account information
        $info = $this->account_factory->load_accounts_info($id);

        //Send response to client
        if ($info) {
            $this->response($info, 400);
        } else {
            $this->response(array('error' => 'Account could not be found'), 404);
        }
    }

    /**
     * Update information of an account and respond with status/errors
     */
    function account_post()
    {
        //Get information from POST method of Restful standard
        $info = $this->post();

        //Ask factory to update account
        $status = $this->account_factory->update_account($info);

        //Send response to client
        if ($status) {
            $this->response(array('success' => 'Account created'), 200);
        } else {
            $this->response(array('error' => 'Account could not be created'), 404);
        }
    }

    /**
     * Create an account with provided information and respond with status/errors
     */
    function account_put()
    {
        //Get information from PUT method of Restful standard
        $info = $this->put();

        //Ask factory to create account
        $status = $this->account_factory->create_account($info);

        //Send response to client
        if ($status) {
            $this->response(array('success' => 'Account created'), 200);
        } else {
            $this->response(array('error' => 'Account could not be created'), 404);
        }
    }

    /**
     * Delete an account with provided id and respond with status/errors
     */
    function account_delete()
    {
        //Get information from GET method of Restful standard
        $id = $this->delete('id');

        //Ask factory to delete account
        $status = $this->account_factory->remove_account($id);

        //Send response to client
        if ($status) {
            $message = array('id' => $id, 'message' => 'DELETED!');
            $this->response($message, 200);
        } else {
            $this->response(array('error' => 'Can not delete this account'), 404);
        }

    }

    /**
     * Get account validation result
     */
    function validation_get()
    {
        //Get information from GET method of Restful standard
        $info = $this->get();

        //Ask factory to validate account information
        $status = $this->account_factory->validate($info['acc_name'], $info['password']);

        //Send response to client according to validating result
        if ($status)
        {
            $message = array(
                'status' => 'account credentials are correct'
            );
            $this->response($message, 200);
        } else
        {
            $message = array(
                'status' => 'account credentials are incorrect'
            );
            $this->response($message, 404);
        }
    }


    /**
     * Check whether an account has permission to perform action (path)
     */
    function check_permission_get()
    {
        //Get information from GET method of Restful standard
        $info = $this->get();

        //Ask factory to check whether this account be allowed to do this action (permission)
        $status = $this->restrict_factory->check_access($info['acc_id'], $info['perm_path']);

        //Send response to client according to validating result
        if ($status)
        {
            $message = array(
                'status' => 'you are allowed to perform this action'
            );
            $this->response($message, 200);
        } else
        {
            $message = array(
                'status' => 'you are forbidden to perform this action'
            );
            $this->response($message, 404);
        }
    }

    /**
     * Create a role and then respond with status/errors
     */
    function role_put()
    {
        //Get information from PUT method of Restful standard
        $info = $this->put();

        //Ask factory to create role
        $status = $this->rbac_role_factory->create_role($info);

        //Send response to client
        if ($status)
        {
            $message = array(
                'status' => 'created'
            );
            $this->response($message, 200);
        } else
        {
            $message = array(
                'status' => 'error'
            );
            $this->response($message, 404);
        }
    }

    /**
     * Get information of a role
     */
    function role_get()
    {
        //Get information from GET method of Restful standard
        $id = $this->get('id');

        //Ask factory to get role information
        $info = $this->rbac_role_factory->read_role($id);

        //Send response to client
        if ($info)
        {
            $this->response($info, 200);
        } else
        {
            $message = array(
                'status' => 'can not find this role'
            );
            $this->response($message, 404);
        }
    }

    /**
     * Get all roles information
     */
    function roles_get()
    {
        //Ask factory to get all roles information
        $info = $this->rbac_role_factory->read_roles();

        //Send response to client
        if ($info)
        {
            $this->response($info, 200);
        } else
        {
            $message = array(
                'status' => 'can not find any roles'
            );
            $this->response($message, 404);
        }
    }

    /**
     * Update a role information and then respond with status/errors
     */
    function role_post()
    {
        //Get information from POST method of Restful standard
        $info = $this->post();

        //Ask factory to update role
        $status = $this->rbac_role_factory->update_role($info);

        //Send response to client
        if ($status)
        {
            $message = array(
                'status' => 'updated'
            );
            $this->response($message, 200);
        } else
        {
            $message = array(
                'status' => 'error'
            );
            $this->response($message, 404);
        }
    }

    /**
     * Delete a role and then respond with status/errors
     */
    function role_delete()
    {
        //Get information from DELETE method of Restful standard
        $id = $this->delete('id');

        //Ask factory to delete role
        $status = $this->rbac_role_factory->delete_role($id);

        //Send response to client
        if ($status)
        {
            $message = array(
                'status' => 'deleted'
            );
            $this->response($message, 200);
        } else
        {
            $message = array(
                'status' => 'error'
            );
            $this->response($message, 404);
        }
    }

    /**
     * Create a permission and then respond with status/errors
     */
    function perm_put()
    {
        //Get information from PUT method of Restful standard
        $info = $this->put();

        //Ask factory to create permission
        $status = $this->rbac_perm_factory->create_perm($info);

        //Send response to client
        if ($status)
        {
            $message = array(
                'status' => 'created'
            );
            $this->response($message, 200);
        } else
        {
            $message = array(
                'status' => 'error'
            );
            $this->response($message, 404);
        }
    }

    /**
     * Get information of a permission
     */
    function perm_get()
    {
        //Get information from GET method of Restful standard
        $id = $this->get('id');

        //Ask factory to get permission information
        $info = $this->rbac_perm_factory->read_perm($id);

        //Send response to client
        if ($info)
        {
            $this->response($info, 200);
        } else
        {
            $message = array(
                'status' => 'error'
            );
            $this->response($message, 404);
        }
    }

    /**
     * Get all permissions information
     */
    function perms_get()
    {
        //Ask factory to get all permissions information
        $info = $this->rbac_perm_factory->read_perms();

        //Send response to client
        if ($info)
        {
            $this->response($info, 200);
        } else
        {
            $message = array(
                'status' => 'error'
            );
            $this->response($message, 404);
        }
    }

    /**
     * Update information of a permission and then respond with status/errors
     */
    function perm_post()
    {
        //Get information from POST method of Restful standard
        $info = $this->post();

        //Ask factory to update permission
        $status = $this->rbac_perm_factory->update_perm($info);

        //Send response to client
        if ($status)
        {
            $message = array(
                'status' => 'updated'
            );
            $this->response($message, 200);
        } else
        {
            $message = array(
                'status' => 'error'
            );
            $this->response($message, 404);
        }
    }

    /**
     * Delete a permission and then respond with status/errors
     */
    function perm_delete()
    {
        //Get information from GET method of Restful standard
        $id = $this->delete('id');

        //Ask factory to delete permission
        $status = $this->rbac_perm_factory->delete_perm($id);

        //Send response to client
        if ($status)
        {
            $message = array(
                'status' => 'deleted'
            );
            $this->response($message, 200);
        } else
        {
            $message = array(
                'status' => 'error'
            );
            $this->response($message, 404);
        }
    }

    /**
     * Assign a permission to a role and then respond with status/errors
     */
    function assign_role_perm_post()
    {
        //Get information from POST method of Restful standard
        $role_id = $this->post('role_id');
        $perm_id = $this->post('perm_id');

        //Ask factory to assign a permission to a role
        $status = $this->rbac_assigning_factory->assign_role_perm($role_id, $perm_id);

        //Send response to client
        if ($status)
        {
            $message = array(
                'status' => 'assigned'
            );
            $this->response($message, 200);
        } else
        {
            $message = array(
                'status' => 'error'
            );
            $this->response($message, 404);
        }
    }

    /**
     * Assign permissions to a role and then respond with status/errors
     */
    function assign_role_perms_post()
    {
        //Get information from POST method of Restful standard
        $role_id = $this->post('role_id');
        $perms_id = $this->post('perms_id');

        //Ask factory to assign a permission to a role
        $status = $this->rbac_assigning_factory->assign_role_perms($role_id, $perms_id);

        //Send response to client
        if ($status)
        {
            $message = array(
                'status' => 'assigned'
            );
            $this->response($message, 200);
        } else
        {
            $message = array(
                'status' => 'error'
            );
            $this->response($message, 404);
        }
    }

    /**
     * Unassign a permission of a role and then respond with status/errors
     */
    function unassign_role_perm_post()
    {
        //Get information from POST method of Restful standard
        $role_id = $this->post('role_id');
        $perm_id = $this->post('perm_id');

        //Ask factory to unassign a permission of a role
        $status = $this->rbac_assigning_factory->unassign_role_perm($role_id, $perm_id);

        //Send response to client
        if ($status)
        {
            $message = array(
                'status' => 'unassigned'
            );
            $this->response($message, 200);
        } else
        {
            $message = array(
                'status' => 'error'
            );
            $this->response($message, 404);
        }
    }

    /**
     * Assign a role to an account and then respond with status/errors
     */
    function assign_acc_role_post()
    {
        //Get information from POST method of Restful standard
        $acc_id = $this->post('acc_id');
        $role_id = $this->post('role_id');

        //Ask factory to assign a role to an account
        $status = $this->rbac_assigning_factory->assign_acc_role($role_id, $acc_id);

        //Send response to client
        if ($status)
        {
            $message = array(
                'status' => 'assigned'
            );
            $this->response($message, 200);
        } else
        {
            $message = array(
                'status' => 'error'
            );
            $this->response($message, 404);
        }
    }

    /**
     * Unassign a role of an account and then respond with status/errors
     */
    function unassign_acc_role_post()
    {
        //Get information from POST method of Restful standard
        $acc_id = $this->post('acc_id');
        $role_id = $this->post('role_id');

        //Ask factory to unassign a role of an account
        $status = $this->rbac_assigning_factory->unassign_acc_role($role_id, $acc_id);

        //Send response to client
        if ($status)
        {
            $message = array(
                'status' => 'assigned'
            );
            $this->response($message, 200);
        } else
        {
            $message = array(
                'status' => 'error'
            );
            $this->response($message, 404);
        }
    }

    /**
     * Unassign all roles of an account and then respond with status/errors
     */
    function unassign_acc_roles_post()
    {
        //Get information from POST method of Restful standard
        $acc_id = $this->post('acc_id');

        //Ask factory to unassign a role of an account
        $status = $this->rbac_assigning_factory->unassign_acc_roles($acc_id);

        //Send response to client
        if ($status)
        {
            $message = array(
                'status' => 'unassigned'
            );
            $this->response($message, 200);
        } else
        {
            $message = array(
                'status' => 'error'
            );
            $this->response($message, 404);
        }
    }
}