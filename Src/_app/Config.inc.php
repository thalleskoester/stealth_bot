<?php

define('BASE', 'http://localhost/stealth');
define('THEME', 'default');

define('INCLUDE_PATH', BASE . '/themes/' . THEME);
define('REQUIRE_PATH', 'themes/' . THEME);

define('IMG_AVATAR_W', 150);
define('IMG_AVATAR_H', 150);

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_BASE', 'stealth');

define('T_USER', 'st_user');
define('T_BOTS', 'st_bots');

/**************************************
*************** FUNÇOES ***************
***************************************/

function MyAutoLoad($Class) {
    $cDir = ['Conn'];
    $iDir = null;

    foreach ($cDir as $dirName):
        if (!$iDir && file_exists(__DIR__ . '/' . $dirName . '/' . $Class . '.class.php') && !is_dir(__DIR__ . '/' . $dirName . '/' . $Class . '.class.php')):
            include_once (__DIR__ . '/' . $dirName . '/' . $Class . '.class.php');
            $iDir = true;
        endif;
    endforeach;
}

spl_autoload_register("MyAutoLoad");

function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine) {
    echo "<div class='trigger trigger-error'>";
    echo "<b>Erro na Linha: #{$ErrLine} ::</b> {$ErrMsg}<br>";
    echo "<small>{$ErrFile}</small>";
    echo "<span class='ajax_close'></span></div>";

    if ($ErrNo == E_USER_ERROR):
        die;
    endif;
}

set_error_handler('PHPErro');

function Erro($ErrMsg, $ErrNo = null) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? 'trigger-info' : ($ErrNo == E_USER_WARNING ? 'trigger-alert' : ($ErrNo == E_USER_ERROR ? 'trigger-error' : 'trigger-success')));
    echo "<div class='trigger {$CssClass}'>{$ErrMsg}<span class='ajax_close'></span></div>";
}

function AjaxErro($ErrMsg, $ErrNo = NULL) {
    $ClassCss = ($ErrNo == E_USER_ERROR ? 'trigger-error' : ($ErrNo == E_USER_WARNING ? 'trigger-alert' : ($ErrNo == E_USER_NOTICE ? 'trigger-info' : 'trigger-success')));
    return "<div class='trigger trigger-ajax {$ClassCss}'>{$ErrMsg}<span class='ajax-close'></span></div>";
}