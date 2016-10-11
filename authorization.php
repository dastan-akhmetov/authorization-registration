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
        if (isset($_SESSION["logged_in"])) {
            header("Location: index");
        }

        $authorized = FALSE;

        if (isset($_POST["submitButton"])) {

            $user = new UserController();
            $user->TITLES = $VALIDATION;
            $user->AUTHORIZATION_TITLES = $AUTHORIZATION;

            $user->email = $_POST["inputEmail"];
            $user->password = filter_var($_POST["inputPassword"], FILTER_SANITIZE_STRING);

            $authorize = $user->authorize();

            if ($authorize) {

                $authorized = TRUE;
                header("Location: index");
            }
        }

    ?>

    <form class="form-horizontal form-signin" method="POST" action="<?= $CURRENT_PAGE ?>">

        <!-- Legend -->
        <legend><?php render_title(); ?></legend>

        <!-- Email -->
        <div class="form-group">
            <label for="inputEmail" class="control-label col-lg-2"><?= $TITLES["email"] ?></label>
            <div class="col-lg-6">
                <input type="email" name="inputEmail" id="inputEmail" class="form-control" placeholder="<?= $TITLES["email"] ?>" value="<?php render_input_value("inputEmail", $authorized); ?>" required autofocus>
            </div>
            <span id="inputEmailHint" class="hints control-label col-lg-4"></span>
        </div>

        <!-- Password -->

        <div class="form-group">
            <label for="inputPassword" class="control-label col-lg-2"><?= $TITLES["password"] ?></label>
            <div class="col-lg-6">
                <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="<?= $TITLES["password"] ?>" value="<?php render_input_value("inputPassword", $authorized); ?>" required>
            </div>
            <span id="inputPasswordHint" class="hints control-label col-lg-4"></span>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-2">
                <button class="btn btn-primary btn-block" type="submit" name="submitButton" id="submitButton"><?= $TITLES["sign_in"] ?></button>
            </div>
        </div>

    </form>

<?php
include_once "templates/footer.php";