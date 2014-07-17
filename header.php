<?php

/********************************************************************************************/
/*	medicine creek 																			*/
/*	header.php																				*/
/* 	Displays all of the <head> section and everything up till site banner					*/
/*	Includes responsive 'hamburger' nav, hidden for larger screen widths					*/
/*	Banner uses css-tricks span hack for responsive background image						*/
/********************************************************************************************/

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Medicine Creek - <?php if ( is_front_page( ) ) { echo "Home"; } else { wp_title( '' ); } ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<nav id="site-navigation" class="main-navigation" role="navigation">
		
		<div class="hamburger">
			<a id="hamburger-button" href="#">
				<span class="icon-bars"></span>&nbsp;&nbsp;Medicine Creek
			</a>
		</div>
		
		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		
	</nav><!-- #site-navigation -->
		
	<div class="site-content">
	
		<header class="site-header" role="banner">
			<a href="http://medicinecreek.co.uk">
				<span class="header-img" role="img" aria-label="Medicine Creek logo">
					<span class="header-img-inner"></span>
				</span>
			</a>
		</header><!-- /site-header -->

	
