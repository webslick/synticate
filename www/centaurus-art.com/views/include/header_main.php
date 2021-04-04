<body class="main-shad">
	<!-- Yandex.Metrika counter -->
	<script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(54085297, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/54085297" style="position:absolute; left:-9999px;" alt=""></div></noscript> <!-- /Yandex.Metrika counter -->	
	<noscript>
		<div><img src="https://mc.yandex.ru/watch/54085297" style="position:absolute; left:-9999px" alt="Yandex"></div>
	</noscript><!-- /Yandex.Metrika counter -->
			
	<!-- header -->
	<header id="navi_fixed" class="main-page-header animate first_top">					
		<!-- Logo -->
		<a class="logo page-logo" href="/" title="Go to the Main page">
			Centaurus Fractals
		<!-- <img src="/img/logo.png" alt="Centaurus art"> -->
		</a>
		        
		<!-- Login menu -->
		<?php include ("log_in.php")?>
		
		<!-- Navigation -->
		<nav id="navi" class="main-page-nav">
			<!-- Mob. Menu icon -->
			<button class="nav-toggle mob-menu-icon" onClick="javascript:show_content ('navi','add','show')">
				<span class="bar-top"></span>
				<span class="bar-mid"></span>
				<span class="bar-bot"></span>
			</button>
						
			<span class="main-nav flex">
		        <a class="m-nav <? if($concept):?>act<? endif ?>" href="/concept">Concept</a>
		   <!-- <a class="m-nav <? if($location):?>act<? endif ?>" href="/location">Location</a> -->
		   <!-- <a class="m-nav <? if($artists):?>act<? endif ?>" href="/artists">Artists</a> -->
		        <a class="m-nav <? if($music):?>act<? endif ?>" href="/music">Music</a>
		   <!-- <a class="m-nav <? if($workshops):?>act<? endif ?>" href="/workshops">Workshops</a> -->
		   <!-- <a class="m-nav" href="/page/program.php">Program</a> -->
		        <a class="m-nav <? if($gallery):?>act<? endif ?>" href="/gallery">Gallery</a>
		    </span>
		</nav>
	</header><!-- END header -->
	
	<!-- Background video --
	<div class="video-background">
		<video preload="auto" autoplay loop muted>
			<source  src="https://visionariumartfestival.com/video/Visionarium_720_3.mp4" type="video/mp4">
		</video>
	</div -->
	
	<!-- Registration form -->
	<?php include ("registration_form.php")?>
