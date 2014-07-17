<?php

/********************************************************************************************/
/*	medicine creek 																			*/
/*	page-about.php 																			*/
/* 	Page template for 'about' page - includes customised loop and custom fields				*/ 
/********************************************************************************************/

get_header(); ?>

	<main id="main" class="site-main" role="main">
	
<?php
	// Retrieve all posts from the custom type 'about', ordered by the custom 'about_post_order' field

	$args = array(
		'post_type' => 'about',
		'key' => 'about_post_order',
		'orderby' => 'meta_value_number',
		'order' => 'ASC'
	);
	
	$loop = new WP_Query( $args );
	
	while ( $loop->have_posts() ) : $loop->the_post();

		// Retrieve url of featured image
		$image_id = get_post_thumbnail_id();
		$image_array = wp_get_attachment_image_src( $image_id, 'medium' );	
?>
		<article class="content-wrapper">

			<div class="content-3">
			<img src="<?php echo $image_array[0]; ?>" class="resp-img photo" />
			</div>
			
			<div class="content-4">
				<div class="text-box">
					<?php the_content(); ?>
				</div>	
			</div>
		
		</article>

<?php endwhile; ?>
		
	</main><!-- #main -->

<?php get_footer(); ?>
