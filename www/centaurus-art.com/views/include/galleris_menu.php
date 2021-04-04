<!-- Navigating other art galleries -->
<div class="nav-galleries-wrap bl-shad">
	<div class="nav-galleries-title">
        <!-- <span class="g-link" onclick="new_gallery()">+ Add New Gallery</span> -->
        Galleries of other artists
    </div>    
	<div class="nav-galleries flex ajax_content">
		<? foreach( $data['gallery'] as $item ): ?>
            <? if( $item['href'] != 'main_gallery' ): ?>
                <a class="g-link" href="/gallery/<?=$item['href']?>" title="To the artist's gallery"># <?=$item['name']?></a>
            <? endif ?>
        <? endforeach ?>
	</div>
</div>
