<?php

$ua = $_SERVER['HTTP_USER_AGENT'];

// スマホのアクセス
if ((strpos($ua, 'Android') !== false) &&
	(strpos($ua, 'Mobile') !== false) ||
	(strpos($ua, 'iPhone') !== false) ||
	(strpos($ua, 'Windows Phone') !== false))
{
	include("login_mb.php");
// PCへのアクセス
} else {
	include("index.html");
}
?>