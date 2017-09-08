<?php 
	header("Content-Type:text/html;charset=utf-8;");
	$link = mysqli_connect('localhost','root','linyuchen','castuser');//连接数据库库
	mysqli_set_charset($link,'utf-8');//设定字符集
	$sql = "CREATE TABLE stulist(
			num INT(6) NOT NULL AUTO_INCREMENT  ,
			schoolnum VARCHAR(8) NOT NULL ,
			password VARCHAR(100) NOT NULL,
			name VARCHAR(10) NOT NULL,
			tel VARCHAR(20) NOT NULL,
			sel1 VARCHAR(5) NOT NULL,
			sel2 VARCHAR(5) NOT NULL,
			PRIMARY KEY(num,schoolnum)
			)ENGINE=InnoDB DEFAULT CHARSET=utf8;";//schoolnum为主键
	if (mysqli_query($link,$sql)) {
		echo "创建stulist表成功!";
	}
	else{
		echo "创建失败!".mysqli_error($link);
	}
	mysqli_close($link);//断开连接
 ?>