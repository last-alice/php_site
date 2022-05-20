<?php

	session_start();
	session_regenerate_id(true);
	if(isset($_SESSION['login'])==false)
	{
		print 'ログインされていません。<br>';
		print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
		exit();
	}

	if(isset($_POST['disp'])==true)
	{
		if(isset($_POST['gdscode'])==false)
		{
			header('Location:gds_ng.php');
			exit();
		}
		$pro_code = $_POST['gdscode'];
		header('Location:gds_disp.php?gdscode='.$gds_code);
		exit();
	}

	if(isset($_POST['add'])==true)
	{
		header('Location:gds_add.php');
		exit();
	}

	if(isset($_POST['edit'])==true)
	{
		if(isset($_POST['gdscode'])==false)
		{
			header('Location:gds_ng.php');
			exit();
		}
		$pro_code = $_POST['gdscode'];
		header('Location:gds_edit.php?gdscode='.$gds_code);
		exit();
	}

	if(isset($_POST['delete'])==true)
	{
		if(isset($_POST['gdscode'])==false)
		{
			header('Location:gds_ng.php');
			exit();
		}
		$pro_code = $_POST['gdscode'];
		header('Location:gds_delete.php?gdscode='.$gds_code);
		exit();
	}

?>