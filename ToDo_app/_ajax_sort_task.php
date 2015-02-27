<?php

// 共通ファイルを読み込む
require_once('config.php');
require_once('functions.php');

// DBに接続
$dbh = connectDb();

//var_dump($_POST['task']);

// 文字列を分析し配列に割り当てる
parse_str($_POST['task']);

//var_dump($task);

foreach ($task as $key => $val) {
    $sql = "update tasks set seq = :seq where id = :id";
    $stmt = $dbh -> prepare($sql);
    $stmt -> execute(array(
        ":seq" => $key,
        ":id" => $val
    ));
}