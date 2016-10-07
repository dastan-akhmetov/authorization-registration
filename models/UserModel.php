<?php

/**
 * Created by PhpStorm.
 * User: dastan
 * Date: 10/4/16
 * Time: 4:23 PM
 */
class UserModel extends DatabaseModel
{
    private $email;
    private $password;
    private $firstname;
    private $lastname;
    private $gender;
    private $date_of_birth;

    public function __construct()
    {
        
        parent::__construct();
        
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

    public function register()
    {

        $this->sql = "INSERT INTO user (`email`,`password`, `firstname`, `lastname`, `gender`, `date_of_birth`) VALUES (:email, :password, :firstname, :lastname, :gender, :date_of_birth)";

        $this->params = array(
            ':email' => $this->email,
            ':password' => $this->password,
            ':firstname' => $this->firstname,
            ':lastname' => $this->lastname,
            ':gender' => $this->gender,
            ':date_of_birth' => $this->date_of_birth
        );

        $register = $this->insert();

        return $register;

    }


}