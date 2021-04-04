<!-- Main content -->	
<main class="content-main">	
    <h1 class="m-page-h1 dn">We welcome you to the space created by the magic hands of Centaurus</h1>
</main><!-- END Main content -->



<!-- Баннер -->
<div id="royalSlider_main" class="banner royalSlider">
	<img src="/images/main_slider/slide-0.jpg" alt="Centaurus Project">
	<img src="/images/main_slider/slide-1.jpg" alt="Centaurus Project">
	<img src="/images/main_slider/slide-2.jpg" alt="Centaurus Project">
	<img src="/images/main_slider/slide-3.jpg" alt="Centaurus Project">
	<img src="/images/main_slider/slide-4.jpg" alt="Centaurus Project">
	<img src="/images/main_slider/slide-5.jpg" alt="Centaurus Project">
	<img src="/images/main_slider/slide-6.jpg" alt="Centaurus Project">
	<img src="/images/main_slider/slide-7.jpg" alt="Centaurus Project">
</div><!-- END Баннер -->


<style media="screen">
	.banner.royalSlider {
	    position: fixed;
	    top: 0;
	    left: 0;
	    width: 100%;
	    height: 100vh;
	    z-index: 0;
	    overflow: hidden;
	}
	.royalSlider {
	    position: relative;
	    direction: ltr;
	}
	
	.rsOverflow {
    	overflow: hidden;
		-webkit-tap-highlight-color: rgba(0,0,0,0);
	}
	.royalSlider > * {
	    float: left;
	}
	.royalSlider {
	    direction: ltr;
	}
	.rsContainer {
	    position: relative;
	    width: 100%;
	    height: 100%;
	    -webkit-tap-highlight-color: rgba(0,0,0,0);
	}
	.rsSlide {
	    position: absolute;
	    left: 0;
	    top: 0;
	    display: block;
	    overflow: hidden;
	    height: 100%;
	    width: 100%;
	}
</style>




<script>
	jQuery(function( $ ) {
		// Слайдер на главной
		$("#royalSlider_main").royalSlider({
			imageScaleMode: 'fill',
			arrowsNav: false,
			transitionType: 'fade',
			loop: true,
			transitionSpeed: 2000,
			navigateByClick: false,
			controlNavigation: 'none',
			autoPlay: {
				enabled: true,
				delay: 3000,
				pauseOnHover: false,
				stopAtAction: false
			}
		});		
	});
</script>