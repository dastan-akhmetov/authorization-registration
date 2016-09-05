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

        } catch (Exception $t) { // TODO: Change to Throwable for PHP 7

            echo "Bad connection: " . $t->getMessage();

        }
    }


}
