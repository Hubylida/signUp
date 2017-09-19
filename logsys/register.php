<?php 
	session_start();
	header("Content-Type:text/html;charset=utf-8;");
	$link = mysqli_connect('localhost','root','linyuchen','castuser');//连接数据库库
	mysqli_set_charset($link,'utf-8');//设定字符集

    if ($link)/*判断是否连接成功*/{
        $schoolnum = $_POST['schoolnum'];
        $pw = $_POST['pw'];
        $pw_2 = $_POST['pw_2'];
        if (strtoupper($_POST['checkinput'])==$_SESSION['checkinput']) {
            if ($_POST['pw']!='da39a3ee5e6b4b0d3255bfef95601890afd80709') {
                if($pw==$pw_2){
                    $search = "SELECT * FROM `stulist` WHERE schoolnum=?";//判断学号是否存在
                    $stmt1 = mysqli_prepare($link,$search);
                    mysqli_stmt_bind_param($stmt1,'s',$schoolnum);//绑定参数
                    mysqli_stmt_execute($stmt1);//执行查询语句
                    $result1 = mysqli_stmt_get_result($stmt1);//查询并返回一个结果集
                    $row = mysqli_fetch_array($result1);//单行数据引入数组
                    if($schoolnum==$row['schoolnum']){
                        echo "<script>alert('学号已存在,请重新注册或登录');location='../views/register.html';</script>"; 
                    }
                    else{
                        $sql = "INSERT INTO stulist(schoolnum,password) VALUES (?,?)" ;//创建sql语句模板
                        $stmt = mysqli_prepare($link,$sql);
                        mysqli_stmt_bind_param($stmt,'ss',$schoolnum,$pw);//绑定参数
                        $result = mysqli_stmt_execute($stmt);
                        if ($result!=FALSE){
                        echo "<script>alert('注册成功');location='../views/login.html';</script>";
                        mysqli_close();
                        exit();
                        }
                    }
                }
                else{
                    echo "<script>alert('两次输入密码不一致');location='../views/register.html'</script>";
                    exit();
                }
            }
            else{
                echo "<script>alert('请输入密码');location='../views/register.html'</script>";
            }   
        }
        else{
            echo "<script>alert('验证码有误');location='../views/register.html'</script>";
        }
    }
    else{
        echo "<script>连接失败</script>".mysqli_connect_error();
        exit();
    }
    
 ?>