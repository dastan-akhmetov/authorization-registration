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

require_once "classes/Database.php";

$CURRENT_LANGUAGE = $_GET["lang"] ?? $_SESSION["lang"] ?? "en";
$_SESSION["lang"] = $_GET["lang"] ?? "en";

$BASE_URL = "http://".$_SERVER["SERVER_NAME"]."/";

$SITE_TITLE = "ABC Company";

/*
 * Russian
 */

// Links
$LANGUAGE_SET["ru"]["links"]["Главная"]         = "index";
$LANGUAGE_SET["ru"]["links"]["Авторизация"]     = "authorization";
$LANGUAGE_SET["ru"]["links"]["Регистрация"]     = "registration";
$LANGUAGE_SET["ru"]["links"]["Выход"]           = "logout";

// Months
$LANGUAGE_SET["ru"]["months"][]                 = ["01", "Январь"];
$LANGUAGE_SET["ru"]["months"][]                 = ["02", "Февраль"];
$LANGUAGE_SET["ru"]["months"][]                 = ["03", "Март"];
$LANGUAGE_SET["ru"]["months"][]                 = ["04", "Апрель"];
$LANGUAGE_SET["ru"]["months"][]                 = ["05", "Май"];
$LANGUAGE_SET["ru"]["months"][]                 = ["06", "Июнь"];
$LANGUAGE_SET["ru"]["months"][]                 = ["07", "Июль"];
$LANGUAGE_SET["ru"]["months"][]                 = ["08", "Август"];
$LANGUAGE_SET["ru"]["months"][]                 = ["09", "Сентябрь"];
$LANGUAGE_SET["ru"]["months"][]                 = ["10", "Октябрь"];
$LANGUAGE_SET["ru"]["months"][]                 = ["11", "Ноябрь"];
$LANGUAGE_SET["ru"]["months"][]                 = ["12", "Декабрь"];

// Titles
$LANGUAGE_SET["ru"]["titles"]["email"]          = "Email";
$LANGUAGE_SET["ru"]["titles"]["password"]       = "Пароль";
$LANGUAGE_SET["ru"]["titles"]["remember_me"]    = "Запомнить меня";
$LANGUAGE_SET["ru"]["titles"]["gender"]         = "Пол";
$LANGUAGE_SET["ru"]["titles"]["male"]           = "Мужской";
$LANGUAGE_SET["ru"]["titles"]["female"]         = "Женский";
$LANGUAGE_SET["ru"]["titles"]["date_of_birth"]  = "Дата рождения";
$LANGUAGE_SET["ru"]["titles"]["day"]            = "День";
$LANGUAGE_SET["ru"]["titles"]["month"]          = "Месяц";
$LANGUAGE_SET["ru"]["titles"]["year"]           = "Год";
$LANGUAGE_SET["ru"]["titles"]["clean"]          = "Очистить";
$LANGUAGE_SET["ru"]["titles"]["register"]       = "Зарегистрировать";
$LANGUAGE_SET["ru"]["titles"]["firstname"]      = "Имя";
$LANGUAGE_SET["ru"]["titles"]["lastname"]       = "Фамилия";
$LANGUAGE_SET["ru"]["titles"]["sign_in"]        = "Войти";

/*
 * English
 */

// Links
$LANGUAGE_SET["en"]["links"]["Home"]            = "index";
$LANGUAGE_SET["en"]["links"]["Authorization"]   = "authorization";
$LANGUAGE_SET["en"]["links"]["Registration"]    = "registration";
$LANGUAGE_SET["en"]["links"]["Logout"]          = "logout";

// Months
$LANGUAGE_SET["en"]["months"][]                 = ["01", "January"];
$LANGUAGE_SET["en"]["months"][]                 = ["02", "February"];
$LANGUAGE_SET["en"]["months"][]                 = ["03", "March"];
$LANGUAGE_SET["en"]["months"][]                 = ["04", "April"];
$LANGUAGE_SET["en"]["months"][]                 = ["05", "May"];
$LANGUAGE_SET["en"]["months"][]                 = ["06", "June"];
$LANGUAGE_SET["en"]["months"][]                 = ["07", "July"];
$LANGUAGE_SET["en"]["months"][]                 = ["08", "August"];
$LANGUAGE_SET["en"]["months"][]                 = ["09", "September"];
$LANGUAGE_SET["en"]["months"][]                 = ["10", "October"];
$LANGUAGE_SET["en"]["months"][]                 = ["11", "November"];
$LANGUAGE_SET["en"]["months"][]                 = ["12", "December"];

// Titles
$LANGUAGE_SET["en"]["titles"]["email"]          = "Email";
$LANGUAGE_SET["en"]["titles"]["password"]       = "Password";
$LANGUAGE_SET["en"]["titles"]["remember_me"]    = "Remember me";
$LANGUAGE_SET["en"]["titles"]["gender"]         = "Gender";
$LANGUAGE_SET["en"]["titles"]["male"]           = "Male";
$LANGUAGE_SET["en"]["titles"]["female"]         = "Female";
$LANGUAGE_SET["en"]["titles"]["date_of_birth"]  = "Date of Birth";
$LANGUAGE_SET["en"]["titles"]["day"]            = "Day";
$LANGUAGE_SET["en"]["titles"]["month"]          = "Month";
$LANGUAGE_SET["en"]["titles"]["year"]           = "Year";
$LANGUAGE_SET["en"]["titles"]["clean"]          = "Clean";
$LANGUAGE_SET["en"]["titles"]["register"]       = "Register";
$LANGUAGE_SET["en"]["titles"]["firstname"]      = "Firstname";
$LANGUAGE_SET["en"]["titles"]["lastname"]       = "Lastname";
$LANGUAGE_SET["en"]["titles"]["sign_in"]        = "Sign In";

// Chosen language pack
$LANGUAGE = $LANGUAGE_SET[$CURRENT_LANGUAGE];

$TITLES = $LANGUAGE["titles"];

$LINKS = $LANGUAGE["links"];

$LINK_TITLES = [];

$CURRENT_PAGE = get_current_page();

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
 * @param $lang
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

    // hyperlinks in current language set
    $links = $LINKS;

    // specify page explicitly
    if ($page == "/")
        $page = "index.php";

    // if it is not a page, but a language link e.g. En | Ru
    if ($link != "page") {
        $title = ucfirst($link); // capitalize title
        $lang = $link; //
    }
    else
        $title = array_search($page, $links);

    echo "<a href=\"" . $BASE_URL . $lang . "/" . $page . "\">" . $title . "</a>";
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