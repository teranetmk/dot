<?php
/**
 * The template for displaying team taxonomy
 */
get_header();
//no columns on this page - giving true as a parameter to get column classes function
$column_classes = fw_ext_extension_get_columns_classes( true );

//getting taxonomy name
$ext_team_settings = fw()->extensions->get( 'team' )->get_settings();
$taxonomy_name     = $ext_team_settings['taxonomy_name'];

$categories = fw_ext_extension_get_listing_categories( array(), 'team' );
global $wp_query;
$sort_classes = fw_ext_extension_get_sort_classes( $wp_query->posts, $categories, '', 'team' );

//get taxonomy settings
$queried_object = get_queried_object();
$atts           = fw_get_db_term_option( $queried_object->term_taxonomy_id, $queried_object->taxonomy );

$unique_id = uniqid();
?>
<?php if ( $atts['team_layout'] == 'layout-1' || empty($atts['team_layout']) ) : ?>
    <div id="content" class="team-layout-1 team-list <?php echo esc_attr( $column_classes['main_column_class'] ); ?>">
		<?php
		//no need to show filters on category set check to 100 categories
		if ( count( $categories ) > 100 ) : ?>
            <div class="filters isotope_filters-<?php echo esc_attr( $unique_id ); ?> text-center">
                <a href="#" data-filter="*" class="selected"><?php esc_html_e( 'All', 'dotdigital' ); ?></a>
				<?php foreach ( $categories as $category ) : ?>
                    <a href="#"
                       data-filter=".<?php echo esc_attr( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></a>
				<?php endforeach; ?>
            </div><!-- eof isotope_filters -->
		<?php endif; //count subcategories check ?>
		<?php if ( have_posts() ) : ?>
            <div class="isotope_container topmargin_20 bottommargin_60 isotope row masonry-layout"
				<?php if ( count( $categories ) > 100 ) { ?>
                    data-filters=".isotope_filters-<?php echo esc_attr( $unique_id ); ?>"
				<?php } ?>
            >
				<?php
				while ( have_posts() ) : the_post();
					?>
                    <div
                            class="isotope-item bottommargin_20 col-lg-4 col-md-4 col-sm-12 <?php echo esc_attr( $sort_classes[ get_the_ID() ] ); ?>">
						<?php
						include( fw()->extensions->get( 'team' )->locate_view_path( 'loop-item' ) );
						?>
                    </div>
				<?php endwhile; ?>
            </div><!-- eof isotope_container -->
		<?php
		else :
			// If no content, include the "No posts found" template.
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
		<?php // Previous/next page navigation.
		$pagination = paginate_links( array(
			'prev_text' => esc_html__( 'Prev', 'dotdigital' ),
			'next_text' => esc_html__( 'Next', 'dotdigital' ),
			'type'      => 'list',
		) );
		if ( $pagination ) {
			echo '<nav class="pagination-nav">' . wp_kses_post( str_replace( 'page-numbers', 'page-numbers pagination', $pagination ) ) . '</nav>';
		}
		?>
    </div><!--eof #content -->
<?php elseif ( $atts['team_layout'] == 'layout-2' ) : ?>
    <div id="content" class="team-layout-2 team-list <?php echo esc_attr( $column_classes['main_column_class'] ); ?>">
		<?php if ( have_posts() ) : ?>
            <div class="topmargin_15 bottommargin_30 row">
				<?php
				while ( have_posts() ) : the_post();
					?>
                    <div
                            class="isotope-item bottommargin_20 col-sm-12">
						<?php
						include( fw()->extensions->get( 'team' )->locate_view_path( 'loop-item-2' ) );
						?>
                    </div>
				<?php endwhile; ?>
            </div><!-- eof isotope_container -->
		<?php
		else :
			// If no content, include the "No posts found" template.
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
		<?php // Previous/next page navigation.
		$pagination = paginate_links( array(
			'prev_text' => esc_html__( 'Prev', 'dotdigital' ),
			'next_text' => esc_html__( 'Next', 'dotdigital' ),
			'type'      => 'list',
		) );
		if ( $pagination ) {
			echo '<nav class="pagination-nav">' . wp_kses_post( str_replace( 'page-numbers', 'page-numbers pagination', $pagination ) ) . '</nav>';
		}
		?>
    </div><!--eof #content -->
<?php endif; ?>
<?php if ( $column_classes['sidebar_class'] ): ?>
    <!-- main aside sidebar -->
    <aside class="<?php echo esc_attr( $column_classes['sidebar_class'] ); ?>">
		<?php get_sidebar(); ?>
    </aside>
    <!-- eof main aside sidebar -->
<?php
endif;
get_footer();