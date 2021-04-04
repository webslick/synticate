<link rel="stylesheet" href="/css/admin_pages.css">

<div id="add_content_wrap" class="win-modal-wrap fade-up">
	<div id="add_content" class="admin-modal win-modal">		
		<span class="fa-close" onclick="javascript: $('#add_content_wrap').hide()" title="Закрыть"></span>
        
        <span class="modal-tips tip-ok dn" id="message_success">Data saved successfully</span>
		<span class="modal-tips tip-err dn" id="message_err">Data Error</span>
        
        <? //print_r( $data );  ?>
        
        <? if ( !isset( $data['published'] ) ): $data['published']=1; endif ?>
        
        <? if ( !isset( $data['gallery'] ) ): ?>
    		<? if ($data['Id']): ?>
                <div class="admin-modal-title">Edit image: #<?=($data['Id'])?$data['Id']:'-1' ?></div>
            <? else:?>
                <div class="admin-modal-title">Add images</div>
            <? endif; ?>
        <? else: ?>
    		<? if ($data['Id']):?>
                <div class="admin-modal-title">Edit gallery: #<?=($data['Id'])?$data['Id']:'-1' ?></div>
            <? else:?>                
                <div class="admin-modal-title">Add new gallery</div>
            <? endif; ?>
        <? endif; ?>
        
		<div class="admin-modal-content amc_id" id="<?=($data['Id'])?$data['Id']:'-1' ?>">
			<div class="content-title-wrap flex sb" <?if($data['href']=='main_gallery'):?>style="display:none;"<? endif ?> >
				<!-- Content Title -->
				<div class="content-title">
					<input class="c-title" oninput="input_latin(this)" type="text" placeholder="Enter title" value="<?=$data['name']?>" >
				</div>
				<div class="content-publ">
					<span class="tips-wrap">
						<span class="tips-text">
							<p>To post content, check this box.</p>
						</span>
					</span>
					<input id="r_box" class="root-box item_published" type="checkbox" hidden <?if($data['published']):?>checked<?endif ?> >
					<label class="root-label" for="r_box">Published</label>
				</div>
			</div>
			
            <? if( !isset( $data['gallery'] ) ): ?>
	            <div class="col-img-1 content-img load_img">
	                <? if($data['img'][0]): ?>
						<img class="img_preview" src="<?=$data['img'][0]?>?<?=rand(0,1000); ?>" onclick="$('.fileload').click()">
	                <? else: ?>
		                <img class="img_preview dn" src="<?=$data['img'][0]?>?<?=rand(0,1000); ?>" onclick="$('.fileload').click()">
		                <span class="load-img-title" onclick="$('.fileload').click()">Add image  1200 x 600 px</span>
	                <? endif; ?>
	                
	                <input type="file" class="fileload" onchange="previewFile()" style="display:none;" />
				</div>
            <? elseif( $data['Id'] > 0 ): ?>
	            <div class="col-img-1 users_panel">
	                <!-- <h5>Permissions users for new gallery access:</h5>
					<? foreach( $data['users'] as $user ): ?>
		                <span class="g-link">
		                <input id="<?=$user['Id']?>" class="root-box" type="checkbox" hidden <?if($user['used']):?>checked<?endif?> >
						<label class="root-label" for="<?=$user['Id']?>"><?=$user['name']?></label>
		                </span>
	                <? endforeach ?> -->
                    <pre><? //print_r($data) ?></pre>
                    <!-- <span class="add-btn" onclick="image_add()">Add new images<b class="fa-plus"></b></span> -->
                    
                    <input type="file" id="fu" name="fileUpload" multiple class="fileUpload" style="display:none">
                    <div class="drop_Zone">                        
                        <span>Images Here</span>
                    </div>



