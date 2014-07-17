<?php

/********************************************************************************************/
/*	medicine creek 																			*/
/*	page.php																				*/
/* 	This template displays all pages by default.  It will attempt to retrieve and display	*/
/*  the featured image and all posts for the page in the default 2 column responsive grid	*/
/*	used in this theme.																		*/ 
/********************************************************************************************/

get_header(); ?>

<?php
	// Retrieve url of featured image
	$image_id = get_post_thumbnail_id();
	$image_array = wp_get_attachment_image_src( $image_id, 'large' );
?>

	<main class="site-main" role="main">
		
		<div class="content-1">

			<div class="text-box">

				<?php while ( have_posts() ) : the_post(); ?>	

					<?php the_content(); ?>
					
				<?php endwhile; // end of the loop. ?>
			
			</div> <!-- /text-box -->
			
		</div> <!-- /content-1 -->
		
		<div class="content-2">
		
			<img src="<?php echo $image_array[0]; ?>" class="resp-img photo" />
			
		</div> <!-- /content-2 -->
		
	</main>

<?php get_footer(); ?>
