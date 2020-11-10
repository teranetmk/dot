<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * Single service loop item layout
 * also using as a default service view in a shortcode
 */

$ext_services_settings = fw()->extensions->get( 'services' )->get_settings();
$taxonomy_name = $ext_services_settings['taxonomy_name'];

$icon_array = fw_ext_services_get_icon_array();

?>
<div class="service_item vertical-item content-padding big-padding with_background text-center overflow-hidden loop-3">
	<div class="item-content">
        <div class="icon_wrap">
	        <?php if ( $icon_array['icon_type'] === 'image' ) : ?>
                <a class="permalink" href="<?php the_permalink(); ?>">
			        <?php echo wp_kses_post( $icon_array['icon_html'] ); ?>
                </a>
	        <?php else: //icon ?>
                <div class="teaser_icon highlight size_big border_icon">
                    <a class="permalink" href="<?php the_permalink(); ?>">
				        <?php echo wp_kses_post( $icon_array['icon_html'] ); ?>
                    </a>
                </div>
	        <?php endif; ?>
        </div>
		<h4 class="entry-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h4>
		<div class="excerpt">
			<?php the_excerpt(); ?>
		</div>
        <a href="<?php the_permalink(); ?>" class="read-more"><?php echo esc_html__('Read more', 'dotdigital'); ?></a>
	</div><!-- eof .item-content -->
</div><!-- eof .teaser -->
