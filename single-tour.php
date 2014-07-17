<?php

/********************************************************************************************/
/*	medicine creek 																			*/
/*	single-tour.php																			*/
/* 	Just included so I can see what a tour post looks like from the WP admin				*/ 
/********************************************************************************************/

get_header(); ?>

	<main class="site-main" role="main">
		
		<div class="content-1">
							
			<?php // query_posts('post_type=tour'); ?>
			
			<?php while ( have_posts() ) : the_post(); ?>

				<div class="text-box add-bottom">
					
					<p class="headline"><?php the_title(); ?></p>
					
					<?php $post_id = get_the_ID(); ?>
					<?php $tour_date = get_post_meta( $post_id, 'tour_date_date', true ); ?>
					<?php $tour_date_venue = get_post_meta( $post_id, 'tour_date_venue', true ); ?>
					<?php $tour_date_venue_url = get_post_meta( $post_id, 'tour_date_venue_url', true ); ?>
					<?php $tour_date_location = get_post_meta( $post_id, 'tour_date_location', true ); ?>
					
					<p>Date: <?php echo $tour_date; ?></p>
					<p>Venue: <a href="<?php echo $tour_date_venue_url; ?>"><?php echo $tour_date_venue; ?></a></p>
					<p>Location: <?php echo $tour_date_location; ?></p>
					
					<?php the_content(); ?>
				</div>					
					
			<?php endwhile; // end of the loop. ?>

		</div> <!-- /content-1 -->
		
	</main>

<?php get_footer(); ?>