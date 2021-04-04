<link rel="stylesheet" href="/css/admin_pages.css">

<div id="add_content_wrap" class="win-modal-wrap fade-up">
	<div id="add_content" class="admin-modal win-modal">
		<span class="fa-close" onclick="javascript: $('#add_content_wrap').hide()" title="Закрыть"></span>
        
		<!-- <span class="modal-tips tip-err">Data Error</span> -->
        
        <? //print_r( $data ) ?>
        
		<? if ($data['Id']): ?>
        	<div class="admin-modal-title">Edit content: #<?=$data['Id']?></div>
        <? else: ?>
        	<div class="admin-modal-title">Add content</div>
        <? endif; ?>
        
		<div class="admin-modal-content" id="<?=$data['Id']?>">
			<div class="content-type flex sb">
				<!-- Select content type -->
				<div class="flex type_content">
					<span class="c-sign">Select content type</span>                
					<!-- Content 1 col -->
					<input id="col_1" class="c-inp" type="radio" name="col" data-type="col-1" hidden <? if ($data['type']=='col-1'):?>checked<? endif ?> >
					<label class="c-type col-type-1" for="col_1" title="Content in 1 col"></label>
					<!-- Content 2 cols -->
					<input id="col_2" class="c-inp" type="radio" name="col" data-type="col-2" hidden <? if ($data['type']=='col-2'):?>checked<? endif ?> >
					<label class="c-type col-type-2" for="col_2" title="Content in 2 cols"></label>
				</div>
				<!-- Published this content block -->
				<div class="content-publ">
					<span class="tips-wrap">
						<span class="tips-text">
							<p>To post content, check this box.</p>
						</span>
					</span>
					<input id="r_box" class="root-box" type="checkbox" hidden <? if ($data['published']): ?>checked<?endif?> >
					<label class="root-label" for="r_box">Published</label>
				</div>
			</div>

			<!-- Content Title -->
			<div class="content-title content-input-block">
				<input class="c-title" type="text" placeholder="Enter content title" value="<?=$data['name']?>" >
			</div>
		
         			
            <? // print_r( $data ); ?>
            
            
        	<!-- Select image or video -->
			<div class="content-type flex more_content">
				<span class="c-sign">Select image or video</span>

				<input id="img_area" class="c-inp" type="radio" name="col_2" data-type="img" hidden <? if (empty($data['content_href'])):?>checked<? endif ?> >
				<label class="img-type" for="img_area" title="Images area"></label>

				<input id="youtube_area" class="c-inp" type="radio" name="col_2" data-type="video" hidden <? if (!empty($data['content_href'])): ?>checked<? endif ?> >
				<label class="img-type yot-type" for="youtube_area" title="Youtube area"></label>                  
			</div>           
            <!-- Youtube Link -->
            <div class="content-input-block">
				<input class="c-title c-link" id="youtube" type="text" placeholder="Enter link to youtube" name="content_href" value="<?=$data['content_href']?>" <? if (empty($data['content_href'] )):?>style="display:none"<? endif ?> > 
			</div> 

            <div class="col-img-1 content-img load_img">
	            <!-- Add img -->
                <div class="img_box" <? if( !empty( $data['content_href'] )): ?>style="display:none;"<? endif ?> >
                    <? if( isset( $data['img'] )): ?>
    					<img class="img_preview" src="<?=$data['img'][0]?>" onclick="$('.fileload').click()">
    				<? else: ?>
                    	<img class="img_preview dn" src="" onclick="$('.fileload').click()">
    					<span class="load-img-title" onclick="$('.fileload').click()">Add image  1200 x 600 px</span>
                    <? endif; ?>
                    <input type="file" class="fileload" onchange="previewFile()" style="display:none">
                </div>             
                <!-- Youtube Video -->
                <div class="fr_box" <? if( empty( $data['content_href'] )):?>style="display:none"<? endif ?> >
                    <iframe width="100%" height="400" src="https://www.youtube.com/embed/<?=$data['content_href']?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>                
                </div>
			</div>
			
            <div class="content-text-wrap">
				<textarea name="editor" rows="8" placeholder="Description text"><?=$data['content']?></textarea>
			</div>
			
			<!-- Add link to gallery -->
			<div class="content-type">
				<span class="tips-wrap">
					<span class="tips-text">
						<p>If this artist has a gallery, you can add a link to this page.</p>
					</span>
				</span>
                <?
                	$this->data['route'] = end( explode("/", $_SERVER['HTTP_REFERER']) );
					if ( empty( $this->data['route'] ) ) {
                    	$this->data['route'] = 'main';
	                }
	                $route = preg_replace( "/\?.*/", "", $this->data['route'] );
	                ${$this->data['route']} = true;
                ?>
                <? if ( isset( $music ) ):  ?>
				    <input id="a_gal" class="add-gal-box" type="checkbox" hidden <?if(!empty($data['gallery_href'] )):?>checked<?endif?> >
				    <label class="add-gal-link" for="a_gal">Add link to music</label>
                <? else: ?>
				    <input id="a_gal" class="add-gal-box" type="checkbox" hidden <?if(!empty($data['gallery_href'] )):?>checked<?endif?> >
				    <label class="add-gal-link" for="a_gal">Add link to gallery</label>
                <? endif; ?>
			</div>
		    <!-- gallery -->
			<div class="content-input-block">
				<!-- Show input for gallery link -->
				<form class="content-title" id="more" <?if(empty($data['gallery_href'])):?>style="display:none"<?endif?> >
                    <!-- <input class="c-title c-link" id="youtube" type="text" placeholder="Enter link to youtube" name="content_href" value="<?=$data['content_href']?>" > -->
                    <? if ( isset( $music ) ): ?>
                        <input class="c-title c-link" type="text" id="gallery_href" placeholder="Enter link to the artist" name="gallery_href" value="<?=$data['gallery_href']?>" >
                    <? else: ?>
                        <input class="c-title c-link" type="text" id="gallery_href" placeholder="Enter link to the gallery" name="gallery_href" value="<?=$data['gallery_href']?>" >
                    <? endif; ?>
				</form>
			</div>				
			
			
			<div class="tr">
				<span class="save-btn save" onclick="event_admin(this,'admin/save')">Save <b class="fa-floppy-o"></b></span>
			</div>
		</div>	
	</div>	
