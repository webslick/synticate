<!-- Main content -->	
<main class="content-page animate third_bottom">
	<h1 class="page-h1">Music</h1>
	
	<!-- Artist Big ban_1 -->
	<section class="article-wrap flex sb col-1 rise block-up">

        <!-- Article list -->
        <? //print_r( $data['items'] ); ?>
        <? foreach( $data['items'] as $item ): ?>
			<article class="article-item art-<?=$item['type']?>" id="<?=$item['Id']?>">
				<div class="flex sb">
	                <h2><?=$item['name']?></h2>
	                <? if( $data['user']['admin'] || $data['user']['moder'] ): ?>
	                <div class="admin-menu fa-caret-down">
	                	<ul class="ad-menu">
	                		<li onclick="load_modal(this, 'admin/edit?id=<?=$item['Id']?>')"><b class="fa-pencil-square-o"></b> Edit</li>
	                		<li onclick="remove_admin(this, 'admin/remove?id=<?=$item['Id']?>')"><b class="fa-trash-o"></b> Dell</li>
	                	</ul>
	                </div>
	                <? endif ?>
	            </div>
	            
	            <? if( empty( $item['content_href'] ) ): ?>
	                <figure class="art-img-block">
	                    <? //print_r( $item ) ?>
	                    <? if( $item['img'][0] != 'no_img.jpg' ): ?>			
	    					<img class="art-img" src="/images/<?=$data['link']?>/<?=$item['img'][0]?>" alt="<?=$item['name']?>">		
	                    <? else: ?>
	                    	<img class="art-img" src="/img/no-image.jpg" alt="No image">
	                    <? endif; ?>
					<!-- <img class="img-load" src="/img/loading_800x333.jpg"> -->
	                    <!-- loader -->
	                    <div class='cssload-loader img-preloader main-preloader'>
							<div class='cssload-inner cssload-one'></div>
							<div class='cssload-inner cssload-two'></div>
							<div class='cssload-inner cssload-three'></div>
						</div>
						<!-- <span class="img-preloader main-preloader"></span> -->
	                </figure>
	            <? else: ?>            
	                <div class="art-video-block">
	    				<iframe width="100%" height="400" src="https://www.youtube.com/embed/<?=$item['content_href']?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
	    			</div>
	            <? endif; ?>
	            
				<div class="art-text-block">
	                <div class="text-block">
	                    <?=$item['content']?>
	                </div>
	                <? if( !empty( $item['gallery_href'] )): ?>
                        <div class="art-text-block">
                            <img class="scl-icon" src="/img/soundcloud-icon.png" alt="Soundcloud icon">
                            <a class="scl-link" href="<?=$item['gallery_href']?>" target="_blank"><?=$item['gallery_href']?></a>
                        </div>
	                <? endif ?>
				</div> 			
			</article>
        <? endforeach ?>
	</section><!-- END Articles List col-2 -->
</main><!-- END Main content -->
