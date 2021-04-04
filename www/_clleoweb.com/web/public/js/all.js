jQuery(function ($) {

	"use strict";
	var $window = $(window);

	// Fix header
	var $stickyHeader = $('#header_fixed'),
		headerHeight = $stickyHeader.outerHeight(),
		menuHeight = 100,
		topPosition = headerHeight - menuHeight,
		headerIsFixed = false;

	function addStyles() {
		$stickyHeader.addClass('header-fixed');
		$('#body_content').css("marginTop",headerHeight);
		headerIsFixed = true;
	}
	function removeStyles() {
		$stickyHeader.removeClass('header-fixed');
		$('#body_content').css("marginTop","0");
		headerIsFixed = false;
	}

	if ($window.scrollTop() >= topPosition) {addStyles();}

	$window.scroll(function() {
		if ($window.scrollTop() >= topPosition) {
			if (!headerIsFixed) {addStyles();}
		} else {
			if (headerIsFixed) {removeStyles();}
		}
	});


	// Right site-Bar
	$('.open_btn').on('click', function() {
		$('.right_bar').toggleClass('opened');

		$('.left_bar').removeClass('opened');
		if ($("body").hasClass("fixed_body"))
			$("body").removeClass("fixed_body");
		else
			$("body").addClass("fixed_body");
	});

	$('main').on('click', function(e) {
		if ($(e.target).closest('.left_bar').not('.lb_btn, .rb_btn').length === 0) {
			$('.left_bar').removeClass('opened');
		}
	});
});

// Добавить удалить класс у объектов
function show_content(id, action, newClass) {
	if (action == 'add') {
		if ($("#" + id).hasClass(newClass)) {
			$("#" + id).removeClass(newClass);
		} else {
			$("#" + id).removeClass('show');
			$("#" + id).addClass(newClass);
		}
	} else {
		$("#" + id).removeClass(newClass);
	}
}

// Прокрутка к якорю (стрелка - вверх страницы)
function scrolltolink(id) {
	jQuery('html, body').animate({
		scrollTop: $('#' + id).offset().top - 45
	}, 1200);
}

// Scroll Animation
const animItems = document.querySelectorAll('.anim_items');

if (animItems.length > 0) {
	window.addEventListener('scroll', animOnScroll);
	function animOnScroll() {
		for (let index = 0; index < animItems.length; index++) {
			const animItem = animItems[index];
			const animItemHeight = animItem.offsetHeight;
			const animItemOffset = offset(animItem).top;
			// По достижении 1/5 Окна браузера добавляется класс
			const animStart = 5;

			let animItemPoint = window.innerHeight - animItemHeight / animStart;
			if (animItemHeight > window.innerHeight) {
				animItemPoint = window.innerHeight - window.innerHeight / animStart;
			}

			if ((pageYOffset > animItemOffset - animItemPoint) && pageYOffset < (animItemOffset + animItemHeight)) {
				animItem.classList.add('animation');
			} else {
				// Если не нужна повторная анимация добавить .no_anim
				if (!animItem.classList.contains('no_anim')) {
					animItem.classList.remove('animation');
				}
			}
		}
	}
	function offset(el) {
		const rect = el.getBoundingClientRect(),
			scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
			scrollTop = window.pageYOffset || document.documentElement.scrollTop;
		return { top: rect.top + scrollTop, left: rect.left + scrollLeft }
	}
	// Задержка анимации
	setTimeout(() => {
		animOnScroll();
	}, 300);
}

