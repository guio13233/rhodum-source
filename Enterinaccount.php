<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/includes.php';
	if ($GLOBALS['loggedIn']) {
		header("Location: /user/dashboard");
		exit;
	}
?>
<!DOCTYPE html>
<html>
	<head>
        <script data-ad-client="ca-pub-3105696169953509" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<title><?php echo config::getName();?></title>
		<?php html::buildHead();?>
        <style>
        h1 {
            text-shadow: 1px 1px #000000;
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }

        h2 {text-align: center;}
        </style>
	</head>
	<body style="margin:0;background-color:#EEEEEE">
		<?php html::getNavigation();?>
		<div class="container">
    <div class="container-fluid">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">   
				<div class="col-xs-12 col-sm-12 col-md-10">
					<script src="/core/func/js/auth/loginv2.js?v=29"></script>
                    <img src="/core/html/img/newfinoob.png" alt="Rhodum" class="center">
					<h2>Login</h2>
					<div id="rStatus"></div>
					<input class="form-control" type="text" id="rUsername" placeholder="Username"></input>
					<input class="form-control" type="password" id="rPassword1" placeholder="Password"></input>
                    <p> <p>
					<button class="btn btn-primary fullWidth" id="rSubmit" style="color:white">Login</button>
                    <p> <p>
                    <button class="btn btn-primary fullWidth btn-success" id="lForgot" style="color:white">Forgot Password</button>
				</div>
			</div>
        </div>                     
    </div> 
		</div>
	</body>
</html>