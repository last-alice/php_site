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

	$gds_code = $_GET['gdscode'];

	$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
	$user='root';
	$password='';
	$dbh = new PDO($dsn,$user,$password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql = 'SELECT name,price,img FROM mst_goods WHERE code=?';
	$stmt = $dbh->prepare($sql);
	$data[] = $gds_code;
	$stmt->execute($data);

	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	$gds_name = $rec['name'];
	$gds_price = $rec['price'];
	$gds_img_name_old = $rec['img'];

	$dbh = null;

	if($gds_img_name_old=='')
	{
		$disp_img='';
	}
	else
	{
		$disp_img = '<img src="./img/'.$gds_img_name_old.'">';
	}

	}
	catch(Exception $e)
	{
		print 'ただいま障害により大変ご迷惑をお掛けしております。';
		exit();
	}

?>

	商品修正<br>
		<br>
	商品コード<br>
	<?php print $img_code; ?>
		<br>
		<br>
	<form method = "post" action = "gds_edit_check.php" enctype = "multipart/form-data">
	<input type = "hidden" name = "code" value = "<?php print $gds_code; ?>">
	<input type = "hidden" name = "img_name_old" value = "<?php print $gds_img_name_old; ?>">
	商品名<br>
	<input type = "text" name = "name" style = "width:200px" value = "<?php print $gds_name; ?>"><br>
	価格<br>
	<input type = "text" name =" price" style = "width:50px" value = "<?php print $gds_price; ?>">円<br>
		<br>
	<?php print $disp_img; ?>
		<br>
	画像を選んでください。<br>
	<input type = "file" name = "img" style = "width:400px"><br>
		<br>
	<input type = "button" onclick = "history.back()" value = "戻る">
	<input type = "submit" value = "OK">
	</form>

</body>
</html>