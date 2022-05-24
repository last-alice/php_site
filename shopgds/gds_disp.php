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
    $gds_img_name = $rec['img'];

    $dbh = null;

    if($gds_img_name=='')
    {
        $disp_img='';
    }
    else
    {
        $disp_img='<img src="./img/'.$gds_img_name.'">';
    }
}
catch(Exception $e)
{
    print'ただいま障害により大変ご迷惑をお掛けしております。';
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

</body>
</html>