<script>
	var progress = {};
	var tmp = window.location.href;
	var gallery = false;
	
	if (typeof( tmp.split("/")[4] ) == 'undefined' ) {
	    gallery = 'main_gallery';
	} else if( typeof( (tmp.split("/")[4]).split("?")[0] ) == 'undefined' ) {
	    gallery = tmp.split("/")[4];
	} else {
	    gallery = (tmp.split("/")[4]).split("?")[0];
	}
	
	var f = {};
	var c = 1;
	var all_count = f.length;
	var load_files = false;
	var target = false;
	//console.log(gallery);

	$(".drop_Zone").on("click",function() {
	    $("#fu").click();    
	}); 
	   
	$(".drop_Zone").liteUploader({
	    script: "/admin/drop",
	    ref: "fileUpload",
	    rules: {
	        allowedFileTypes: "image/jpeg,image/png,image/gif",
	        //maxSize: 250000
	    },
    params: {
        gallery: gallery,
        id: $(".amc_id").attr("id")
    },
    singleFileUploads: true
	})
		.on("lu:before", function (e, files) {
		$("#ajax_progress").show().find("span").html(c+" / 0%"); 
	})  
	.on("lu:progress", function (e, state) {})  
	.on("lu:success", function (e, data) {
	$("#ajax_progress").show().find("span").html(c+" / "+Math.floor( ( c / f.length ) * 100 )+"%");
	
    c++;
    if (c >= f.length) {
        setTimeout(function() {
            $("#ajax_progress").hide().find("span").html("");
	            var html = $(data).find("#prod_grid").html();
	            var obj_div = $("#prod_grid").html(html);                
	
	            var ids = [];
	            var obj = $(obj_div).find("img");
	            for(i=0;i<obj.length;i++) {
	                ids[i] = $(obj[i]).attr("id");
            }
            
			if (obj.length > 0) {
				apiGallery = jQuery(obj_div).unitegallery(gallery_option);
			
				for (i=0;i<ids.length;i++) {
					var id = ids[i];
					var obj = $(obj_div).find(".ug-thumb-overlay");
					$( obj[i] ).append('<div class="admin-menu fa-caret-down"><ul class="ad-menu"><li onclick="edit('+id+')"><b class="fa-pencil-square-o"></b> Edit</li><li onclick="remove('+id+')"><b class="fa-trash-o"></b> Dell</li></ul></div>');
				}
            }
	    },1000);
    }
	})
		.on("drag dragstart dragend dragover dragenter dragleave drop", function(e) {
		e.preventDefault();
		e.stopPropagation();
	})
		.on("dragover dragenter", function() {
		$(this).addClass("hover");
	})
		.on("dragleave dragend drop", function() {
		$(this).removeClass("hover");
	})
		.on("drop", function(e) {
    f = e.originalEvent.dataTransfer.files;
    //progress = e.originalEvent.dataTransfer.files;
    //$(this).data("liteUploader").startUpload(e.originalEvent.dataTransfer.files);
    
        $(".drop_Zone span").html("load files: "+f.length);
        if (f.length > 0) {
            load_files = e.originalEvent.dataTransfer.files;
            target = this;            
        }    
    c = 1;
	});

	// click uploads
	//============================================
	$("#fu").liteUploader({
	    script: "/admin/drop",
	    rules: {
	        allowedFileTypes: "image/jpeg,image/png,image/gif",
	        //maxSize: 250000
	    },
	    params: {
	      gallery: gallery,
	      id: $(".amc_id").attr("id")
	    },
	    singleFileUploads: true
		})  
		.on("lu:before", function(e, files) {
			$("#ajax_progress").show().find("span").html(c+" / 0%"); 
		})  
		.on("lu:progress", function(e, state) {})  
		.on("lu:success", function(e, data) {
		//console.log(data);
		$("#ajax_progress").show().find("span").html(c+" / "+Math.floor( ( c / f.length ) * 100 )+"%");
	   
	    c++;
	    if (c >= f.length) {
	        setTimeout(function() {
	            $("#ajax_progress").hide().find("span").html("");
	                var html = $(data).find("#prod_grid").html();
	                var obj_div = $("#prod_grid").html(html);                
	
	                var ids = [];
	                var obj = $(obj_div).find("img");
	                for(i=0;i<obj.length;i++) {
	                    ids[i] = $(obj[i]).attr("id");
	                }
	                
		            if( obj.length > 0 ) {
	                    apiGallery = jQuery(obj_div).unitegallery( gallery_option );
	                
	                    for (i=0;i<ids.length;i++) {
	                       var id = ids[i];
	                       var obj = $(obj_div).find(".ug-thumb-overlay");
	                       $( obj[i] ).append('<div class="admin-menu fa-caret-down"><ul class="ad-menu"><li onclick="edit('+id+')"><b class="fa-pencil-square-o"></b> Edit</li><li onclick="remove('+id+')"><b class="fa-trash-o"></b> Dell</li></ul></div>');
	                   }
	                }
		    },1000);
	    }
	    //console.log(data);
	    //console.log(j+1);    
	});
    
    $("#fu").change(function (e) {
        f = e.originalEvent.srcElement.files;
        //console.log(e.originalEvent.srcElement.files);
        //console.log($(this).data("liteUploader"));
        
        $(".drop_Zone span").html("load files: "+f.length);
        if (f.length > 0) {
            load_files = e.originalEvent.srcElement.files;
            target = this;            
        }
        //$(this).data("liteUploader").startUpload(e.originalEvent.srcElement.files);
        //console.log(f);
        c = 1;
    });
</script>

	    </div>
            <? endif; ?>

			<div class="tr">
                <? if (!isset( $data['gallery']) ): ?>
					<span class="save-btn save" onclick="event_gallery(this,'admin/gallery_save_image')">Save <b class="fa-floppy-o"></b></span>
                <? else: ?>
					<span class="save-btn save" onclick="save_gallery(this,'admin/gallery_save_gallery')">Save <b class="fa-floppy-o"></b></span>
                <? endif; ?>
			</div>
		</div>	
	</div>	
</div>

