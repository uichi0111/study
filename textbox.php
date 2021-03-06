<!DOCTYPE html>
<html lang="jp">
<head>
<meta charset = "utf-8">
<meta name = "viewport" content = "width=devise-width , initial - scale = 1.0">
<title> フォームの使い方 </title>
</head>
<body>
<div>

<?php
//h()関数を読み込む
require_once '/Applications/XAMPP/xamppfiles/htdocs/lib/h.php';

echo "<p>結果</p>";
echo "テキストボックス(初期値とautofocus属性を指定):";
if (isset($_POST["example1"]))
{
	echo h($_POST["example1"]);
}


echo "<br>テキストボックス(size属性に10を指定):";
if (isset($_POST["example2"]))
{
	echo h($_POST["example2"]);
}


echo "<br>テキストボックス(size属性に50、maxlength属性に30を指定):";
if (isset($_POST["example3"]))
{
	echo h($_POST["example3"]);
	
	
}echo "<br>テキストボックス(disabledでボックスを無効化する):";
if (isset($_POST["example4"]))
{
	echo h($_POST["example4"]);
	
	
}echo "<br>テキストボックス(readonlyで書き換えを禁止する):";
if (isset($_POST["example5"]))
{
	echo h($_POST["example5"]);
}

echo "</p><hr>";
?>
<form method = "post" action = "textbox.php">
<p>テキストボックス(初期値とautofocus属性を指定):
<input type = "text" name = "example1" value = "サンプル" autofoucs></p>

<p>テキストボックス(size属性に10を指定):
<input type = "text" name = "example2" size = "10" value = ""></p>

<p>テキストボックス(size属性に50、maxlength属性に30を指定)
<input type = "text" name = "example3"  size = "50" maxlength = "30" value = ""></p>

<!--要素が無効化されると、ボタンは押せなくなり、テキストは入力できなくなり、選択ボックスは選択できなくなる-->
<p>テキストボックス(disabledでボックスを無効化する):
<input type = "text" name = "example4" value = "サンプル" disabled></p>

<p>テキストボックス(readonlyで書き換えを禁止する):	
<input type = "text" name = "example5" value = "サンプル" readonly></p>
<p><input type = "submit" value = "送信する"></p>


</form>
</div>
</body>
</html>
