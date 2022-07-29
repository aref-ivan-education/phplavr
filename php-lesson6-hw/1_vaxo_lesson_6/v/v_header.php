<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta charset='UTF-8'>
		<title><?=$page_title?></title>
	</head>
	<body>
		<? if ($is_auth): ?>
		    <p>Welcome <?=$_SESSION['login']?>!</p>
		<? endif; ?>