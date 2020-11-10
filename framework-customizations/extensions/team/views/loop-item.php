<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * Single service loop item layout
 * also using as a default service view in a shortcode
 */

$ext_team_settings = fw()->extensions->get( 'team' )->get_settings();
$taxonomy_name = $ext_team_settings['taxonomy_name'];

$pID = get_the_ID();
$atts = fw_get_db_post_option($pID);

?>
<div class="vertical-item text-center content-padding big-padding with_background overflow-hidden ">

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="item-media">
			<?php
			$full_image_src = wp_get_attachment_url( get_post_thumbnail_id( $pID ) );
			the_post_thumbnail('dotdigital-square');
			?>
            <div class="media-links">
                <a class="abs-link" href="<?php the_permalink(); ?>"></a>
            </div>
		</div>
	<?php endif; //has_post_thumbnail ?>
	<div class="item-content">

		<h6 class="item-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h6>

		<?php if ( ! empty( $atts['position'] ) ) : ?>
			<p class="position highlight text-uppercase"><?php echo wp_kses_post( $atts['position'] ); ?></p>
		<?php endif; //position ?>

		<div class="desc">
			<?php the_excerpt(); ?>
		</div>

		<?php if ( ! empty( $atts['social_icons'] ) ) : ?>
			<div class="team-social-icons">
				<?php
				//get icons-social shortcode to render icons in team member item
				$shortcodes_extension = fw()->extensions->get( 'shortcodes' );
				if ( ! empty( $shortcodes_extension ) ) {
					echo fw_ext( 'shortcodes' )->get_shortcode( 'icons_social' )->render( array( 'social_icons' => $atts['social_icons'] ) );
				}
				?>
			</div><!-- eof social icons -->
		<?php endif; //social icons ?>
	</div>
</div><!-- eof .vertical-item -->
