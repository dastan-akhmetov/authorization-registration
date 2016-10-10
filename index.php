<?php
require_once "templates/header.php";
?>

<?php
    if (isset($_SESSION["logged_in"])) {
    
        $registered = FALSE;
?>
        <div class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><?= $TITLES["change_password"] ?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <!-- Password -->
                            <div class="form-group">
                                <label for="inputPassword" class="col-lg-4 control-label"><?= $TITLES["password"] ?></label>
                                <div class="col-lg-5">
                                    <input type="password" name="inputPassword" class="form-control" id="inputPassword" placeholder="<?= $TITLES["password"] ?>" value="<?php render_input_value("inputPassword", $registered); ?>" required>
                                </div>
                                <span id="inputPasswordHint" class="hints control-label col-lg-3"></span>
                            </div>

                            <!-- Repeat Password -->
                            <div class="form-group">
                                <label for="inputPasswordRepeat" class="col-lg-4 control-label"><?= $TITLES["password_repeat"] ?></label>
                                <div class="col-lg-5">
                                    <input type="password" name="inputPasswordRepeat" class="form-control" id="inputPasswordRepeat" placeholder="<?= $TITLES["password_repeat"] ?>" value="<?php render_input_value("inputPasswordRepeat", $registered); ?>" required>
                                </div>
                                <span id="inputPasswordRepeatHint" class="hints control-label col-lg-3"></span>
                            </div>
                            <div class="form-group">
                                <div id="resultPasswordChange" class="centered-text">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?= $TITLES["close"] ?></button>
                        <button type="button" id="saveChangePassword" class="btn btn-primary"><?= $TITLES["save_changes"] ?></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="user-details">
            <input type="hidden" name="hiddenEmail" id="hiddenEmail" value="<?= $_SESSION["email"] ?>" />
            <div class="row">
                <!-- Photo -->
                <div class="col-lg-4 photo">
                    <img src="<?= $BASE_URL . $_SESSION["photo_url"] ?>" />
                </div>

                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="details-list">
                                <li>
                                    <strong><?= $TITLES["firstname"] ?>:</strong> <?= $_SESSION["firstname"] ?>
                                </li>
                                <li>
                                    <strong><?= $TITLES["lastname"] ?>:</strong> <?= $_SESSION["lastname"] ?>
                                </li>
                                <li>
                                    <strong><?= $TITLES["date_of_birth"] ?>:</strong> <?= convert_date_of_birth_to_human_readable($_SESSION["date_of_birth"]) ?>
                                </li>
                                <li>
                                    <strong><?= $TITLES["gender"] ?>:</strong> <?= $TITLES[$_SESSION["gender"]] ?>
                                </li>
                                <li>
                                    <strong><?= $TITLES["email"] ?>:</strong> <?= $_SESSION["email"] ?>
                                </li>
                                <li>
                                    <a href="#" id="changePassword" class="btn btn-primary"><?= $TITLES["change_password"] ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
    else
    {
        echo "<h3 class=\"centered-text\">" . $TITLES["welcome_to"] . " ABC Company</h3>";
    }

?>

<?php
require_once "templates/footer.php";
?>