<?php

//セッション(サーバー側にデータを保存する)

session_start();
//セッションの作成
$_SESSION['userName'] = "ikeuchi";

セッションの削除
//unset($_SESSION['userName']);

echo $_SESSION['userName'];

