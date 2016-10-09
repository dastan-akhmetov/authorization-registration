<?php
/**
 * Created by PhpStorm.
 * User: dastan
 * Date: 10/4/16
 * Time: 4:28 PM
 */
require "bootstrap.php";
?>

<?php
    if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === TRUE) {
        session_start();
        session_unset();
        session_destroy();


        header("Location: index");
    }
    else
        header("Location: index");
?>
