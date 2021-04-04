<!DOCTYPE html>
<html lang="ru">
<!-- Head -->
<?php include '../include/head.php'?>

<body>
	<!-- Header -->
	<?php include '../include/header-page.php'?>

	<!-- Main content -->
	<main class="main wrapper">
		<!-- Section One ---------------------------------->
		<section class="page-contacts--section-one anim_items no_anim">
			<div class="page-contacts--content content-wrap">
				<div class="page-title">
					<img class="title-element anim_items" src="/icon/contacts_g.svg" alt="Element">
					<img class="title-text" src="/icon/contacts_3.gif" alt="Contacts">
				</div>
				<div class="go-to-btn">
					<a class="mouse" href="#section_2" title="Go to Section Two"></a>
				</div>
			</div>
		</section>

		<!-- Section Two ---------------------------------->
		<section id="section_2" class="page-contacts--section-two">
			<div class="page-contacts--content content-wrap flex jb">
				<div class="page-contacts--text anim_items no_anim">
					<a class="mail-link" href="mailto:hi@synticate.team">Join us: hi@synticate.team</a>
					<a class="mail-link" href="tel:+74952603777">+7 495 260-37-77</a>
					<!-- Location -->
					<a id="location" class="page-contacts--address popap_open" href="#Popup_location" title="Show Location">
						<p>
							Office 44, Novodmitrovskaya str. 1/1,<br>
							Moscow 127015
						</p>
						<svg class="i-location">
							<use xlink:href="/icon/sprite.svg#location"/>
						</svg>
					</a>
				</div>
				<div class="page-contacts--element anim_items no_anim">
					<img src="/icon/info.gif" alt="Info icon">
				</div>
			</div>
			<!-- Popup_location -->
			<div id="Popup_location" class="win-wrap popup">
				<div class="popup--map-content popup--content popup_content">
					<svg class="popap_close win-close i-close">
						<use xlink:href="/icon/sprite.svg#close"/>
					</svg>
					<div class="popup--map">
						<div style="position:relative;overflow:hidden;"><a href="https://yandex.ru/maps/213/moscow/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Москва</a><a href="https://yandex.ru/maps/213/moscow/?from=api-maps&ll=37.585477%2C55.806670&mode=usermaps&origin=jsapi_2_1_74&um=constructor%3Ada388f5d58294e154bbee47de01320bc22b0f59e26295b1fdf2e10cebae418fa&utm_medium=mapframe&utm_source=maps&z=18" style="color:#eee;font-size:12px;position:absolute;top:14px;">Яндекс.Карты — поиск мест и адресов, городской транспорт</a><iframe src="https://yandex.ru/map-widget/v1/-/CCUQeCe7xD" width="100%" height=450" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe></div>
					</div>
					<div class="popup--title">Synticate Team</div>
					<div class="popup--text">
						Office 44, Novodmitrovskaya str.1/1, 127015 Moscow, Russia
					</div>
				</div>
			</div>
			<div class="soc-btn">
				<!-- Soc links -->
				<div class="soc-btn--wrap anim_items">
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
			</div>
		</section>
	</main>
	<!-- Footer -->
	<?php include '../include/footer.php' ?>
</body>
</html>
