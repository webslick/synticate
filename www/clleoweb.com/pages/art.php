<!DOCTYPE html>
<html lang="ru">
<!-- Head -->
<?php include '../include/head.php'?>

<body>
	<!-- Header -->
	<?php include '../include/header-page.php'?>

	<!-- Main content -->
	<main class="main wrapper">
		<section class="page-art main-section-one anim_items no_anim">
			<div class="page-art--content content-wrap">
				<div class="page-title">
					<img class="title-element anim_items" src="/icon/art_g.svg" alt="Element">
					<img class="i-title" src="/icon/art-progects.svg" alt="Art progect">
				</div>
				<div class="go-to-btn">
					<a class="mouse" href="#section_2" title="Go to Section Two"></a>
				</div>
			</div>
		</section>

		<!-- Section Two ---------------------------------->
		<section id="section_2" class="section-works">
			<div class="section-works--content flex jb">
			<!-- Preview_1 -->
			<div class="sw-item preload-img anim_items no_anim">
				<picture>
					<source class="b-lazy" data-srcset="/image_web/img_small/Hi_human.jpg" media="(max-width: 768px)">
					<source class="b-lazy" data-srcset="/image_web/webp/Hi_human.webp" type="image/webp">
					<img class="b-lazy" data-src="/image_web/Hi_human.jpg" alt="Image Preview">
				</picture>
				<div class="sw-item--title">Hi, Human</div>
				<div class="sw-item--hover">
					<a class="sw-item--play popap_open" href="#preview_1" title="Open Video">
						<svg class="i-play">
							<use xlink:href="/icon/sprite.svg#play"/>
						</svg>
						Quick play
					</a>
				</div>
			</div>
			<!-- Preview_popap_1 -->
			<div id="preview_1" class="win-wrap popup">
				<div class="popup--content popup_content">
					<svg class="popap_close win-close i-close">
						<use xlink:href="/icon/sprite.svg#close"/>
					</svg>
					<div class="popup--video">
						<iframe title="vimeo-player" src="https://player.vimeo.com/video/407190750" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
					</div>
					<div class="popup--title">Hi, Human</div>
					<div class="popup--text">
						Design development is always an exciting challenge which we're happy to accept!
						While working on full cg video with 3d animation of Robert the Robot we also created some composition design options for the scenes.
					</div>
				</div>
			</div><!-- END Preview_1 -->

			<!-- Preview_2 ----------------------------------------------------->
			<div class="sw-item preload-img anim_items no_anim">
				<picture>
					<source class="b-lazy" data-srcset="/image_web/img_small/Z_portal.jpg" media="(max-width: 768px)">
					<source class="b-lazy" data-srcset="/image_web/webp/Z_portal.webp">
					<img class="b-lazy" data-src="/image_web/Z_portal.jpg" alt="Image Preview">
				</picture>
				<div class="sw-item--title">Z Portal</div>
				<div class="sw-item--hover">
					<a class="sw-item--play popap_open" href="#preview_2" title="Open Video">
						<svg class="i-play">
							<use xlink:href="/icon/sprite.svg#play"/>
						</svg>
						Quick play
					</a>
				</div>
			</div>
			<!-- Preview_popap_2 -->
			<div id="preview_2" class="win-wrap popup">
				<div class="popup--content popup_content">
					<svg class="popap_close win-close i-close">
						<use xlink:href="/icon/sprite.svg#close"/>
					</svg>
					<div class="popup--video">
						<iframe title="vimeo-player" src="https://player.vimeo.com/video/352687334" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
					</div>
					<div class="popup--title">Z Portal</div>
					<div class="popup--text">
						Ipsum dolor sit amet consectetur adipisicing elit. Aut enim vero veritatis velit assumenda soluta sed ad, omnis alias placeat debitis voluptas ea ipsam dolorum error dolorem, a blanditiis! Quidem!
						Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut enim vero veritatis velit assumenda soluta sed ad, omnis alias placeat debitis voluptas ea ipsam dolorum error dolorem, a blanditiis! Quidem!
						Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut enim vero veritatis velit
					</div>
				</div>
			</div><!-- END Preview_2 -->
		</sedtion>
	</main>
	<!-- Footer -->
	<?php include '../include/footer.php' ?>
</body>
</html>
