<body class="main-shad">
	<!-- Yandex.Metrika counter -->
	<script>
	    (function (d, w, c) {
	        (w[c] = w[c] || []).push(function(){
	            try {
	                w.yaCounter51416728 = new Ya.Metrika2({
	                    id:51416728,
	                    clickmap:true,
	                    trackLinks:true,
	                    accurateTrackBounce:true,
	                    webvisor:true
	                });
	            } catch(e) { }
	        });	
	        var n = d.getElementsByTagName("script")[0],
	            s = d.createElement("script"),
	            f = function () { n.parentNode.insertBefore(s, n);};
	        s.type = "text/javascript";
	        s.async = true;
	        s.src = "https://mc.yandex.ru/metrika/tag.js";
	
	        if (w.opera == "[object Opera]") {
	            d.addEventListener("DOMContentLoaded", f, false);
	        } else { f(); }
	    })(document, window, "yandex_metrika_callbacks2");
	</script>	
	<noscript>
		<div><img src="https://mc.yandex.ru/watch/51416728" style="position:absolute; left:-9999px" alt="Yandex"></div>
	</noscript><!-- /Yandex.Metrika counter -->
			
	<!-- header -->
	<header id="navi_fixed" class="main-page-header animate first_top">					
		<!-- Logo -->
		<a class="logo page-logo" href="/" title="Go to the Main page">
			<img src="/img/logo.png" alt="Visionarium Art Festival">
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
						
			<span class="main-nav flex sb">
		        <a class="m-nav <? if($concept):?>act<? endif ?>" href="/concept">Concept</a>
		        <a class="m-nav <? if($location):?>act<? endif ?>" href="/location">Location</a>
		        <a class="m-nav <? if($artists):?>act<? endif ?>" href="/artists">Artists</a>
		        <a class="m-nav t-nav pulse" href="https://www.hadra.net/tickets/index.php?event_id=17&&lang=2&fbclid=IwAR2MFhGQkQgyyf8JaRT7ZpZO08_dpjZM1cLnAUunPssidDvHPORIjuNMB5Q" target="_blank" onclick="yaCounter51416728.reachGoal ('buy_ticket'); return true;">T i c k e t</a>
		        <a class="m-nav <? if($music):?>act<? endif ?>" href="/music">Music</a>
		        <a class="m-nav <? if($workshops):?>act<? endif ?>" href="/workshops">Workshops</a>
		   <!-- <a class="m-nav" href="/page/program.php">Program</a> -->
		        <a class="m-nav <? if($gallery):?>act<? endif ?>" href="/gallery">Gallery</a>
		    </span>
		</nav>
	</header><!-- END header -->
	
	<!-- Background video -->
	<div class="video-background">
		<video preload="auto" autoplay loop muted>
			<source  src="https://visionariumartfestival.com/video/Visionarium_720_3.mp4" type="video/mp4">
	   <!-- <source src="https://visionariumartfestival.com/video/Visionarium_720_3.webm" type="video/webm"> -->
		</video>
	</div>
	
	<!-- Registration form -->
	<?php include ("registration_form.php")?>
