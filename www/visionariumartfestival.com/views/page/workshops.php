<!-- Head -->
<?php //include ("../include/head.php"); ?>

<!-- Header -->
<?php //include ("../include/header_page.php"); ?>

<!-- Main content -->	
<main class="content-page animate third_bottom">		
    <h1 class="page-h1">Workshop</h1>
    <!-- Section Gallery -->
	<section class="article-wrap col-1 rise block-up">
		<div class="gallery-wrap">
			<figure id="prod_grid" class="unite-gallery-wrap">
				<? $files = glob("images/workshops/*.*");
	                foreach($files as $path) {
						?>
							<img src="<?=$path?>" data-image="<?=$path?>" data-description="" alt="Gallery Image" style="display:none">
						<?                    
	                }
				?>				
			</figure>	
		</div>
	</section><!-- END Section Gallery -->
	
	<section class="article-wrap col-1 rise block-up">	
		<!-- Page Text -->
		<div class="article-item">
			<h2>Workshop area</h2>		
			<div class="art-text-block">	
<!--
				<p>Workshop area - It is the place where art is born, collaboration or solo live art painting.
					In the workshop area, you can find the most interesting program for those who want to learn,
					there will be taught varied art techniques, pottery, art lessons, lectures and presentation
					of year study programs at different art schools and Academies.</p>
				<p>Presentation of “The Vienna Academy of Visionary Art” Led by Laurence Caruana and Florence 
					Menard which are unique for their approach Each class is taught by skilled professionals 
					who transmit their value of craft while sharing insights into the artist’s vocation.</p>
				<p>At the heart of our programme is the painter’s quest for Original Vision, expressed
					in a unique and refined manner. By promoting cultural ideals of craftsmanship, beauty,
					and style, we celebrate the individual emergence of creativity and genius.</p>
				<p>Laurence Caruana - Lecture - The History of Visionary Art And Figure Drawing, Oil techniques.</p>		
				<p>IhtiAnderson- Platonic shapes workshop, UV Art 3D painting on Black Background. 
					Ebrew The Golden Ratio Perspective</p>
				<p>Artist workshop ticket will allow Full participation in all the workshops on the Festival 
					grounds - VR experience, Oil, figure drawing, the golden cut( Ratio), perspective, 
					UV acrylic painting - creation of 3D objects in your own space, platonic shapes - building
					with sticks and Ebru technique.</p>
-->
					
				<p>Dear Guest In our Festival you can find variety of workshops and Lectures:</p>
				<p>History of Visionary Art- Lecture</p>
				<p>Presentation of Robert Venosa and Martina Hoffmann Art
				<p>- Composition</p>
				<p>- Figure Drawing</p>
				<p>- Ebrew Technique</p> 
				<p>- Platonic shapes and 3D Modeling</p> 
				<p>- UV painting on Black tissue</p>
				<p>- Decalcomania</p>
				<p>- VR experience</p>

				<p>Artist workshop ticket will allow participation in all the workshops on the Festival grounds - VR experience, Oil, Model sketching, the golden cut, perspective, UV acrylic painting - creation of 3D objects in your own space, platonic shapes building with sticks and Ebru technique.</p>

				<p>You may buy single workshop tickets in the Gallery Shop or on the entrance gate to the festival at your arrival.</p>
				<p>Single workshop ticket costs 35 euro.</p>
				<p>Single VR experience ticket costs 25 euro.</p>
					
					
					
			</div>
		</div>
	</section><!-- END Page Text -->
</main><!-- END Main content -->

<!-- footer -->
<?php //include ("../include/footer.php"); ?>