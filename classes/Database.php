<?php

// Database connection configurations
define ("DSN", "mysql:dbname=authorization;host=localhost");
define ("USER", "authorization");
define ("PASS", "authorization");


class Database
{

    protected $handler;

    public function __construct()
    {

        try {

            $this->handler = new PDO(DSN, USER, PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

        } catch (Throwable $t) {

            echo "Bad connection.";

        }

    }

    public function executeNoParams($sql)
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

}
