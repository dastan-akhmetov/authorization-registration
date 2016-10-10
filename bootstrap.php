<?php
/**
 * Created by PhpStorm.
 * User: dastan
 * Date: 10/4/16
 * Time: 4:32 PM
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once "models/DatabaseModel.php";
require_once "models/UserModel.php";
require_once "controllers/UserController.php";

$CURRENT_LANGUAGE = $_GET["lang"] ?? $_SESSION["lang"] ?? "en";
$_SESSION["lang"] = $_GET["lang"] ?? "en";

$BASE_URL = "http://".$_SERVER["SERVER_NAME"]."/";
$DOMAIN_NAME = $_SERVER["SERVER_NAME"];

$ROOT_DIR = __DIR__;

$ABS_UPLOAD_DIR = $ROOT_DIR . "/uploads/";
$SHORT_UPLOAD_DIR = "uploads/";

$SITE_TITLE = "ABC Company";

$FILE_UPLOAD_SIZE = 1000000;

/*
 * Russian
 */

// Links
$LANGUAGE_SET["ru"]["links"]["Главная"]             = "index";
$LANGUAGE_SET["ru"]["links"]["Авторизация"]         = "authorization";
$LANGUAGE_SET["ru"]["links"]["Регистрация"]         = "registration";
$LANGUAGE_SET["ru"]["links"]["Выход"]               = "logout";

// Months
$LANGUAGE_SET["ru"]["months"][]                     = ["01", "Январь"];
$LANGUAGE_SET["ru"]["months"][]                     = ["02", "Февраль"];
$LANGUAGE_SET["ru"]["months"][]                     = ["03", "Март"];
$LANGUAGE_SET["ru"]["months"][]                     = ["04", "Апрель"];
$LANGUAGE_SET["ru"]["months"][]                     = ["05", "Май"];
$LANGUAGE_SET["ru"]["months"][]                     = ["06", "Июнь"];
$LANGUAGE_SET["ru"]["months"][]                     = ["07", "Июль"];
$LANGUAGE_SET["ru"]["months"][]                     = ["08", "Август"];
$LANGUAGE_SET["ru"]["months"][]                     = ["09", "Сентябрь"];
$LANGUAGE_SET["ru"]["months"][]                     = ["10", "Октябрь"];
$LANGUAGE_SET["ru"]["months"][]                     = ["11", "Ноябрь"];
$LANGUAGE_SET["ru"]["months"][]                     = ["12", "Декабрь"];

// Titles
$LANGUAGE_SET["ru"]["titles"]["email"]              = "Email";
$LANGUAGE_SET["ru"]["titles"]["password"]           = "Пароль";
$LANGUAGE_SET["ru"]["titles"]["password_repeat"]    = "Повторите пароль";
$LANGUAGE_SET["ru"]["titles"]["remember_me"]        = "Запомнить меня";
$LANGUAGE_SET["ru"]["titles"]["gender"]             = "Пол";
$LANGUAGE_SET["ru"]["titles"]["male"]               = "Мужской";
$LANGUAGE_SET["ru"]["titles"]["female"]             = "Женский";
$LANGUAGE_SET["ru"]["titles"]["date_of_birth"]      = "Дата рождения";
$LANGUAGE_SET["ru"]["titles"]["day"]                = "День";
$LANGUAGE_SET["ru"]["titles"]["month"]              = "Месяц";
$LANGUAGE_SET["ru"]["titles"]["year"]               = "Год";
$LANGUAGE_SET["ru"]["titles"]["clean"]              = "Очистить";
$LANGUAGE_SET["ru"]["titles"]["register"]           = "Зарегистрировать";
$LANGUAGE_SET["ru"]["titles"]["firstname"]          = "Имя";
$LANGUAGE_SET["ru"]["titles"]["lastname"]           = "Фамилия";
$LANGUAGE_SET["ru"]["titles"]["photo"]              = "Фото";
$LANGUAGE_SET["ru"]["titles"]["upload_photo"]       = "Загрузить фото";
$LANGUAGE_SET["ru"]["titles"]["sign_in"]            = "Войти";
$LANGUAGE_SET["ru"]["titles"]["welcome"]            = "Добро пожаловать";
$LANGUAGE_SET["ru"]["titles"]["welcome_to"]         = "Добро пожаловать в";
$LANGUAGE_SET["ru"]["titles"]["change_password"]    = "Сменить пароль";
$LANGUAGE_SET["ru"]["titles"]["save_changes"]       = "Сохранить изменения";
$LANGUAGE_SET["ru"]["titles"]["close"]              = "Закрыть";

