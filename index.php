<?php
define("root", getcwd() . "/");
require root . "core.php";
$UI = new UI();
$List = $UI->CreateList();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/mdui.min.css">
    <link rel="stylesheet" href="/css/materialdesignicons.min.css">
    <title><?=$config['name']?></title>
</head>
<body>
    <div class="mdui-appbar mdui-theme-primary-<?=$config['primary-color']?> <?=$config['accent-color'] !== null ? 'mdui-theme-accent-' . $config['accent-color'] : 'mdui-theme-accent-' . $config['primary-color']?>">
        <div class="mdui-toolbar mdui-color-theme">
            <div id="menu-button" class="mdui-btn mdui-btn-icon mdui-ripple"><span class="mdui-icon mdi mdi-menu"></span></div>
            <div class="mdui-typo-headline"><?=$config['name']?></div>
        </div>
    </div>
    <div id="main-drawer" class="mdui-drawer mdui-drawer-close mdui-color-white">
        <div class="mdui-list">
            <?= $List !== '' ? '<div class="mdui-subheader">主要</div>' : '';?>
            <div class="mdui-list-item mdui-ripple">
                <span class="mdui-list-item-icon mdui-icon mdi mdi-account-circle"></span>
                <span class="mdui-list-item-content">登录</span>
            </div>
            <?= $List !== '' ? '<div class="mdui-subheader">其它</div>' . $List : '';?>
        </div>
    </div>
</body>
<script src="/js/mdui.min.js"></script>
<script src="/js/initialization.js"></script>
<script src="/js/actions/actions-index.js"></script>
</html>