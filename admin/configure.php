<?php
/* configure.php
 * 这不是配置文件的一部分，而是配置文件的解析过程。
 * 因此请不要随意修改本文件的内容，否则可能导致解析出错。
 */

require "./../global.php";
define("class_dir", $dir);

$Settings = json_decode(file_get_contents(class_dir . "/config.json"), true);
$Innotype = $Settings["Innotype"];

class Configuration
{
    function getInfo($key)
    {
        global $Innotype;
        return $Innotype["General"]["info"][$key];
    }

    function getSEO($key)
    {
        global $Innotype;
        return $Innotype["General"]["seo"][$key];
    }

    function getCompBool($key)
    {
        global $Innotype;
        return $Innotype["General"]["content"]["components"][$key];
    }

    function getDebugModeBool()
    {
        global $Innotype;
        return $Innotype["Development"]["debugmode"];
    }
}

$Configuration = new Configuration();
$Info = array(
    "sitename" => $Configuration->getInfo("sitename"),
    "owner" => $Configuration->getInfo("owner"),
    "startdate" => $Configuration->getInfo("startat"),
    "keyword" => $Configuration->getSEO("keyword"),
    "description" => $Configuration->getSEO("description"),
    "appbar" => $Configuration->getCompBool("appbar"),
    "menu" => $Configuration->getCompBool("menu"),
    "dialog" => $Configuration->getCompBool("dialogs"),
    "dbgmode" => $Configuration->getDebugModeBool()
);
var_dump($Info);
