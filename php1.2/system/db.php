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
        $this->sql(1);
        $res = $this->instance->query($this->sql)->fetch();
        $this->errorInfo($this->instance);
        return $res;
    }

    // find all records
    public function select()
    {
        $this->sql(1);
        $res = $this->instance->query($this->sql)->fetchAll();
        $this->errorInfo($this->instance);
        return $res;
    }

    // insert one record
    public function insert($data)
    {
        $this->manageInsert($data);
        $this->sql(2);
        $res = $this->instance->exec($this->sql);
        $this->errorInfo($this->instance);
        return $res;
    }

    // insert all record
    public function insertAll()
    {

    }

    // update specified record
    public function update($data)
    {
        $this->manageUpdate($data);
        $this->sql(3);
        $res = $this->instance->exec($this->sql);
        $this->errorInfo($this->instance);
        return $res;
    }

    // delete specified record
    public function delete()
    {
        $this->sql(4);
        $res = $this->instance->exec($this->sql);
        $this->errorInfo($this->instance);
        return $res;
    }

    // manage field for updating
    public function manageUpdate($data)
    {
        $str = '';
        foreach($data as $k => $v){
            $str .= '`'.$k.'`="'.$v.'",';
        }

        $this->updateField = rtrim($str,',');
    }

    // manage field and value for inserting
    public function manageInsert($data)
    {
        $key = array_keys($data);
        $str1 = '';
        foreach($key as $v){
            $str1 .= '`'.$v.'`,';
        }
        $this->insertField = rtrim($str1,',');

        $value = array_values($data);
        $str = '';
        foreach($value as $k => $v){
            $str .= '"'.$v.'",';
        }
        $str = rtrim($str,',');
        $this->insertValue = $str;
    }

    // record error info
    public function errorInfo($obj)
    {
        $this->errorCode = $obj->errorCode();
        $this->errorInfo = $obj->errorInfo();
    }

    // build sql 1:query 2:insert one 3:update 4:delete
    public function sql($type = 1,$param = [])
    {
        switch($type){
            case 1:
                $this->sql = 'select '.$this->field.' from '.$this->table.' where '.$this->where.' order by '.$this->order.$this->limit;
            break;
            case 2://单次插入
                $this->sql = 'insert into '.$this->table.' ('.$this->insertField.') values ('.$this->insertValue.')';
            break;
            case 3:
                $this->sql = 'update '.$this->table.' set '.$this->updateField.' where '.$this->where;
            break;
            case 4:
                $this->sql = 'delete from '.$this->table.' where '.$this->where;
            default:
        }
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
            $this->where = rtrim($tmp,'and ');
        }else{
            $this->where = $where;
        }
        return $this;
    }
 }