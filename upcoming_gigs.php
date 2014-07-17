<?php

/********************************************************************************************/
/*	medicine creek 																			*/
/*	upcoming_gigs.php																		*/
/* 	Include file which outputs brief details of the next three gigs into a text box			*/
/********************************************************************************************/

?>

<h2>Upcoming Gigs:</h2>

<div class="text-box">
	
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
		'posts_per_page' => 3,
		'meta_query' => array ( $meta_query ),
		'meta_key' => 'tour_date_date',
		'orderby' => 'meta_value_num',
		'order' => 'ASC'
	);
	
	// Initiate custom loop
	$loop = new WP_Query( $args );
	
	while ( $loop->have_posts() ) : $loop->the_post();
	
		// Retrieve custom fields
		$post_id = get_the_ID(); 
		$tour_date = get_post_meta( $post_id, 'tour_date_date', true );
		$tour_date_venue = get_post_meta( $post_id, 'tour_date_venue', true );
		$tour_date_venue_url = get_post_meta( $post_id, 'tour_date_venue_url', true ); 
		$tour_date_location = get_post_meta( $post_id, 'tour_date_location', true );
	
		// Convert YYYYMMDD DATE to UNIX timestamp, format to DD/MM/YYYY
		$phpdate = strtotime($tour_date);
		$tour_date_formatted = date("d/m/Y", $phpdate);
		
		$html = '<div class="upcoming-row"><div class="upcoming-date"><b>' . $tour_date_formatted . '</b></div><div class="upcoming-text">';
		
		if ( $tour_date_venue_url ) {
			$html .= '<a href="' . $tour_date_venue_url . '">' . $tour_date_venue . '</a>, ' . $tour_date_location . '</div></div>';
		} else {
			$html .= $tour_date_venue . ', ' . $tour_date_location . '</div></div>';
		}
		
		echo $html . PHP_EOL;

	endwhile;
?>

</div>