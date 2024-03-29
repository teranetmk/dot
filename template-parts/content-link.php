<?php
/**
 * The default template for displaying link content
 *
 * Used for both single and index/archive/search.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$show_post_thumbnail = ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) ? false : true;

$post_categories   = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'post_categories' ) : 'yes';
$post_author   = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'post_author' ) : 'yes';
$post_date   = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'post_date' ) : 'yes';
$post_tags   = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'post_tags' ) : 'yes';

//single item layout
if ( is_singular() ) : ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'vertical-item content-padding with_background big-padding' ); ?>>
		<?php dotdigital_post_thumbnail(); ?>
        <div class="item-content">
			<?php
			the_content();
			?>
			<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links topmargin_30"><span class="page-links-title">' . esc_html__( 'Pages:', 'dotdigital' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
			?>
        </div><!-- .entry-content -->
        <div class="entry-meta ds with_padding">
            <div class="entry-avatar">
				<?php
				global $post;
				echo get_avatar( $post->post_author ); ?>
            </div>
			<?php if ( $post_author == 'yes' ) : ?>
            <div class="entry-author">
				<?php if ( 'post' == get_post_type() ) {
					dotdigital_posted_by();
				} ?>
            </div>
			<?php endif; ?><!-- .entry-author -->
			<?php if ( $post_date == 'yes' ) : ?>
            <div class="entry-date">
				<?php if ( 'post' == get_post_type() ) {
					dotdigital_posted_on();
				} ?>
            </div>
			<?php endif; ?><!-- .entry-date -->
            <div class="entry-blog-adds">
				<?php dotdigital_blog_adds() ?>
            </div><!-- eof .entry-blog-adds -->
			<?php if ( $post_tags == 'yes' ) : ?>
                <div class="entry-tags">
					<?php  esc_html_e( 'Tags:', 'dotdigital' ); ?>
					<?php the_tags( '<span class="tag-links">', ' ', '</span>' ); ?>
                </div>
			<?php endif; ?>	<!-- .item tags -->
            <div class="entry-blog-share">
				<?php dotdigital_post_adds() ?>
            </div><!-- eof .entry-blog-share -->
        </div><!-- .entry-meta -->
    </article><!-- #post-## -->
<?php
//eof single page layout
//blog feed layout
else:
	$post_categories   = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'post_categories' ) : false;
	$post_author   = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'post_author' ) : 'yes';
	$post_date   = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'post_date' ) : 'yes';
	$post_tags   = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'post_tags' ) : 'yes';
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'vertical-item content-padding big-padding with_background' ); ?>>
		<div class="item-content">
			<header class="entry-header">
				<?php if ( ! defined( 'FW' ) ) : ?>
                    <div  class="categories-links theme_buttons color color1 small_height"><?php echo get_the_category_list( _x( ' ', 'Used between list items, there is a space after the comma.', 'dotdigital' ) ); ?></div>
				<?php elseif ( defined( 'FW' ) && $post_categories == 'yes' ) :  ?>
					<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && dotdigital_categorized_blog() ) : ?>
                        <div class="categories-links theme_buttons color color1 small_height"><?php echo get_the_category_list( _x( ' ', 'Used between list items, there is a space after the comma.', 'dotdigital' ) ); ?></div>
					<?php endif; ?>
				<?php endif; ?>
                <!-- .item cats -->
				<?php
				the_title( '<h5 class="entry-title darklinks"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' );
				?>
			</header><!-- .entry-header -->

			<?php if ( is_search() ) : ?>
				<div class="entry-summary">
					<?php
					the_excerpt();
					?>
				</div><!-- .entry-summary -->
			<?php else : ?>
				<div class="entry-content">
					<?php
						//hidding "more link" in content
						the_content( esc_html__( 'Read more', 'dotdigital' ) );
					?>
				</div><!-- .entry-content -->
			<?php endif; //is_search 
			?>
		</div><!-- eof .item-content -->
        <div class="entry-meta ds with_padding">
            <div class="entry-avatar">
				<?php
				global $post;
				echo get_avatar( $post->post_author ); ?>
            </div>
			<?php if ( $post_author == 'yes' ) : ?>
            <div class="entry-author">
				<?php if ( 'post' == get_post_type() ) {
					dotdigital_posted_by();
				} ?>
            </div>
			<?php endif; ?><!-- .entry-author -->
			<?php if ( $post_date == 'yes' ) : ?>
            <div class="entry-date">
				<?php if ( 'post' == get_post_type() ) {
					dotdigital_posted_on();
				} ?>
            </div>
			<?php endif; ?><!-- .entry-date -->
            <div class="entry-blog-adds">
				<?php dotdigital_blog_adds() ?>
            </div><!-- eof .entry-blog-adds -->
            <div class="entry-blog-share">
				<?php dotdigital_post_adds() ?>
            </div><!-- eof .entry-blog-share -->
        </div><!-- .entry-meta -->
	</article><!-- #post-## -->
<?php endif;  //is singular