// Validation titles
$LANGUAGE_SET["ru"]["validation"]["invalid_email_format"]       = "Неверный формат Email";
$LANGUAGE_SET["ru"]["validation"]["password_less_than_6"]       = "Пароль должен быть длиною в 6 знаков и более";
$LANGUAGE_SET["ru"]["validation"]["password_dont_match"]        = "Пароли не совпадают";
$LANGUAGE_SET["ru"]["validation"]["day"]                        = "День";
$LANGUAGE_SET["ru"]["validation"]["month"]                      = "Месяц";
$LANGUAGE_SET["ru"]["validation"]["year"]                       = "Год";
$LANGUAGE_SET["ru"]["validation"]["select_is_not_selected"]     = " не выбран";
$LANGUAGE_SET["ru"]["validation"]["gender_is_incorrect"]        = "Неверный пол";
$LANGUAGE_SET["ru"]["validation"]["firstname_is_short"]         = "Имя слишком короткое";
$LANGUAGE_SET["ru"]["validation"]["firstname_is_not_string"]    = "Имя должно состоять только из букв";
$LANGUAGE_SET["ru"]["validation"]["lastname_is_short"]          = "Фамилия слишком короткая";
$LANGUAGE_SET["ru"]["validation"]["lastname_is_not_string"]     = "Фамилия должна состоять только из букв";
$LANGUAGE_SET["ru"]["validation"]["file_format_incorrect"]      = "Неверный формат файла. Допустимые форматы: gif, jpg, png";
$LANGUAGE_SET["ru"]["validation"]["file_is_bigger"]             = "Файл превышает размер в " . $FILE_UPLOAD_SIZE . " Кб";
$LANGUAGE_SET["ru"]["validation"]["file_cannot_be_uploaded"]    = "Файл не может быть загружен. Попробуйте заново";

// Registration titles
$LANGUAGE_SET["ru"]["registration"]["successful_registration"]  = "Вы успешно прошли регистрацию";
$LANGUAGE_SET["ru"]["registration"]["failed_registration"]      = "Произошла ошибка во время регистрации. Попробуйте заново";
$LANGUAGE_SET["ru"]["registration"]["file_cannot_be_uploaded"]  = "Произошла ошибка во время регистрации. Файл не может быть загружен. Попробуйте заново";
$LANGUAGE_SET["ru"]["registration"]["duplicate_email"]          = "Email уже занят. Пожалуйста, используйте другой";

// Authorization titles
$LANGUAGE_SET["ru"]["authorization"]["successful_authorization"]  = "Вы успешно прошли авторизацию";
$LANGUAGE_SET["ru"]["authorization"]["failed_authorization"]      = "Произошла ошибка во время авторизации. Попробуйте заново";
$LANGUAGE_SET["ru"]["authorization"]["credentials_dont_match"]    = "Неверный email/пароль";

/*
 * English
 */

// Links
$LANGUAGE_SET["en"]["links"]["Home"]                = "index";
$LANGUAGE_SET["en"]["links"]["Authorization"]       = "authorization";
$LANGUAGE_SET["en"]["links"]["Registration"]        = "registration";
$LANGUAGE_SET["en"]["links"]["Logout"]              = "logout";

