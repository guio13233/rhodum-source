<link type="text/css" rel="stylesheet" href="/core/html/css/themes/united.css"/>
<link type="text/css" rel="stylesheet" href="/core/html/css/global.css?v=6"/>
<link type="text/css" rel="stylesheet" href="/core/html/css/font-awesome.min.css"/>
<link rel="apple-touch-icon" sizes="57x57" href="/html/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/html/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/html/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/html/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/html/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/html/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/html/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/html/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/html/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/html/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/html/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/html/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/html/favicon/favicon-16x16.png">
<link rel="manifest" href="/html/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/html/favicon/ms-icon-144x144.png">
<link rel="icon" href="/html/favicon/favicon.ico">
<script src="/core/html/js/jquery-3.1.0.min.js"></script>
<script src="/core/html/js/gibberish-aes-1.0.0.min.js"></script>
<script src="/core/html/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/fe2bf6e013.js" crossorigin="anonymous"></script>
<meta name="csrf-token" content="<?php echo $GLOBALS['csrf_token'];?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="description" content="Rhodum! Socialize with friends, play games and customize your character. Create an account for free and explore the older versions of an amazing game">
<meta name="keywords" content="Old Roblox, Rhodum, Socialize, Games, Forum, Character customisation">
<meta name="author" content="Rhodum">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-KTKQHE3092"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-KTKQHE3092');
</script>
<?php
	if ($GLOBALS['loggedIn'] && $GLOBALS['userTable']['themeChoice'] == 1) echo '<link type="text/css" rel="stylesheet" href="/core/html/css/blackstyle.css?v=9'.time().'"/>';
	if ($GLOBALS['loggedIn'] && $GLOBALS['userTable']['themeChoice'] == 0) echo '<link type="text/css" rel="stylesheet" href="/core/html/css/style.css?v28="/>';
	
	if (!$GLOBALS['loggedIn']) echo '<link type="text/css" rel="stylesheet" href="/core/html/css/style.css?v=28"/>';
?>