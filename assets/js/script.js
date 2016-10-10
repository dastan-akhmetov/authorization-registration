/**
 * Created by hoph on 10/10/16.
 */

$(document).ready(function(){

    var protocol = "http://";
    var current_url = window.location.href.replace(protocol, "");

    var url_pieces = current_url.split("/");

    var current_domain = url_pieces[0];
    var current_language = url_pieces[1];
    var current_page = url_pieces[2];

    var LANGUAGE_SET = [];
    var LANGUAGE = [];
    var VALIDATION = [];

    LANGUAGE_SET['en'] = [];
    LANGUAGE_SET['en']['validation'] = [];

    LANGUAGE_SET['ru'] = [];
    LANGUAGE_SET['ru']['validation'] = [];

    LANGUAGE_SET['en']['validation']['valid']                       = '&#10004;';
    LANGUAGE_SET['en']['validation']['invalid_email']               = 'Please, enter a valid email address';
    LANGUAGE_SET['en']['validation']['invalid_password']            = 'Password must contain at least 6 characters';
    LANGUAGE_SET['en']['validation']['invalid_password_repeat']     = 'Passwords do not match';
    LANGUAGE_SET['en']['validation']['password_repeat_null']        = 'Repeat password is empty';
    LANGUAGE_SET['en']['validation']['invalid_firstname']           = 'Firstname must contain only alphabetic letters';
    LANGUAGE_SET['en']['validation']['invalid_lastname']            = 'Lastname must contain only alphabetic letters';
    LANGUAGE_SET['en']['validation']['invalid_gender']              = 'Please, choose your gender';
    LANGUAGE_SET['en']['validation']['invalid_date_of_birth']       = 'Please, indicate your date of birth';
    LANGUAGE_SET['en']['validation']['invalid_day']                 = 'Please, indicate your day of birth';
    LANGUAGE_SET['en']['validation']['invalid_month']               = 'Please, indicate your month of birth';
    LANGUAGE_SET['en']['validation']['invalid_year']                = 'Please, indicate your year of birth';
    LANGUAGE_SET['en']['validation']['duplicate_email']             = 'Email is already in use. Please, provide another one';
    LANGUAGE_SET['en']['validation']['password_changed']            = 'Password successfully changed';
    LANGUAGE_SET['en']['validation']['password_not_changed']        = 'Password was not changed. Try again';
    LANGUAGE_SET['en']['validation']['passwords_do_not_match']      = 'Passwords do not match. Try again';

    LANGUAGE_SET['ru']['validation']['valid']                       = '&#10004;';
    LANGUAGE_SET['ru']['validation']['invalid_email']               = 'Пожалуйста, введите валидный адрес email';
    LANGUAGE_SET['ru']['validation']['invalid_password']            = 'Минимальная длина пароля должна составлять 6 знаков';
    LANGUAGE_SET['ru']['validation']['invalid_password_repeat']     = 'Пароли не совпадают';
    LANGUAGE_SET['ru']['validation']['password_repeat_null']        = 'Повторный пароль пустой';
    LANGUAGE_SET['ru']['validation']['invalid_firstname']           = 'Имя должно содержать только буквы';
    LANGUAGE_SET['ru']['validation']['invalid_lastname']            = 'Фамилия должна содержать только буквы';
    LANGUAGE_SET['ru']['validation']['invalid_gender']              = 'Пожалуйста, выберите ваш пол';
    LANGUAGE_SET['ru']['validation']['invalid_date_of_birth']       = 'Пожалуйста, укажите дату рождения';
    LANGUAGE_SET['ru']['validation']['invalid_day']                 = 'Пожалуйста, укажите день рождения';
    LANGUAGE_SET['ru']['validation']['invalid_month']               = 'Пожалуйста, укажите месяц рождения';
    LANGUAGE_SET['ru']['validation']['invalid_year']                = 'Пожалуйста, укажите год рождения';
    LANGUAGE_SET['ru']['validation']['duplicate_email']             = 'Email уже занят. Пожалуйста, используйте другой адрес';
    LANGUAGE_SET['ru']['validation']['password_changed']            = 'Пароль успешно изменен';
    LANGUAGE_SET['ru']['validation']['password_not_changed']        = 'Пароль не изменен. Попробуйте заново';
    LANGUAGE_SET['ru']['validation']['passwords_do_not_match']      = 'Пароли не совпадают. Попробуйте заново';

    LANGUAGE = LANGUAGE_SET[current_language];
    VALIDATION = LANGUAGE['validation'];

    var validation = {
        'email': false,
        'password': false,
        'passwordRepeat': false,
        'firstname': false,
        'lastname': false,
        'gender': false,
        'dateOfBirth': false
    };

    var emailTag = $("#inputEmail");
    var emailHint = $("#inputEmailHint");

    var passwordTag = $("#inputPassword");
    var passwordHint = $("#inputPasswordHint");

    var passwordRepeatTag = $("#inputPasswordRepeat");
    var passwordRepeatHint = $("#inputPasswordRepeatHint");

    var firstnameTag = $("#inputFirstname");
    var firstnameHint = $("#inputFirstnameHint");

    var lastnameTag = $("#inputLastname");
    var lastnameHint = $("#inputLastnameHint");

    var genderMale = $("#inputGenderMale");
    var genderMaleLabel = $("#labelGenderMale");

    var genderFemale = $("#inputGenderFemale");
    var genderFemaleLabel = $("#labelGenderFemale");
    var genderHint = $("#inputGenderHint");

    var selectDay = $("#selectDay");
    var selectMonth = $("#selectMonth");
    var selectYear = $("#selectYear");
    var selectHint = $("#selectHint");

    var submitButton = $("#submitButton");

    function isAuthorizationPossible() {

        if (validationEmail === true && validationPassword === true)

            return true;

        else

            return false;

    }

    function isRegistrationPossible() {

        if (validation.email === true &&
            validation.password === true &&
            validation.passwordRepeat === true &&
            validation.firstname === true &&
            validation.lastname === true &&
            validation.gender === true &&
            validation.dateOfBirth === true) {

            return true;

        }
        else {

            return false;

        }



    }

    submitButton.click(function (e) {

        if (current_page == 'authorization') {

            if (!isAuthorizationPossible())

                e.preventDefault();

        }
        else if (current_page == 'registration') {

            if (!isRegistrationPossible())

                e.preventDefault();

        }

    })

    String.prototype.capitalize = function() {
        return this.charAt(0).toUpperCase() + this.slice(1);
    }

    /*
    General validation
     */
    function validate_text_field(type) {

        var correct_email = /[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/igm;
        var correct_password = /^(\S){6,}$/igm;
        var correct_firstname = /[a-zA-Zа-яА-Я]{2,}/igm;
        var correct_lastname = /[a-zA-Zа-яА-Я]{2,}/igm;

        var correct = eval('correct_' + type);
        var inputTag = eval(type + 'Tag');
        var inputHint = eval(type + 'Hint');

        if (inputTag.val() == '' || !correct.test(inputTag.val())) {

            inputHint.removeClass('hint-success');
            inputHint.html(VALIDATION['invalid_' + type]);

            inputTag.removeClass('success');
            inputTag.addClass('danger');

            validation[type] = false;

        }
        else {

            inputHint.addClass('hint-success');
            inputHint.html(VALIDATION['valid']);

            inputTag.removeClass('danger');
            inputTag.addClass('success');

            validation[type] = true;

        }

    }

    /*
    Email
     */
    emailTag.change(function () {

        validate_text_field('email');

    })

    emailTag.blur(function () {

        validate_text_field('email');
        check_email_duplication();

    })

    /*
    Password
     */
    passwordTag.change(function () {

        validate_text_field('password');
        
        if (current_page == 'index' || current_page == 'registration')
            validate_password_repeat();

    })

    passwordTag.blur(function () {

        validate_text_field('password');

    })

    /*
    Firstname
     */
    firstnameTag.change(function () {

        validate_text_field('firstname');

    })

    firstnameTag.blur(function () {

        validate_text_field('firstname');

    })

    /*
    Lastname
     */
    lastnameTag.change(function () {

        validate_text_field('lastname');

    })

    lastnameTag.blur(function () {

        validate_text_field('lastname');

    })

    /*
    Password repeat
     */
    function validate_password_repeat() {

        if (passwordRepeatTag.val() !== passwordTag.val()) {

            passwordRepeatHint.removeClass('hint-success');
            passwordRepeatHint.html(VALIDATION['invalid_password_repeat']);

            passwordRepeatTag.removeClass('success');
            passwordRepeatTag.addClass('danger');

            validation['passwordRepeat'] = false;

        }
        else {

            passwordRepeatHint.addClass('hint-success');
            passwordRepeatHint.html(VALIDATION['valid']);

            passwordRepeatTag.removeClass('danger');
            passwordRepeatTag.addClass('success');

            validation['passwordRepeat'] = true;

        }

        if (passwordRepeatTag.val().length === 0) {

            passwordRepeatHint.removeClass('hint-success');
            passwordRepeatHint.html(VALIDATION['password_repeat_null']);

            passwordRepeatTag.removeClass('success');
            passwordRepeatTag.addClass('danger');

            validation['passwordRepeat'] = false;

        }

    }

    passwordRepeatTag.change(function () {

        validate_password_repeat();

    })

    passwordRepeatTag.blur(function () {

        validate_password_repeat();

    })

    function validate_gender() {

        if (genderMale.prop('checked') === false && genderFemale.prop('checked') === false) {

            genderMaleLabel.addClass('danger-text');
            genderFemaleLabel.addClass('danger-text');
            genderHint.removeClass('hint-success');
            genderHint.html(VALIDATION['invalid_gender']);

            validation['gender'] = false;

        }
        else if (genderMale.prop('checked') === true || genderFemale.prop('checked') === true) {

            genderMaleLabel.addClass('success-text');
            genderFemaleLabel.addClass('success-text');
            genderHint.addClass('hint-success');
            genderHint.html(VALIDATION['valid']);

            validation['gender'] = true;

        }

    }

    genderMale.on('click', function () {

        validate_gender();

    })

    genderFemale.on('click', function () {

        validate_gender();

    })

    function validate_date_of_birth() {

        var selects = [
            {
                name: eval('selectDay'),
                type: 'day'
            },
            {
                name: eval('selectMonth'),
                type: 'month'
            },
            {
                name: eval('selectYear'),
                type: 'year'
            }
        ];

        if (selectDay.val() == '-' && selectMonth.val() == '-' && selectYear.val() == '-') {

            selectDay.removeClass('success');
            selectMonth.removeClass('success');
            selectYear.removeClass('success');

            selectDay.addClass('danger');
            selectMonth.addClass('danger');
            selectYear.addClass('danger');

            selectHint.removeClass('hint-success');
            selectHint.html(VALIDATION['invalid_date_of_birth']);

            validation['dateOfBirth'] = false;

        }
        else if (selectDay.val() != '-' && selectMonth.val() != '-' && selectYear.val() != '-'){

            selectDay.removeClass('danger');
            selectMonth.removeClass('danger');
            selectYear.removeClass('danger');

            selectDay.addClass('success');
            selectMonth.addClass('success');
            selectYear.addClass('success');

            selectHint.addClass('hint-success');
            selectHint.html(VALIDATION['valid']);

            validation['dateOfBirth'] = true;

        }
        else {

            selectHint.html('');

            for (i in selects) {

                var select = selects[i];

                if (select.name.val() == '-') {

                    select.name.addClass('danger');
                    select.name.removeClass('success');

                    selectHint.removeClass('hint-success');
                    selectHint.append(VALIDATION['invalid_' + select.type] + '<br/>');

                }
                else {

                    select.name.removeClass('danger');
                    select.name.addClass('success');

                }

            }

            validation['dateOfBirth'] = false;

        }

    }

    selectDay.change(function () {

        validate_date_of_birth();

    })

    selectMonth.change(function () {

        validate_date_of_birth();

    })

    selectYear.change(function () {

        validate_date_of_birth();

    })


    /*
    Check fields on page load
     */
    function page_load_validate() {

        if (emailTag.val() != '')
            validate_text_field('email');

        if (passwordTag.val() != '')
            validate_text_field('password');

        if (current_page == 'registration') {

            if (passwordRepeatTag.val() != '')
                validate_password_repeat();

            if (firstnameTag.val() != '')
                validate_text_field('firstname');

            if (lastnameTag.val() != '')
                validate_text_field('lastname');

            validate_gender();

            validate_date_of_birth();

        }

    }

    page_load_validate();

    function check_email_duplication() {

        var correct_email = /[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/igm;

        if (correct_email.test(emailTag.val()) && current_page == 'registration') {

            var urlString = protocol + current_domain + '/' + current_language + '/' + 'ajax';

            var request = $.ajax({
                method: "POST",
                url: urlString,
                data: { action: 'check_email', email: emailTag.val() }
            });

            request.done(function(data){

                var response = $.parseJSON(data);
                var isDuplicate = response.isDuplicate;

                if (isDuplicate === true) {

                    emailTag.removeClass('success');
                    emailTag.addClass('danger');
                    emailHint.removeClass('hint-success');
                    emailHint.html(VALIDATION['duplicate_email']);
                    validation.email = false;

                }
                else {

                    emailTag.removeClass('danger');
                    emailTag.addClass('success');
                    emailHint.addClass('hint-success');
                    emailHint.html(VALIDATION['valid']);
                    validation.email = true;

                }

            });

            request.fail(function (data) {

                console.log(data);

            })

        }

    }

    $("#changePassword").click(function () {

        $(".modal").css('display', 'block');

    })

    $("button.close").click(function () {

        $(".modal").css('display', 'none');

    })

    $("button[data-dismiss=modal]").click(function () {

        $(".modal").css('display', 'none');

    })

    $("#saveChangePassword").click(function () {

        var correct_password = /^(\S){6,}$/igm;

        if (passwordTag.val() === passwordRepeatTag.val() && correct_password.test(passwordTag.val())) {

            var urlString = protocol + current_domain + '/' + current_language + '/' + 'ajax';

            var emailValue = $("#hiddenEmail").val();

            var request = $.ajax({
                method: "POST",
                url: urlString,
                data: { action: 'change_password', email: emailValue, password: passwordTag.val(), password_repeat: passwordRepeatTag.val() }
            });

            request.done(function(data){

                var response = $.parseJSON(data);
                var passwordChanged = response.passwordChanged;

                if (passwordChanged === true) {

                    $("#resultPasswordChange").removeClass('danger-text');
                    $("#resultPasswordChange").addClass('success-text');
                    $("#resultPasswordChange").html(VALIDATION['password_changed']);

                }
                else {

                    $("#resultPasswordChange").removeClass('success-text');
                    $("#resultPasswordChange").addClass('danger-text');

                    if (response.reason == 'passwords_do_not_match')

                        $("#resultPasswordChange").html(VALIDATION['passwords_do_not_match']);

                    else

                        $("#resultPasswordChange").html(VALIDATION['password_not_changed']);

                }

            });

            request.fail(function (data) {

                console.log(data);

            })

        }

    })

});