<? if( !isset($data['status']) ) { $data['status'] = ''; } ?>
<div id="log_form_wrap" class="r-form-wrap win-modal-wrap fade-up" style="display:none">
	<div id="log_form" class="r-form win-modal">
		<span class="fa-close" onclick="javascript: $('#log_form_wrap').hide()" title="Закрыть"></span>
		
		<div class="r-form-title"><? if($data['status']=='ok'){ ?>Set new password<? }else{ ?>Authorization<? } ?></div>
		
        <form id="form_auth" action="login" name="auth" method="post">
    		<div class="r-form-input">
    			<input id="email" type="text" placeholder="E-mail">
    		</div>
    		<div class="r-form-input">
    			<input id="pass" type="password" placeholder="<?=($data['status']=='ok')?"New password":"Password"?>" >
    		</div>	
            <div class="r-form-input" style="display:none;" id="r-form-input-pass2">
    			<input id="pass2" type="password" placeholder="Confirm password" >
    		</div>
        </form>
	
		<? if($data['status']!='ok'){ ?>
			<button id="login" class="r-form-btn">Log In</button>
			<button onclick="remindPassword()" id="login-remind" class="r-form-btn" style="display:none;">Remind</button>
		<? }else{ ?>
			<button onclick="setNewPassword()" id="butNewPassword" class="r-form-btn">New password</button>
		<? } ?>
		<div class="r-form-sign  flex sa">
			<a class="dn" href="">New user registration</a>
			<? if($data['status']!='ok'){ ?>
				<span id="signa"><a href="#" onclick="forgotPassword();return false;">Forgot password?</a></span>
			<? } ?>
		</div>
		<img class="r-form-logo" src="/img/logo_small.png" alt="Logo">
	</div>
	<div id="log_form_forgot" class="r-form win-modal" style="display:none;">
		<span class="fa-close" onclick="javascript: $('#log_form_wrap').hide()" title="Закрыть"></span>
		<div class="r-form-title">E-mail was sended</div>
		<div class="r-form-sign  flex sa">E-mail was sended</div>
	</div>
	<div id="log_form_newpass" class="r-form win-modal" style="display:none;">
		<span class="fa-close" onclick="javascript: $('#log_form_wrap').hide()" title="Закрыть"></span>
		<div class="r-form-title">Change password</div>
		<div class="r-form-sign  flex sa">Password was changed</div>
	</div>
</div>


<script>
	
	<? if($data['status']=='ok'){ ?>
		$(document).ready(function(){
			$('#log_form_wrap').show();
			$('#email').hide();
			$('#pass').show();
			$('#r-form-input-pass2').show();
		})
	<? } ?>
	
	$(document).ready(function() {
	    $('#email, #pass').keypress(function (e) {
	        if(e.which == 13) {            
	            $("#login").click();
	            return false;  
	        }
	    });     
	});
	function setNewPassword(){
		//console.log('setNewPassword');
		var paction = "pass="+encodeURIComponent( $("#pass").val() );
		paction += "&pass2="+encodeURIComponent( $("#pass2").val() );
		console.log(paction);
		$.ajax({
			type: "POST",
			url:  "/login/new_password",
			dataType: 'JSON',
			data: paction,
			success: function( data ) {
				console.log(data);
				//return false;
				if(data.status=='error'){
					$('#pass').parent().addClass('err');
					$('#pass2').parent().addClass('err');
				}else if(data.status=='ok'){
					$('#log_form_forgot').css('display','none');
					$('#log_form').css('display','none');
					$('#log_form_newpass').css('display','');
					setTimeout("location.href='/'", 2000);
				}
			}
		});
	}
	function forgotPassword(){
		//console.log('forgotPassword');
		$('#pass').css('display','none');
		$('#login').css('display','none');
		$('#login-remind').css('display','');
		$('#signa').empty();
		var html = '<a href="#" onclick="returnToLogIn();return false;">Log In</a>';
		$('#signa').append(html);
		return false;
	}
	function returnToLogIn(){
		$('#pass').css('display','');
		$('#login').css('display','');
		$('#login-remind').css('display','none');
		$('#signa').empty();
		var html = '<a href="#" onclick="forgotPassword();return false;">Forgot password?</a>';
		$('#signa').append(html);
		$('#email').parent().removeClass('err');
	}
	function remindPassword(){
		$.ajax({
			type: "POST",
			url:  "/login/forgot",
			dataType: 'JSON',
			data: "email="+encodeURIComponent( $("#email").val() ),
			success: function( data ) {
				console.log(data);
				console.log($('#email').parent());
				if(data.status=='error'){
					if(data.error=='empty'){
						$('#email').parent().addClass('err');
					}else if(data.error=='novalid'){
						$('#email').parent().addClass('err');
					}else{
						
					}
				}else if(data.status=='ok'){
					$('#log_form_forgot').css('display','');
					$('#log_form').css('display','none');
					$('#log_form_newpass').css('display','none');
					setTimeout("location.href='/'", 2000);
				}
			}
		});
	}
</script>
