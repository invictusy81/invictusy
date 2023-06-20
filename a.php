<?php

include $_SERVER['DOCUMENT_ROOT'] . '/lib.php';

$time = time();

$today = date("Y-m-d");

$dayFirstTime = strtotime(date("Y-m-d") . ' 00:00:00');



$my_day = $today;

$nextday = date('Y-m-d', strtotime('+1 day', strtotime($today)));



$tmp = explode('-', $today);

$ftime = mktime(0, 0, 0, $tmp[1], $tmp[2], $tmp[0]);



$spend_time = $time - $dayFirstTime;

//1분 2분 3분 파워볼

$orderNo = floor($spend_time / 180)+1;



$n_today = mktime( 0,0,0, date('m'),date('d'), date('Y') );

$n_time = time() ;

$n_past_time = $n_time - $n_today ;

$remainTime = 180 - ($n_past_time % 180 );



$fieldKeyNameArr1["resOE"] = array('O'=>'홀','E'=>'짝');

$fieldKeyNameArr1["resLR"] = array('L'=>'좌','R'=>'우');

$fieldKeyNameArr1["classOE"] = array('O'=>'odd-circle','E'=>'even-circle');

$fieldKeyNameArr1["class34"] = array('3'=>'three-circle','4'=>'four-circle');

$fieldKeyNameArr1["classLR"] = array('L'=>'left-circle','R'=>'right-circle');



$res = $DB->query("select * from dari3Results where orderNo!='".($orderNo)."' order by createdDate desc,orderNo desc limit 0,480");



$resLR=0;

$res34=0;

$resOE=0;

$resL4O=0;

$resR3O=0;

$resL3E=0;

$resR4E=0;

?>

<html lang="ko"><head>

<meta charset="utf-8">

<!-- <META NAME="ROBOTS" CONTENT="NOINDEX"> -->

<link rel="shortcut icon" type="image/x-icon" href="https://boscore.com/img/favicon.ico">

<!--=안드로이드=-->

<!-- <link href='/img/icon192x192.png' rel='icon' type='image/png' />

<link href='/img/icon192x192.png' rel='shortcut icon' type='image/png' /> -->

<!--=아이폰=-->

<!-- <link href='/img/icon128x128.png' rel='apple-touch-icon'  type='image/png'/> -->

<link href="//cdn.jsdelivr.net/font-nanumlight/1.0/NanumBarunGothicWeb.woff" as="font" crossorigin="anonymous">

<!--<link rel="preload" href="/font/NanumBarunGothic.woff" as="font" crossorigin="anonymous" />-->

<meta name="viewport" content="width=1300">

<meta http-equiv="imagetoolbar" content="no">

<meta http-equiv="X-UA-Compatible" content="IE=Edge">

<meta name="title" content="보스코어 - SPORTS COMMUNITY">

<meta name="publisher" content="보스코어 - SPORTS COMMUNITY">

<meta name="author" content="보스코어 - SPORTS COMMUNITY">

<meta name="robots" content="index,follow">

<meta name="keywords" content="보스코어 - SPORTS COMMUNITY">

<meta name="description" content="보스코어 - SPORTS COMMUNITY">

<meta name="twitter:card" content="summary_large_image">

<meta property="og:title" content="보스코어 - SPORTS COMMUNITY">

<meta property="og:site_name" content="보스코어 - SPORTS COMMUNITY">

<meta property="og:author" content="보스코어 - SPORTS COMMUNITY">

<meta property="og:type" content="">

<meta property="og:image" content="http://boscore.com/data/apms/background/KakaoTalk_20180312_170948972.png">

<meta property="og:description" content="보스코어 - SPORTS COMMUNITY">

<meta property="og:url" content="boscore.com/ladder/ls480_1.php?ep=1">

<link rel="image_src" href="http://boscore.com/data/apms/background/KakaoTalk_20180312_170948972.png">

<link rel="canonical" href="boscore.com/ladder/ls480_1.php?ep=1">

<title>보스코어 - SPORTS COMMUNITY</title>

<link rel="stylesheet" href="/css/default.css">

<link rel="stylesheet" href="/css/apms.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="/css/level/basic.css">



<link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i,900,900i&amp;display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:400,500,700&amp;display=swap" rel="stylesheet">

<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css">

<script src="/js/jquery-1.11.3.min.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script> 



<script type="text/javascript" src="/js/d3.min.js"></script>

<link rel="stylesheet" href="ladder_stats.css?v=<?=time()?>">

<link rel="stylesheet" href="/css/ladder.css">



<ul class="ladder-top-tab">

	<li><a href="dari3A.php" class="active">최근분석</a></li>

	<li><a href="dari3B_1.php">일별분석</a></li>

	<li><a href="dari3C_1.php">회차분석</a></li>

</ul>

<style>

	*{

		box-sizing:border-box;

	}

	dd{

		margin:0;

	}

	</style>

