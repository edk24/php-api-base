<?php

/**
 * Class Db
 * 数据库操作类
 * @author 余小波
 */
class Db {
    public $config = [
        'type'      => 'mysql',
        'host'      =>  'localhost',
        'user'      =>  'root',
        'pass'      =>  '',
        'port'      =>  3306,
        'dbname'    =>  '',
        'charset'   => 'utf8',

    ];
    // 连接对象
    protected static $connection;

    public function connect($config=[])
    {
        $this->config = $config;
        $dsn = '';
        switch ($config['type'])
        {
            case 'mysql':
                $dsn="mysql:host={$config['host']};dbname={$config['dbname']};port={$config['port']}";
                self::$connection = new PDO($dsn, $config['user'], $config['pass']);
                return true;
        }
        return false;
    }

    public function __destruct(){
        self::$connection = null;
    }

    public function query($sql)
    {
        $type = substr($sql, 0, 6);
        if (strcasecmp($type ,'select')!=0)
        {
            return $this->exec($sql);
        }

        $result = self::$connection->query($sql);
        if ($result) {
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function exec($sql)
    {
        $aff = self::$connection->exec($sql);
        return $aff;
    }

    public function startTrans()
    {
        self::$connection->beginTransaction();
    }

    public function commit()
    {
        self::$connection->commit();
    }

    public function rollback()
    {
        self::$connection->rollBack();
    }

    public function getLastId()
    {
        return self::$connection->lastInsertId();
    }

    public function getError()
    {
        $err = self::$connection->errorInfo();
        if ($err) {
            return $err[2];
        }
        return '';
    }

}