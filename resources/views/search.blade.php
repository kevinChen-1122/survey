<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel='icon' href="/images/favicon.ico" mce_href='/favicon.ico' type='image/x-icon'>
	<link rel="stylesheet" href="css/fontawesome.min.css">
	<link rel="stylesheet" href="css/regular.min.css">
	<link rel="stylesheet" href="css/solid.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<title>金沙赌场-查询QQ专用资料</title>
</head>
<style>
	.popup {
		display: none;
		width: 100%;
		height: 100%;
		background: rgba(0,0,0,0.6);
		position: fixed;
		top: 0;
		left: 0;
		z-index: 99999;
	}
	.popup .popup_content {
		width: 530px;
		position: absolute;
		top: 45%;
		left: 50%;
		-moz-transform: translate(-50%, -50%);
		-ms-transform: translate(-50%, -50%);
		-webkit-transform: translate(-50%, -50%);
		transform: translate(-50%, -50%);
		background: #fff;
		border: 1px solid #ccc;
		padding: 30px 0 40px 0;
	}
	.popup .popup_content .popup_close {
		display: block;
		width: 40px;
		height: 40px;
		text-indent: 100%;
		white-space: nowrap;
		overflow: hidden;
		position: absolute;
		top: -20px;
		right: -20px;
		z-index: 2;
		background: #179146;
		border-radius: 99em;
	}
	.popup .popup_content form {
		position: relative;
		width: 330px;
		margin: auto;
	}
	.popup .popup_content .popup_close::before {
		content: "";
		width: 28px;
		height: 4px;
		background: #fff;
		position: absolute;
		top: 50%;
		left: 50%;
		-moz-transform: rotate(45deg) translate(-50%, -50%);
		-ms-transform: rotate(45deg) translate(-50%, -50%);
		-webkit-transform: rotate(45deg) translate(-50%, -50%);
		transform: rotate(45deg) translate(-50%, -50%);
		-moz-transform-origin: left top;
		-ms-transform-origin: left top;
		-webkit-transform-origin: left top;
		transform-origin: left top;
	}
	.popup .popup_content .popup_close::after {
		content: "";
		width: 28px;
		height: 4px;
		background: #fff;
		position: absolute;
		top: 50%;
		left: 50%;
		-moz-transform: rotate(-45deg) translate(-50%, -50%);
		-ms-transform: rotate(-45deg) translate(-50%, -50%);
		-webkit-transform: rotate(-45deg) translate(-50%, -50%);
		transform: rotate(-45deg) translate(-50%, -50%);
		-moz-transform-origin: left top;
		-ms-transform-origin: left top;
		-webkit-transform-origin: left top;
		transform-origin: left top;
	}
	.popup .popup_content p {
		text-align: center;
		font-size: 20px;
		line-height: 40px;
		font-weight: bold;
		color: #0f7536;
		padding: 0 0 20px 0;
	}
	.popup .popup_content form input {
		display: block;
		width: 100%;
		font-size: 15px;
		line-height: 38px;
		color: #000;
		font-family: "Microsoft YaHei";
		border-radius: 6px;
		border: 1px solid #179146;
		box-sizing: border-box;
		padding: 0 10px;
		margin: 0 0 20px 0;
	}
	.popup .popup_content form .send_btn {
		display: inline-block;
		width: 100%;
		float: left;
		background: #179146;
		font-size: 16px;
		line-height: 38px;
		color: #fde476;
		font-weight: bold;
		border-radius: 6px;
		cursor: pointer;
		text-align: center;
	}
