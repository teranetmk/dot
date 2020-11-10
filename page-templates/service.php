<?php
/**
 * Template Name: ServicePage
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
 ?>
<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till main content section
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; //is_singular && pings_open ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
//page preloader
$preloader_enabled = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'preloader_enabled' ) : true;
$preloader_image   = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'preloader_image' ) : false;
if ( $preloader_enabled ) : ?>
	<!-- page preloader -->
	<div class="preloader">
		<div class="preloader_image to_animate" data-animation="pulse" <?php echo ( esc_attr($preloader_image )) ? ' style="background-image: url(' . esc_url( $preloader_image['url'] ) . ')"' : '' ?>></div>
	</div>
<?php endif; //preloader_enabled ?>

<!-- search modal -->
<div class="modal" tabindex="-1" role="dialog" aria-labelledby="search_modal" id="search_modal">
	<button type="button" class="close" data-dismiss="modal" aria-label="<?php esc_html_e('Close', 'dotdigital'); ?>">
		<span aria-hidden="true">
			<i class="rt-icon2-cross2"></i>
		</span>
	</button>
	<div class="widget widget_search">
		<?php get_search_form(); ?>
	</div>
</div>
<?php if (defined('FW')) : ?>
	<!-- Unyson messages modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="messages_modal">
		<div class="fw-messages-wrap ls with_padding">
			<?php FW_Flash_Messages::_print_frontend(); ?>
		</div>
	</div><!-- eof .modal -->
<?php endif; ?>

<!-- wrappers for visual page editor and boxed version of template -->
<?php
//light or dark version
$version            = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'version' ) : 'light';
$main_section_class = ( $version !== 'light' ) ? 'ls' : 'ls';

//get template style from ULR - for demo
if ( isset( $_GET[ 'version' ] ) ) {
	$main_section_class = esc_attr($_GET[ 'version' ]);
}
?>
<div id="canvas" class="wide">
	<div id="box_wrapper">
		<!-- template sections -->
		<?php

		$header = dotdigital_get_predefined_template_part( 'header' );
		get_template_part( 'template-parts/header/' . esc_attr( 'header-6' ) );
		
		if ( ! is_front_page() &  ! isset($_GET[ 'home_demo' ])) {
			$breadcrumbs = dotdigital_get_predefined_template_part( 'breadcrumbs' );
			get_template_part( 'template-parts/breadcrumbs/' . esc_attr( $breadcrumbs ) );
		}

		if ( ! is_home() ) {
			do_action( 'dotdigital_slider' );
		}

		if ( ! is_page_template( 'page-templates/full-width.php' )
             && ! is_page_template( 'page-templates/full-page.php' )
             &&  ! is_page_template( 'page-templates/service.php' )
             && ! is_singular( 'fw-services' )
		     && ! is_singular( 'fw-event' )
		     //not opening section if is single post with video format
			&& ! ( is_singular()
			&& ( get_post_format( get_queried_object_id() ) == 'video' ) )
		) : ?>
		<section class="<?php echo esc_attr( $main_section_class ); ?> page_content section_padding_top_90 section_padding_bottom_90 columns_padding_30">
			<div class="">
				<div class="row">
					<?php if ( is_home() ) { ?>
						<div class="blog-slider col-xs-12">
							<?php do_action( 'dotdigital_blog_slider') ; ?>
						</div>
					<?php } ?>
<?php endif; //!full-width ?>
<?php if ( ! defined( 'FW' ) ) : ?>
<div class="page_content">
	<?php
	endif; //FW check
	// Start the Loop.
	while ( have_posts() ) : the_post();
		// Include the page content template.
		if ( is_search() ) : ?>
            <div class="entry-summary">
				<?php the_excerpt(); ?>
            </div><!-- .entry-summary -->
		<?php
		else : ?>
            <div id="fullpage" class="fullpage-wrapper">
				<?php
				//hidding "more link" in content
				the_content(); ?>
            </div>
			<?php	wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'dotdigital' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		endif; //is_search
	endwhile;
	if ( ! defined( 'FW' ) ) : ?>
</div>
<?php
endif; //FW check
get_footer(); 
?>