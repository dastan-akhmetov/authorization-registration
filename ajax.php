<?php
/**
 * Created by PhpStorm.
 * User: hoph
 * Date: 10/11/16
 * Time: 3:31 AM
 */
if (isset($_POST["action"])) {

    require_once 'bootstrap.php';

    $user = new UserController();

    if ($_POST["action"] == "check_email") {

        $user->email = $_POST["email"];
        $isDuplicate = $user->check_email_duplicate();

        $response = [
            'isDuplicate' => $isDuplicate
        ];

        echo json_encode($response);
        exit();

    }

    if ($_POST["action"] == "change_password") {

        if ($_POST["password"] == $_POST["password_repeat"]) {

            $user->email = $_POST["email"];
            $user->password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

            $result = $user->change_password();

            $response = [
                'passwordChanged' => $result
            ];

        }
        else {

            $response = [
                'passwordChanged' => FALSE,
                'reason' => 'passwords_do_not_match'
            ];

        }

        echo json_encode($response);
        exit();

    }



}