<?php
/**
 * Created by PhpStorm.
 * User: dastan
 * Date: 10/4/16
 * Time: 4:28 PM
 */
require_once "templates/header.php";
?>

    <?php
    if (isset($_POST["submitButton"])) {

        $user = new UserController();

        // Language titles
        $user->TITLES = $VALIDATION;

        $user->email = $_POST["inputEmail"];

        $user->password = $_POST["inputPassword"];
        $user->password_repeat = $_POST["inputPasswordRepeat"];

        $user->firstname = $_POST["inputFirstname"];
        $user->lastname = $_POST["inputLastname"];

        $user->day_of_birth = $_POST["selectDay"];
        $user->month_of_birth = $_POST["selectMonth"];
        $user->year_of_birth = $_POST["selectYear"];

        $user->gender = $_POST["inputGender"];

        // TRUE - Registration, FALSE - Authorization
        $user->isRegistering = TRUE;

        $user->validate_fields();
    }

    ?>
    <form class="form-horizontal form-registration" method="post" action="registration">
        <fieldset>

            <!-- Legend -->
            <legend><?php render_title(); ?></legend>

            <!-- Email -->
            <div class="form-group">
                <label for="inputEmail" class="col-lg-4 control-label"><?= $TITLES["email"] ?></label>
                <div class="col-lg-8">
                    <input type="text" name="inputEmail" class="form-control" id="inputEmail" placeholder="<?= $TITLES["email"] ?>" value="<?php render_input_value("inputEmail"); ?>" required>
                </div>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="inputPassword" class="col-lg-4 control-label"><?= $TITLES["password"] ?></label>
                <div class="col-lg-8">
                    <input type="password" name="inputPassword" class="form-control" id="inputPassword" placeholder="<?= $TITLES["password"] ?>" value="<?php render_input_value("inputPassword"); ?>" required>
                </div>
            </div>

            <!-- Repeat Password -->
            <div class="form-group">
                <label for="inputPasswordRepeat" class="col-lg-4 control-label"><?= $TITLES["password_repeat"] ?></label>
                <div class="col-lg-8">
                    <input type="password" name="inputPasswordRepeat" class="form-control" id="inputPasswordRepeat" placeholder="<?= $TITLES["password_repeat"] ?>" value="<?php render_input_value("inputPasswordRepeat"); ?>" required>
                </div>
            </div>

            <!-- Firstname -->
            <div class="form-group">
                <label for="inputFirstname" class="col-lg-4 control-label"><?= $TITLES["firstname"] ?></label>
                <div class="col-lg-8">
                    <input type="text" name="inputFirstname" class="form-control" id="inputFirstname" placeholder="<?= $TITLES["firstname"] ?>" value="<?php render_input_value("inputFirstname"); ?>" required>
                </div>
            </div>

            <!-- Lastname -->
            <div class="form-group">
                <label for="inputLastname" class="col-lg-4 control-label"><?= $TITLES["lastname"] ?></label>
                <div class="col-lg-8">
                    <input type="text" name="inputLastname" class="form-control" id="inputLastname" placeholder="<?= $TITLES["lastname"] ?>" value="<?php render_input_value("inputLastname"); ?>" required>
                </div>
            </div>

            <!-- Gender -->
            <div class="form-group">
                <label class="col-lg-4 control-label"><?= $TITLES["gender"] ?></label>
                <div class="col-lg-8">
                    <div class="radio">
                        <label>
                            <input type="radio" name="inputGender" id="inputGenderMale" value="male" <?php render_radio_checked("inputGender", "male"); ?> required>
                            <?= $TITLES["male"] ?>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="inputGender" id="inputGenderFemale" value="female" <?php render_radio_checked("inputGender", "female"); ?> required>
                            <?= $TITLES["female"] ?>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Date of Birth -->
            <div class="form-group">
                <label for="select" class="col-lg-4 control-label"><?= $TITLES["date_of_birth"] ?></label>
                <div class="col-lg-8 form-dob">
                    <div class="row">

                        <!-- Day -->
                        <div class="col-md-3">
                            <label for="selectDay"><?= $TITLES["day"] ?></label>
                            <select class="form-control select-dob" name="selectDay" id="selectDay" required>
                                <?php
                                    $selected = get_input_value("selectDay");
                                    render_days_of_month($selected);
                                ?>
                            </select>
                        </div>

                        <!-- Month -->
                        <div class="col-md-5">
                            <label for="selectMonth"><?= $TITLES["month"] ?></label>
                            <select class="form-control select-dob" name="selectMonth" id="selectMonth" required>
                                <?php
                                    $selected = get_input_value("selectMonth");
                                    render_months($selected);
                                ?>
                            </select>
                        </div>

                        <!-- Year -->
                        <div class="col-md-4">
                            <label for="selectYear"><?= $TITLES["year"] ?></label>
                            <select class="form-control select-dob" name="selectYear" id="selectYear" required>
                                <?php
                                    $selected = get_input_value("selectYear");
                                    render_years($selected);
                                ?>
                            </select>
                        </div>

                    </div> <!-- .row -->
                </div>
            </div> <!-- Date of Birth -->

            <!-- Submit and Clean Buttons -->
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-4">
                    <button type="reset" class="btn btn-default"><?= $TITLES["clean"] ?></button>
                    <button type="submit" name="submitButton" class="btn btn-primary"><?= $TITLES["register"] ?></button>
                </div>
            </div>

        </fieldset>
    </form>

<?php
require_once "templates/footer.php";
?>
