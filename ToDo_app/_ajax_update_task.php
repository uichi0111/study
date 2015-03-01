<?php

// 共通ファイルを読み込む
require_once('config.php');
require_once('functions.php');

// DBに接続
$dbh = connectDb();

// SQL文
var_dump($_POST['task']);

$sql = "update tasks set title = :title, modified = now() where id = :id";
$stmt = $dbh->prepare($sql);
$stmt->execute(array(
    ":id" => (int)$_POST['id'],
    ":title" => $_PSOT['title']
));