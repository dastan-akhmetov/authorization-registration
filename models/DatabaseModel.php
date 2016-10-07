<?php

// Database connection configurations
define ("DSN", "mysql:dbname=authorization;host=localhost");
define ("USER", "authorization");
define ("PASS", "authorization");


class DatabaseModel
{

    protected $handler;
    protected $params;
    protected $sql;

    /**
     * Database constructor.
     */
    public function __construct()
    {

        try {

            $this->handler = new PDO(DSN, USER, PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

        } catch (Throwable $t) {

            echo "Bad connection.";

        }

    }

    public function __get($property)
    {

        if (property_exists($this, $property))

            return $this->$property;

    }

    public function __set($property, $value)
    {

        if (property_exists($this, $property))

            $this->$property = $value;

        return $this;

    }

    /**
     * @param $sql
     * @return bool
     */
    public function queryNoParams($sql)
    {

        try {

            $query = $this->handler->prepare($sql);
            $query->execute();

        } catch (Throwable $t) {

            echo "Bad query.";
            return FALSE;

        }

        return TRUE;

    }

    public function select()
    {
        try {

            $query = $this->handler->prepare($this->sql);
            $query->execute($this->params);

            $result = $query->fetchAll(PDO::FETCH_ASSOC);

        } catch (Throwable $t) {

            echo "Bad select.";

        }

        return $result;
    }

    public function insert()
    {
        try {

            $query = $this->handler->prepare($this->sql);
            $query->execute($this->params);

        } catch (Throwable $t) {

            echo "Bad insert.";

        }

        return TRUE;
    }


}
