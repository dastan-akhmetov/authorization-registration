<?php

namespace Models\User;

/**
 * Created by PhpStorm.
 * User: dastan
 * Date: 10/4/16
 * Time: 4:23 PM
 */
class User extends Database
{
    
    public function __construct()
    {
        
        parent::__construct();
        echo "This is User Model";
        
    }

}