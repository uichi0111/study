<?php

//オブジェクト指向
/*
クラス：設計図
-メンバー変数
-メソッド（関数）
-コンストラクタ

インスタンス：クラスを実体化したもの

*/

class User {
    public $name;
    //protectedはサブクラスでも使える
    protected $email; //privateにするとクラス内でしかアクセス出来ない

    //メソッドを定義
    public function __construct($name, $email){
        $this->name = $name;
        $this->email = $email;
    }
    public function sayHI(){
        echo "hi! my name is ".$this->name;
    }
}

//クラスの継承（拡張）
class SuperUser extends User{

    public function supersayHI(){
        echo "hiiiiiiiiiiiiiiiiiiiii! my name is ".$this->name;
    }
}
//newを使って実体化する
$tom = new User("tom", "dummy@gamil.com");
//$bob = new User("bob", "dummy@gmail.com");拡張したクラスに含まれる
$bob = new SuperUser("bob","dummy@gmail");


echo $tom->name;
echo"<BR>";
echo $tom->sayHI();
echo"<BR>";
echo $bob->name;
echo"<BR>";
echo $bob->supersayHI();
//echo $bob->email;privateなのでエラーになる












