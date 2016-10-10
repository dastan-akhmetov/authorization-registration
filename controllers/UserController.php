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
    private $AUTHORIZATION_TITLES;
    private $email;
    private $password;
    private $password_repeat;
    private $firstname;
    private $lastname;
    private $photo;
    private $photo_url;
    private $photo_type;
    private $day_of_birth;
    private $month_of_birth;
    private $year_of_birth;
    private $gender;
    private $isRegistering;

    private $FILE_UPLOAD_SIZE;
    private $ABS_UPLOAD_DIR;
    private $SHORT_UPLOAD_DIR;

    private $message;
    private $message_type;


    public function __construct()
    {
        global $FILE_UPLOAD_SIZE;
        global $ABS_UPLOAD_DIR;
        global $SHORT_UPLOAD_DIR;

        $this->model = new UserModel;
        $this->remember_me = FALSE;
        $this->isRegistering = FALSE;

        $this->FILE_UPLOAD_SIZE = $FILE_UPLOAD_SIZE;
        $this->ABS_UPLOAD_DIR = $ABS_UPLOAD_DIR;
        $this->SHORT_UPLOAD_DIR = $SHORT_UPLOAD_DIR;

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

    public function authorize()
    {
        $validations_ok = $this->validate_fields();

        if ($validations_ok) {

            $hash_password = sha1($this->password);

            $this->model->email = $this->email;
            $this->model->password = $hash_password;

            $authorize = $this->model->authorize();

            if (count($authorize) < 1) {
                $this->message_type = "danger";
                $this->message = $this->AUTHORIZATION_TITLES["credentials_dont_match"];

                $this->print_message();

                return FALSE;
            }

            $user = $authorize[0];

            if ($user["password"] == $hash_password && $user["email"] == $this->email) {

                $this->message_type = "success";
                $this->message = $this->AUTHORIZATION_TITLES["successful_authorization"];

                $this->print_message();

                $_SESSION["logged_in"] = TRUE;
                $_SESSION["firstname"] = $user["firstname"];
                $_SESSION["lastname"] = $user["lastname"];
                $_SESSION["photo_url"] = $user["photo_url"];
                $_SESSION["date_of_birth"] = $user["date_of_birth"];
                $_SESSION["gender"] = $user["gender"];
                $_SESSION["email"] = $user["email"];

                return TRUE;

            }
            else {

                $this->message_type = "danger";
                $this->message = $this->AUTHORIZATION_TITLES["credentials_dont_match"];

                $this->print_message();

                return FALSE;

            }


        }
    }

    public function register()
    {

        $validations_ok = $this->validate_fields();

        if ($validations_ok === TRUE) {

            $upload_photo = $this->upload_photo();

            if (!$upload_photo) {

                $this->message_type = "danger";
                $this->message = $this->REGISTRATION_TITLES["file_cannot_be_uploaded"];

                $this->print_message();

                return FALSE;

            }

            $hash_password = sha1($this->password);

            $this->model->email = $this->email;
            $this->model->password = $hash_password;
            $this->model->firstname = $this->firstname;
            $this->model->lastname = $this->lastname;
            $this->model->photo_url = $this->photo_url;

            $this->model->gender = $this->gender;
            $this->model->date_of_birth = $this->year_of_birth . '-' . $this->month_of_birth . '-' . $this->day_of_birth;

            $register = $this->model->register();

            if ($register === TRUE) {

                $this->message_type = "success";
                $this->message = $this->REGISTRATION_TITLES["successful_registration"];

                $this->print_message();

                return TRUE;

            }
            else {

                $this->message_type = "danger";

                if ($register === "Duplicate")

                    $this->message = $this->REGISTRATION_TITLES["duplicate_email"];

                else

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

    public function upload_photo()
    {

        $upload_filename = $this->photo["name"];
        $upload_filename = hash("sha256", $upload_filename . time());

        $photo_url = $this->ABS_UPLOAD_DIR . $upload_filename . "." . $this->photo_type;
        $this->photo_url = $this->SHORT_UPLOAD_DIR . $upload_filename . "." . $this->photo_type;

        if (!is_dir($this->ABS_UPLOAD_DIR))
            mkdir($this->ABS_UPLOAD_DIR, 0777);

        if (move_uploaded_file($this->photo["tmp_name"], $photo_url)) {

            return TRUE;

        }
        else {

            return FALSE;

        }

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

            // Validate photo
            $photos = $this->validate_photo();

            foreach ($photos as $photo) {

                $messages[] = $photo;

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

    public function validate_photo()
    {

        $message = [];

        $error = $this->photo["error"];

        $format = $this->validate_photo_format();

        $size = $this->validate_photo_size();

        if ($error === 0) {

            if ($format) {

                if ($size)

                    $message[] = FALSE;

                else // size

                    $message[] = $this->TITLES["file_is_bigger"];

            } // format
            else

                $message[] = $this->TITLES["file_format_incorrect"];

        } // error
        else

            $message[] = $this->TITLES["file_cannot_be_uploaded"] . " " . $error;

        return $message;

    }

    public function validate_photo_format()
    {

        $allowed_formats = [
            "image/gif",
            "image/jpg",
            "image/jpeg",
            "image/png"
        ];

        $format = $this->photo["type"];
        $type = array_search($format, $allowed_formats);

        if ($type) {

            if ($format == "image/jpeg")
                $format = "image/jpg";

            $this->photo_type = str_replace("image/", "", $format);

            return TRUE;

        }
        else

            return FALSE;

    }

    public function validate_photo_size()
    {

        $size = $this->photo["size"];

        if ($size <= $this->FILE_UPLOAD_SIZE)

            return TRUE;

        else

            return FALSE;

    }

    /*
     * * * * * * * * * * * *   VALIDATIONS END  * * * * * * * * * * * *
     */
}