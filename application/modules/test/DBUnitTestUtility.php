<?php
/**
 * Created by PhpStorm.
 * User: Tuan Long
 * Date: 9/23/2014
 * Time: 4:23 PM
 */

class DBUnitTestUtility{

    /**
     * Reference to CodeIgniter
     *
     * @var resource
     */
    protected $CI;

    private static $nameDBtesting = null;
    private static $nameDBSource=null;


    function __construct()
    {
        $this->CI = & get_instance();
        self::$nameDBtesting = $this->CI->db->database.'_testing';
        self::$nameDBSource = $this->CI->db->database;
    }

    /**
     *
     */
    public function setUpDatabaseIrbsTesting(){

        //$dsn = $this->CI->db->dbdriver.':dbname='.self::$nameDBtesting.';host='.$this->CI->db->hostname;
        $dbname = self::$nameDBtesting;
        $host = $this->CI->db->hostname;
        $username = $this->CI->db->username;
        $password = $this->CI->db->password;
        $conn = new mysqli($host,$username,$password,$dbname);

        //create an array of MySQL queries to run
        $queries = array(
            'account'=> array(
                'DROP TABLE IF EXISTS '.self::$nameDBtesting.'.account',
                'CREATE TABLE '.self::$nameDBtesting.'.account SELECT * FROM '.self::$nameDBSource.'.account',
                'ALTER TABLE account MODIFY id INT AUTO_INCREMENT, ADD PRIMARY KEY (id)'
            ),
            'file'=> array(
                'DROP TABLE IF EXISTS '.self::$nameDBtesting.'.file;',
                'CREATE TABLE '.self::$nameDBtesting.'.file SELECT * FROM '.self::$nameDBSource.'.file',
                'ALTER TABLE file MODIFY id INT AUTO_INCREMENT, ADD PRIMARY KEY (id)'
            ),
            'inkiu_account'=> array(
                'DROP TABLE IF EXISTS '.self::$nameDBtesting.'.inkiu_account;',
                'CREATE TABLE '.self::$nameDBtesting.'.inkiu_account SELECT * FROM '.self::$nameDBSource.'.inkiu_account',
                'ALTER TABLE inkiu_account MODIFY id INT AUTO_INCREMENT, ADD PRIMARY KEY (id)'
            ),
            'inkiu_order'=> array(
                'DROP TABLE IF EXISTS '.self::$nameDBtesting.'.inkiu_order;',
                'CREATE TABLE '.self::$nameDBtesting.'.inkiu_order SELECT * FROM '.self::$nameDBSource.'.inkiu_order'
            ),
            'order'=> array(
                'DROP TABLE IF EXISTS '.self::$nameDBtesting.'.order;',
                'CREATE TABLE '.self::$nameDBtesting.'.order SELECT * FROM '.self::$nameDBSource.'.order',
                'ALTER TABLE order MODIFY id INT AUTO_INCREMENT, ADD PRIMARY KEY (id)'
            ),
            'order_component'=> array(
                'DROP TABLE IF EXISTS '.self::$nameDBtesting.'.order_component;',
                'CREATE TABLE '.self::$nameDBtesting.'.order_component SELECT * FROM '.self::$nameDBSource.'.order_component',
                'ALTER TABLE order_component MODIFY id INT AUTO_INCREMENT, ADD PRIMARY KEY (id)'
            ),
            'order_component_feedback'=> array(
                'DROP TABLE IF EXISTS '.self::$nameDBtesting.'.order_component_feedback;',
                'CREATE TABLE '.self::$nameDBtesting.'.order_component_feedback SELECT * FROM '.self::$nameDBSource.'.order_component_feedback'
            ),
            'order_component_image'=> array(
                'DROP TABLE IF EXISTS '.self::$nameDBtesting.'.order_component_image;',
                'CREATE TABLE '.self::$nameDBtesting.'.order_component_image SELECT * FROM '.self::$nameDBSource.'.order_component_image',
                'ALTER TABLE order_component_image MODIFY id INT AUTO_INCREMENT, ADD PRIMARY KEY (id)'
            ),
            'order_component_level'=> array(
                'DROP TABLE IF EXISTS '.self::$nameDBtesting.'.order_component_level;',
                'CREATE TABLE '.self::$nameDBtesting.'.order_component_level SELECT * FROM '.self::$nameDBSource.'.order_component_level'
            ),
            'order_component_status'=> array(
                'DROP TABLE IF EXISTS '.self::$nameDBtesting.'.order_component_status;',
                'CREATE TABLE '.self::$nameDBtesting.'.order_component_status SELECT * FROM '.self::$nameDBSource.'.order_component_status'
            ),
            'order_has_component'=> array(
                'DROP TABLE IF EXISTS '.self::$nameDBtesting.'.order_has_component;',
                'CREATE TABLE '.self::$nameDBtesting.'.order_has_component SELECT * FROM '.self::$nameDBSource.'.order_has_component'
            ),
            'rbac_permissions'=> array(
                'DROP TABLE IF EXISTS '.self::$nameDBtesting.'.rbac_permissions;',
                'CREATE TABLE '.self::$nameDBtesting.'.rbac_permissions SELECT * FROM '.self::$nameDBSource.'.rbac_permissions',
                'ALTER TABLE rbac_permissions MODIFY ID INT AUTO_INCREMENT, ADD PRIMARY KEY (ID)'
            ),
            'rbac_rolepermissions'=> array(
                'DROP TABLE IF EXISTS '.self::$nameDBtesting.'.rbac_rolepermissions;',
                'CREATE TABLE '.self::$nameDBtesting.'.rbac_rolepermissions SELECT * FROM '.self::$nameDBSource.'.rbac_rolepermissions'
            ),
            'rbac_roles'=> array(
                'DROP TABLE IF EXISTS '.self::$nameDBtesting.'.rbac_roles;',
                'CREATE TABLE '.self::$nameDBtesting.'.rbac_roles SELECT * FROM '.self::$nameDBSource.'.rbac_roles',
                'ALTER TABLE rbac_roles MODIFY ID INT AUTO_INCREMENT, ADD PRIMARY KEY (ID)'
            ),
            'rbac_userroles'=> array(
                'DROP TABLE IF EXISTS '.self::$nameDBtesting.'.rbac_userroles;',
                'CREATE TABLE '.self::$nameDBtesting.'.rbac_userroles SELECT * FROM '.self::$nameDBSource.'.rbac_userroles'
            )
        );

        //run MySql queries
         foreach($queries as $query){
             foreach($query as $q){
                 $conn->query($q);
             }
         }
        $conn->close();
    }



} 