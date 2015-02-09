<?php
// データベースへの接続
// MySQL

try{
    $dbh = new PDO('mysql:host=localhost; dbname=blog_app','dbuser','bEN9sona');
}catch(PDOException $e){    //エラーが発生した場合
    var_dump($e->getMessage());
    exit;
}
echo "success!";

echo "<BR>";

//処理
//すべてのユーザーのデータを取得して表示する
$sql = "select * from users";
//SQL文を実行
$stmt = $dbh -> query($sql);
//$stmt -> fetchAllでSQL文で取得
foreach ($stmt -> fetchAll(PDO::FETCH_ASSOC) as $user){
    var_dump($user['name']);
}

//件数を表示する
    //$dbh -> query("select count(*) from users")でSQL文を発行してfetchColumnで取得
echo $dbh -> query("select count(*) from users") -> fetchColumn(). "records found";
echo "<BR>";

//データベースの中にレコードを挿入する
    //SQL文を作るときにエスケープするときは
        //prepareを使ってSQL文を使う(エスケープ処理を自動で行う)
            //values(?.?.?)に入る値を次の命令の配列で与える
//$stmt = $dbh -> prepare("insert into users(name,email,password) values(?,?,?)");
//$stmt -> execute(array("n","e","p"));

//もしくは
    //$stmt = $dbh -> prepare("insert into users(name,email,password) values(:name,:email,:password)");
    //$stmt -> execute(array(":name"=>"n2",":email"=>"e2",":password"=>"p"));

//$stmt = $dbh -> prepare("insert into users(name,email,password) values(:name,:email,:password)");
//$stmt->bindParam(":name",$name);
//$stmt->bindParam(":email",$email);
//$stmt->bindParam(":password",$password);

//$name = "n10";
//$email = "e10";
//$password = "p10";

//$stmt -> execute();
//echo "done";
//echo "<BR>";

//最後にインサートされたレコードのIDを取得
//echo $dbh -> lastInsertId();
//echo "<BR>";

//nから始まる名前のデータのemailをダミーに変えてみる
//$stmt = $dbh -> prepare("update users set email = :email where name like :name");
//$stmt -> execute(array(":email"=>"dummy",":name"=>"n%"));

//削除
$stmt = $dbh -> prepare("delete from users where password = :password");
$stmt -> execute(array(":password" => "p10"));

//件数をカウント
echo  $stmt -> rowCount() . "records deleted";















// 切断
$dbh = null;