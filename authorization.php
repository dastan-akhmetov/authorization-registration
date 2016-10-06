<?php
/**
 * Created by PhpStorm.
 * User: dastan
 * Date: 10/4/16
 * Time: 4:28 PM
 */
include_once "templates/header.php";
?>
    <?php render_link("index"); ?>
    <form class="form-signin">
        <legend><?php render_title(); ?></legend>
        <label for="inputEmail" class="sr-only"><?= $TITLES["email"] ?></label>
        <input type="email" id="inputEmail" class="form-control" placeholder="<?= $TITLES["email"] ?>" required autofocus>
        <label for="inputPassword" class="sr-only"><?= $TITLES["password"] ?></label>
        <input type="password" id="inputPassword" class="form-control" placeholder="<?= $TITLES["password"] ?>" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> <?= $TITLES["remember_me"] ?>
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit"><?= $TITLES["sign_in"] ?></button>
    </form>

<?php
include_once "templates/footer.php";