<script>
	var _section = false;
	$(document).ready(function() {
	    _section = $(".c-title").val();
	});

	function previewFile() { 	
	    var file    = document.querySelector('input[type=file]').files[0];
	    var reader  = new FileReader();
	    reader.onloadend = function() {
	        var base64_img = reader.result;		
	        $(".img_preview").attr("src",base64_img).removeClass("dn");
	        $(".load-img-title").hide();
	    }
	    if (file) {
	        reader.readAsDataURL(file);
	    }
	}
	
	function save_gallery( _this, url ) {
	    var _this_obj = $( _this ).parents();
	    var id = $( $( _this ).parents()[1] ).attr("id");    
	    var section = $(_this_obj).find(".c-title").val();
    
	    var published = 0;
	    if ( $(_this_obj).find(".item_published:checked")[0] ) {
	        published = 1;
	    }
	    
	    var users = $(".users_panel").find("input[type=checkbox]:checked");
	    var users_id = [];
	    for (i=0;i<users.length;i++) {
	        users_id[i] = $(users[i]).attr("id");
	    }
	    
	    item_data = {
	        Id: id,
	        published: published,
	        users_id: users_id,
	        section: encodeURIComponent(section)            
	    };    
	    $.ajax({
	        type: "POST",            
	        url: url,
	        data: item_data,
            headers: {
                'Cache-Control': 'no-cache, no-store, must-revalidate', 
                'Pragma': 'no-cache', 
                'Expires': '0'
            },
	        success: function( data ) { 
	            console.log(data);
                if( data.trim() != 'duplicated' ) {
                    $("#message_success").removeClass("dn").fadeIn(1000,function() {
                        setTimeout(function() {
                            $("#message_success").fadeOut(1000,function() {
                                if ( _section != section ) {
                                    window.location.href = '/gallery/'+data+'?edit';    
                                }
                            });
                        },2000);
                    });                    
                } else {
                    $("#message_err").removeClass("dn").html("Name already exists").fadeIn(1000,function() {
                        setTimeout(function() {
                            $("#message_err").fadeOut(1000,function(){});
                        },2000);
                    });
                    
                }
	        }
	    });
        if ( load_files ) {
            $(target).data("liteUploader").startUpload(load_files);
            load_files = false;
            target = false;
            $(".fa-close").click();
        }
        
    }
	
	function event_gallery( _this, url ) {
	    var _this_obj = $( _this ).parents();
	    var id = $( $( _this ).parents()[1] ).attr("id");
	    if ( id ) {
	        var title = $(_this_obj).find(".c-title").val();
	
			var section = location.href;            
			section = (section.split('/')[4]).split("?")[0];
            if( typeof(section) == 'undefined' ){
                section = 'main_gallery';
            }
	       
	        var published = false;
	        if ( $(_this_obj).find("input[type=checkbox]:checked")[0] ){
	            published = true;
	        }
	        var img = $(_this_obj).find(".img_preview").attr("src");
	        
	        item_data = {
	            Id:id,
	            name:encodeURIComponent(title),
	            published: published,
				section: section,
	            img:img
	            
	        };

	        $.ajax({
	            type: "POST",            
	            url: url,
	            data: item_data,
                headers: {
                    'Cache-Control': 'no-cache, no-store, must-revalidate', 
                    'Pragma': 'no-cache', 
                    'Expires': '0'
                },
	            
	            //loading...
	            beforeSend: function() {                
	                $("#ajax_progress").show().find("span").html( "0%" );
	            },
	            xhr: function() {
	                var xhr = new window.XMLHttpRequest();
	                xhr.upload.addEventListener("progress", function(evt) {
	                    if (evt.lengthComputable) {
	                        var percentComplete = ( evt.loaded / evt.total ) * 100;
	                        percentComplete = Math.floor( percentComplete ) + '%';
	                        $("#ajax_progress span").html( percentComplete );
	                        if( percentComplete == '100%' ) {
	                            //$("#ajax_progress").hide();
	                        }
	                    }
	                }, false);            
	                
	                return xhr;
	            },
	            //endloading...
	            
	            success: function( data ) {
	                $("#ajax_progress").hide();
	                apiGallery.destroy();
	                
	                var html = $(data).find("#prod_grid").html();
	                var obj_div = $("#prod_grid").html(html);                
	
	                var ids = [];
	                var obj = $(obj_div).find("img");
	                for(i=0;i<obj.length;i++) {
	                    ids[i] = $(obj[i]).attr("id");
	                }
	                if( obj.length > 0 ) {
	                   apiGallery = jQuery(obj_div).unitegallery( gallery_option );
                       
    	                for(i=0;i<ids.length;i++) {
    	                    var id = ids[i];
    	                    var obj = $(obj_div).find(".ug-thumb-overlay");
    	                    $( obj[i] ).append('<div class="admin-menu fa-caret-down"><ul class="ad-menu"><li onclick="edit('+id+')"><b class="fa-pencil-square-o"></b> Edit</li><li onclick="remove('+id+')"><b class="fa-trash-o"></b> Dell</li></ul></div>');
    	                }
	                }	                
	            }
	        });
	        $("#ajax_modal_content").html("");
	    }
	}
    
    function input_latin(obj) {
        if (/^[a-zA-Z0-9 ,.\-:"()]*?$/.test(obj.value)) obj.defaultValue = obj.value;      
        else obj.value = obj.defaultValue;
    }
    //gallery_edit(this, '<?=$_GET['section']?>')
    //gallery_remove('<?=$_GET['section']?>')
</script>

