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
<title> ○○電機</title>
</head>
<body>

<?php

try
{

	$gds_code = $_POST['code'];
	$gds_img_name = $_POST['img_name'];

	$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
	$user='root';
	$password='';
	$dbh = new PDO($dsn,$user,$password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql = 'DELETE FROM mst_goods WHERE code=?';
	$stmt = $dbh->prepare($sql);
	$data[] = $gds_code;
	$stmt->execute($data);

	$dbh = null;

	if($gds_img_name!='')
	{
		unlink('./img/'.$gds_img_name);
	}

	}
catch (Exception $e)
	{
		print 'ただいま障害により大変ご迷惑をお掛けしております。';
		exit();
	}

?>

	削除しました。<br>
		<br>
	<a href = "gds_list.php">戻る</a>

</body>
</html>