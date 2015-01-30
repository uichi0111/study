<?php
//htmlでのエスケープ処理をする関数
//引数が文字列、配列のいずれでも処理

function h($var) //htmlでのエスケープ処理をする関数
{
	if (is_array($var)) //is_array関数で配列かどうかを確認
	{
		return array_map('h', $var);// array_map関数（コールバック関数）で配列の各要素に対して指定した関数を実行
	}else{
		return htmlspecialchars($var, ENT_QUOTES, 'utf-8');
	}
}
