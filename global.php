<?php

// 声明一个变量，代表当前的目录
$dir = dirname(__FILE__);

class Innotype
{
    public function GetComp($components)
    {
        global $dir;
        if (file_exists($dir . "/static/components/" . $components . ".php")) {
            $comp = file_get_contents($dir . "/static/components/" . $components . ".php");
        } else {
            return false;
        }
        echo ($comp);
        return true;
    }

    public function GetContents($content)
    {
        global $dir;
        switch ($content) {
            case "index":
                echo (file_get_contents($dir . "/static/main.php"));
                break;

            case "all":
                $this->InitalizePage("load");
                break;

            default:
                if (file_exists($dir . "/static/" . $content . ".php")) {
                    echo (file_exists($dir . "/static/" . $content . ".php"));
                    return true;
                } else {
                    return false;
                }
        }
    }

    protected function InitalizePage($action) 
    {
        switch ($action) {
            case "load":
                // 获取完整 DOM 结构
                $this->GetContents("head");
                echo ('<body>');
                // 此处可添加对 Appbar 设置的判断
                $this->GetComp("appbar");
                $this->GetContents("index");
                echo('</body>');
                $this->GetContents("footer");
                return true;
                break;
        }
    }
}

$Innotype = new Innotype();
