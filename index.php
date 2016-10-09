<?php
require_once "templates/header.php";
?>

<?php
    if (isset($_SESSION["logged_in"])) {
?>
        <div class="user-details">
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
                                    <a href="#" class="btn btn-primary"><?= $TITLES["change_password"] ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Firstname -->

            <!-- Lastname -->

            <!-- Email -->

            <!-- Change password -->
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