// Months
$LANGUAGE_SET["en"]["months"][]                     = ["01", "January"];
$LANGUAGE_SET["en"]["months"][]                     = ["02", "February"];
$LANGUAGE_SET["en"]["months"][]                     = ["03", "March"];
$LANGUAGE_SET["en"]["months"][]                     = ["04", "April"];
$LANGUAGE_SET["en"]["months"][]                     = ["05", "May"];
$LANGUAGE_SET["en"]["months"][]                     = ["06", "June"];
$LANGUAGE_SET["en"]["months"][]                     = ["07", "July"];
$LANGUAGE_SET["en"]["months"][]                     = ["08", "August"];
$LANGUAGE_SET["en"]["months"][]                     = ["09", "September"];
$LANGUAGE_SET["en"]["months"][]                     = ["10", "October"];
$LANGUAGE_SET["en"]["months"][]                     = ["11", "November"];
$LANGUAGE_SET["en"]["months"][]                     = ["12", "December"];

// Titles
$LANGUAGE_SET["en"]["titles"]["email"]              = "Email";
$LANGUAGE_SET["en"]["titles"]["password"]           = "Password";
$LANGUAGE_SET["en"]["titles"]["password_repeat"]    = "Repeat password";
$LANGUAGE_SET["en"]["titles"]["remember_me"]        = "Remember me";
$LANGUAGE_SET["en"]["titles"]["gender"]             = "Gender";
$LANGUAGE_SET["en"]["titles"]["male"]               = "Male";
$LANGUAGE_SET["en"]["titles"]["female"]             = "Female";
$LANGUAGE_SET["en"]["titles"]["date_of_birth"]      = "Date of Birth";
$LANGUAGE_SET["en"]["titles"]["day"]                = "Day";
$LANGUAGE_SET["en"]["titles"]["month"]              = "Month";
$LANGUAGE_SET["en"]["titles"]["year"]               = "Year";
$LANGUAGE_SET["en"]["titles"]["clean"]              = "Clean";
$LANGUAGE_SET["en"]["titles"]["register"]           = "Register";
$LANGUAGE_SET["en"]["titles"]["firstname"]          = "Firstname";
$LANGUAGE_SET["en"]["titles"]["lastname"]           = "Lastname";
$LANGUAGE_SET["en"]["titles"]["photo"]              = "Photo";
$LANGUAGE_SET["en"]["titles"]["upload_photo"]       = "Upload photo";
$LANGUAGE_SET["en"]["titles"]["sign_in"]            = "Sign In";
$LANGUAGE_SET["en"]["titles"]["welcome"]            = "Welcome";
$LANGUAGE_SET["en"]["titles"]["welcome_to"]         = "Welcome to";
$LANGUAGE_SET["en"]["titles"]["change_password"]    = "Change password";
$LANGUAGE_SET["en"]["titles"]["save_changes"]       = "Save changes";
$LANGUAGE_SET["en"]["titles"]["close"]              = "Close";

// Validation titles
$LANGUAGE_SET["en"]["validation"]["invalid_email_format"]       = "Invalid Email format";
$LANGUAGE_SET["en"]["validation"]["password_less_than_6"]       = "Password must be 6 characters and more";
$LANGUAGE_SET["en"]["validation"]["password_dont_match"]        = "Passwords do not match";
$LANGUAGE_SET["en"]["validation"]["day"]                        = "Day";
$LANGUAGE_SET["en"]["validation"]["month"]                      = "Month";
$LANGUAGE_SET["en"]["validation"]["year"]                       = "Year";
$LANGUAGE_SET["en"]["validation"]["select_is_not_selected"]     = " is not selected";
$LANGUAGE_SET["en"]["validation"]["gender_is_incorrect"]        = "Incorrect gender";
$LANGUAGE_SET["en"]["validation"]["firstname_is_short"]         = "Firstname is too short";
$LANGUAGE_SET["en"]["validation"]["firstname_is_not_string"]    = "Firstname must contain only alphabetic letters";
$LANGUAGE_SET["en"]["validation"]["lastname_is_short"]          = "Lastname is too short";
$LANGUAGE_SET["en"]["validation"]["lastname_is_not_string"]     = "Lastname must contain only alphabetic letters";
$LANGUAGE_SET["en"]["validation"]["file_format_incorrect"]      = "File format is incorrect. Allowed formats: gif, jpg, png";
$LANGUAGE_SET["en"]["validation"]["file_is_bigger"]             = "File is bigger than " . $FILE_UPLOAD_SIZE . " Kb";
$LANGUAGE_SET["en"]["validation"]["file_cannot_be_uploaded"]    = "File cannot be uploaded. Try again";