</style>
<body>

	<div class="wrap">
		<div class="main">
			<div class="content">
				<h1>查询QQ专用资料</h1>
				<form id="survey" action="">
					<div class="item">
						<label for="userid">会员账号</label>
						<input type="text" name="userid" id="userid" value="" placeholder="必填" >
					</div>
					<div id="qq_div" style="display:none;">
					</div>
					<div id="creat_at_div" style="display:none;">
						<div class="item">
							<label for="creat_at">注册日期</label>
							<input type="text" name="creat_at" id="creat_at" value="" placeholder="必填">
						</div>
					</div>
					<div class="btns">
						<button type="button" id="login_btn" class="send_btn" onclick="showLoginPop()">@if($member)登出@else登录@endif</button>
						<button type="button" id="check_btn" class="check_btn <?php if(!$member){echo'notwork';} ?>" onclick="search()">查询</button>
					</div>
				</form>

			</div>

		</div><!-- main END -->
	</div><!-- wrap END -->
	
	<!-- login page start -->
	<div class="login_pop popup" id="login">
		<div class="popup_content">
			<a class="popup_close" href="javascript:void(0)" onclick="closeLoginPop()">关闭</a>
			<p>登录查询账号</p>
			<form name="login_form" class="ng-pristine ng-valid">
				<input id="checkLogin" name="username" type="text" placeholder="填写会员账号">
				<a class="send_btn" href="javascript:void(0)" onclick="clickLogin()">立即登录</a>
			</form>
		</div>
	</div>
	<!-- login page end -->


	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript">

		//開啟登入彈窗
		//登出
		function showLoginPop(){
			var status = document.getElementById("login_btn").textContent;
			
			if(status =='登出'){
				if (confirm("是否登出 ?")) {
					$.ajax({
						type: 'get',
						url: '/logout',
						success: function(res){
							if (res.error == -1) {
								alert("登出成功.");
								document.getElementById("login_btn").textContent='登录';
								document.getElementById('userid').value = '';
								document.getElementById("check_btn").classList.add("notwork");
								document.getElementById('qq_div').style.display = 'none';
								document.getElementById('creat_at_div').style.display = 'none';
								// 會員已登入
							} else if (res.msg) {
								alert(res.msg);
							} else {
								alert("发生未知的错误.");
								location.reload();
							}
						},
					});
				}
				return;
			}else{
				document.getElementById('login').style.display = 'block';
			}
		}
		function search(){
			
			//check search btn can work
			var status = document.getElementById("check_btn").classList.contains('notwork');
			if(!status){
				var username = document.getElementById('userid').value;
				var checkIsnull = isNull(username);
				if(!checkIsnull){
					$.ajax({
						type: 'get',
						url: '/search',
						dataType: 'json',
						data: { username },
						success: function(res){
							if (res.error == -1) {
								var tag = document.getElementById('qq_div');
								tag.innerHTML = "";
								res.data.qqnumber.forEach(function(element) {
									var div = document.createElement("div");
									div.setAttribute("class", "item");
									var label = document.createElement("label");
									label.textContent = 'QQ号码';
									var input = document.createElement("input");
									input.setAttribute ("type", "text");
									input.setAttribute ("placeholder", "必填");
									input.value = element.qq_number;
									div.appendChild(label);
									div.appendChild(input);
									tag.appendChild(div);
								});
								document.getElementById('creat_at').value = res.data.registration_date;
								
								document.getElementById('qq_div').style.display = 'block';
								document.getElementById('creat_at_div').style.display = 'block';
							} else if (res.error == 103) {
								alert("您未登入, 页面将重新整理.");
								location.reload();
							} else if (res.msg) {
								alert(res.msg);
							} else {
								alert("发生未知的错误.");
								location.reload();
							}
						},
					});
				}else{
					alert('请输入要查询帐号');
				}
			}
		}
		//關閉登入彈窗
		function closeLoginPop(){
			document.getElementById('login').style.display = 'none';
		}
		
		//查詢登入
		function clickLogin(){
			var username = document.getElementById('checkLogin').value;
			var checkIsnull = isNull(username);
			if(!checkIsnull){
				$.ajax({
					type: 'get',
					url: '/login',
					dataType: 'json',
					data: { username },
					success: function(res){
						if (res.error == -1) {
							alert("登录成功.");
							document.getElementById("login_btn").textContent='登出';
							document.getElementById('login').style.display = 'none';
							document.getElementById("check_btn").classList.remove("notwork");
							// 會員已登入
						} else if (res.error == 100) {
							alert("您已经登入, 页面将重新整理.");
							location.reload();
						} else if (res.msg) {
							alert(res.msg);
						} else {
							alert("发生未知的错误.");
							location.reload();
						}
					},
				});
			}else{
				alert('查询账号不能为空');
			}
		}
		
		function isNull( str ){
			if ( str == "" ) return true;
			var regu = "^[ ]+$";
			var re = new RegExp(regu);
			return re.test(str);
		}
		
		$(function() {
			var ajax_sent = false;
		
			{{-- Laravel - CSRF Protection --}}
			$.ajaxSetup({
				headers: {
					"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
				},
				beforeSend: function() {
					ajax_sent = true;
				},
				error: function(jqXHR) {
					if (jqXHR.status == '419') {
						if (confirm("Session 已失效，请重新整理页面.")) {
							location.reload();
						}
					}
				},
				complete: function(jqXHR, textStatus) {
					ajax_sent = false;
				}
			});
		});
	</script>
</body>
</html>