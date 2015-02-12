<?php
//定数を定義
define('DB_HOST','localhost');
define('DB_USER','dbuser');
define('DB_PASSWORD', 'U8df76d');
define('DB_NAME', 'paging_php');
define('COMMENTS_PER_PAGE', 5);

//悪意のあるコードに対応するようエラーチェックを行う
//正規表現によるマッチング
///^[1-9][0-9]*$/
//最初の文字は 1～9 のどれかの文字。
//二文字目以降は 0～9 の文字が 0個 以上 繰り返して終わる。
if (preg_match('/^[1-9][0-9]*$/', $_GET['page'])){
    $page = (int)$_GET['page'];
}else{
    $page = 1;
}

//エラー設定
//// E_NOTICE 以外の全てのエラーを表示する
error_reporting(E_ALL & ~E_NOTICE);


//データベースに接続
try {
    $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
//例外処理
}catch (PDOException $e){
    echo $e->getMessage();
    exit;
}

// select * from comments limit OFFSET,COUNT
// page offset count
//  1   0     5
//  2   5     5
//  3   10    5
//  4   15    5

$offset = COMMENTS_PER_PAGE * ($page - 1);
//"select * from comments limit "・・・limitの後の半角スペースをなくすとWarning: Invalid argument supplied for foreach()がでた
$sql = "select * from comments limit ".$offset.",".COMMENTS_PER_PAGE;
//データベースから引っ張ってきたものを一旦配列に入れる
//まず空の配列を作る
$comments = array();
//foreachで$rowを配列に入れていく
foreach ($dbh->query($sql) as $row) {
    array_push($comments, $row);
}
$offset = COMMENTS_PER_PAGE * ($page - 1);
$sql = "select * from comments limit ".$offset.",".COMMENTS_PER_PAGE;
$comments = array();
foreach ($dbh->query($sql) as $row) {
    array_push($comments, $row);
}


$total = $dbh->query("select count(*) from comments")->fetchColumn();
$totalPages = ceil($total / COMMENTS_PER_PAGE);

//var_dump($comments);
//exit;

$from = $offset + 1;
//三項演算子で処理
$to = ($offset + COMMENTS_PER_PAGE) < $total ? ($offset + COMMENTS_PER_PAGE) : $total;

?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="utf-8">
    <title>コメント一覧</title>
</head>
<body>
    <h1>コメント一覧</h1>
    <p>全<?php echo $total; ?>件中、<?php echo $from; ?>件〜<?php echo $to; ?>件を表示しています</p>

    <ul>
    <?php foreach ($comments as $comment) :?>
    <li><?php echo htmlspecialchars($comment['comment'], ENT_QUOTES, 'utf-8');?></li>
    <?php endforeach; ?>
    </ul>

    <?php if ($page > 1) : ?>
    <a href="?page=<?php echo $page-1; ?>">前</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
        <?php if ($page == $i) :?>
            <STRONG><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></STRONG>
        <?php else:?>
            <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endif;?>

    <?php endfor; ?>
    <?php if ($page < $totalPages) : ?>
    <a href="?page=<?php echo $page+1; ?>">次</a>
    <?php endif; ?>
</body>
</html>