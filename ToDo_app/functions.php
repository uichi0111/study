<?php

// よく使う関数を定義

// データベースに接続
function connectDb() {
    try {
        return new PDO(DSN, DB_USER, DB_PASSWORD);
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }

}

// データをHTMLに反映するための関数
function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, "UTF-(");
}