<?php

/********************************************************************************************/
/*	medicine creek 																			*/
/*	front-page.php 																			*/
/* 	Custom template for home page - includes blog posts, EP details and other content		*/ 
/********************************************************************************************/

get_header(); ?>

<?php
	// Retrieve url of featured image
	$image_id = get_post_thumbnail_id();
	$image_array = wp_get_attachment_image_src( $image_id, 'large' );
?>

	<main class="site-main" role="main">
		
		<div class="content-1">
		
			<h2>Latest News:</h2>
			
			<?php query_posts('post_type=post'); ?>
			
			<?php while ( have_posts() ) : the_post(); ?>

				<article class="text-box">
					
					<header>
						<h3 class="headline"><?php the_title(); ?></h3>
						<p class="story-date"><?php the_date(); ?></p>
					</header>
					
					<?php the_content(); ?>
				</article>					
					
			<?php endwhile; // end of the loop. ?>
			
			<h2>Medicine Creek EP:</h2>

			<img src="<?php bloginfo('template_url'); ?>/img/ep_cover.jpg" class="resp-img photo" />
				
			<div class="text-box">				
				<p>Debut EP 'Medicine Creek' available now!<p>
				<p><a href="http://medicinecreek.bandcamp.com/" target="_new">Listen / download at Bandcamp</a></p>
			</div>		

		</div> <!-- /content-1 -->
		
		<div class="content-2">
		
			<img src="<?php echo $image_array[0]; ?>" class="resp-img photo" />
					
			<?php get_template_part( "upcoming_gigs" ); ?>

			<?php get_template_part( "mailing_list" ); ?>

			<?php get_template_part( "twitter" ); ?>
		
		</div> <!-- /content-2 -->
		
	</main>

<?php get_footer(); ?>