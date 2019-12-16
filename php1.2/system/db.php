<?php

namespace system;

/**
 * 数据库连接
 */
 class db
 {
    // instance
    private $instance;

    // where
    private $where;
    // field
    private $field;
    // table
    private $table = null;
    // order
    private $order = null;
    // group
    private $group;
    // limit
    private $limit = 1;
    // page
    private $page = 1;
    // sql
    private $sql;

    /**
     * init db
     */
    public function __construct($database = 'mysql',$host = 'localhost',$dbname = 'test',$user = 'root',$password = 'root',$port = 3306)
    {
        $dsn = $database.':host='.$host.';dbname='.$dbname.';port='.$port;
        $this->instance = new \PDO($dsn,$user,$password);
    }

    /**
     * find one record
     */
    public function find()
    {
        $this->sql();
        vd($this->sql);
        return $this->instance->query($this->sql);
    }

    // build sql
    public function sql()
    {
        $this->sql = 'select '.$this->field.' from '.$this->table.' where '.$this->where.' order by '.$this->order.$this->limit;
    }

    // set limit
    public function limit($limit = 10)
    {
        $this->limit = ' limit '.($this->page-1)*($this->limit).','.($this->page)*($this->limit).' ';
        return $this;
    }

    // set group
    public function group($group)
    {
        $this->group = $group;
        return $this;
    }

    // set order
    public function order($order)
    {
        $this->order = $order;
        return $this;
    }

    // set table
    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * set field
     */
    public function field($field)
    {
        $this->field = $field;
        return $this;
    }

    /**
     * set where
     */
    public function where($where)
    {
        if(\is_array($where)){
            $tmp = '';
            foreach($where as $k => $v){
                $tmp .= $k.'='.$v.' and ';
            }
            $this->where = rtrim('and ',$tmp);
        }else{
            $this->where = $where;
        }
        return $this;
    }

    /**
     * get param
     */
    public static function get($parse_name)
    {
        return self::$$parse_name;
    }

    /**
     * set param
     */
    public static function set($parse_name,$parse_value)
    {
        self::$$parse_name = $parse_value;
    }
 }