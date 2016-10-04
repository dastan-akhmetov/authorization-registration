<?php
/**
 * Created by PhpStorm.
 * User: dastan
 * Date: 10/4/16
 * Time: 3:55 PM
 */

require "../classes/Database.php";

/**
 * The function creates a table `User`
 */
function create()
{

    // instantiate an object
    $db = new Database();

    // cleanup
    $sql = "DROP TABLE IF EXISTS `user`";
    $db->queryNoParams($sql);

    // create a table
    $sql = "CREATE TABLE `user`(
      `id` INT NOT NULL AUTO_INCREMENT,
      `email` VARCHAR (255) NOT NULL,
      `password` VARCHAR (255) NOT NULL,
      `firstname` VARCHAR (255) NOT NULL,
      `lastname` VARCHAR (255) NOT NULL,
      `date_of_birth` DATE NOT NULL,
      `gender` VARCHAR (6) NOT NULL,
      PRIMARY KEY (`id`),
      INDEX `email` (`email` ASC)
    )";
    $db->queryNoParams($sql);

}

create();