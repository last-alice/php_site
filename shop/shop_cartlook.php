<?php
	session_start();
    session_regenerate_id(true);
    if(isset($_SESSION['member_login'])==false)
    {
		print 'ようこそゲスト様　';
		print '<a href="member_login.html">会員ログイン</a><br>';
		print '<br>';
    }
    else
    {
		print 'ようこそ';
		print $_SESSION['member_name'];
		print '様　';
		print '<a href="member_logout.php">ログアウト</a><br />';
		print '<br>';
}
?>

<!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>カートの中身</title>

        <link rel="stylesheet" href="../main.css">
        <link rel="stylesheet" href="../ress.css">
    </head>

    <body>

<?php

try
{

	if(isset($_SESSION['cart'])==true)
	{
	$cart=$_SESSION['cart'];
	$qty=$_SESSION['qty'];
	$max=count($cart);
	}
	else
	{
		$max=0;
	}

	if($max==0)
	{
		print'カートに商品が入っていません。<br>';
		print'<br>';
		print'<a href="shop_list.php">商品一覧に戻る</a>';
		exit();
	}

	$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
	$user='root';
	$password='';
	$dbh=new PDO($dsn,$user,$password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	foreach($cart as $key=>$val)
	{
		$sql='SELECT code,name,price,img FROM mst_product WHERE code=?';
		$stmt=$dbh->prepare($sql);
		$data[0]=$val;
		$stmt->execute($data);

		$rec=$stmt->fetch(PDO::FETCH_ASSOC);

		$pro_name[]=$rec['name'];
		$pro_price[]=$rec['price'];
		if($rec['img']=='')
		{
			$pro_img[]='';
		}
		else
		{
			$pro_img[]='<img src="../img'.$rec['img'].'">';
		}
	}
	$dbh=null;

}
catch(Exception $e)
{
    print 'ただいま障害により接続出来ません。';
    print '大変ご迷惑をお掛けしております。';
    exit();
}

?>

	カートの中身<br>
	<br>
	<form method="post" action="qty_change.php">
	<table border="1">
		<tr>
			<td>商品</td>
			<td>商品画像</td>
			<td>価格</td>
			<td>数量</td>
			<td>小計</td>
			<td>削除</td>
		</tr>
	<?php for($i=0;$i<$max;$i++)
		{
	?>
	<tr>
		<td><?php print $pro_name[$i]; ?></td>
		<td><?php print $pro_gazou[$i]; ?></td>
		<td><?php print $pro_price[$i]; ?>円</td>
		<td><input type="text" name="qty<?php print $i; ?>" value="<?php print $kazu[$i]; ?>"></td>
		<td><?php print $pro_price[$i]*$kazu[$i]; ?>円</td>
		<td><input type="checkbox" name="dlt<?php print $i; ?>"></td>
	</tr>
<?php
	}
?>
	</table>
	<input type="hidden" name="max" value="<?php print $max; ?>">
	<input type="submit" value="数量変更"><br>
	<input type="button" onclick="history.back()" value="戻る">
	</form>
	<br>
	<a href="shop_form.html">ご購入手続きへ進む</a><br>

<?php
	if(isset($_SESSION["member_login"])==true)
	{
		print'<a href="shop_simple_check.php">会員かんたん注文へ進む</a><br>';
	}
?>

</body>
</html>