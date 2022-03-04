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

    <title>商品一覧</title>

    <link rel="stylesheet" href="../main.css">
    <link rel="stylesheet" href="../ress.css">
</head>

<body>
    <header>
        <div class="list">
            <div class="container">
                <ul>
                    <li><a href="top.php">TOP</a></li>
                    <li>商品一覧</li>
                </ul>
            </div>
        </div>
    </header>
    <main>

    <?php

        try
        {

            $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
            $user='root';
            $password='';
            $dbh = new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql = 'SELECT code,name,price FROM mst_goods WHERE 1';
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            $dbh = null;

            print '商品一覧<br><br>';

            while(true)
            {
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if($rec==false)
                {
                    break;
                }
                print '<a href="shop_goods.php?godscode='.$rec['code']. '">';
                print $rec['name'].'---';
                print $rec['price'].'円';
                print '</a>';
                print '<br>';
            }

            print '<br>';
            print '<a href="shop_cartlook.php">カートを見る</a><br>';

        }
        catch (Exception $e)
        {
            print 'ただいま障害により接続出来ません。';
            print '大変ご迷惑をお掛けしております。';

            exit();
        }

    ?>
    </main>
    <footer>
        <div class="container">
            <p>Copyright @ 2022 ○○電機</p>
        </div>
    </footer>
</body>

</html>