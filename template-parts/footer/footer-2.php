<?php
/**
 * The template part for selected footer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$footer_image   = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'footer_image1' ) : ' ';
?>
<?php if( is_active_sidebar('sidebar-1-footer-alt') || is_active_sidebar('sidebar-2-footer-alt') || is_active_sidebar('sidebar-3-footer-alt') ) :?>
    <!--<div class="caetpfot">
        <div class="container">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="topcont">
                      <i class="fa fa-phone"></i>  0203-907-6868
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <footer id="footer" class="page_footer footer-2 section_padding_top_100 section_padding_bottom_150 columns_padding_25 ds"  <?php echo !empty( $footer_image['url'] ) ? ' style="background-image1: url('. esc_url( $footer_image['url']) .')"' : ' ' ?>>
        <div class="container">

            <div class="row">
                <div class="col-xs-12 col-md-4 text-center to_animate" data-animation="fadeInUp">
			        <?php dynamic_sidebar( 'sidebar-1-footer-alt' ); ?>
                </div>
                <div class="col-xs-12 col-md-4 text-center to_animate" data-animation="fadeInUp">
			        <?php dynamic_sidebar( 'sidebar-2-footer-alt' ); ?>
                </div>
                <div class="col-xs-12 col-md-4 text-center to_animate" data-animation="fadeInUp">
			        <?php dynamic_sidebar( 'sidebar-3-footer-alt' ); ?>
                </div>
               
            </div>

        </div>
    </footer><!-- .page_footer -->
  
<?php endif; ?>