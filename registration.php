<?php
/**
 * Created by PhpStorm.
 * User: dastan
 * Date: 10/4/16
 * Time: 4:28 PM
 */
require_once "templates/header.php";
?>
    <form class="form-horizontal form-registration">
        <fieldset>
            <legend><?php render_title(); ?></legend>
            <div class="form-group">
                <label for="inputEmail" class="col-lg-3 control-label"><?= $TITLES["email"] ?></label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" id="inputEmail" placeholder="<?= $TITLES["email"] ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="col-lg-3 control-label"><?= $TITLES["password"] ?></label>
                <div class="col-lg-9">
                    <input type="password" class="form-control" id="inputPassword" placeholder="<?= $TITLES["password"] ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="inputFirstname" class="col-lg-3 control-label"><?= $TITLES["firstname"] ?></label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" id="inputFirstname" placeholder="<?= $TITLES["firstname"] ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="inputLastname" class="col-lg-3 control-label"><?= $TITLES["lastname"] ?></label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" id="inputLastname" placeholder="<?= $TITLES["lastname"] ?>">
                </div>
            </div>


            <div class="form-group">
                <label class="col-lg-3 control-label"><?= $TITLES["gender"] ?></label>
                <div class="col-lg-9">
                    <div class="radio">
                        <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                            <?= $TITLES["male"] ?>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                            <?= $TITLES["female"] ?>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="select" class="col-lg-3 control-label"><?= $TITLES["date_of_birth"] ?></label>
                <div class="col-lg-9 form-dob">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="selectDay"><?= $TITLES["day"] ?></label>
                            <select class="form-control select-dob" name="dob_day" id="selectDay">
                                <?php
                                    for ($i = 1; $i < 32; $i++) {

                                            echo "<option value=\"" . $i . "\">" . $i . "</option>";

                                            if ($i != 31)
                                                echo "\n\t\t\t\t\t\t\t\t";
                                            else
                                                echo "\n";

                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="selectMonth"><?= $TITLES["month"] ?></label>
                            <select class="form-control select-dob" id="selectMonth">
                                <?php
                                    $months = $LANGUAGE["months"];
                                    $i = 1;

                                    foreach ($months as $month) {

                                        echo "<option value=\"" . $month[0] . "\">" . $month[1] . "</option>";

                                        if ($i != 12)
                                            echo "\n\t\t\t\t\t\t\t\t";
                                        else
                                            echo "\n";

                                        $i++;

                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="selectYear"><?= $TITLES["year"] ?></label>
                            <select class="form-control select-dob" id="selectYear">
                                <?php
                                    for ($i = 1900; $i < 2017; $i++) {
                                        echo "<option value=\"" . $i . "\">" . $i . "</option>";

                                        if ($i != 2016)
                                            echo "\n\t\t\t\t\t\t\t\t";
                                        else
                                            echo "\n";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-3">
                    <button type="reset" class="btn btn-default"><?= $TITLES["clean"] ?></button>
                    <button type="submit" class="btn btn-primary"><?= $TITLES["register"] ?></button>
                </div>
            </div>
        </fieldset>
    </form>

<?php
require_once "templates/footer.php";
?>
