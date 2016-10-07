<?php

/**
 * Created by PhpStorm.
 * User: hoph
 * Date: 10/6/16
 * Time: 7:37 PM
 */
class UserController
{

    private $model;
    private $TITLES;
    private $REGISTRATION_TITLES;
    private $email;
    private $password;
    private $password_repeat;
    private $firstname;
    private $lastname;
    private $day_of_birth;
    private $month_of_birth;
    private $year_of_birth;
    private $gender;
    private $isRegistering;

    private $message;
    private $message_type;


    public function __construct()
    {

        $this->model = new UserModel;
        $this->isRegistering = FALSE;

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

        $validations_ok = $this->validate_fields();

        if ($validations_ok) {

            $hash_password = sha1($this->password);

            $this->model->email = $this->email;
            $this->model->password = $hash_password;
            $this->model->firstname = $this->firstname;
            $this->model->lastname = $this->lastname;
            $this->model->gender = $this->gender;
            $this->model->date_of_birth = $this->year_of_birth . '-' . $this->month_of_birth . '-' . $this->day_of_birth;

            $register = $this->model->register();

            if ($register) {

                $this->message_type = "success";
                $this->message = $this->REGISTRATION_TITLES["successful_registration"];

                $this->print_message();

                return TRUE;

            }
            else {

                $this->message_type = "danger";
                $this->message = $this->REGISTRATION_TITLES["failed_registration"];

                $this->print_message();

                return FALSE;

            }

        }

    }

    public function print_message()
    {

        echo "<div class=\"alert alert-dismissible alert-" . $this->message_type . "\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
            echo $this->message;
        echo "</div>";

    }


    /*
     * * * * * * * * * * * *   VALIDATIONS BEGIN  * * * * * * * * * * * *
     */

    public function validate_fields()
    {

        $messages = [];

        $messages["email"] = $this->validate_email();

        // Registration
        if ($this->isRegistering) {

            // Validate passwords for length and matching
            $passwords = $this->validate_passwords();

            // Pass errors
            foreach ($passwords as $password) {

                $messages[] = $password;

            }

            // Validate dropdowns
            $selects = $this->validate_selects();

            // Pass errors
            foreach ($selects as $select) {

                $messages[] = $select;

            }

            // Validate gender
            $messages["gender"] = $this->validate_gender();

            // Validate firstname
            $firstnames = $this->validate_firstname();

            foreach ($firstnames as $firstname) {

                $messages[] = $firstname;

            }

            // Validate lastname
            $lastnames = $this->validate_lastname();

            foreach ($lastnames as $lastname) {

                $messages[] = $lastname;

            }

        }
        // Authorization
        else {

            $messages["password"] = $this->validate_password_only();

        }

        $returnFalse = 0;
        $returnTotal = count($messages);

        foreach ($messages as $message) {

            if ($message === FALSE)

                $returnFalse++;
        }

        if ($returnFalse == $returnTotal) {

            return TRUE;

        }
        else {

            // Print out the errors
            $this->render_validation_errors($messages);

            return FALSE;

        }



    }

    public function render_validation_errors($messages)
    {

        foreach ($messages as $message) {

            if ($message !== FALSE) {

                echo "<div class=\"alert alert-dismissible alert-danger\">";

                    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";

                    echo $message;

                echo "</div>";

            }

        }

    }

    public function validate_email()
    {

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL))

            return $this->TITLES["invalid_email_format"];

        else

            return FALSE;

    }

    public function validate_password_only()
    {

        return $this->validate_password_length();

    }

    public function validate_passwords()
    {

        $message = [];

        $message[] = $this->validate_password_length();

        $message[] = $this->validate_passwords_matching();

        return $message;

    }

    public function validate_password_length()
    {

        $length = strlen($this->password);

        if ($length < 6)

            return $this->TITLES["password_less_than_6"];

        else

            return FALSE;

    }

    public function validate_passwords_matching()
    {

        if ($this->password != $this->password_repeat)

            return $this->TITLES["password_dont_match"];

        else

            return FALSE;

    }

    public function validate_selects()
    {

        $message = [];

        $day = $this->TITLES["day"];
        $month = $this->TITLES["month"];
        $year = $this->TITLES["year"];

        $selects[$day] = $this->day_of_birth;
        $selects[$month] = $this->month_of_birth;
        $selects[$year] = $this->year_of_birth;

        foreach ($selects as $key => $value) {

            if ($value == "-")

                $message[] = $key . $this->TITLES["select_is_not_selected"];

            else

                $message[] = FALSE;

        }

        return $message;

    }

    public function validate_gender()
    {

        if ($this->gender != "male" && $this->gender != "female")

            $message = $this->TITLES["gender_is_incorrect"];

        else

            $message = FALSE;

        return $message;

    }

    public function validate_firstname()
    {

        return $this->validate_name("firstname", $this->firstname);

    }

    public function validate_lastname()
    {

        return $this->validate_name("lastname", $this->lastname);

    }

    public function validate_name($type, $name)
    {

        $message = [];

        $length = strlen($name);

        if ($length < 2)

            $message[] = $this->TITLES[$type . "_is_short"];

        else

            $message[] = FALSE;

        $pattern = "/([a-zA-Zа-яА-Я])/";

        $match = preg_match($pattern, $name);

        if ($match != 1)

            $message[] = $this->TITLES[$type . "_is_not_string"];

        else

            $message[] = FALSE;

        return $message;

    }

    /*
     * * * * * * * * * * * *   VALIDATIONS END  * * * * * * * * * * * *
     */
}