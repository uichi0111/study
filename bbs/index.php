<?php

$dataFile = "/Applications/XAMPP/xamppfiles/htdocs/bbs/bbs.text";



//表示するときのエスケープ関数を作る
function h ($s){
	return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
	}
//ファイルに書き込み可能か調べた
//if (is_writable($dataFile)){
//	echo "書き込み可能";
//	}else{
//	echo "書き込み不可";
//	}



if ($_SERVER['REQUEST_METHOD'] == 'POST' &&//$_SERVER['REQUEST_METHOD']でPOSTかGETか判別して
	isset($_POST["message"])&& //メッセージがセットされているか判別して
	isset($_POST["user"]))	   //ユーザーがセットされている判別する
	{
		$message = $_POST['message'];
		$user = $_POST['user'];
	
		//前後の空白をトリミングする
		$message = trim($_POST['message']);
		$user = trim($_POST['user']);


	if ($message !== "")//もしメッセージが空じゃなく
		{
			//ユーザーが空だったら"ななしさん"を代入
			$user = ($user === "") ? "ななしさん":$user;
		
			//送信されたデータにタブが含まれていたら半角空白に置き換える
			$message = str_replace("\t", ' ', $message);
			$user = str_replace("\t", ' ', $user);
		}
		//日付年月日の作成
		$postedAt = date('Y-m-d H:i:s');
		
		$newData = $message . "\t" . $user . "\t" .$postedAt."\n"; //"\t"=タブ,"\n"=改行
		$fp = fopen($dataFile, 'a');//'a'書き出し用のみでオープン。ファイルポインタをファイルの終端に置く。 ファイルが存在しない場合には、作成を試みる
		fwrite($fp, $newData);
		fclose($fp);
		
}
	
//file関数で中身を一行ずつ取り出し配列に入れる
$posts = file($dataFile,FILE_IGNORE_NEW_LINES);//FILE_IGNORE_NEW_LINESで配列の各要素の最後に改行文字を追加しない。

$posts = array_reverse($posts);//投稿順に表示させたいので配列を逆にする

?>

<!DOCTYPE html>
<html lang="jp">
<head>
<meta charset="utf-8">
<title>簡易掲示板</title>
<head>
<body>
	<h1>簡易掲示板</h1>
	<form action ="" method="post">
		message: <input type="text" name="message">
		user: <input type="text" name="user">
		<input type="submit" value="送信">
	</form>
	<h2>投稿一覧(<?php echo count($posts) ; ?>件)</h2>
	
	
<!--<u1>タグはunorderd listの略でリスト項目に順序を付けない場合に使用する-->	
	<u1>
		<?php if (count($posts)) :/*変数に含まれる数を数える*/ ?>
			<?php foreach ($posts as $post) :/*指定した配列(ファイルから読み取った配列)の要素を一つずつ抜き取る*/?>
			<?php list($message, $user, $postedAt) = explode("\t", $post);/*$postにタブ区切りで要素が入っているのでそれをexplode関数で分割してlist関数で各変数に渡す*/?>
			<li><?php echo h($message);?> <?php echo h($user);?> <?php echo h($postedAt);?></li>
			<?php endforeach ; ?>
		<?php else : ?>
		<li>まだ投稿はありません。</li>
		<?php endif;/*評価式を終了させるもの(endif)を除き、 すべてのステートメントでコロンを使う！ */?>
		
	</ul>
</body>
</html>