<div class="game-timer-info">

	별다리 3분 <span class="round" ><?=$orderNo?></span>회차 <strong class="remain-time" id="timer_time">0분 59초</strong>후 추첨시작

	<div id="timer_bar" class="game-timer-bar" style="width: 11.67%;"></div>

</div>

<div class="summary-data" style="margin-top:5px">

	<div class="hd"><strong>최근 480 회차</strong> 기준 통계데이터</div>

	<div id="analysis-table" class="bd">

		<div class="bar-graph">

		<div class="bar">

			<p class="left" style="width:48.12%;" id="resLP">

				<span class="per" id="resLR"><strong>231</strong> (48.12%)</span>

				<span class="tx">좌</span>

			</p>

			<p class="right" style="width:51.88%;" id="resRP">

				<span class="per" id="resR"><strong>249</strong> (51.88%)</span>

				<span class="tx">우</span>

			</p>

		</div>

		<div class="bar">

			<p class="left" style="width:47.08%;" id="res3P">

				<span class="per" id="res3"><strong>226</strong> (47.08%)</span>

				<span class="tx">3</span>

			</p>

			<p class="right" style="width:52.92%;" id="res4P">

				<span class="per" id="res4"><strong>254</strong> (52.92%)</span>

				<span class="tx">4</span>

			</p>

		</div>

		<div class="bar">

			<p class="left" style="width:47.29%;" id="resOP">

				<span class="per" id="resO"><strong>227</strong> (47.29%)</span>

				<span class="tx">홀</span>

			</p>

			<p class="right" style="width:52.71%;" id="resEP">

				<span class="per" id="resE"><strong>253</strong> (52.71%)</span>

				<span class="tx">짝</span>

			</p>

		</div>

	</div>

		<div class="pie-graph">

			<div class="graph">

				<svg width="132" height="132">

					<g transform="translate(66, 66)">

						<g class="arc">

							<path d="M4.0413344371862654e-15,-66A66,66 0 0,1 65.85849111955172,-4.319623531736013L0,0Z" fill="#e74c3c"></path>

						</g>

						<g class="arc">

							<path d="M65.85849111955172,-4.319623531736013A66,66 0 0,1 -11.162338194428912,65.04922909637895L0,0Z" fill="#c0392b"></path>

						</g>

						<g class="arc">

							<path d="M-11.162338194428912,65.04922909637895A66,66 0 0,1 -65.90974811070001,-3.450377368357959L0,0Z" fill="#2980b9"></path>

						</g>

						<g class="arc">

							<path d="M-65.90974811070001,-3.450377368357959A66,66 0 0,1 -1.2124003311558795e-14,-66L0,0Z" fill="#3498db"></path>

						</g>

					</g>

				</svg>

			</div>

			<ul class="info">

				<li class="left4odd"><span class="ic"></span>좌4홀 : <span id="resL4O">116</span>회 (<em class="per" id="resL4OP">24.17</em>%)</li>

				<li class="right3odd"><span class="ic"></span>우3홀 : <span id="resR3O">116</span>회 (<em class="per" id="resR3OP">23.13</em>%)</li>

				<li class="left3even"><span class="ic"></span>좌3짝 : <span id="resL3E">116</span>회 (<em class="per" id="resL3EP">43.96</em>%)</li>

				<li class="right4even on"><span class="ic"></span>우4짝 : <span id="resR4E">116</span>회 (<em class="per" id="resR4EP">8.75</em>%)</li>

			</ul>

		</div>

	</div>

</div>

<div class="stats-list-wrap">

	<table class="stats-list">

		<colgroup>

			<col>

			<col width="150px">

			<col width="150px">

			<col width="150px">

			<col width="150px">

		</colgroup>

		<thead>

			<tr>

				<th>날짜/회차</th>

				<th>시간</th>

				<th>시작</th>

				<th>줄수</th>

				<th>결과</th>

			</tr>

		</thead>

		<tbody>

		<?

		$rnt=0;

		while ($row = $DB->fetch_array($res)){

			if($row['resLR']=="L")

			{

				$resLR=$resLR+1;

			}

			if($row['resOE']=="O")

			{

				$resOE=$resOE+1;

			}

			if($row['res34']=="3")

			{

				$res34=$res34+1;

			}

			if($row['resLR']=="L" && $row['res34']=="4" && $row['resOE']=="O")

			{

				$resL4O=$resL4O+1;

			}

			if($row['resLR']=="R" && $row['res34']=="3" && $row['resOE']=="O")

			{

				$resR3O=$resR3O+1;

			}

			if($row['resLR']=="L" && $row['res34']=="3" && $row['resOE']=="E")

			{

				$resL3E=$resL3E+1;

			}

			if($row['resLR']=="R" && $row['res34']=="4" && $row['resOE']=="E")

			{

				$resR4E=$resR4E+1;

			}

			$rnt=$rnt+1;

		?>

		<tr <?if($rnt>15){?> class="tr_hi8" style="display:none;" <?}?>>

			<td><?=$row["gameDay"]?> <strong><?=$row["orderNo"]?></strong></td>

			<td><?=date('H:i',strtotime($row['gameTime']))?></td>

			<td><span class="<?=$fieldKeyNameArr1["classLR"][$row['resLR']]?>"><?=$fieldKeyNameArr1["resLR"][$row['resLR']]?></span></td>

			<td><span class="<?=$fieldKeyNameArr1["class34"][$row['res34']]?>"><?=$row["res34"]?></span></td>

			<td><span class="<?=$fieldKeyNameArr1["classOE"][$row['resOE']]?>"><?=$fieldKeyNameArr1["resOE"][$row['resOE']]?></span></td>

		</tr>

		<?}?>

		</tbody>

	</table>

		<a href="javascript:showmo();"  id="btn_mo_poe" class="bottom-more-btn">데이터 더보기</a>

		<a id="lb_mo_poe" href="#" class="bottom-more-btn" style="display:none;">마지막 데이터입니다.</a>