// Registration titles
$LANGUAGE_SET["en"]["registration"]["successful_registration"]  = "You are successfully registered";
$LANGUAGE_SET["en"]["registration"]["failed_registration"]      = "Something went wrong on the registration process. Try again";
$LANGUAGE_SET["en"]["registration"]["file_cannot_be_uploaded"]  = "Something went wrong on the registration process. File cannot be uploaded. Try again";
$LANGUAGE_SET["en"]["registration"]["duplicate_email"]          = "Email is already in use. Please, provide another one";

// Authorization titles
$LANGUAGE_SET["en"]["authorization"]["successful_authorization"]  = "You are successfully authorized";
$LANGUAGE_SET["en"]["authorization"]["failed_authorization"]      = "Something went wrong on the authorization process. Try again";
$LANGUAGE_SET["en"]["authorization"]["credentials_dont_match"]    = "Invalid email/password";

// Chosen language pack
$LANGUAGE = $LANGUAGE_SET[$CURRENT_LANGUAGE];

$TITLES = $LANGUAGE["titles"];

$LINKS = $LANGUAGE["links"];

$LINK_TITLES = [];

$CURRENT_PAGE = get_current_page();

$VALIDATION = $LANGUAGE["validation"];

$REGISTRATION = $LANGUAGE["registration"];

$AUTHORIZATION = $LANGUAGE["authorization"];

/**
 * @param $links
 */
function make_link_titles($links)
{
    global $LINK_TITLES;

    $LINK_TITLES = array_flip($links);
}

make_link_titles($LANGUAGE["links"]);

/**
 *
 */
function render_breadcrumbs()
{
    global $BASE_URL;
    global $CURRENT_LANGUAGE;
    global $LINK_TITLES;
    global $CURRENT_PAGE;

    $root = "/";
    $breadcrumbs = [];

    if ($CURRENT_PAGE == $root || $CURRENT_PAGE == "index")
    {
        $breadcrumbs[] = "index";
    }
    else {
        $breadcrumbs[] = "index";
        $breadcrumbs[] = $CURRENT_PAGE;
    }

    echo "<ul class=\"breadcrumb\">";

    for ($i = 0; $i < count($breadcrumbs); $i++) {

            echo "<li><a href=\"" . $BASE_URL . $CURRENT_LANGUAGE . "/" . $breadcrumbs[$i] . "\">" . $LINK_TITLES[$breadcrumbs[$i]] . "</a></li>";

    }

    echo "</ul>";

}


$LANGUAGE_PAIRS = []; // declare language pairs array

/**
 * Extracts available languages from language set
 */
function make_language_pairs()
{
    global $LANGUAGE_SET;
    global $LANGUAGE_PAIRS;

    foreach ($LANGUAGE_SET as $key => $value) {

        $LANGUAGE_PAIRS[] = $key;

    }
}

/* Execute language pairs making process */
make_language_pairs();

/**
 * @return mixed
 */
function get_current_page()
{

    $current_page = $_SERVER["REQUEST_URI"];

    if ($current_page != "/") {
        // extract language part
        $lang = "/" . $current_page[1] . "" . $current_page[2]; // en|ru

        // extract current page
        $current_page = str_replace($lang . "/", "", $current_page); // index.php
    }

    return $current_page;

}

/**
 *
 */
function render_language_links()
{

    global $LANGUAGE_PAIRS;

    $page = get_current_page();

    foreach ($LANGUAGE_PAIRS as $lang) {


        echo "<li>";
            render_link($page, $lang);
        echo "</li>";

    }

}

