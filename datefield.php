<!DOCTYPE html>
<html lang="jp">
<head>
<meta charset="utf=8">
<meta name="viewport" content"=width=device-eidth,initial-scale=1.0">
<title>日付フィールド</title>
</head>
<body>
<dvi>
<?php
require_once "/Applications/XAMPP/xamppfiles/htdocs/lib/h.php";

echo "<p>結果</p>";
echo "日付は？";
if (isset($_POST["date"]))
{
	echo h($_POST["date"]);
}
echo "</p><hr>";
?>
<form method="post" action="datefield.php">
<p>日付
<input type="date" name="date">
<input type="submit" value="送信する"></p>
</form>
</div>
</body>
</html>