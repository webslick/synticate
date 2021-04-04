<link rel="stylesheet" href="/css/admin_pages.css">
<link rel="stylesheet" href="/css/croppie.css">
<script src="/js/croppie.js"></script>
<script src="/js/list_admin.js"></script>


<div id="admin_list_wrap" class="win-modal-wrap fade-up">
	<div id="admin_list" class="admin-modal win-modal">
    
		<div class="admin-modal-title">Admin list</div>
		<span class="add-btn" onclick="admin_event(this,'newuser')">Add new <b class="fa-plus"></b></span>
		<span class="fa-close" onclick="javascript: $('#admin_list_wrap').hide()" title="Close"></span>
		
        <span class="modal-tips tip-ok dn" id="message_success">Data saved successfully</span>
		<span class="modal-tips tip-err dn" id="message_err">Data Error</span>
	
		<div class="admin-list-wrap">            
			<!-- Add new Admin block -->            
			<div class="add-admin-form admin-list-item flex admin_event_box" style="display:none">
                <div class="admin-avatar">
					<img class="d user_avatar" src="/images/users/no_avatar.jpg" alt="User Avatar">
					<span onclick="load_avatar()" class="fa fa-camera" title="Edit avatar"></span>
                    <input onchange="read_url(this)" type='file' id="input_avatar" class="dn">
				</div>
				<div class="admin-data">
					<div class="admin-data-inp">
						<input id="edit_name" type="text" placeholder="Name">
						<span class="fa fa-boys-clothing"></span>
					</div>
					<div class="admin-data-inp">
						<input id="edit_phone" type="text" placeholder="Phone">
						<span class="fa fa-phone"></span>
					</div>
					<div class="admin-data-inp err">
						<input id="edit_email" type="text" placeholder="Email">
						<span class="fa fa-envelope"></span>
					</div>
					<div class="admin-data-inp">
						<input id="edit_pass" type="text" placeholder="Password">
						<span class="fa fa-certificate"></span>
					</div>
				</div>
				<div class="edit-block">
					<span class="fa-close-1" title="Отменить / Удалить"></span>
					<div onclick="admin_event(this,'saveuser')" class="save-btn pa">Save <b class="fa-floppy-o"></b></div>
				</div>
			</div>
            
            <? foreach( $data as $user ): ?>
			<!-- Admin list item -->
			<div class="admin-list-item flex" id="<?=$user['Id']?>">
				<div class="admin-avatar">
					<img class="d user_avatar_<?=$user['Id']?>" src="/images/users/<?=$user['img'] ?>" alt="User Avatar">
				</div>
				<div class="admin-data">
					<div class="admin-name">
						<?=$user['name'] ?>
					</div>
					<div class="admin-phone">
						<?=$user['phone'] ?>
					</div>
					<div class="admin-email">
						<?=$user['email'] ?>
					</div>
					<div class="admin-pass">
						********
					</div>
				</div>
				<div class="edit-block">
					<div class="admin-menu fa-caret-down">
						<ul class="ad-menu">
							<li onclick="admin_event(this,'edituser')"><b class="fa-pencil-square-o"></b> Edit</li>
							<li onclick="admin_event(this,'removeuser')"><b class="fa-trash-o"></b> Dell</li>
						</ul>
					</div>
					<div class="admin-root" title="">
						<span class="tips-wrap">
							<span class="tips-text">
								<p>Root Status - Allow the administrator to create, delete and edit other users.</p>
							</span>
						</span>
						<input <? if ($user['access'] == 0):?>checked<?endif?> id="r_box_<?=$user['Id']?>" class="root-box" type="checkbox" hidden>
						<label onclick="admin_event(this,'toggleroot')" class="root-label" for="r_box_<?=$user['Id']?>">Root</label>
					</div>
				</div>
			</div>
            <? endforeach ?>            
		</div>
	</div>
</div>

<!-- Upload User avatar modal -->
<div id="modal_avatar" class="win-modal-wrap fade-up dn">
    <div id="admin_list" class="add-avatar-modal win-modal">
        <div class="admin-modal-title">Upload avatar</div>
        <span class="fa-close" onclick="javascript: $('#modal_avatar').hide()" title="Close"></span>
        <div id="load_avatar"></div>
        <div id="save_avatar" class="save-btn pa">Save <b class="fa-floppy-o"></b></div>
    </div>
</div>