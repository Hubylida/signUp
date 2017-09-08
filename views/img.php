<?php
	session_start();
	header("Content-Type:image/png");//图片格式png
	$image=imagecreatetruecolor(100,32);//创建一个真彩色图片
	$imgcolor=imagecolorallocate($image,255,255,255);//图片填充颜色
	imagefill($image,0,0,$imgcolor);//图片区域填充
	$code="";
	for ($i=0; $i <4 ; $i++) { 
		$font=5;//字体
		$fontcolor=imagecolorallocate($image, rand(0,120),rand(0,120),rand(0,120));//字体颜色
		$content='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$fontcontent=substr($content,rand(0,strlen($content)),1);//内容
		$code.="$fontcontent";
		$x=($i*100/4)+rand(7,9);//位置
		$y=rand(20,26);
		imagettftext($image,17,rand(-30,30),$x,$y,$fontcolor,'font.ttf',$fontcontent);//$x,$y从字符左下角开始

	}//数字
	
	$_SESSION['checkinput']=$code;//将验证码存入对话中
	for ($i=0; $i < 300 ;$i++) { 
		$pointcolor=imagecolorallocate($image,rand(50,200),rand(500,200),rand(50,200));//干扰点颜色
		imagesetpixel($image,rand(1,99),rand(1,32), $pointcolor);//画一个干扰点
	}//干扰点
	for ($i=0; $i <12; $i++) { 
		$linecolor=imagecolorallocate($image,rand(50,200),rand(50,200),rand(50,200));
		imageline($image,rand(1,99), rand(1,32), rand(1,99), rand(1,32), $linecolor);
	}
	imagepng($image); //以png格式输出图片
	imagedestroy($image);//销毁图片
?>