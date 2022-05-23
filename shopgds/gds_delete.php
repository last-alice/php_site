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

	$pro_code = $_GET['gdscode'];

	$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
	$user='root';
	$password='';
	$dbh = new PDO($dsn,$user,$password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql = 'SELECT name,img FROM mst_goods WHERE code=?';
	$stmt = $dbh->prepare($sql);
	$data[] = $gds_code;
	$stmt->execute($data);

	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	$pro_name = $rec['name'];
	$pro_gazou_name = $rec['img'];

	$dbh = null;

	if($gds_img_name=='')
	{
		$disp_img='';
	}
	else
	{
		$disp_img = '<img src="./img/'.$gds_img_name.'">';
	}

}
catch(Exception $e)
	{
		print'ただいま障害により大変ご迷惑をお掛けしております。';
		exit();
	}

?>

	商品スタッフ削除<br>
		<br>
	商品コード<br>
	<?php print $gds_code; ?>
		<br>
	商品名<br>
	<?php print $gds_name; ?>
		<br>
	<?php print $disp_img; ?>
		<br>
	この商品を削除してよろしいですか？<br />
		<br>
	<form method = "post" action = "gds_delete_done.php">
	<input type = "hidden" name = "code" value = "<?php print $gds_code; ?>">
	<input type = "hidden" name = "gazou_name" value = "<?php print $gds_img_name; ?>">
	<input type = "button" onclick = "history.back()" value = "戻る">
	<input type = "submit" value = "OK">
</form>

</body>
</html>