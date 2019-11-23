<?php
/**
 * core.php
 * Innotype 核心
 */

$config = require root . "config.php";

class UI {
    private $list;
    public function __construct(){
        global $config;
        $this->list = $config['custom-list'];
    }

    public function CreateList(): string {
        $list = '';
        for ($i = 0; $i < count($this->list); $i++) {
            $list = $list . <<<HTML
            <div class="mdui-list-item mdui-ripple" onclick="{$this->list[$i]['action']}">
                <span class="mdui-list-item-icon mdui-icon mdi {$this->list[$i]['icon']}"></span>
                <span class="mdui-list-item-content">{$this->list[$i]['text']}</span>
            </div>
HTML;
        }
        return $list;
    }
}

?>