<?php
ob_start();
session_start();
require '_app/Config.inc.php';

$GetURL = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
$SetURL = (empty($GetURL) ? 'index' : $GetURL);
$URL = explode('/', $SetURL);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">

        <title>,:: Stealth Botnet ::.</title>

        <meta name="robots" content="noindex, nofollow">
        <meta name="description" content="">

        <link rel="base" href="<?= BASE; ?>">
        <link rel="page" href="<?= $URL[0]; ?>">
        <link rel="shortcut icon" href="<?= INCLUDE_PATH . '/images/favicon.png'; ?>">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
        <style>*{font-family: 'Lato', sans-serif;}</style>

        <link rel="stylesheet" href="<?= BASE . '/_cdn/css/reset.css'; ?>">
        <link rel="stylesheet" href="<?= INCLUDE_PATH . '/style.css'; ?>">

        <!--[if lt IE 9]>
            <script src="<?= BASE; ?>/_cdn/js/html5shiv.js"></script>
        <![endif]-->
    </head>

    <body>
        <?php
        if ($URL[0] == 'login'):
            if (file_exists(REQUIRE_PATH . '/login.php')):
                require_once REQUIRE_PATH . '/login.php';
            else:
                require_once REQUIRE_PATH . '/404.php';
            endif;
        else:
            if (file_exists(REQUIRE_PATH . '/inc/header.inc.php')):
                require_once REQUIRE_PATH . '/inc/header.inc.php';
            else:
                trigger_error('Arquivo "/inc/header.inc.php" não existe. Por favor crie!');
            endif;

            if (file_exists(REQUIRE_PATH . "/{$URL[0]}.php")):
                require_once REQUIRE_PATH . "/{$URL[0]}.php";
            else:
                if (file_exists(REQUIRE_PATH . '/404.php')):
                    require_once REQUIRE_PATH . '/404.php';
                else:
                    trigger_error('Arquivo "404.php" não existe. Por favor crie!');
                endif;
            endif;
        endif;
        if (file_exists(REQUIRE_PATH . '/inc/footer.inc.php')):
            require_once REQUIRE_PATH . '/inc/footer.inc.php';
        else:
            trigger_error('Arquivo "/inc/footer.inc.php" não existe. Por favor crie!');
        endif;
        ?>

        <script src="<?= BASE . '/_cdn/js/jquery.min.js'; ?>"></script>
        <script src="<?= BASE . '/_cdn/js/jquery.form.js'; ?>"></script>
        <script src="<?= BASE . '/_cdn/js/botnet.js'; ?>"></script>
        <?php
        if (file_exists(REQUIRE_PATH . '/script.js')):
            require_once REQUIRE_PATH . '/script.js';
        endif;
        ?>
    </body>
</html>
<?php
ob_end_flush();


if (!file_exists('.htaccess')):
    $htaccesswrite = "RewriteEngine On\r\nOptions All -Indexes\r\n\r\nRewriteCond %{SCRIPT_FILENAME} !-f\r\nRewriteCond %{SCRIPT_FILENAME} !-d\r\nRewriteRule ^(.*)$ index.php?url=$1\r\n\r\n<IfModule mod_expires.c>\r\nExpiresActive On\r\nExpiresByType image/jpg 'access 1 year'\r\nExpiresByType image/jpeg 'access 1 year'\r\nExpiresByType image/gif 'access 1 year'\r\nExpiresByType image/png 'access 1 year'\r\nExpiresByType text/css 'access 1 month'\r\nExpiresByType application/pdf 'access 1 month'\r\nExpiresByType text/x-javascript 'access 1 month'\r\nExpiresByType application/x-shockwave-flash 'access 1 month'\r\nExpiresByType image/x-icon 'access 1 year'\r\nExpiresDefault 'access 2 days'\r\n</IfModule>";
    $htaccess = fopen('.htaccess', "w");
    fwrite($htaccess, str_replace("'", '"', $htaccesswrite));
    fclose($htaccess);
endif;
