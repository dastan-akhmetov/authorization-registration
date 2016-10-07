<?php
/**
 * Created by PhpStorm.
 * User: dastan
 * Date: 10/4/16
 * Time: 4:28 PM
 */
include_once "templates/header.php";
?>
    <?php
        if (isset($_POST["submitButton"])) {

            $user = new UserController();
            $user->TITLES = $VALIDATION;

            $user->email = $_POST["inputEmail"];
            $user->password = $_POST["inputPassword"];

            $user->validate_fields();
        }

    ?>

    <form class="form-signin" method="POST" action="<?= $CURRENT_PAGE ?>">

        <!-- Legend -->
        <legend><?php render_title(); ?></legend>

        <!-- Email -->
        <label for="inputEmail" class="sr-only"><?= $TITLES["email"] ?></label>
        <input type="email" name="inputEmail" id="inputEmail" class="form-control" placeholder="<?= $TITLES["email"] ?>" value="<?php render_input_value("inputEmail"); ?>" required autofocus>

        <!-- Password -->
        <label for="inputPassword" class="sr-only"><?= $TITLES["password"] ?></label>
        <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="<?= $TITLES["password"] ?>" value="<?php render_input_value("inputPassword"); ?>" required>

        <!-- Remember me -->
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> <?= $TITLES["remember_me"] ?>
            </label>
        </div>

        <!-- Submit Button -->
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submitButton"><?= $TITLES["sign_in"] ?></button>

    </form>

<?php
include_once "templates/footer.php";