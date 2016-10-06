<?php
require_once "templates/header.php";
?>

<ul>
    <?php
        if (isset($_SESSION["logged_in"]))
            render_link("logout");
        else {
            echo "<ul>";
                echo "<li>";
                    render_link("authorization");
                echo "</li>";
                echo "<li>";
                    render_link("registration");
                echo "</li>";
            echo "</ul>";
        }
    ?>
</ul>





<?php
require_once "templates/footer.php";
?>