// Popaps win
const popupLinks=document.querySelectorAll(".popap_open"),body=document.querySelector("body"),lockPadding=document.querySelectorAll(".lock_padding");let unlock=!0;const timeout=800;if(popupLinks.length>0)for(let e=0;e<popupLinks.length;e++){const o=popupLinks[e];o.addEventListener("click",(function(e){const t=o.getAttribute("href").replace("#","");popupOpen(document.getElementById(t)),e.preventDefault()}))}const popupCloseIcon=document.querySelectorAll(".popap_close");if(popupCloseIcon.length>0)for(let e=0;e<popupCloseIcon.length;e++){const o=popupCloseIcon[e];o.addEventListener("click",(function(e){popupClose(o.closest(".popup")),e.preventDefault()}))}function popupOpen(e){if(e&&unlock){const o=document.querySelector(".popup.open");o?popupClose(o,!1):bodyLock(),e.classList.add("open"),e.addEventListener("click",(function(e){e.target.closest(".popup_content")||popupClose(e.target.closest(".popup"))}))}}function popupClose(e,o=!0){unlock&&(e.classList.remove("open"),o&&bodyUnLock())}function bodyLock(){const e=window.innerWidth-document.querySelector(".wrapper").offsetWidth+"px";if(lockPadding.length>0)for(let o=0;o<lockPadding.length;o++){lockPadding[o].style.paddingRight=e}body.style.paddingRight=e,body.classList.add("lock"),unlock=!1,setTimeout((function(){unlock=!0}),800)}function bodyUnLock(){setTimeout((function(){if(lockPadding.length>0)for(let e=0;e<lockPadding.length;e++){lockPadding[e].style.paddingRight="0px"}body.style.paddingRight="0px",body.classList.remove("lock")}),800),unlock=!1,setTimeout((function(){unlock=!0}),800)}document.addEventListener("keydown",(function(e){if(27===e.which){popupClose(document.querySelector(".popup.open"))}})),Element.prototype.closest||(Element.prototype.closest=function(e){for(var o=this;o;){if(o.matches(e))return o;o=o.parentElement}return null}),Element.prototype.matches||(Element.prototype.matches=Element.prototype.matchesSelector||Element.prototype.webkitMatchesSelector||Element.prototype.mozMatchesSelector||Element.prototype.msMatchesSelector);


// Ajax apload
$(function(){
	$('#popup_main').on('click', function(){	// При клике по элементу с id=price выполнять...
		$.ajax({
			url: '/popups_vimeo/win_vimeo_main.php', // Путь к файлу, который нужно подгрузить
			type: 'GET',
			beforeSend: function(){
				$('.ajax_content').empty(); // Перед выполнением очищает содержимое блока с id=win_content
			},
			success: function(responce){
					$('.ajax_content').append(responce); // Подгрузка внутрь блока с id=content
			},
			error: function(){
				alert('Error!');
			}
		});
	});
	$('#popup_1').on('click', function(){	// При клике по элементу с id=price выполнять...
		$.ajax({
			url: '/popups_vimeo/popup_1.php', // Путь к файлу, который нужно подгрузить
			type: 'GET',
			beforeSend: function(){
				$('.ajax_content_1').empty(); // Перед выполнением очищает содержимое блока с id=win_content
			},
			success: function(responce){
					$('.ajax_content_1').append(responce); // Подгрузка внутрь блока с id=content
			},
			error: function(){
				alert('Error!');
			}
		});
	});
	$('#popup_2').on('click', function(){	// При клике по элементу с id=price выполнять...
		$.ajax({
			url: '/popups_vimeo/popup_2.php', // Путь к файлу, который нужно подгрузить
			type: 'GET',
			beforeSend: function(){
				$('.ajax_content_2').empty(); // Перед выполнением очищает содержимое блока с id=win_content
			},
			success: function(responce){
					$('.ajax_content_2').append(responce); // Подгрузка внутрь блока с id=content
			},
			error: function(){
				alert('Error!');
			}
		});
	});

	// Popup Location
	$('#location').on('click', function(){	// При клике по элементу с id=price выполнять...
		$.ajax({
			url: '/include/popup_location.php', // Путь к файлу, который нужно подгрузить
			type: 'GET',
			beforeSend: function(){
				$('.ajax_location').empty(); // Перед выполнением очищает содержимое блока с id=win_content
			},
			success: function(responce){
					$('.ajax_location').append(responce); // Подгрузка внутрь блока с id=content
			},
			error: function(){
				alert('Error!');
			}
		});
	});
});
