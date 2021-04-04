<!-- Head -->
<?php //include ("../include/head.php");?>

<!-- Header -->
<?php //include ("../include/header_page.php");?>

<!-- Main content -->	
<main class="content-page animate third_bottom">
    <?
	    $title = $data['name'];
	    if( $data['href'] == 'main_gallery' ){
	        $title = '';
	    }
    ?>
    <h1 class="page-h1">Gallery <?=$title?></h1>
	<!-- Gallery -->
	<div class="gallery-wrap">
        <? if( isset( $data['user']['admin'] ) || isset( $data['user']['moder'] ) ): ?>
        <div class="admin-menu fa-caret-down">
            <ul class="ad-menu">
                <li onclick="gallery_edit(this, '<?=$data['href']?>')"><b class="fa-pencil-square-o"></b> Edit</li>
                <? if( $data['href'] != 'main_gallery' ): ?>
                    <li onclick="gallery_remove('<?=$data['href']?>')"><b class="fa-trash-o"></b> Dell</li>
                <? endif ?>
            </ul>
        </div>
        <? endif ?>
        <figure id="prod_grid">
	        <? foreach( $data['images'] as $item ): ?>
	            <img id="<?=$item['Id']?>" src="images/gallery/<?=$data['href']?>/thumbs_img/<?=$item['thumbs']?>?<?=rand(0,1000);?>" data-image="images/gallery/<?=$data['href']?>/<?=$item['file_name']?>?<?=rand(0,1000);?>" alt="Gallery Image" data-description="">
	        <? endforeach ?>
        </figure>
        <? if( isset( $_GET['edit'] ) ): ?>
	        <script>
	            $(document).ready(function(){
	                setTimeout(function(){
	                    $( $(".gallery-wrap").find(".ad-menu").find("li")[0] ).click();     
	                }, 1000);
	            });
	        </script>
        <? endif ?>
        
        <script>
	        // Gallery settings
	        var gallery_option = {
	            gallery_width:"100%",	
	            gallery_min_width: 400,            		
	            tiles_type:"nested",
	            
	            tiles_space_between_cols: 10, 
	            tile_show_link_icon:false,
	            tile_enable_textpanel:false,
	            tile_min_columns: 2, 		
	            tile_link_newpage: false,
	            tile_space_between_icons: 26
	        };
	        
	        /*//sort images...
	        $(document).ready(function(){
	            $( ".ug-tiles-wrapper" ).sortable({
	                tolerance: "pointer",
	                handle: ".ug-thumb-overlay"
	            }).on( "sortstop", function() {                
	                items_list = $(this).sortable("toArray");
	                console.log("sort:>"+items_list);
	            });
	            $( ".ug-tiles-wrapper" ).disableSelection(); 
	        });*/
            
            // Gather id images before aploads gallery
	        var ids = [];
	        var obj = $("#prod_grid").find("img");
	        for(i=0;i<obj.length;i++) {
	            ids[i] = $(obj[i]).attr("id");
	        }
	        // Dell image
	        function remove( id ) {	            
	            $(".ug-lightbox-button-close").click();
	            confirm_popup('Remove this image?', function() {
	                $("#ajax_preloader").show();	                
	                $.ajax({
	                    type: "POST",
	                    url: "/admin/remove_gallery_items",
	                    data: "id="+id,
	                    beforeSend: function() {                
	                        apiGallery.destroy();
	                    },
	                    success: function( data ) {
	                        $("#ajax_preloader").hide();
                            
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
	            });
	        }
	        // Edit images
	        function edit( id ) {
	            $(".ug-lightbox-button-close").click();
                $("#ajax_preloader").show();
	            $.ajax({
	                type: "POST",
	                url: "/admin/editimage",
	                data: "id="+id,
	                success: function( res ) {
	                    $("#ajax_preloader").hide();
	                    $("#ajax_modal_content").html(res);
	                    //console.log(res);
	                }
	            });            
	        }	
	        <?if( $data['user']['admin'] || $data['user']['moder'] ):?>
	        // Menu edit images
	        $(document).ready(function() {            
	            for(i=0;i<ids.length;i++) {
	                var id = ids[i];
	                var obj = $("#prod_grid").find(".ug-thumb-overlay");
	                $( obj[i] ).append('<div class="admin-menu fa-caret-down"><ul class="ad-menu"><li onclick="edit('+id+')"><b class="fa-pencil-square-o"></b> Edit</li><li onclick="remove('+id+')"><b class="fa-trash-o"></b> Dell</li></ul></div>');
	            }                        
	        });
	        <?endif?>
	        // Add image
	        function image_add() {
	            $("#ajax_preloader").show();
	            $.ajax({
	                type: "POST",
	                url: "/admin/addimage",
	                success: function( res ) {
	                    $("#ajax_preloader").hide();
	                    $("#ajax_modal_content").html(res);
	                    //console.log(res);
	                }
	            });  
	        }
	        // New gallery
	        function new_gallery() {
	            $("#ajax_preloader").show();
	            $.ajax({
	                type: "POST",
	                url: "/admin/addgallery",
	                success: function( res ) {
	                    $("#ajax_preloader").hide();
	                    $("#ajax_modal_content").html(res);
	                    console.log(res);
	                }
	            });
	        }
	        // Edit gallery
	        function gallery_edit( _this, id ) {
                $("#ajax_preloader").show();
	            $.ajax({
	                type: "POST",
	                data:{id:id},
	                url: "/admin/editgallery",
	                success: function( res ) {
	                    $("#ajax_preloader").hide();
	                    //console.log(res);
	                    $("#ajax_modal_content").html(res);
	                }
	            });
	        }
	        // Dell gallery
	        function gallery_remove( id ) {
	            confirm_popup( 'Remove?', function() {
                    $("#ajax_preloader").show();
	                $.ajax({
	                    type: "POST",
	                    data:{id:id},
	                    url: "/admin/removegallery",
	                    success: function( res ) {
	                        //console.log(res);
	                        if( res ){
	                            window.location.href = '/gallery';
	                        }
	                    }
	                });
	            });
	        }
        </script>
	</div>
</main><!-- END Main content -->