</div>

<!-- 빌더 1.7.22 / 5.2.9.8 / 5.2.9.8 -->





<script>

var remainTime = <?=$remainTime?>;



var nowTimer = function() {

	remainTime--;

	minutes = (remainTime) / 180;

	mRound = Math.floor(minutes);

	seconds = (remainTime) % 180;

	sRound = Math.round(seconds);



    $("#timer_time").html("0분 "+sRound+"초");

	 $("#timer_bar").css("width",(sRound/180*100)+"%");

	if(remainTime<=0)

	{

		location.reload();

	}



}

setInterval("nowTimer()", 1000);





var ld_mode=1;

var row_count="480";

$(function(){

	$("#refresh-btn").click(function(){location.reload();});

	$("#row-count").change(function(){

		$("#round-form").submit();

	});

	$(".row-count-btn").click(function(){

		var new_row_count=$(this).data('row-count');

		$("#row-count").val(new_row_count);

		$("#round-form").submit();

		return false;

	});

});



function showmo()

{

	$(".tr_hi8").css("display","table-row");

	$("#btn_mo_poe").hide();

	$("#lb_mo_poe").show();

}



$("#res3").html("<strong><?=$res34?></strong> (<?=round($res34/480*100,2)?>%)");

$("#res4").html("<strong><?=480-$res34?></strong> (<?=round(100-$res34/480*100,2)?>%)");

$("#res3P").css("width","<?=round($res34/480*100,2)?>%");

$("#res4P").css("width","<?=round(100-$res34/480*100,2)?>%");

<?if($res34/480*100>50){?>

	$("#res3P").addClass("on");

<?}else{?>

	$("#res4P").addClass("on");

<?}?>



$("#resL").html("<strong><?=$resLR?></strong> (<?=round($resLR/480*100,2)?>%)");

$("#resR").html("<strong><?=480-$resLR?></strong> (<?=round(100-$resLR/480*100,2)?>%)");

$("#resLP").css("width","<?=round($resLR/480*100,2)?>%");

$("#resRP").css("width","<?=round(100-$resLR/480*100,2)?>%");

<?if($resLR/480*100>50){?>

	$("#resLP").addClass("on");

<?}else{?>

	$("#resRP").addClass("on");

<?}?>



$("#resO").html("<strong><?=$resOE?></strong> (<?=round($resOE/480*100,2)?>%)");

$("#resE").html("<strong><?=480-$resOE?></strong> (<?=round(100-$resOE/480*100,2)?>%)");

$("#resOP").css("width","<?=round($resOE/480*100,2)?>%");

$("#resEP").css("width","<?=round(100-$resOE/480*100,2)?>%");

<?if($resOE/480*100>50){?>

	$("#resOP").addClass("on");

<?}else{?>

	$("#resEP").addClass("on");

<?}?>



$("#resL4O").html("<?=$resL4O?>");

$("#resL4OP").html("<?=round($resL4O/480*100,2)?>");



$("#resR3O").html("<?=$resR3O?>");

$("#resR3OP").html("<?=round($resR3O/480*100,2)?>");



$("#resL3E").html("<?=$resL3E?>");

$("#resL3EP").html("<?=round($resL3E/480*100,2)?>");



$("#resR4E").html("<?=$resR4E?>");

$("#resR4EP").html("<?=round($resR4E/480*100,2)?>");



$(".pie-graph .graph").empty();

var DATA=['<?=$resL4O?>','<?=$resR3O?>','<?=$resL3E?>','<?=$resR4E?>'];

var r=66;

var canvas=d3.select(".pie-graph .graph").append("svg").attr("width",132).attr("height",132);

var group=canvas.append("g").attr("transform","translate(66, 66)");

var color=d3.scale.ordinal().range(["#e74c3c","#c0392b","#2980b9","#3498db"]);

var arc=d3.svg.arc().innerRadius(0).outerRadius(r);

var pie=d3.layout.pie().sort(null).value(function(d){return d;});

var arcs=group.selectAll(".arc").data(pie(DATA)).enter().append("g").attr("class","arc");

arcs.append("path").attr("d",arc).attr("fill",function(d,i){return color(i);});



</script>



</body>

</html>
