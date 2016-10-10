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
    private $photo_url;
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
        try {

            $this->sql = "INSERT INTO user (`email`,`password`, `firstname`, `lastname`, `gender`, `date_of_birth`, `photo_url`) VALUES (:email, :password, :firstname, :lastname, :gender, :date_of_birth, :photo_url)";

            $this->params = array(
                ':email' => $this->email,
                ':password' => $this->password,
                ':firstname' => $this->firstname,
                ':lastname' => $this->lastname,
                ':gender' => $this->gender,
                ':date_of_birth' => $this->date_of_birth,
                ':photo_url' => $this->photo_url
            );

            $register = $this->insert();

        } catch (Throwable $t) {

            $register = "Bad register.";

        }


        return $register;

    }

    public function authorize()
    {

        try {

            $this->sql = "SELECT * FROM user WHERE email = :email AND password = :password";
            $this->params = array(
                ':email' => $this->email,
                ':password' => $this->password
            );

        } catch (Throwable $t) {

            return "Bad authorize.";

        }


        return $this->select();

    }

    public function check_email_duplicate()
    {

        try {

            $this->sql = "SELECT * FROM user WHERE email = :email";
            $this->params = array(
                ':email' => $this->email
            );

        } catch (Throwable $t) {

            return "Bad email check.";

        }

        return $this->select();

    }

    public function change_password()
    {

        try {

            $this->sql = "UPDATE user SET password = :password WHERE email = :email";
            $this->params = array(
                ':password' => $this->password,
                ':email' => $this->email
            );

        } catch (Throwable $t) {

            return "Bad password change.";

        }

        return $this->update();

    }



}