</div>

<script>
	// Отображение подсказки размера загружаемого изображения
	$(document).ready(function() {
	    $(".type_content input[type=radio]").click(function() {
	        var type = $(this).data().type;
	        if ( type == 'col-1' ){
	            $(".load-img-title").html("Add image  1200 x 600 px");
	        } else {
	            $(".load-img-title").html("Add image  800 x 500 px");
	        }
	    });
	    $( ".content-type" ).find("input[type=radio]:checked").click();
	});
    
    //
    $(document).ready(function() {
        $("#a_gal").on("click", function() {
            if ( $("#a_gal").is(':checked') ) {
                $(".content-title#more").show();
            } else {
                $(".content-title#more").hide();
            }
        });
        $("#youtube").on("change paste keyup", function() {
            if ( $(this).val() != '' ) {
                $(".fr_box").show().find("iframe").attr("src","https://www.youtube.com/embed/"+$(this).val());
                //$(".img_box").hide();
            } else {
                //$(".fr_box").hide();
                //$(".img_box").show();
            }
        });       
        $(".more_content input[type=radio]").click(function() {
            var type = $(this).data().type;
            if (type == 'video') {
                $("#youtube").show();
                $(".fr_box").show();
                $(".img_box").hide();
            } else {
                $("#youtube").hide();
                $(".fr_box").hide();
                $(".img_box").show();
            }            
        });
    });
	
	// Загрузка изображения для создаваемого контентного блока
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
	// Текстовый редактор	
	CKEDITOR.replace('editor');
</script>
