<!DOCTYPE html>
<html lang="<?=lang('short')?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<title><? if (isset($og) && $og['title']) echo $og['title'] . " | "; ?><?=lang('site_title')?></title>
	
	<!-- Custom styles for this template -->
	<link href="/css/dandc.css" rel="stylesheet">
	
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	<? if (isset($og) && count($og)): ?>
	<meta property="og:title" content="<?=$og['title']?>">
	<meta property="og:type" content="product">
	<meta property="og:url" content="<?=$og['url']?>">
	<meta property="og:image" content="<?=$og['image']?>">
	<meta property="og:site_name" content="KitchenAid Declare and Share">
	<meta property="og:description" content="<?=$og['description']?>">
	<? endif; ?>
</head>
<body>
	<div id="lang_switch">
		<a href="/welcome/lang/english?redirect=<?=urlencode(uri_string())?>" onclick="te('language-selector','en','')"<? if (lang('short') == 'en'): ?> class="current"<? endif; ?>>EN</a> | <a href="/welcome/lang/french?redirect=<?=urlencode(uri_string())?>" onclick="te('language-selector','fr','')"<? if (lang('short') == 'fr'): ?> class="current"<? endif; ?>>FR</a>
	</div>