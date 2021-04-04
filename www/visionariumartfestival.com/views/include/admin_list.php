<div id="admin_list_wrap" class="win-modal-wrap fade-up" style="display:none">
	<div id="admin_list" class="admin-modal win-modal">
		<div class="admin-modal-title">Admin list</div>
		<span class="add-btn">Add new <b class="fa-plus"></b></span>
		<span class="fa-close" onclick="javascript: $('#admin_list_wrap').hide()" title="Закрыть"></span>
		<span class="modal-tips tip-ok">Data saved successfully</span>
		<span class="modal-tips tip-err">Data Error</span>
	
		<div class="admin-list-wrap">
			<!-- Add new Admin block -->
			<div class="add-admin-form admin-list-item flex">
				<div class="admin-avatar">
					<img class="d" src="/images/users/user_admin_0.jpg" alt="User Avatar">
					<img class="dn" src="/images/users/user_admin_1.jpg" alt="User Icon">
					<span class="fa fa-camera" title="Edit avatar"></span>
				</div>
				<div class="admin-data">
					<div class="admin-data-inp">
						<input id="" type="text" placeholder="Name">
						<span class="fa fa-boys-clothing"></span>
					</div>
					<div class="admin-data-inp">
						<input type="text" placeholder="Phone">
						<span class="fa fa-phone"></span>
					</div>
					<div class="admin-data-inp err">
						<input type="text" placeholder="Email">
						<span class="fa fa-envelope"></span>
					</div>
					<div class="admin-data-inp">
						<input type="text" placeholder="Password">
						<span class="fa fa-certificate"></span>
					</div>
				</div>
				<div class="edit-block">
					<span class="fa-close-1" title="Отменить / Удалить"></span>
					<div class="save-btn pa">Save <b class="fa-floppy-o"></b></div>
				</div>
			</div>
			<!-- Admin list item -->
			<div class="admin-list-item flex">
				<div class="admin-avatar">
					<img class="dn" src="/images/users/user_admin_0.jpg" alt="User Avatar">
					<img class="d" src="/images/users/user_admin_1.jpg" alt="User Icon">
				</div>
				<div class="admin-data">
					<div class="admin-name">
						Юрий Заполярный
					</div>
					<div class="admin-phone">
						+79151117100
					</div>
					<div class="admin-email">
						ihtianderson@gmail.com
					</div>
					<div class="admin-pass">
						********
					</div>
				</div>
				<div class="edit-block">
					<div class="admin-menu fa-caret-down">
						<ul class="ad-menu">
							<li><b class="fa-pencil-square-o"></b> Edit</li>
							<li onClick="javascript: $('#conf_popap').show()"><b class="fa-trash-o"></b> Dell</li>
						</ul>
					</div>
					<div class="admin-root" title="">
						<span class="tips-wrap">
							<span class="tips-text">
								<p>Root Status - Allow the administrator to create, delete and edit other users.</p>
							</span>
						</span>
						<input id="r_box" class="root-box" type="checkbox" hidden>
						<label class="root-label" for="r_box">Root</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	// Move modal window
	$(function() {
		$("#admin_list").draggable();
	});
</script>
