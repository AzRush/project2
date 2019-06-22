<?php
include 'php/database_connect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title>display</title>

	<link href="display/style.css" rel="stylesheet" type="text/css">

</head>
<body>

<div class="play" id="play">
	<a href="javascript:" id="next">&gt;&gt;<div class="nextImg"><img width="80" height="54" src="display/2.jpg"></div></a>
	<a href="javascript:" id="prev">&lt;&lt;<div class="prevImg"><img width="80" height="54" src="display/3.jpg"></div></a>
	<ol></ol>
	<ul style="width: 2100px; left: 0px;">
		<li><a href="details.php"><img src="display/1.jpg" alt="1"></a></li>
		<li><a href="details.php"><img src="display/2.jpg" alt="2"></a></li>
		<li><a href="details.php"><img src="display/3.jpg" alt="3"></a></li>
	</ul>
</div>

<script type="text/javascript" src="display/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
$(function(){
	var oDiv = $("#play");  //外部盒子
	var count = $("#play ul li").length;  //内部图片数量
	var countwidth = $("#play ul li").width();  //图片边框宽度
	var oUl = $("#play ul").css("width",count*countwidth);  //ul li总宽度
	var now = 0;
	var next = $("#next");
	var prev = $("#prev");
	//点击按钮数量
	for(var i = 0; i < count; i++){
		$("#play ol").append("<li>" + Number(i+1) + "</li>");
		$("#play ol li:first").addClass("active");
	}
	//左右点击图片获取
	var nI = $("#play ul li:nth-child(2)").find("img").attr("src");
	$(".nextImg img").attr("src",nI);
	var pI = $("#play ul li:last-child").find("img").attr("src");
	$(".prevImg img").attr("src",pI);
	//按钮点击事件
	var aBtn = $("#play ol li");
	aBtn.each(function(index){
		$(this).click(function(){
			clearInterval(timer);
			tab(index);
			nextImg();
			prevImg();
			timer=setInterval(autoRun,5000);
		});
	});
	//图片循环事件
	function tab(index){
		now = index;
		aBtn.removeClass("active");
		aBtn.eq(index).addClass("active");
		oUl.stop(true,false).animate({"left":-countwidth * now},800);
	}
	//下一张按钮图片切换
	function nextImg(){
		var d = $("#play ul li").find("img").eq(now+1).attr("src");
		var nI = $("#play ul li:nth-child(1)").find("img").attr("src");
		$(".nextImg").find("img").attr("src",d);
		if(now==count-1){
			$(".nextImg").find("img").attr("src",nI);
		}
	}
	//上一张图片按钮切换
	function prevImg(){
		var f = $("#play ul li").find("img").eq(now-1).attr("src");
		$(".prevImg").find("img").attr("src",f);
	}
	
	//下一张点击事件
	next.click(function(){
		clearInterval(timer);
		now++;
		if(now==count){
			now=0;
		}
		tab(now);
		nextImg();
		prevImg();
		timer=setInterval(autoRun, 5000);
	});
	//上一张点击事件
	prev.click(function(){
		clearInterval(timer);
		now--;
		if(now==-1){
			now=count-1;
		}
		tab(now);
		nextImg();
		prevImg();
		timer=setInterval(autoRun, 5000);
	});
	//自动轮播定义
	function autoRun(){
		now++;
		if(now==count){
			now=0;
		}
		tab(now);
		nextImg();
		prevImg();
	};
	var timer=setInterval(autoRun, 5000);
});
</script>
</body>
</html>