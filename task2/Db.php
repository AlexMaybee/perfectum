<?php

class Db
{
    public $connect;
    private static $instance;

    private function __construct()
    {
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, //Отображение ошибок при работе с БД
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC, //Получение ассоц. массива (без цифр)
        ];

        $this->connect = new \PDO("mysql:host=localhost;dbname=perfectum;charset=utf8", 'root', '',
            $options);

        if(!$this->connect)
            throw new \Exception('Test trouble with connect!');
    }

    public static function init()
    {
        if(!self::$instance)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getAll($sql,$params = [],$flag = false)
    {
        $obj = $this->connect->prepare($sql);

        if($params)
        {
            foreach ($params as $paramName => $value)
            {
                $obj->bindParam(':'.$paramName,$value);
            }
        }
        if($obj->execute())
        {
            if(!$flag)
            {
                return $obj->fetchAll();
            }
            else
            {
                return $obj->fetchAll(\PDO::FETCH_UNIQUE);
            }
        }
        return false;
    }

    public function getOne($sql,$params = [])
    {
        $obj = $this->connect->prepare($sql);

        if($params)
        {
            foreach ($params as $paramName => $value)
            {
//                $value = (int)$value;
                $obj->bindParam(':'.$paramName,$value);
            }
        }
        if($obj->execute())
        {
            return $obj->fetch();
        }
        return false;
    }

    public function put($sql,$params)
    {
        $obj = $this->connect->prepare($sql);
        return ($obj->execute($params)) ? $this->connect->lastInsertId() : false;
    }
}