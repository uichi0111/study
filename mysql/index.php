<?php
// データベースへの接続
// MySql

try{
    $dbh = new PDO('mysql:host=localhost; dbname=blog_app','dbuser','bEN9sona');
}catch(PDOException $e){
    var_dump($e->getMessage());
    exit;
}
echo "success!";

// 切断
$dbh = null;