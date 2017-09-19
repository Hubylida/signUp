<?php 
	session_start();
	header("Content-Type:text/html;charset=utf-8;");
	$link = mysqli_connect('localhost','root','linyuchen','castuser');//连接数据库
	mysqli_set_charset($link,'utf8');//设定字符集
	if($link){	
		$schoolnum = $_POST['schoolnum'];
		$pw = $_POST['pw'];
		$_SESSION['schoolnum']=$schoolnum;  
        $_SESSION['pw']=$pw;
		$search = "SELECT `schoolnum`,`password`,`flag` FROM `stulist` WHERE schoolnum=? and password=?";//创建sql语句模板
		$stmt = mysqli_prepare($link,$search);//准备一条查询语句
		mysqli_stmt_bind_param($stmt,'ss',$schoolnum,$pw);//绑定参数
		mysqli_stmt_execute($stmt);//执行查询语句
		$result = mysqli_stmt_get_result($stmt);//查询并返回一个结果集
		$row = mysqli_fetch_array($result);//单行数据引入数组
		if($schoolnum==$row['schoolnum']&&$pw==$row['password']){
			if($row['flag']=='TRUE'){
				echo "<script>location='../views/tip.php';</script>";
			}
			else{
				echo "<script>location='../views/signUp.html';</script>";
			}
		}	
		else{	
			echo "<script>alert('学号或密码不正确');location='../views/login.html';</script>";
			exit();
		}
	}
	else{
		echo "<script>alert('连接数据库失败');</script>".mysqli_connect_error();
		exit();
	}
 ?>