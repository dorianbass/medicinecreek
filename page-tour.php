<?php

/********************************************************************************************/
/*	medicine creek 																			*/
/*	page-tour.php 																			*/
/* 	Page template for 'tour' page - includes customised loop and custom fields				*/ 
/********************************************************************************************/

get_header(); ?>

	<main id="main" class="site-main" role="main">
	
<?php 
	// Retrieve url of featured image
	$image_id = get_post_thumbnail_id();
	$image_array = wp_get_attachment_image_src( $image_id, 'large' );
?>
	
	<div class="content-1">
	
<?php
	// Get today's date to use as comparison against gig dates
	$today_num = date( 'Ymd' );
	
	// Create meta_query to only select posts where gig date is today or later
	$meta_query = array( 
		'key' => 'tour_date_date',
		'value' => $today_num,
		'type' => 'numeric',
		'compare' => '>='
	);
	
	// Create loop arguments to select from 'tour' post type and order by gig date
	$args = array(
		'post_type' => 'tour',
		'posts_per_page' => -1,
		'meta_query' => array ( $meta_query ),
		'meta_key' => 'tour_date_date',
		'orderby' => 'meta_value_num',
		'order' => 'ASC'
	);
	
	// Initiate custom loop
	$loop = new WP_Query( $args );
	
	while ( $loop->have_posts() ) : $loop->the_post();

		// Retreive values for custom fields in current post
		$post_id = get_the_ID();
		$date = get_post_meta( $post_id, 'tour_date_date', true );
		$venue = get_post_meta( $post_id, 'tour_date_venue', true );
		$venue_url = get_post_meta( $post_id, 'tour_date_venue_url', true );
		$location = get_post_meta( $post_id, 'tour_date_location', true );
		
		// Convert mySQL DATE to UNIX timestamp for all date info
		$phpdate = strtotime( $date );
		
		// Create associative array of date components, retrieve date
		$date_array = getdate( $phpdate );
		$gig_month = $date_array['month'];
		$gig_day = $date_array['mday'];	
			
		// Format date to MMM and DD
		if ( strlen($gig_day) == 1 ) { $gig_day = "0" . $gig_day; } 
		$gig_month = strtoupper( substr($gig_month,0,3) );
		
		// Add anchor link to venue if specified
		if ( $venue_url ) {
			$venue = '<a href="' . $venue_url . '"> ' . $venue . '</a>';
		}		
?>

		<div class="text-box">
		
			<div class="gig-row">
				
				<div class="gig-date">
					<span class="gig-month"><?php echo $gig_month; ?></span>
					<span class="gig-day"><?php echo $gig_day; ?></span>
				</div>

				<div class="gig-details">
					<span class="gig-location"><?php echo $venue; ?>,&nbsp;<?php echo $location; ?></span>
				</div>

			</div>					
		</div>

<?php endwhile; ?>
	
	</div> <!-- /content-1 -->
	
	<div class="content-2">
	
		<img src="<?php echo $image_array[0] ?>" class="resp-img photo" />
	
		<?php get_template_part( "twitter" ); ?>
	
	</div> <!-- /content-2 -->
		
	</main><!-- #main -->

<?php get_footer(); ?>
