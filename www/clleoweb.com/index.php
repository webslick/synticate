<!DOCTYPE html>
<html lang="ru">
<!-- Head -->
<?php include './include/head.php'?>

<body>
	<!-- Header -->
	<?php include './include/header.php'?>
	<!-- Main content -->
	<main class="main wrapper">
		<!-- Section One ---------------------------------->
		<section class="main-section-one">
			<div class="section-one--content flex jb content-wrap">
				<div class="section-one--text anim_items">
					<h1 class="section-one--title">
						SYNTICATE is a
						CG Art Direction studio.
						We synthesize full cg content, 3d and 2d animation, motion graphics,
						generative graphics and AI avatars.
					</h1>
				</div>
				<a id="popup_main" class="section-one--preview preload-img popap_open anim_items" href="#preview_main">
					<picture>
						<source srcset="/image_web/img_small/Synti_Showreel_2020.jpg" media="(max-width: 768px)">
						<source srcset="/image_web/webp/Synti_Showreel_2020.webp" type="image/webp">
						<img class="b-lazy" data-src="/image_web/Synti_Showreel_2020.jpg" alt="Image Preview">
					</picture>
					<svg class="i-play">
						<use xlink:href="/icon/sprite.svg#play_yellow"/>
					</svg>
				</a>
				<!-- Preview_popap_main -->
				<div id="preview_main" class="win-wrap popup">
					<div class="popup--content popup_content ajax_content"></div>
				</div>
			</div>
			<div class="go-to-btn">
				<!-- Soc links -->
				<div class="section-one-soc anim_items">
					<a href="https://www.behance.net/synticateteam" target="_blank" title="Go to our page Behance">
						<svg class="i-soc">
							<use xlink:href="/icon/sprite.svg#behance"/>
						</svg>
					</a>
					<a href="https://vimeo.com/synticate" target="_blank" title="Go to our page Vimeo">
						<svg class="i-soc">
							<use xlink:href="/icon/sprite.svg#vimeo"/>
						</svg>
					</a>
					<a href="https://www.instagram.com/synticate.team/" target="_blank" title="Go to our page Instagram">
						<svg class="i-soc">
							<use xlink:href="/icon/sprite.svg#insta"/>
						</svg>
					</a>
				</div>
				<a class="mouse" href="#section_2" title="Go to Section Works"></a>
			</div>
		</section>
		<!-- Section works -->
		<?php include './include/section_works.php'?>
		<!-- Section Test -->
		<?php include './include/section_test.php'?>
	</main>
	<!-- Footer -->
	<?php include './include/footer.php' ?>
</body>
</html>