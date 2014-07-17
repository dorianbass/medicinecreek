<?php

/********************************************************************************************/
/*	medicine creek 																			*/
/*	page-music.php 																			*/
/* 	Page template for 'music' page - includes bandcamp music player							*/ 
/********************************************************************************************/

get_header(); ?>

<?php
	// Retrieve url of featured image
	$image_id = get_post_thumbnail_id();
	$image_array = wp_get_attachment_image_src( $image_id, 'large' );
?>

	<main id="main" class="site-main" role="main">
	
		<div class="content-1">
			
			<div class="text-box">
		
				<?php while ( have_posts() ) : the_post(); ?>
								
				<?php the_content(); ?>

				<?php endwhile; ?>
			
				<iframe style="border: 0; width: 350px; height: 621px; margin-bottom: 1em;" class="resp-img music-player" src="http://bandcamp.com/EmbeddedPlayer/album=2819176155/size=large/bgcol=ffffff/linkcol=0687f5/transparent=true/" seamless>
					<a href="http://medicinecreek.bandcamp.com/album/medicine-creek">Medicine Creek by Medicine Creek</a>
				</iframe>
			
			</div>
		
		</div> <!-- /content-1 -->
		
		<div class="content-2">
		
			<img src="<?php echo $image_array[0]; ?>" class="resp-img photo" />
		
			<?php get_template_part( "twitter" ); ?>
		
		</div> <!-- /content-2 -->
	
	</main>

<?php get_footer(); ?>