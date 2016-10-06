<?php
/**
 * Created by PhpStorm.
 * User: dastan
 * Date: 10/4/16
 * Time: 4:26 PM
 */
require_once "bootstrap.php";
?>

<!doctype html>
<html>
    <head>
        <title></title>
        <link type="text/css" rel="stylesheet" href="<?php echo $BASE_URL; ?>assets/css/bootstrap3.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo $BASE_URL; ?>assets/css/styles.css">
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= $BASE_URL ."". $CURRENT_LANGUAGE ?>/index"><?= $SITE_TITLE ?></a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <?php
                        if (!isset($_SESSION["logged_in"])) {

                            echo "<li>";
                                render_link("authorization");
                            echo "</li>";
                            echo "<li>";
                                render_link("registration");
                            echo "</li>";

                        }


                        else
                        ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php

                            render_language_links();

                            if (isset($_SESSION["logged_in"])) {

                                echo "<li>";
                                    render_link("logout");
                                echo "</li>";

                            }

                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <?php render_breadcrumbs(); ?>
