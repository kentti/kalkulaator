<?php
 
/*
    The important thing to realize is that the config file should be included in every
    page of your project, or at least any page you want access to these settings.
    This allows you to confidently use these settings throughout a project because
    if something changes such as your database credentials, or a path to a specific resource,
    you'll only need to update it here.
*/
 
abstract class Products
{
    const Window = "aken";
    const Door = "uks";
    const Stairs = "trepp";
}

abstract class WindowTypes
{
    const Cottage = "suvemaja";
    const House = "elumaja";
}

abstract class DoorTypes
{
    const Internal = "siseuks";
    const External = "valisuks";
}

abstract class StairsTypes
{
    const Straight = "sirge";
    const StairsL = "Ltrepp";
    const StairsU = "Utrepp";
}

abstract class WindowFrame
{
    const Single = "yhekordne";
    const Double = "kahekordne";
}

abstract class WindowOpeningSimple
{
    const In = "sisse";
    const Out = "valja";
}

abstract class WindowOpeningDouble
{
    const InPlusIn = "sisse_sisse";
    const InPlusOut = "sisse_valja";
}

abstract class WindowGlass
{
    const Double = "2x_pakett";
    const Triple = "3x_pakett";
    const DoublePlusSingle = "2x_pakett_tavaline";
}

abstract class DoorVariant
{
    const Panel = "tahveluks";
    const Glass = "klaasuks";
    const Plank = "lauduks";
    const InsulatedPanel = "soojustatud_tahveluks";
    const Thick = "paksem_uks";
}

abstract class DoorLock
{
    const Cheap = "odav";
    const MidRange = "keskmine";
    const Expensive = "kallis";
}

abstract class StepType
{
    const Open = "avatud";
    const Closed = "suletud";
}

$config = array(
    "db" => array(
        "dbname" => "hinnakalkulaator",
        "username" => "root",
        "password" => "kukimuki",
        "host" => "localhost"
    ),
    "urls" => array(
        "baseUrl" => "http://example.com"
    ),
    "paths" => array(
        "resources" => "/resources",
        "images" => array(
            "content" => $_SERVER["DOCUMENT_ROOT"] . "/images/content",
            "layout" => $_SERVER["DOCUMENT_ROOT"] . "/images/layout"
        )
    )
);
 
/*
    I will usually place the following in a bootstrap file or some type of environment
    setup file (code that is run at the start of every page request), but they work 
    just as well in your config file if it's in php (some alternatives to php are xml or ini files).
*/
 
/*
    Creating constants for heavily used paths makes things a lot easier.
    ex. require_once(LIBRARY_PATH . "Paginator.php")
*/
defined("LIBRARY_PATH")
    or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library'));
     
defined("TEMPLATES_PATH")
    or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));
 
/*
    Error reporting.
*/
ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRCT);
 
?>