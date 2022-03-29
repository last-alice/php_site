<?php
    session_start();
    session_regenerate_id(true);
    if(isset($_SESSION['login'])==false)
    {
        print 'ログインされていません。<br>';
        print '<a href = "../staff_login/staff_login.html">ログイン画面へ</a>';
        exit();
    }
    else
    {
        print $_SESSION['staff_name'];
        print 'さんログイン中<br>';
        print '<br>';
    }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>○○電機</title>
</head>
<body>

<?php

	require_once('../common/common.php');

	$post=sanitize($_POST);
	$gds_name = $post['name'];
	$gds_price = $post['price'];
	$gds_img = $_FILES['img'];

	if($gds_name=='')
		{
			print '商品名が入力されていません。<br />';
		}
	else
		{
			print '商品名:';
			print $gds_name;
			print '<br>';
	}

	if(preg_match('/\A[0-9]+\z/',$gds_price)==0)
		{
		print '価格をきちんと入力してください。<br>';
	}
	else
		{
		print '価格:';
		print $gds_price;
		print '円<br>';
	}

	if($gds_img['size']>0)
	{
		if($gds_img['size']>1000000)
		{
			print '画像が大き過ぎます';
		}
		else
		{
			move_uploaded_file($gds_img['tmp_name'],'./img/'.$gds_img['name']);
			print '<img src="./img/'.$gds_img['name'].'">';
			print '<br>';
		}
	}

	if($gds_name=='' || preg_match('/\A[0-9]+\z/',$gds_price)==0 || $gds_img['size'] > 1000000)
		{
			print '<form>';
			print '<input type = "button" onclick = "history.back()" value = "戻る">';
			print '</form>';
	}
	else
	{
		print '上記の商品を追加します。<br>';
		print '<form method = "post" action = "gds_add_done.php">';
		print '<input type = "hidden" name = "name" value = "'.$gds_name.'">';
		print '<input type = "hidden" name = "price" value = "'.$gds_price.'">';
		print '<input type = "hidden" name = "img_name" value = "'.$gds_img['name'] .'">';
		print '<br>';
		print '<input type = "button" onclick = "history.back()" value = "戻る">';
		print '<input type = "submit" value = "OK">';
		print '</form>';
	}

?>
</body>
</html>