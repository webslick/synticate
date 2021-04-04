<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Visionarium Art Festival - New Event will come soon</title> 
	<meta name="description" content="We would like to invite you to a magnificent art event. 
									  Visionarium  art festival- provides  a ground where brightest artists come to 
									  create, exhibit, teach and study together">
	<meta name="keywords" content="art festival, event, visionarium, artists, creature, psychedelic music">
	<meta name="google-site-verification" content="dtRGJgruFQhBcJjld2Hse0V9so0_Zv-fmGHfRXuSXxo">
	
	<base href="<?=SITE?>">
    
    <link rel="shortcut icon" href="/img/favicon.ico"> 
	
	<!-- Сommon css	 -->
	<link rel="stylesheet" href="/css/common.css">
	
	<!-- Main css -->
	<link rel="stylesheet" href="/css/main.css">
	
	<? if (!isset($main)): ?>
		<!-- Page css -->
		<link rel="stylesheet" href="/css/page.css">
	<? endif ?>
	
	<!-- Главная jquery библиотека -->
	<!-- JQUery UI -->
	<!-- <script src="/js/jquery-ui.min.js"></script> -->
    
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>    
			 
    
    <? if ( $data['user']['admin'] || $data['user']['moder'] ): ?>
	    <script src="/js/plugins/jquery.ui.touch-punch.min.js"></script>
	    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script> -->
	    <script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
	        
	    <!-- <script src="/js/plugins/popup/magnific-popup.min.js"></script>
	    <link rel="stylesheet" href="/js/plugins/popup/magnific-popup.css"> -->
	    
	    <script src="/js/plugins/liteuploader.js"></script>
	    <script src="/js/admin.js"></script>
	    
	    <link rel="stylesheet" href="/css/admin_pages.css">
    <? endif ?>
    
    <? if (isset($location)): ?>
        <!-- Owl carusel -->
		<!-- <script src="/js/jquery_3.3.1.min.js"></script> -->
		<script src="/js/owl.carousel.min.js"></script>	
		<link rel="stylesheet" href="/css/owl.carousel.css">
	<? endif ?>

	<? if (isset($gallery)||isset($workshops)): ?>
		<!-- Unite gallery carusel -->
		<link rel="stylesheet" href="/css/gallery.css">		
		<link rel='stylesheet' href='/plugins/unitegallery/css/unite-gallery.css'>		
		<script src='/plugins/unitegallery/js/unitegallery.min.js'></script>	
		<script src='/plugins/unitegallery/themes/tiles/ug-theme-tiles.js'></script>	
	<? endif ?>	
</head>