/**
 * @param $page
 * @param string $link
 *
 */
function render_link($page, $link = "page")
{
    global $BASE_URL;
    global $LINKS;
    global $CURRENT_LANGUAGE;

    // currently used language
    $lang = $CURRENT_LANGUAGE;

    $class = NULL;

    // hyperlinks in current language set
    $links = $LINKS;

    // specify page explicitly
    if ($page == "/")
        $page = "index.php";

    // if it is not a page, but a language link e.g. En | Ru
    if ($link != "page") {
        $title = ucfirst($link); // capitalize title
        $lang = $link; //
        $class = "<span class=\"flag flag-" . $lang . "\"></span>";
    }
    else
        $title = array_search($page, $links);

    echo "<a href=\"" . $BASE_URL . $lang . "/" . $page . "\">" . $class . " " . $title . "</a>";
}

/**
 *
 */
function render_title()
{
    global $LANGUAGE;
    $links = $LANGUAGE["links"];

    echo array_search(get_current_page(), $links);
}

function render_input_value($fieldName, $registered = FALSE)
{
    if ($registered)
        echo NULL;
    else
        echo $_POST[$fieldName] ?? NULL;
}

function get_input_value($fieldName)
{
    return $_POST[$fieldName] ?? NULL;
}

function render_radio_checked($fieldName, $value, $registered = FALSE)
{

    if (!$registered && isset($_POST[$fieldName])) {
        if ($_POST[$fieldName] == $value)
            echo " checked=\"\" ";
    }

}

function render_days_of_month($selected, $registered = FALSE)
{
    if ($registered)
        $selected = "-";

    echo "<option value=\"-\"> - </option>";
    echo "\n\t\t\t\t\t\t\t\t";

    for ($i = 1; $i < 32; $i++) {

        if ($selected == $i)
            echo "<option selected value=\"" . $i . "\">" . $i . "</option>";
        else
            echo "<option value=\"" . $i . "\">" . $i . "</option>";

        if ($i != 31)
            echo "\n\t\t\t\t\t\t\t\t";
        else
            echo "\n";

    }
}

function render_months($selected, $registered = FALSE)
{
    global $LANGUAGE;

    if ($registered)
        $selected = "-";

    $months = $LANGUAGE["months"];
    $i = 1;

    echo "<option value=\"-\"> - </option>";
    echo "\n\t\t\t\t\t\t\t\t";

    foreach ($months as $month) {

        if ($selected == $month[0])
            echo "<option selected value=\"" . $month[0] . "\">" . $month[1] . "</option>";
        else
            echo "<option value=\"" . $month[0] . "\">" . $month[1] . "</option>";

        if ($i != 12)
            echo "\n\t\t\t\t\t\t\t\t";
        else
            echo "\n";

        $i++;

    }
}

function render_years($selected, $registered = FALSE)
{

    if ($registered)
        $selected = "-";

    echo "<option value=\"-\"> - </option>";
    echo "\n\t\t\t\t\t\t\t\t";

    for ($i = 1900; $i < 2017; $i++) {

        if ($selected == $i)
            echo "<option selected value=\"" . $i . "\">" . $i . "</option>";
        else
            echo "<option value=\"" . $i . "\">" . $i . "</option>";


        if ($i != 2016)
            echo "\n\t\t\t\t\t\t\t\t";
        else
            echo "\n";
    }
}

function convert_date_of_birth_to_human_readable($string)
{
    global $LANGUAGE;

    $year = $string[0] . $string[1] . $string[2] . $string[3];
    $month = $string[5] . $string[6];

    if ($string[8] != "0")

        $day = $string[8] . $string[9];

    else

        $day = $string[9];

    foreach ($LANGUAGE["months"] as $month_array) {

        if ($month_array[0] == $month)
            $month = $month_array[1];

    }

    $human_readable = $day . " " . $month . " " . $year;

    return $human_readable;
}