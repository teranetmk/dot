<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * @var array $atts
 * @var array $posts
 */

$unique_id = uniqid();

$categories = fw_ext_extension_get_listing_categories( array(), 'services' );
$sort_classes = fw_ext_extension_get_sort_classes( $posts->posts, $categories, '', 'services' );

if ( $atts['show_filters'] ) : ?>
	<div class="filters carousel_filters-<?php echo esc_attr( $unique_id ); ?> text-center">
		<a href="#" data-filter="*" class="selected"><?php esc_html_e( 'All', 'dotdigital' ); ?></a>
		<?php
		foreach ( $categories as $category ) {
			?>
			<a href="#"
			   data-filter=".<?php echo esc_attr( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></a>
			<?php
		} //foreach
		?>
	</div>
	<?php
endif; //showfilters check

$autoplay = isset($atts['carousel_autoplay']) ? $atts['carousel_autoplay'] : true;
$autoplay_timeout = isset($atts['autoplay_timeout']) ? $atts['autoplay_timeout'] : 3000;
?>
<div
	class="owl-carousel shortcode-service <?php echo esc_attr( $atts['custom_class'] ); ?>"
	data-loop="true"
    data-autoplay="<?php echo esc_attr( $autoplay ); ?>"
    data-autoplaytimeout="<?php echo esc_attr( $autoplay_timeout ); ?>"
	data-nav="true"
	data-margin="<?php echo esc_attr( $atts['margin'] ); ?>"
	data-responsive-xs="<?php echo esc_attr( $atts['responsive_xs'] ); ?>"
	data-responsive-sm="<?php echo esc_attr( $atts['responsive_sm'] ); ?>"
	data-responsive-md="<?php echo esc_attr( $atts['responsive_md'] ); ?>"
	data-responsive-lg="<?php echo esc_attr( $atts['responsive_lg'] ); ?>"
	<?php if ( $atts['show_filters'] ) : ?>
		data-filters=".carousel_filters-<?php echo esc_attr( $unique_id ); ?>"
	<?php endif; // filters ?>
>
	<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
	<div class="owl-carousel-item <?php echo esc_attr( $sort_classes[get_the_ID()] ); ?>">
		<?php
            $item_template = isset( $atts['item_template']) ? $atts['item_template'] : 'loop-item';
			include( fw()->extensions->get( 'services' )->locate_view_path( $item_template ) );
		?>
	</div>
	<?php endwhile; ?>
	<?php wp_reset_postdata(); // reset the query ?>
</div>