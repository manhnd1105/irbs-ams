<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!class_exists('CI_Model')) {
    /** @noinspection PhpIncludeInspection */
    require_once(BASEPATH . 'core/Model.php');
}

class CrudHelper extends CI_Model
{
    protected $table = null;
    protected $key = null;
    protected $fields = array();
    public $CI = null;

    public function __construct($table = null)
    {
        parent::__construct();
        $this->initialize($table);
    }

    public function initialize($table = null)
    {
        $this->CI = & get_instance();
        $this->CI->load->database();
        if (!is_null($table)) {
            // get table name
            $this->table = $this->db->dbprefix($table);

            // get list columns
            $this->fields = $this->db->list_fields($this->table);

            $fields = $this->db->field_data($this->table);
            foreach ($fields as $row) {
                if ($row->primary_key) {
                    $this->key = $row->name;
                    break;
                }
            }
        }
    }

    public function read($id)
    {
        // id là mảng
        if (is_array($id)) {

            foreach ($id as $k => $v) {

                if (!in_array($k, $this->fields)) {
                    show_error("CRUD : '$k' not in fields of table '$this->table'");
                }
            }
            $this->db->where($id);

        } else { // id là string
            $this->db->where($this->key, $id);
        }

        $query = $this->db->get($this->table);

        return $query->row_array();
    }

    public function readAll()
    {
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

    public function readLast()
    {

        $this->db->order_by($this->key, 'DESC');
        $result = $this->db->get($this->table);
        return $result->row_array();
    }

    public function insert($o)
    {
        $data = array();
        foreach ($this->fields as $v) {
            if (isset($o[$v])) {
                $data[$v] = $o[$v];

                /* set như dưới đây cũng được mà mỗi lần set là chạy vòng lặp,if này nọ */
                //$this->db->set($k, $o[$v]);
            }
        }

        return $this->db->insert($this->table, $data);
    }

    public function update($o, $where = null)
    {

        if (!$where) {
            if (isset($o[$this->key])) {
                $this->db->where($this->key, $o[$this->key]);
                // uset key trong $o
                unset($o[$this->key]);
            } else {
                show_error('CRUD : Can not found value key for update');
            }
        } else {
            $this->db->where($where);
        }

        $data = array();
        foreach ($o as $k => $v) {
            // chỉ update những trường tồn tại trong column
            if (in_array($k, $this->fields)) {
                $data[$k] = $v;
                //$this->db->set($k, $o[$k]);
            }
        }

        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {

        if (is_numeric($id)) {
            $this->db->where($this->key, $id);
        } elseif (is_array($id)) {
            $this->db->where_in($this->key, $id);
        }

        return $this->db->delete($this->table);
    }

    public function get($limit = null, $offset = null)
    {
        $query = $this->db->get($this->table, $limit, $offset);
        return $query->result_array();
    }

    public function get_by($column, $where)
    {
        $this->db->where($column, $where);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function count_all($where = null)
    {
        if (!is_null($where)) {
            $this->db->where($where);
        }
        return $this->db->count_all_results($this->table);
    }

    public function insert_id()
    {
        return $this->db->insert_id();
    }

    public function check_exist($col, $val, $id = null)
    {
        $this->db->where($col, $val);
        if ($id) {
            $this->db->where("$this->key !=", $id);
        }
        $qr = $this->db->get($this->table);

        return $qr->num_rows();
    }

    public function status($id, $col, $status = null)
    {
        if ($status && is_numeric($status)) {
            $this->db->set($col, $status);
        } else {
            $this->db->set($col, "1-$col", FALSE);
        }
        $this->db->where($this->key, $id);

        return $this->db->update($this->table);
    }

    public function __call($method, $agruments)
    {
        if (!method_exists($this, $method) && method_exists($this->db, $method)) {
            //$agruments = array_merge(array($this->table), $agruments);
            return call_user_func_array(array($this->db, $method), $agruments);
        } else {
            show_error("CRUD : Method '$method' not found");
        }
    }

    public function get_primary_key()
    {
        return $this->key;
    }

    public function get_fields()
    {
        return $this->fields;
    }
}
