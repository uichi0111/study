<HTML>
<HEAD>
<TITLE>テスト</TITLE>
</HEAD>
<BODY>

<?php


//縮小幅を指定
$resizeX = 150;
$thumbnail_name = "thumbnail.jpg";
//ファイルの移動先を設定
$file_dir = '/Applications/XAMPP/xamppfiles/htdocs/exif/';

//$fil_dirとファイル名を格納
$file_path = $file_dir . $_FILES["photo1"]["name"];

//ファイルを移動する
if(move_uploaded_file($_FILES["photo1"]["tmp_name"],$file_path))
	{
		//画像ファイルの移動先パスを移動
		$img_dir = "/exif/";
		
		$img_path = $img_dir. $_FILES["photo1"]["name"];//$img_dirとファイル名を格納
		
		$thumbnail_path = $img_dir . $thumbnail_name;//$img_dirとファイル名を格納
		
		//ファイルの画像形式をチェック
		if(mb_strpos($_FILES["photo1"]["type"],"jpeg"))
			{
				$gdimg_in = imagecreatefromjpeg($file_path);//ファイルを読み込みイメージIDを格納
				$ix = imagesx($gdimg_in);//画像の横幅を取得
				$iy = imagesy($gdimg_in);//画像の縦幅を取得
				$ox = $resizeX;//画像の縮小幅を取得
				$oy = ($ox * $iy) / $ix;//拡大縮小後の縦幅を計算
				$gdimg_out = imagecreatetruecolor($ox, $oy);//変更後のイメージIDを作成
				imagecopyresized($gdimg_out, $gdimg_in, 0, 0, 0, 0, $ox, $oy, $ix, $iy);//画像の複製とサイズ変更
				imagejpeg($gdimg_out, $img_dir);//画像をファイルに保存
				//利用したメモリを開放
				imagedestroy($gdimg_in);
				imagedestroy($gdimg_out);
						
				//アップロードした画像の情報を取得
				$size  = getimagesize($file_path);
				$size2 = getimagesize($thumbnail_path);
				
?>
ファイルアップロードを完了しました<BR>
<IMG src="<?=$img_path?>"<?=$size[3]?>><BR>
<IMG src="<?=$thumbnail_path?>"<?=$size2[3]?>><BR>

<?php
}else{
	echo "jpeg画像をアップして下さい<BR>";
}
}else{
    echo "正常にアップロードされませんでした。<BR>";
}
?>

</BODY>
</HTML>


