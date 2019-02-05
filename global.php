<?php

// 声明一个变量，代表当前的目录
$dir = dirname(__FILE__);
define("dir", $dir);

class Innotype
{
    protected function GetComp(string $components)
    {
        global $dir;
        if (file_exists($dir . "/static/components/" . $components . ".php")) {
            $comp = file_get_contents($dir . "/static/components/" . $components . ".php");
        } else {
            return false;
        }
        return $comp;
    }

    protected function GetContents(string $content)
    {
        global $dir;
        switch ($content) {
            case "index":
                return file_get_contents($dir . "/static/main.php", "main");
                break;

            default:
                if (file_exists($dir . "/static/" . $content . ".php")) {
                    return file_get_contents($dir . "/static/" . $content . ".php");
                }
        }
    }

    protected function StringInitialize($pageContent, $pageType = null)
    {
        global $Info;
        switch ($pageType) {

            case "appbar":
                $content = str_ireplace("{{sitename}}", $Info["sitename"], $pageContent);
                break;

            case "footer":
                $content = str_ireplace("{{starttime}}", $Info["startdate"], $pageContent);
                break;

            default:
                $content = str_ireplace("{{sitename}}", $Info["sitename"], $pageContent);
                $content = str_ireplace("{{starttime}}", $Info["startdate"], $pageContent);
        }
        return $content;
    }

    public function InitializePage(string $action)
    {
        switch ($action) {
            case "load":
                // 获取完整 DOM 结构
                echo ($this->StringInitialize($this->GetContents("head"), "head"));
                echo ('<body>');
                // 此处可添加对 Appbar 设置的判断
                echo ($this->StringInitialize($this->GetComp("appbar"), "appbar"));
                echo ($this->StringInitialize($this->GetContents("index"), "main"));
                echo ('</body>');
                echo ($this->StringInitialize($this->GetContents("footer"), "footer"));
                return true;
                break;
        }
    }
}

class Configuration
{
    private $Settings;
    private $Innotype;
    public function __construct()
    {
        $this->Settings = json_decode(file_get_contents(dir . "/config.json"), true);
        $this->Innotype = $this->Settings["Innotype"];
    }
    public function getInfo($key)
    {
        return $this->Innotype["General"]["info"][$key];
    }

    public function getSEO($key)
    {
        return $this->Innotype["General"]["seo"][$key];
    }

    public function getCompBool($key)
    {
        return $this->Innotype["General"]["content"]["components"][$key];
    }

    public function getDebugModeBool()
    {
        return $this->Innotype["Development"]["debugmode"];
    }

    public function getBuilt(int $pos, $key = null)
    {
        if (!empty($key)) {
            return $this->Innotype["BuiltIn"][$pos][$key];
        } else {
            return $this->Innotype["BuiltIn"][$pos];
        }
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
    "dbgmode" => $Configuration->getDebugModeBool(),
    "mdui" => $Configuration->getBuilt(0),
    "jscookie" => $Configuration->getBuilt(1),
    "parsedown" => $Configuration->getBuilt(2),
);
$Innotype = new Innotype();
