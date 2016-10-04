<?php
/**
 * Created by PhpStorm.
 * User: dastan
 * Date: 10/4/16
 * Time: 4:28 PM
 */
require_once "templates/header.php";
?>

    <a href="index.php">Index</a>
    <form class="form-register">

        <h2 class="form-register-heading">Registration</h2>

        <!-- Firstname -->
        <div class="form-group">
            <label for="inputFirstname" class="col-md-2 form-control-label">Firstname</label>
            <div class="col-md-3">
                <input type="text" id="inputFirstname" class="form-control" placeholder="Firstname" required autofocus>
            </div>
        </div>
        <!-- Lastname -->
        <label for="inputLastname" class="sr-only">Lastname</label>
        <input type="text" id="inputLastname" class="form-control" placeholder="Lastname" required autofocus>

        <!-- Email -->
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>

        <!-- Password -->
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>

        <!-- Date of Birth -->
        <label for="inputDateOfBirth" class="sr-only">Date of Birth</label>
        <input type="text" id="inputDateOfBirth" class="form-control" placeholder="Date of Birth" required>

        <!-- Gender -->
        <input type="radio" id="inputGenderMale" name="inputGender" placeholder="Gender" required value="male">
        <label for="inputGenderMale">Male</label>
        <br/>
        <input type="radio" id="inputGenderFemale" name="inputGender" placeholder="Gender" required value="female">
        <label for="inputGenderFemale">Female</label>



        <!-- Checkbox -->
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>

        <!-- Submit Button -->
        <button class="btn btn-lg btn-primary btn-block" type="submit">Register me</button>

    </form>

<?php
require_once "templates/footer.php";
?>
