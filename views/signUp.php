<?php 
    session_start();
    header("Content-type:text/html;charset=utf-8;");
    $link = mysqli_connect('localhost','root','linyuchen','castuser');//连接数据库
    mysqli_set_charset($link,'utf8');
    if ($link) {
        $schoolnum = $_SESSION['schoolnum'];
        $pw = $_SESSION['pw'];
        $sql = "SELECT `name`,`tel`,`sel1`,`sel2`,`schoolnum`,`password` FROM `stulist` WHERE schoolnum='$schoolnum' and password='$pw' ";
        $result = mysqli_query($link,$sql);//执行查询语句
        $row = mysqli_fetch_array($result);
        
    }
    else{
        echo "<script>alert('连接数据库失败');location='../index.html';</script>";
    }
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="http://ou2r9nim8.bkt.clouddn.com/bitbug_favicon%20%281%29.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/index.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <script src="../lib/sha1.js"></script>
    <title>网上报名</title>
</head>

<body>
    <div class="main">

        <div class="head">
            <a href="login.html" id="back"><img src="../img/back.png" alt=""></a>
            <span id="main_title">通院科协在线报名</span>
        </div>

        <form action="../logsys/signUp.php" id="signUp" method="post">
            <label>姓名:<input type="text" 
                name="name" 
                id="name" 
                <?php echo 'value="'.$row['name'].'"'; ?>
                autocomplete="off"
                data-rule="minlength:2%maxlength:8">
                <div id="name-input-error" class="input-error">姓名输入有误</div>
            </label>
            <label>手机:<input type="text" 
                name="tel" 
                id="phoneNum" 
                autocomplete="off"
                <?php echo 'value="'.$row['tel'].'"'; ?>
                data-rule="pattern:^1[3|4|5|7|8][0-9]\d{8}$%minlength:11%maxlength:11">
                <div id="tel-input-error" class="input-error">手机号格式有误</div>
            </label>
            <label>部门一:
                    <select name="sel1" id="select_1">
                        <?php
                            $selected1=$selected2=$selected3=$selected4=""; 
                            switch ($row['sel1']) {
                                case '计算机部':
                                    $selected1='selected';
                                    break;
                                case '电子部':
                                    $selected2='selected';
                                    break;
                                case '办公室':
                                    $selected3='selected';
                                    break;
                                case '赛事部':
                                    $selected4='selected';
                                    break;
                            }
                         ?>
                        <option value="计算机部" class="option_1" <?php echo $selected1; ?>>计算机部</option>
                        <option value="电子部" class="option_1" <?php echo $selected2; ?>>电子部</option>
                        <option value="办公室" class="option_1" <?php echo $selected3; ?>>办公室</option>
                        <option value="赛事部" class="option_1" <?php echo $selected4; ?>>赛事部</option>
                    </select>
            </label>
            <label>部门二:
                    <select name="sel2" id="select_2">
                        <?php
                            $selected1=$selected2=$selected3=$selected4=""; 
                            switch ($row['sel2']) {
                                case '计算机部':
                                    $selected1='selected';
                                    break;
                                case '电子部':
                                    $selected2='selected';
                                    break;
                                case '办公室':
                                    $selected3='selected';
                                    break;
                                case '赛事部':
                                    $selected4='selected';
                                    break;
                            }
                         ?>
                        <option value="计算机部" class="option_2" <?php echo $selected1; ?>>计算机部</option>
                        <option value="电子部" class="option_2" <?php echo $selected2; ?>>电子部</option>
                        <option value="办公室" class="option_2" <?php echo $selected3; ?>>办公室</option>
                        <option value="赛事部" class="option_2" <?php echo $selected4; ?>>赛事部</option>
                    </select>
                    
            </label>
            <div class="submit-wrap"><input type="submit" value="提交" id="submit"></div>
        </form>
        <div class="footer">@通院科协</div>
    </div>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/validator.js"></script>
    <script src="../js/input.js"></script>
    <script src="../js/main.js"></script>
    <script>
        window.onload = function () {
            var name = document.querySelector('name');
            var select_1 = document.querySelector('#select_1'),
                select_2 = document.querySelector('#select_2'),
                input_error = document.querySelectorAll('.input-error')
            var signUp = document.getElementById('signUp');

            function selectChange(select_1, select_2) {
                var value = select_1.value;
                var nodes = select_2.childNodes;
                var l = nodes.length;
                for (var i = 1; i < l; i = i + 2) {
                    if (value === nodes[i].value) {
                        nodes[i].style.display = "none";
                    } else {
                        nodes[i].style.display = "block";
                    }
                }
            }

            function testError() {
                for (var i = 0; i < input_error.length; i++) {
                    if (input_error[i].style.display === 'block') {
                        return false;
                    }
                }
                return true;
            }
            select_1.onchange = function () {
                selectChange(select_1, select_2);
            }
            select_2.onchange = function () {
                selectChange(select_2, select_1);
            }
        }
    </script>
</body>

</html>
