<?php

// 共通ファイルを読み込む
require_once('config.php');
require_once('functions.php');

// DBに接続
$dbh = connectDb();

// SQL文

// レコードを削除すると処理が重いのでフラグを立てて削除されたことにする
$sql = "update tasks set type = 'deleted', modified = now() where id = :id";
$stmt = $dbh->prepare($sql);
$stmt->execute(array(":id" => (int)$_POST['id']));