<?php
/**
 * The template part for selected footer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$footer_image   = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'footer_image' ) : ' ';
?>
<!--
<div class="caetpfot">
        <div class="container">
            <div class="row">
                
                <div class="col-md-4">
                    <div class="topcont">
                     <a href="mailto:info@caebusinesssolutions.co.uk"><i class="fa fa-envelope"></i>  info@caebusinesssolutions.co.uk</a> 
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-6">
                    <div class="topcont">
                    <img src="https://asaevents.uk/business/wp-content/uploads/2019/04/arows.png">  <i class="fa fa-phone"></i>  0203-907-6868
                    </div>
                </div>
                
            </div>
        </div>
    </div> -->
<?php if( is_active_sidebar('sidebar-footer-1') ) :?>
    <footer id="footer" class="page_footer section_padding_top_50 section_padding_bottom_65 columns_padding_25 ds" <?php echo !empty( $footer_image['url'] ) ? ' style="background-image: url('. esc_url( $footer_image['url']) .')"' : ' ' ?>>
        <div class="left_part" <?php echo !empty( $footer_image['url'] ) ? ' style="background-image: url('. esc_url( $footer_image['url']) .')"' : ' ' ?>></div>
        <div class="right_part" <?php echo !empty( $footer_image['url'] ) ? ' style="background-image: url('. esc_url( $footer_image['url']) .')"' : ' ' ?>></div>
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
     <script>
    
    
        jQuery(window).scroll(function () {
    if(jQuery(window).scrollTop() < 1000) {

         jQuery('#slide-1-a').addClass('marg');
    }
       
    });
</script>
<style>
.marg{margin-top:100px;}
@media (max-width:600px){
    .marg {
    margin-top: 200px !important;
    margin-bottom: 100px;
}
}
</style>
<?php endif; ?>