$(document).ready(function(){
    // Autorization
    $("#login").click(function() {
        $(".r-form-input").removeClass("err");
        $.ajax({
            type: "POST",
            url:  "/login",
            dataType: 'JSON',
            data: "email="+encodeURIComponent( $("#email").val() )+"&pass="+encodeURIComponent( $("#pass").val() ),
            success: function( data ) {
                var e = data.e;
                e.forEach( function( elem ) {
                    if( elem == 'auth' ){
                        $("#form_auth").submit();
                        window.location.reload();
                        glob_reload(window.location.href);
                    } else {
                        var el = elem.split('_');
                        $("#"+el[1]).parent().addClass(el[0]);                        
                    }                                          
                });
            }
        });
        return false;    
    });
    function glob_reload(url) {
        $.ajax({
            type: "GET",
            url:  url,
            success: function( data ) {
               
            }
        });
    }
    
    // User Log Out
    $("#logout").click(function() {
        $.post( "/login/exit", function() {
            setTimeout(function(){
                window.location.reload();
            },1000);
        });

    });
    // Focus сброс полей
    $( "input[type=text], input[type=password]" ).focus(function() {
        //console.log(this);
        $(this).parent().removeClass("err");
    });
    
    // Paralax effect on main page
	$window = $(window);
	$('div[data-type="background"]').each(function() {
	var $bgobj = $(this);
		$(window).scroll(function() {
        	var yPos = -($window.scrollTop() / $bgobj.data('speed')); 
        	var coords = -yPos + 'px';
			//var coords = '50% '+ yPos + 'px';
			//$bgobj.css({ backgroundPosition: coords });
			
			var currentScroll = $(window).scrollTop();
			var perc = (jQuery('#bg_fixed').height()-$(window).height())*100/jQuery('#bg_fixed').height();
            //console.log(perc+' - '+currentScroll+' - '+jQuery('#bg_fixed').height()*perc/100);
			if (perc<0 || currentScroll < (jQuery('#bg_fixed').height()*perc/100)) {
				var coords = (0-(currentScroll*.25))+'px';
				//console.log('Paralax='+coords);
				
				$bgobj.css( 'top', coords );
			} else {
				$('#bg_fixed').css({
				position: 'fixed',
				top: -(jQuery('#bg_fixed').height()*perc/100),
				left: '0'
        		});

			}
    	})
	}); 
}); 


// Fixed header
jQuery(function($) {
	"use strict";
	var $window = $(window);
	
	var $stickyHeader = $('#navi_fixed'),
		headerHeight = $stickyHeader.outerHeight(),
		menuHeight = -32,
		topPosition = headerHeight - menuHeight,
		headerIsFixed = false;
	
	function addStyles() {		
		$stickyHeader.addClass('navi-fixed');
		$('#body_content').css("marginTop",headerHeight);
		headerIsFixed = true;
	}
	function removeStyles() {
		$stickyHeader.removeClass('navi-fixed');
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
});

// Mobile menu toogle
// $(document).ready(function(){
// 	$('.mob-menu-icon').on('click', function(e) {
// 		e.preventDefault;
// 		$(this).toggleClass('is-active');
// 	});
// });


// Добавить удалить класс у объектов
// Например: Добавить класс test к объекту pid: show_content('pid','add','test');
// Например: Удалить класс test  объекта pid: show_content('pid','remove','test');
function show_content (id, action, newClass) {
    if (action=='add') {
        if ($("#"+id).hasClass(newClass)) {
            $("#"+id).removeClass(newClass);    
        }
        else {
            $('.show').removeClass('show');
            $("#"+id).addClass(newClass);
        }
    } else {
        $("#"+id).removeClass(newClass);
    }
}

// Фиксация фона при прокрутке по достижении нижнего края изображения	
$(window).scroll(function() {
    var currentScroll = $(window).scrollTop();
    var perc = (jQuery('#bg_fixed').height()-$(window).height())*100/jQuery('#bg_fixed').height();

	if (perc<=0) {
        $('#bg_fixed').css({
            position: 'fixed',
            top: 0,
            left: '0'
        });	    
    } else {
    if (currentScroll >= jQuery('#bg_fixed').height()*perc/100) {
	    //console.log('MYSCROLL = '+perc+' - '+currentScroll+' - '+jQuery('#bg_fixed').height()*perc/100);
	    var paralax_add = currentScroll*.25;
	    //console.log('paralax='+paralax_add+' == myscroll='+(jQuery('#bg_fixed').height()*perc/100));
        //$('#bg_fixed').css({
        //    position: 'fixed',
        //    top: -(jQuery('#bg_fixed').height()*perc/100),
        //    left: '0'
        //});
    } else {
        $('#bg_fixed').css({
            position: 'absolute',
            top: '0'
        });
    }
    }
});


// Timer
jQuery(document).ready(function() {
	jQuery(".eTimer").eTimer({
		etType: 0, 
		etDate: "17.05.2019.0.0", 
		etTitleText: "Before the event", 
		etTitleSize: 12,
		etShowSign: 2, 
		etSep: ":", 
		etFontFamily: "Arial", 
		etTextColor: "#e4dcdc", 
		etPaddingTB: 5, 
		etPaddingLR: 8,
		etBackground: "rgba(0, 0, 0, 0.55)", 
		etBorderSize: 0, 
		etBorderRadius: 3, 
		etBorderColor: "white", 
		etShadow: "0px 3px 30px -1px #34595c", 
		etLastUnit: 4, 
		etNumberFontFamily:"Impact",
		etNumberSize: 20, 
		etNumberColor: "white", 
		etNumberPaddingTB: 0, 
		etNumberPaddingLR: 1, 
		etNumberBackground: "transparent", etNumberBorderColor: "transparent"
	});
});