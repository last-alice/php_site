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
		print '<a href="member_logout.php">ログアウト</a><br>';
        print '<br>';
    }
?>

<!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>商品詳細</title>

        <link rel="stylesheet" href="../main.css">
        <link rel="stylesheet" href="../ress.css">
    </head>

    <body>

<?php

try
{

    $pro_code = $_GET['procode'];

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
    $gds_gazou_name = $rec['img'];

    $dbh = null;

    if($gds_img_name=='')
    {
        $disp_img='';
    }
    else
    {
        $disp_img='<img src="../img'.$gds_img_name.'">';
    }
    print '<a href="shop_cartin.php?procode='.$gds_code.'">カートに入れる</a><br><br>';

}
catch(Exception $e)
{
    print 'ただいま障害により接続出来ません。';
    print '大変ご迷惑をお掛けしております。';
	exit();
}

?>

    商品情報参照<br>
        <br>
    商品コード<br>
    <?php print $gds_code; ?>
        <br>
    商品名<br>
    <?php print $gds_name; ?>
        <br>
    価格<br>
    <?php print $gds_price; ?>円
    <br>
    <?php print $disp_img; ?>
    <br>
    <br>
    <form>
        <input type = "button" onclick = "history.back()" value = "戻る">
    </form>

        <footer>
            <div class="container">
                <p>Copyright @ 2022 ○○電機</p>
            </div>
        </footer>

    </body>
</html>