<?php
require_once "templates/header.php";
?>

<ul>
    <?php
        if (isset($_SESSION["logged_in"]))
            echo "<li><a href=\"logout.php\">Logout</a></li>";
        else {
            echo "<li><a href=\"login.php\">Login</a></li>";
            echo "<li><a href=\"register.php\">Register</a></li>";
        }
    ?>
</ul>





<?php
require_once "templates/footer.php.php";
?>