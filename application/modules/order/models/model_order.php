<?php

/**
 * Class Model_order
 */
class Model_order extends CI_Model
{
    /**
     * Just to implement Singleton
     * @var mixed
     */
    private static $_db;

    /**
     * Construct function
     */
    function __construct()
    {
        parent::__construct();
        self::$_db = & get_instance()->db;
    }

    /**
     * Get order information from database
     * @param null $where
     * Type: array
     *        Desc: content of WHERE statement in query
     *        Example: $where = array('Name' => 'manhnd')
     *        Default: NULL (query has no where statement)
     * @param string $required_fields
     * Type: string
     *        Desc: Table columns that you want to select in query
     *        Example: $required_fields = 'RoleName, RoleDescription'
     *    Default: '*' to select all columns
     * @param string $return_type
     *     *        Type: string
     *        Desc: number of rows that you want to take in query
     *        Example: $return_type = 'one'
     *        Values:
     *            'all': select all rows in result
     *            'one': select one row in result (first row)
     *        Default: 'all'
     * @return mixed
     */
    public static function get_order($where = NULL, $required_fields = '*', $return_type = 'all')
    {
        if ($where !== NULL) {
            self::$_db->where($where);
        }
        self::$_db->select($required_fields);
        self::$_db->from('irbs.order');
        self::$_db->join('irbs.inkiu_order', 'order.id = inkiu_order.id');
        $result = array();
        switch ($return_type) {
            case 'all':
                $result = self::$_db->get()->result_array();
                break;
            case 'one':
                $result = self::$_db->get()->row_array();
        }
        return $result;
    }

    /**
     * Insert new record
     * @param $info
     * @return mixed
     * @throws Exception
     */
    public static function insert_order($info)
    {
        try
        {
            self::$_db->trans_start();
            //Insert into order table
            $order_data = new order_table($info);
            self::$_db->insert('irbs.order', $order_data);

            //Get inserted id and then insert into inkiu order table
            $id = self::$_db->insert_id();
            $info['id'] = $id;
            $inkiu_order_data = new inkiu_order_table($info);
            self::$_db->insert('irbs.inkiu_order', $inkiu_order_data);
            self::$_db->trans_complete();
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
        return $id;
    }

    /**
     * Edit existing record
     * @param $info
     * @return bool
     * @throws Exception
     */
    public static function edit_order($info)
    {
        try
        {
            //Parse data from passed information
            $order_data = new order_table($info);
            $inkiu_order_data = new inkiu_order_table($info);

            //Update two tables
            self::$_db->trans_start();
            self::$_db->update('irbs.order', $order_data, array('order.id' => $info['id']));
            self::$_db->update('irbs.inkiu_order', $inkiu_order_data, array('inkiu_order.id' => $info['id']));
            self::$_db->trans_complete();
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
        return true;

    }


    /**
     * Delete a record
     * @param $id
     * @return bool
     * @throws Exception
     */
    public static function delete_order($id)
    {
        try
        {
            self::$_db->trans_start();
            self::$_db->delete('irbs.inkiu_order', array('inkiu_order.id' => $id));
            self::$_db->delete('irbs.order', array('order.id' => $id));
            self::$_db->trans_complete();
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
        return true;
    }

    /**
     * Delete some records or all records
     * @param null $ids
     * @return bool
     * @throws Exception
     */
    public static function delete_orders($ids = NULL)
    {
        try
        {
            self::$_db->trans_start();
            //If has no id => delete all records
            if ($ids == NULL)
            {
                self::$_db->delete('irbs.inkiu_order');
                self::$_db->delete('irbs.order');
            }
            //If has some ids => delete each id
            else
            {
                foreach ($ids as $id)
                {
                    self::delete_order($id);
                }
            }
            self::$_db->trans_complete();
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
        return true;
    }
}

/**
 * Class inkiu_order_table
 */
class inkiu_order_table
{
    /**
     * @var
     */
    var $id;
    /**
     * @var
     */
    var $creator;

    /**
     * @param $info
     */
    function __construct($info)
    {
        $this->id = $info['id'];
        $this->creator = $info['creator'];
    }
}

/**
 * Class order_table
 */
class order_table
{
    /**
     * @var
     */
    var $description;
    /**
     * @var
     */
    var $creation_date;

    /**
     * @param $info
     */
    function __construct($info)
    {
        $this->description = $info['description'];
        $this->creation_date = $info['creation_date'];
    }
}