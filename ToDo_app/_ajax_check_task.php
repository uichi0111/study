<?php

// 共通ファイルを読み込む
require_once('config.php');
require_once('functions.php');

// DBに接続
$dbh = connectDb();

// SQL文

// MYSQLのif文を使う
$sql = "update tasks set type = if(type = 'done' ,'notyet', 'done'), modified = now() where id = :id";
$stmt = $dbh->prepare($sql);
$stmt->execute(array(":id" => (int)$_POST['id']));