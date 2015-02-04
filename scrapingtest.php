<?php
//simplehtmldomを読み込む
include "/Applications/XAMPP/xamppfiles/htdocs/simplehtmldom_1_5/simple_html_dom.php";

//str_get_html()またはfile_get_html()から、simple_html_domオブジェクトを生成
$html = file_get_html('http://www.yahoo.co.jp/');

//imgタグを属性として習得し$elementに格納
foreach($html->find('img') as $element){

       echo $element->src . "<br>";
}