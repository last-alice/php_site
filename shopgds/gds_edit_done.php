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

try
{

	require_once('../common/common.php');

	$post=sanitize($_POST);
	$gds_code = $post['code'];
	$gds_name = $post['name'];
	$gds_price = $post['price'];
	$gds_img_name_old = $post['img_name_old'];
	$gds_img_name = $post['img_name'];

	$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
	$user='root';
	$password='';
	$dbh = new PDO($dsn,$user,$password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql = 'UPDATE mst_goods SET name=?,price=?,img=? WHERE code=?';
	$stmt = $dbh->prepare($sql);
	$data[] = $gds_name;
	$data[] = $gds_price;
	$data[] = $gds_img_name;
	$data[] = $gds_code;
	$stmt->execute($data);

	$dbh = null;

	if($gds_img_name_old!=$gds_img_name)
	{
		if($gds_img_name_old!='')
		{
			unlink('./img/'.$gds_img_name_old);
		}
	}

	print '修正しました。<br>';

	}
catch(Exception $e)
	{
		print'ただいま障害により大変ご迷惑をお掛けしております。';
		exit();
	}

?>

	<a href = "gds_list.php">戻る</a>

</body>
</html>