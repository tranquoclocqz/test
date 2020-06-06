<HTML>
<HEAD>
	<TITLE>:: Thông Báo ::</TITLE>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="REFRESH" content="3; url=<?=$page_transfer?>">
	<meta name="robots" content="noodp,noindex,nofollow" />
</HEAD>
<BODY>
	<div id="alert">
		<div style="display: block;margin:0px auto;text-align: center">
			<div id="spinningSquaresG">
	<div id="spinningSquaresG_1" class="spinningSquaresG"></div>
	<div id="spinningSquaresG_2" class="spinningSquaresG"></div>
	<div id="spinningSquaresG_3" class="spinningSquaresG"></div>
	<div id="spinningSquaresG_4" class="spinningSquaresG"></div>
	<div id="spinningSquaresG_5" class="spinningSquaresG"></div>
	<div id="spinningSquaresG_6" class="spinningSquaresG"></div>
	<div id="spinningSquaresG_7" class="spinningSquaresG"></div>
	<div id="spinningSquaresG_8" class="spinningSquaresG"></div>
</div>
		</div>
		<div class="title">Thông báo</div>
		<div class="message"><?=$showtext?></div>
		<div class="rlink" style="font-size: 18px;">(<a href="<?=$page_transfer?>"  style=" color: #015364; text-decoration: none;">Click vào đây nếu không muốn đợi lâu</a>)</div>
	</div>
</BODY>
</HTML>
<style>
body{
	background:#eee
}
#alert{
	background:#fff;
	padding:40px;
	margin:30px auto;
	border-radius:3px;
	-webkit-box-shadow: 0px 0px 3px 0px rgba(50, 50, 50, 0.3);
	-moz-box-shadow:    0px 0px 3px 0px rgba(50, 50, 50, 0.3);
	box-shadow:         0px 0px 3px 0px rgba(50, 50, 50, 0.3);	
	width:350px;
	margin-top: 100px;
	text-align:center;

}
#alert .message{
	color: #FF0000
}
#alert .rlink{    
	font-size: 14px;
	margin-top: 10px;
	border-top: 1px solid #ccc;
	padding-top: 10px;  
}
#alert .title{    
	text-transform: uppercase;
	font-weight: bold;
	margin: 10px;
}

#spinningSquaresG{
	position:relative;
	width:234px;
	height:28px;
	margin:auto;
}

.spinningSquaresG{
	position:absolute;
	top:0;
	background-color:rgb(0,0,0);
	width:28px;
	height:28px;
	animation-name:bounce_spinningSquaresG;
		-o-animation-name:bounce_spinningSquaresG;
		-ms-animation-name:bounce_spinningSquaresG;
		-webkit-animation-name:bounce_spinningSquaresG;
		-moz-animation-name:bounce_spinningSquaresG;
	animation-duration:1.5s;
		-o-animation-duration:1.5s;
		-ms-animation-duration:1.5s;
		-webkit-animation-duration:1.5s;
		-moz-animation-duration:1.5s;
	animation-iteration-count:infinite;
		-o-animation-iteration-count:infinite;
		-ms-animation-iteration-count:infinite;
		-webkit-animation-iteration-count:infinite;
		-moz-animation-iteration-count:infinite;
	animation-direction:normal;
		-o-animation-direction:normal;
		-ms-animation-direction:normal;
		-webkit-animation-direction:normal;
		-moz-animation-direction:normal;
	transform:scale(.3);
		-o-transform:scale(.3);
		-ms-transform:scale(.3);
		-webkit-transform:scale(.3);
		-moz-transform:scale(.3);
}

#spinningSquaresG_1{
	left:0;
	animation-delay:0.6s;
		-o-animation-delay:0.6s;
		-ms-animation-delay:0.6s;
		-webkit-animation-delay:0.6s;
		-moz-animation-delay:0.6s;
}

#spinningSquaresG_2{
	left:29px;
	animation-delay:0.75s;
		-o-animation-delay:0.75s;
		-ms-animation-delay:0.75s;
		-webkit-animation-delay:0.75s;
		-moz-animation-delay:0.75s;
}

#spinningSquaresG_3{
	left:58px;
	animation-delay:0.9s;
		-o-animation-delay:0.9s;
		-ms-animation-delay:0.9s;
		-webkit-animation-delay:0.9s;
		-moz-animation-delay:0.9s;
}

#spinningSquaresG_4{
	left:88px;
	animation-delay:1.05s;
		-o-animation-delay:1.05s;
		-ms-animation-delay:1.05s;
		-webkit-animation-delay:1.05s;
		-moz-animation-delay:1.05s;
}

#spinningSquaresG_5{
	left:117px;
	animation-delay:1.2s;
		-o-animation-delay:1.2s;
		-ms-animation-delay:1.2s;
		-webkit-animation-delay:1.2s;
		-moz-animation-delay:1.2s;
}

#spinningSquaresG_6{
	left:146px;
	animation-delay:1.35s;
		-o-animation-delay:1.35s;
		-ms-animation-delay:1.35s;
		-webkit-animation-delay:1.35s;
		-moz-animation-delay:1.35s;
}

#spinningSquaresG_7{
	left:175px;
	animation-delay:1.5s;
		-o-animation-delay:1.5s;
		-ms-animation-delay:1.5s;
		-webkit-animation-delay:1.5s;
		-moz-animation-delay:1.5s;
}

#spinningSquaresG_8{
	left:205px;
	animation-delay:1.64s;
		-o-animation-delay:1.64s;
		-ms-animation-delay:1.64s;
		-webkit-animation-delay:1.64s;
		-moz-animation-delay:1.64s;
}



@keyframes bounce_spinningSquaresG{
	0%{
		transform:scale(1);
		background-color:rgb(0,0,0);
	}

	100%{
		transform:scale(.3) rotate(90deg);
		background-color:rgb(255,255,255);
	}
}

@-o-keyframes bounce_spinningSquaresG{
	0%{
		-o-transform:scale(1);
		background-color:rgb(0,0,0);
	}

	100%{
		-o-transform:scale(.3) rotate(90deg);
		background-color:rgb(255,255,255);
	}
}

@-ms-keyframes bounce_spinningSquaresG{
	0%{
		-ms-transform:scale(1);
		background-color:rgb(0,0,0);
	}

	100%{
		-ms-transform:scale(.3) rotate(90deg);
		background-color:rgb(255,255,255);
	}
}

@-webkit-keyframes bounce_spinningSquaresG{
	0%{
		-webkit-transform:scale(1);
		background-color:rgb(0,0,0);
	}

	100%{
		-webkit-transform:scale(.3) rotate(90deg);
		background-color:rgb(255,255,255);
	}
}

@-moz-keyframes bounce_spinningSquaresG{
	0%{
		-moz-transform:scale(1);
		background-color:rgb(0,0,0);
	}

	100%{
		-moz-transform:scale(.3) rotate(90deg);
		background-color:rgb(255,255,255);
	}
}
</style>