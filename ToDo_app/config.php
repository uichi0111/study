<?php

// DB

define('DSN','mysql:host=localhost; dbname=todo_app');
define('DB_USER','dbuser');
define('DB_PASSWORD','3EwruTre');


// エラー表示
// すべてのエラーを表示するがNOTICEは厳密すぎるので除く
error_reporting(E_ALL & ~E_NOTICE);

