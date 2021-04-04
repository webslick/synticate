<? 
//echo "<pre>DATA:"; print_r($data['user']); echo "</pre>";
if( $data['user'] ){
    $email = array_column($data['user'], 'email')[0];
    $avatar = array_column($data['user'], 'img')[0]; 
    $name = array_column($data['user'], 'name')[0];    
}
?>
<div class="log-in-block">
    <? if( $data['user']['admin'] || $data['user']['moder'] ): ?>
	<div class="log-user">
		<div class="log-user-avatar">
			<img class="d" src="/images/users/<?=$avatar?>" alt="<?=$name?>" title="<?=$email?>">			
		</div>
		<div class="log-user-menu admin-menu fa-caret-down">
			<ul class="lu-menu ad-menu">               
                <? if( !isset($gallery) && ( $data['user']['admin'] || $data['user']['moder'] ) && !isset($main) && !isset($location) && !isset($workshops) ): ?>
                    <li class="new_item" data-type="col-2"><b class="fa-plus"></b> Add content</li>
                <? elseif( isset($gallery) && ( $data['user']['admin'] || $data['user']['moder'] ) ): ?>
                    <li onclick="new_gallery()"><b class="fa-plus"></b> New gallery</li>
                <? endif; ?>
                                 
                <? if( $data['user']['admin'] ): ?>
                    <li onclick="load_modal( this, 'admin/users' )"><b class="fa-icon-contact-card"></b> User list</li>
				<? endif ?>
                
				<li id="logout"><b class="fa-sign-out"></b> Log out</li>
			</ul>
		</div>		
	</div>
    <? else: ?>			
	<div class="log-in fa-sign-in" onClick="javascript: $('#log_form_wrap').show()" title="Log in"></div>
    <? endif; ?>
</div>